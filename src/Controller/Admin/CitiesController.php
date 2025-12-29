<?php
declare(strict_types=1);

namespace App\Controller\Admin;


use App\Controller\Admin\AppController;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * Cities Controller
 *
 * @property \App\Model\Table\CitiesTable $Cities
 */
class CitiesController extends AppController
{
	//public $defaultOrder 	 = ['Pagecategories.name' => 'asc', 'Pages.pos' => 'asc'];	// For example
	public $defaultOrder 	 = ['id' => 'asc'];

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

	}

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($clearFilter = null)
    {
		//Configure::write('Theme.admin.config.header_buttons_in_action.index', array_merge(Configure::read('Theme.admin.config.header_buttons_in_action.index'), 
		//	['back' => false, 'add' => true, 'edit' => false, 'save' => false, 'view' => false, 'delete' => false]
		//));

		$this->set('title', __('Browse the') . ': ' . __('Cities'));
		
		//$this->config['paginate_limit'] = 1000;
		$queryParams = $this->request->getQuery();
		$conditions 	 = ['Cities.country_id' => 1, 'Cities.county_id' => 3];		// Default conditions
		$page 		 	 = '1';
		$sort 		 	 = 'name';
		$direction 	 	 = 'asc';
		$showSearchBar	 = false;
		$searchInSession = '';
		$search 	 	 = '';		

		if ($clearFilter == 'clear-filter'){
			if($this->session->check('Layout.' . $this->controller . '.search')){
				$this->session->delete('Layout.' . $this->controller . '.search');
			}
			$showSearchBar	 = true;
		}

		// ############################# SORT ORDER & PAGE ###############################
		if($this->session->check('Layout.' . $this->controller . '.queryparams')){
			$this->queryParamsInSession = json_decode($this->session->read('Layout.' . $this->controller . '.queryparams'));
		}
		
		if(isset($this->queryParamsInSession->page)){
			$page = $this->queryParamsInSession->page;
		}
		
		if(isset($this->queryParamsInSession->sort)){
			$sort = $this->queryParamsInSession->sort;
		}
		
		if(isset($this->queryParamsInSession->direction)){
			$direction = $this->queryParamsInSession->direction;
		}

		if(isset($queryParams['page'])){
			$this->queryParamsInSession->page = $queryParams['page'];
			$page = $this->queryParamsInSession->page;
		}

		if(isset($queryParams['sort'])){
			$this->queryParamsInSession->sort = $queryParams['sort'];
			$sort = $this->queryParamsInSession->sort;
		}

		if(isset($queryParams['direction'])){
			$this->queryParamsInSession->direction = $queryParams['direction'];
			$direction = $this->queryParamsInSession->direction;
		}

		if(!empty($this->queryParamsInSession)){
			$this->session->write('Layout.' . $this->controller . '.queryparams', json_encode($this->queryParamsInSession));
		}

		if($page === null){
			return $this->redirect(['controller' => $this->controller, 'action' => 'index', '?' => array_merge(['page' => 1], $queryParams) ]);
		}

		$this->paginate['Cities']['page'] 	= $page;
		
		if($sort !== null && $direction !== null){
			$this->paginate['Cities']['order'] 	= [$sort => $direction];
		}else{
			$this->paginate['Cities']['order'] 	= $this->defaultOrder;
		}
		
		// ############################# /.SORT ORDER & PAGE ###############################

		// ############################# SEARCH ############################################
		$search = '';
		if($this->session->check('Layout.' . $this->controller . '.search')){
			$search = $this->session->read('Layout.' . $this->controller . '.search');
		}

		if ($this->request->is('post')) {
			$search = $this->request->getData()['search'];
			$this->session->write('Layout.' . $this->controller . '.search', $search);
		}
		// ############################# /.SEARCH ############################################		

		// ############################# QUERY #############################################
		if($search !== ''){
			$showSearchBar	 = true;
			$query = $this->Cities->find()
				->contain(['Countries', 'Counties'])
				->where([
					//$conditions,
					'OR' => [
						'name LIKE' => '%' . $search .  '%',
						//'title LIKE' => '%' . $search .  '%',
						//'value' => (integer) $search,			// Must be convert to integer
					]
				]);
		}else{
			$query = $this->Cities->find()->contain(['Countries', 'Counties'])->where($conditions);
		}
		// ############################# /.QUERY ###########################################


		// ############################# PAGINATE ############################################
		try {
			$this->paginate['Cities']['limit'] = $this->config['paginate_limit'];
			$this->paginate['Cities']['maxLimit'] = $this->config['paginate_limit'];
			$cities = $this->paginate($query);
		} catch (NotFoundException $e) {
			// Do something here like redirecting to first or last page.
			// $e->getPrevious()->getAttributes('pagingParams') will give you required info.
			$this->Flash->warning(__($e->getMessage()), ['plugin' => 'JeffAdmin5']);
			$paging = $e->getPrevious()->getAttributes('pagingParams')['pagingParams'];
			$requestedPage = $paging['requestedPage'];

			// HU: Ha érvénytelen oldalra akar lapozni az URL-ben, akkor az 1. oldalra irányít át.
			// EN: If you want to page to an invalid page in the URL, it redirects to page 1.
			if ($paging['pageCount'] < $paging['requestedPage']){
                return $this->redirect([
					'controller' => $this->controller,
					'action' => 'index',
					'?' => [
						'page'		=> $paging['pageCount'],
						'direction'	=> $direction ?? null,
						'sort'		=> $sort ?? null,
					],
					//'#' => 3
				]);
			}
		}
		// ############################# /.PAGINATE ##########################################

        $this->set('search', $search);
        $this->set('showSearchBar', $showSearchBar);

		if(empty($cities->toArray())){
			return $this->redirect(['action' => 'add']);
		}
		
		$this->set(compact('cities'));
    }

    /**
     * View method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		//Configure::write('Theme.admin.config.header_buttons_in_action.view', array_merge(Configure::read('Theme.admin.config.header_buttons_in_action.view'), 
		//	['back' => true, 'add' => true, 'edit' => true, 'save' => false, 'view' => false, 'delete' => true]
		//));

		try {
			$city = $this->Cities->get((int) $id, contain: ['Countries', 'Counties', 'Companies']);
		} catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) {
			$this->Flash->warning(__($exeption->getMessage()), ['plugin' => 'JeffAdmin5']);
			return $this->redirect(['action' => 'index']);
		}

		$this->set('title', __('View the') . ': ' . __('city') . ' ' . __('record'));
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
		$name = $city->name;
		$this->set(compact('city', 'id', 'name'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		//Configure::write('Theme.admin.config.header_buttons_in_action.add', array_merge(Configure::read('Theme.admin.config.header_buttons_in_action.add'), 
		//	['back' => true, 'add' => false, 'edit' => false, 'save' => true, 'view' => false, 'delete' => false]
		//));
		
		$this->set('title', __('Add new') . ': ' . __('city') . ' ' . __('record'));
        $city = $this->Cities->newEmptyEntity();
        if ($this->request->is('post')) {
			$data = $this->request->getData();
			//debug($data);
            $city = $this->Cities->patchEntity($city, $data);
			//dd($city);
			/*
				if(...){
					$city->setErrors('field', __('Message'));
				}
			*/
			//dd($city->getErrors());
            if (!$city->hasErrors() && $this->Cities->save($city)) {
                //$this->Flash->success(__('The city has been saved.'), ['plugin' => 'JeffAdmin5']);
                $this->Flash->success(__('The save has been: OK'), ['plugin' => 'JeffAdmin5']);
				$this->session->write('Layout.' . $this->controller . '.LastId', $city->id);

                //return $this->redirect(['action' => 'add']);
                return $this->redirect([
					'controller' => $this->controller,
					'action' => 'index',
					'#' => $city->id
				]);

            }
            //$this->Flash->error(__('The city could not be saved. Please, try again.'), ['plugin' => 'JeffAdmin5']);
            $this->Flash->error(__('The save has been not. Please check the datas and try again.'), ['plugin' => 'JeffAdmin5']);
        }
        $countries = $this->Cities->Countries->find('list', conditions: ['visible' => true], limit: 200, order: ['pos' => 'asc', 'name' => 'asc'])->all();
        $counties = $this->Cities->Counties->find('list', conditions: ['visible' => true], limit: 200, order: ['pos' => 'asc', 'name' => 'asc'])->all();
        $this->set(compact('city', 'countries', 'counties'));
    }

    /**
     * Edit method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		//Configure::write('Theme.admin.config.header_buttons_in_action.edit', array_merge(Configure::read('Theme.admin.config.header_buttons_in_action.edit'), 
		//	['back' => true, 'add' => true, 'edit' => false, 'save' => true, 'view' => true, 'delete' => true]
		//));

		try {
			$city = $this->Cities->get((int) $id, contain: []);
		} catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) {
			$this->Flash->warning(__($exeption->getMessage()), ['plugin' => 'JeffAdmin5']);
			return $this->redirect(['action' => 'index']);
		}

		$this->set('title', __('Edit the') . ': ' . __('city') . ' ' . __('record'));
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
			
		if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
			//debug($data);
			$city = $this->Cities->patchEntity($city, $data);
			//dd($city);
			/*
				if(...){
					$city->setError('field', __('Message'));
				}
			*/
			//dd($city->getErrors());
			if (!$city->hasErrors() && $this->Cities->save($city)) {
				//$this->Flash->success(__('The city has been saved.'), ['plugin' => 'JeffAdmin5']);
				$this->Flash->success(__('The save has been: OK'), ['plugin' => 'JeffAdmin5']);

				//return $this->redirect(['action' => 'index']);
				return $this->redirect([
					'controller' => $this->controller,
					'action' => 'index',
					'#' => $city->id
				]);

			}
			//$this->Flash->error(__('The city could not be saved. Please, try again.'), ['plugin' => 'JeffAdmin5']);
			$this->Flash->error(__('The save has been not. Please check the datas and try again.'), ['plugin' => 'JeffAdmin5']);
        }
        $countries = $this->Cities->Countries->find('list', conditions: ['visible' => true], limit: 200, order: ['pos' => 'asc', 'name' => 'asc'])->all();
        $counties = $this->Cities->Counties->find('list', conditions: ['visible' => true], limit: 200, order: ['pos' => 'asc', 'name' => 'asc'])->all();
		$name = $city->name;
        $this->set(compact('city', 'countries', 'counties', 'id', 'name'));
    }

    /**
     * Delete method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$this->request->allowMethod(['post', 'delete']);

		try {
			$city = $this->Cities->get((int) $id);
		} catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) {
			$this->Flash->warning(__($exeption->getMessage()), ['plugin' => 'JeffAdmin5']);
			return $this->redirect(['action' => 'index']);
		}

		if ($this->Cities->delete($city)) {
			$this->session->delete('Layout.' . $this->controller . '.LastId');
			//$this->Flash->success(__('The city has been deleted.'), ['plugin' => 'JeffAdmin5']);
			$this->Flash->success(__('The has been deleted.'), ['plugin' => 'JeffAdmin5']);
		} else {
			//$this->Flash->error(__('The city could not be deleted. Please, try again.'), ['plugin' => 'JeffAdmin5']);
			$this->Flash->error(__('The has been deleted. Please check the datas and try again.'), ['plugin' => 'JeffAdmin5']);
		}

        return $this->redirect(['action' => 'index']);
    }
}
