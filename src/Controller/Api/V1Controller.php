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
		$categories = $this->Categories->find()->select(['Categories.id', 'Categories.icon_id', 'Categories.name', 'Categories.description']);
		$searchTerm = $this->request->getQuery('q');
        $conditions = ['company_count > ' => 0];
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

		$this->set([
			'success' => true,
			'count' => $categories->count(),	//count((array) $categories),
			'data' => $categories,
		]);
		$this->viewBuilder()->setOption('serialize', ['success', 'count', 'data']);
    }

    public function companies($category_id)
    {
        //dd($category_id);

        $conditions = ['category_id' => $category_id];

        $categories = $this->Companies->find()->contain(['Cities'])->select([
            'Companies.id', 'Companies.icon_id', 'Companies.name', 'Companies.description', 
            'Cities.name', 'Cities.zip',
            'Companies.address', 'Companies.house_number',
            'Companies.phone', 'Companies.phone2', 'Companies.web', 'Companies.email',
            'Companies.google_map_url', 'Companies.longitude', 'Companies.latitude'
        ]);
        //dd($categories);
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

        $categories->where($conditions)->all();

		$this->set([
			'success' => true,
			'count' => $categories->count(),	//count((array) $categories),
			'data' => $categories,
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