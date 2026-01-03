<?php
// src/Controller/RecipesController.php
	//use Cake\View\JsonView;

namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\View\JsonView;

class V1Controller extends AppController
{
	public $Categories;
	public $Companies;
    public $Persons;

    public function viewClasses(): array
    {
        return [JsonView::class];
    }

	public function initialize(): void
	{
		parent::initialize();		
		$this->Categories = $this->fetchTable('Categories');
		$this->Companies = $this->fetchTable('Companies');
		$this->Persons = $this->fetchTable('Persons');
    }

    public function categories()
    {
		$categories = $this->Categories->find()->contain(['Icons'])->select(['Categories.id', 'Categories.icon_id', 'Icons.ext', 'Categories.name', 'Categories.description']);
		$searchTerm = $this->request->getQuery('q');
        $conditions = ['Categories.company_count > ' => 0];
        if (!empty($searchTerm)) {
            $searchTerm = str_replace(' ', '%', $searchTerm);
            $searchTerm = str_replace('-', '%', $searchTerm);
            $searchTerm = str_replace('_', '%', $searchTerm);
            $searchTerm = str_replace('*', '%', $searchTerm);
            $searchTerm = str_replace('?', '%', $searchTerm);
            $searchTerm = str_replace('!', '%', $searchTerm);
            $searchTerm = str_replace('@', '%', $searchTerm);
            $searchTerm = str_replace('#', '%', $searchTerm);
            $searchTerm = str_replace('$', '%', $searchTerm);
			$conditions[] = [
                'OR' => [
                    ['Categories.name LIKE' => '%' . $searchTerm . '%'],
                    ['Categories.name_slug LIKE' => '%' . $searchTerm . '%'],
                    ['Categories.keywords LIKE' => '%' . $searchTerm . '%'],
                    ['Categories.keywords_slug LIKE' => '%' . $searchTerm . '%'],
                    ['Categories.description LIKE' => '%' . $searchTerm . '%'],
                    ['Categories.description_slug LIKE' => '%' . $searchTerm . '%'],
                ]
            ];
        }
        $categories->where($conditions)->all();

        $response = [];
        foreach ($categories as $category){
            $response[] = [
                'id' => $category->id,
                'icon_id' => $category->icon_id,
                'icon_ext' => $category->icon->ext,
                'name' => $category->name,
                'description' => $category->description,                
            ];
        }

		$this->set([
			'success' => true,
			'count' => count($response),	//count((array) $categories),
			'data' => $response,
		]);
		$this->viewBuilder()->setOption('serialize', ['success', 'count', 'data']);
    }

    public function companies($category_id)
    {
        //dd($category_id);

        $conditions = ['Companies.category_id' => $category_id];

        $companies = $this->Companies->find()->contain(['Icons', 'Cities'])->select([
            'Companies.id', 'Companies.icon_id', 'Icons.ext', 'Companies.name', 'Companies.description', 
            'Cities.zip', 'Cities.name', 
            'Companies.address', 'Companies.house_number',
            'Companies.phone', 'Companies.phone2', 'Companies.web', 'Companies.email',
            'Companies.google_map_url', 'Companies.longitude', 'Companies.latitude'
        ]);
        //dd($companies);
        $searchTerm = $this->request->getQuery('q');
		if (!empty($searchTerm)) {
            $searchTerm = str_replace(' ', '%', $searchTerm);
            $searchTerm = str_replace('-', '%', $searchTerm);
            $searchTerm = str_replace('_', '%', $searchTerm);
            $searchTerm = str_replace('*', '%', $searchTerm);
            $searchTerm = str_replace('?', '%', $searchTerm);
            $searchTerm = str_replace('!', '%', $searchTerm);
            $searchTerm = str_replace('@', '%', $searchTerm);
            $searchTerm = str_replace('#', '%', $searchTerm);
            $searchTerm = str_replace('$', '%', $searchTerm);
			$conditions[] = [
                'OR' => [
                    ['Companies.name LIKE' => '%' . $searchTerm . '%'],
                    ['Companies.name_slug LIKE' => '%' . $searchTerm . '%'],
                    ['Companies.keywords LIKE' => '%' . $searchTerm . '%'],
                    ['Companies.keywords_slug LIKE' => '%' . $searchTerm . '%'],
                    ['Companies.description LIKE' => '%' . $searchTerm . '%'],
                    ['Companies.description_slug LIKE' => '%' . $searchTerm . '%'],
                ]
            ];
		}

        $companies->where($conditions)->all();

        $response = [];
        foreach ($companies as $company){
            $response[] = [
                'id' => $company->id,
                'icon_id' => $company->icon_id,
                'icon_ext' => $company->icon->ext,
                'name' => $company->name,
                'description' => $company->description,
                'city_zip' => $company->city->zip,
                'city_name' => $company->city->name,
                'address' => $company->address,
                'house_number' => $company->house_number,
                'phone' => $company->phone,
                'phone2' => $company->phone2,
                'web' => $company->web,
                'email' => $company->email,
                'google_map_url' => $company->google_map_url,
                'longitude' => $company->longitude,
                'latitude' => $company->latitude,
            ];
        }

		$this->set([
			'success' => true,
			'count' => count($response),
			'data' => $response,
		]);
		$this->viewBuilder()->setOption('serialize', ['success', 'count', 'data']);
    }

    public function persons($company_id = null)
    {
		$categories = $this->Persons->find()->select([
            'Persons.id', 'Persons.icon_id', 'Persons.name', 'Persons.description',
            'Persons.opening_time', 'Persons.phone', 'Persons.phone2', 'Persons.Phone3', 'Persons.phone4', 'Persons.phone5',
            'Persons.email', 'Persons.email2', 'Persons.web', 'Persons.facebook', 'Persons.youtube'
        ]);
        $searchTerm = $this->request->getQuery('q');
        $conditions = ['company_id' => $company_id];
		if (!empty($searchTerm)) {
            $searchTerm = str_replace(' ', '%', $searchTerm);
            $searchTerm = str_replace('-', '%', $searchTerm);
            $searchTerm = str_replace('_', '%', $searchTerm);
            $searchTerm = str_replace('*', '%', $searchTerm);
            $searchTerm = str_replace('?', '%', $searchTerm);
            $searchTerm = str_replace('!', '%', $searchTerm);
            $searchTerm = str_replace('@', '%', $searchTerm);
            $searchTerm = str_replace('#', '%', $searchTerm);
            $searchTerm = str_replace('$', '%', $searchTerm);
			$categories->where([
                'OR' => [
                    ['Persons.name LIKE' => '%' . $searchTerm . '%'],
                    ['Persons.name_slug LIKE' => '%' . $searchTerm . '%'],
                    ['Persons.keywords LIKE' => '%' . $searchTerm . '%'],
                    ['Persons.keywords_slug LIKE' => '%' . $searchTerm . '%'],
                    ['Persons.description LIKE' => '%' . $searchTerm . '%'],
                    ['Persons.description_slug LIKE' => '%' . $searchTerm . '%'],
                ]
            ]);
		}

		$categories->all();
		$this->set([
			'success' => true,
			'count' => $categories->count(),	//count((array) $categories),
			'data' => $categories,
		]);
		$this->viewBuilder()->setOption('serialize', ['success', 'count', 'data']);
    }


}

?>