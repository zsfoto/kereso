<?php
// src/Controller/RecipesController.php
	//use Cake\View\JsonView;

namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\View\JsonView;

class V1Controller extends AppController
{
	public $Categories;
	
    public function viewClasses(): array
    {
        return [JsonView::class];
    }

	public function initialize(): void
	{
		parent::initialize();
		
		$this->Categories = $this->fetchTable('Categories');;		
    }


	// http://kereso.loc/ker/api/v1/index.json?q=dok
    public function index()
    {
		// 1. Paraméter beolvasása a kérésből
		$searchTerm = $this->request->getQuery('q');

		// Ellenőrzés: ha van keresőszó, de rövidebb 3 karakternél
		//if ($searchTerm !== null && mb_strlen($searchTerm) < 3) {
		//	$this->set([
		//		'success' => false,
		//		'message' => 'A keresési kifejezésnek legalább 3 karakternek kell lennie.'
		//	]);
		//	$this->response = $this->response->withStatus(400); // Hibás kérés állapotkód
		//	$this->viewBuilder()->setOption('serialize', ['success', 'message']);
		//	return;
		//}

		// 2. Lekérdezés indítása a modellen
		$categories = $this->Categories->find()->contain(['Icons', 'Companies' => ['Persons']]);

		// 3. Feltétel hozzáadása, ha van keresési kifejezés
		if (!empty($searchTerm)) {
			$categories->where([
                'OR' => [
                    ['Categories.name LIKE' => '%' . $searchTerm . '%'],
                    ['Categories.name_slug LIKE' => '%' . $searchTerm . '%'],
                    ['Categories.keywords LIKE' => '%' . $searchTerm . '%'],
                    ['Categories.keywords_slug LIKE' => '%' . $searchTerm . '%'],

                    //['Companies.name LIKE' => '%' . $searchTerm . '%'],
                    //['Companies.name_slug LIKE' => '%' . $searchTerm . '%'],
                    //['Companies.keywords LIKE' => '%' . $searchTerm . '%'],
                    //['Companies.keywords_slug LIKE' => '%' . $searchTerm . '%'],

                    //['Persons.name LIKE' => '%' . $searchTerm . '%'],
                    //['Persons.name_slug LIKE' => '%' . $searchTerm . '%'],
                    //['Persons.keywords LIKE' => '%' . $searchTerm . '%'],
                    //['Persons.keywords_slug LIKE' => '%' . $searchTerm . '%'],

                ]
            ]);
		}

		$categories->all();

		//dd(count($categories));

		// 4. JSON válasz összeállítása
		$this->set([
			'success' => true,
			'count' => $categories->count(),	//count((array) $categories),
			'data' => $categories,
		]);
		$this->viewBuilder()->setOption('serialize', ['success', 'count', 'data']);
		
		/*
        $categories = $this->Categories->find('all')->all();

        $this->set('categories', $categories);
        $this->viewBuilder()->setOption('serialize', ['categories']);
		*/
    }

    public function view($id)
    {
        $recipe = $this->Recipes->get($id);
        $this->set('recipe', $recipe);
        $this->viewBuilder()->setOption('serialize', ['recipe']);
    }

    public function add()
    {
        $this->request->allowMethod(['post', 'put']);
        $recipe = $this->Recipes->newEntity($this->request->getData());
        if ($this->Recipes->save($recipe)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'recipe' => $recipe,
        ]);
        $this->viewBuilder()->setOption('serialize', ['recipe', 'message']);
    }

    public function edit($id)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $recipe = $this->Recipes->get($id);
        $recipe = $this->Recipes->patchEntity($recipe, $this->request->getData());
        if ($this->Recipes->save($recipe)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'recipe' => $recipe,
        ]);
        $this->viewBuilder()->setOption('serialize', ['recipe', 'message']);
    }

    public function delete($id)
    {
        $this->request->allowMethod(['delete']);
        $recipe = $this->Recipes->get($id);
        $message = 'Deleted';
        if (!$this->Recipes->delete($recipe)) {
            $message = 'Error';
        }
        $this->set('message', $message);
        $this->viewBuilder()->setOption('serialize', ['message']);
    }
}

?>