<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;
use Cake\Utility\Text;
//use Cake\Filesystem\Folder;	// composer require cakephp/filesystem => nincs updatelve a packages-en

/**
 * Companies Controller
 *
 * @property \App\Model\Table\CompaniesTable $Companies
 */
class CompaniesController extends AppController
{
	//public $defaultOrder 	 = ['Pagecategories.name' => 'asc', 'Pages.pos' => 'asc'];	// For example
	public $defaultOrder 	 = ['id' => 'asc'];
	public $targetPath		 = '';
	public $logoDir			 = '';
	public $logoFilename	 = '';

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

		$this->logoDir = 'companies';
		$this->logoFilename = '_logo.';	// id . $this->logoFilename . ext;

		$this->set('logo_dir', $this->logoDir);		
		$this->set('logo_filename', $this->logoFilename);

		$this->targetPath = WWW_ROOT . 'img' . DS . $this->logoDir . DS;

		//$dir = new Folder($this->targetPath . 'xxx', true, 0775);
		if(!is_dir($this->targetPath)){
			mkdir($this->targetPath, 0775, true); // a 'true' rekurzív létrehozást jelent
		}
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

		$this->set('title', __('Browse the') . ': ' . __('Companies'));
		
		//$this->config['paginate_limit'] = 1000;
		$queryParams = $this->request->getQuery();
		$conditions 	 = [];		// Default conditions
		$page 		 	 = '1';
		$sort 		 	 = 'id';
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

		$this->paginate['Companies']['page'] 	= $page;
		
		if($sort !== null && $direction !== null){
			$this->paginate['Companies']['order'] 	= [$sort => $direction];
		}else{
			$this->paginate['Companies']['order'] 	= $this->defaultOrder;
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
			$query = $this->Companies->find()
				->contain(['Icons', 'Categories', 'Cities'])
				->where([
					//$conditions,
					'OR' => [
						'name LIKE' => '%' . $search .  '%',
						//'title LIKE' => '%' . $search .  '%',
						//'value' => (integer) $search,			// Must be convert to integer
					]
				]);
		}else{
			$query = $this->Companies->find()->contain(['Icons', 'Categories', 'Cities'])->where($conditions);
		}
		// ############################# /.QUERY ###########################################

		// ############################# PAGINATE ############################################
		try {
			$this->paginate['Companies']['limit'] = $this->config['paginate_limit'];
			$this->paginate['Companies']['maxLimit'] = $this->config['paginate_limit'];
			$companies = $this->paginate($query);
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

		if(empty($companies->toArray())){
			return $this->redirect(['action' => 'add']);
		}
		
		$this->set(compact('companies'));
    }

    /**
     * View method
     *
     * @param string|null $id Company id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		//Configure::write('Theme.admin.config.header_buttons_in_action.view', array_merge(Configure::read('Theme.admin.config.header_buttons_in_action.view'), 
		//	['back' => true, 'add' => true, 'edit' => true, 'save' => false, 'view' => false, 'delete' => true]
		//));

		try {
			$company = $this->Companies->get((int) $id, contain: ['Icons', 'Categories', 'Cities', 'Persons']);
		} catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) {
			$this->Flash->warning(__($exeption->getMessage()), ['plugin' => 'JeffAdmin5']);
			return $this->redirect(['action' => 'index']);
		}

		$this->set('title', __('View the') . ': ' . __('company') . ' ' . __('record'));
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
		$name = $company->name;
		$this->set(compact('company', 'id', 'name'));
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
		
		$this->set('title', __('Add new') . ': ' . __('company') . ' ' . __('record'));
        $company = $this->Companies->newEmptyEntity();
        if ($this->request->is('post')) {
			$data = $this->request->getData();
			//debug($data);
            $company = $this->Companies->patchEntity($company, $data);

			// 1. A fájl objektum lekérése
			$logo = $this->request->getData('logo');
			//dd($logo);

			$company->action = 'add';
			//$company->name_slug = Text::slug(strtolower($company->name), ' ');
			//$company->description_slug = Text::slug(strtolower($company->name), ' ');
			//$company->keywords_slug = Text::slug(strtolower($company->name), ' ');
				
			//dd($company);
			/*
				if(...){
					$company->setErrors('field', __('Message'));
				}
			*/
			//dd($company->getErrors());
            if (!$company->hasErrors() && $this->Companies->save($company)) {
                //$this->Flash->success(__('The company has been saved.'), ['plugin' => 'JeffAdmin5']);
                $this->Flash->success(__('The save has been: OK'), ['plugin' => 'JeffAdmin5']);
				$this->session->write('Layout.' . $this->controller . '.LastId', $company->id);

                //return $this->redirect(['action' => 'add']);
                return $this->redirect([
					'controller' => $this->controller,
					'action' => 'index',
					'#' => $company->id
				]);

            }
            $this->Flash->error(__('The save has been not. Please check the datas and try again.'), ['plugin' => 'JeffAdmin5']);
        }
        $icons = $this->Companies->Icons->find('list', conditions: ['visible' => true], limit: 200, order: ['pos' => 'asc', 'name' => 'asc'])->all();
        $categories = $this->Companies->Categories->find('list', conditions: ['visible' => true], limit: 200, order: ['pos' => 'asc', 'name' => 'asc'])->all();
		//																Magyarország, Baranya
        $cities = $this->Companies->Cities->find('list', conditions: ['Cities.country_id' => 1, 'Cities.county_id' => 3], limit: 5000, order: ['name' => 'asc'])->all();
        $this->set(compact('company', 'icons', 'categories', 'cities'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Company id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		//Configure::write('Theme.admin.config.header_buttons_in_action.edit', array_merge(Configure::read('Theme.admin.config.header_buttons_in_action.edit'), 
		//	['back' => true, 'add' => true, 'edit' => false, 'save' => true, 'view' => true, 'delete' => true]
		//));

		try {
			$company = $this->Companies->get((int) $id, contain: []);
		} catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) {
			$this->Flash->warning(__($exeption->getMessage()), ['plugin' => 'JeffAdmin5']);
			return $this->redirect(['action' => 'index']);
		}

		$this->set('title', __('Edit the') . ': ' . __('company') . ' ' . __('record'));
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
			
		if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
			//dd($data);
			$company = $this->Companies->patchEntity($company, $data);
			//dd($company);

			$company->action = 'upd';
			$company->name_slug = Text::slug(strtolower($company->name), ' ');
			$company->description_slug = Text::slug(strtolower($company->name), ' ');
			$company->keywords_slug = Text::slug(strtolower($company->name), ' ');
			//dd($company);
			/*
				if(...){
					$company->setError('field', __('Message'));
				}
			*/

			$file_logo = $this->request->getData('file_logo');

			if ($file_logo instanceof \Laminas\Diactoros\UploadedFile && $file_logo->getError() === UPLOAD_ERR_OK) {
				$ext_logo = pathinfo($file_logo->getClientFilename(), PATHINFO_EXTENSION);

				//$logo_file_name = $file->getClientFilename();
				$logo_file_name = $company->id . $this->logoFilename . $ext_logo;

				$company->logo = $logo_file_name;
				$company->logo_ext = $ext_logo;
			}

			//dd($company->getErrors());
			$company->setErrors($company->getErrors());
			if (!$company->hasErrors() && $this->Companies->save($company)) {
				if ($file_logo instanceof \Laminas\Diactoros\UploadedFile && $file_logo->getError() === UPLOAD_ERR_OK) {
					if(file_exists($this->targetPath . $logo_file_name)){
						unlink($this->targetPath . $logo_file_name);
					}

					$file_logo->moveTo($this->targetPath . $logo_file_name);

					chmod($this->targetPath . $logo_file_name, 0664);
				}

				$this->Flash->success(__('The save has been: OK'), ['plugin' => 'JeffAdmin5']);

				//return $this->redirect(['action' => 'index']);
				return $this->redirect([
					'controller' => $this->controller,
					'action' => 'index',
					'#' => $company->id
				]);

			}
			$this->Flash->error(__('The save has been not. Please check the datas and try again.'), ['plugin' => 'JeffAdmin5']);
        }
        $icons = $this->Companies->Icons->find('list', conditions: ['visible' => true], limit: 200, order: ['pos' => 'asc', 'name' => 'asc'])->all();
        $categories = $this->Companies->Categories->find('list', conditions: ['visible' => true], limit: 200, order: ['pos' => 'asc', 'name' => 'asc'])->all();
		//																Magyarország, 					Baranya
        $cities = $this->Companies->Cities->find('list', conditions: ['Cities.country_id' => 1, 'Cities.county_id' => 3], limit: 5000, order: ['name' => 'asc'])->all();
		$name = $company->name;
        $this->set(compact('company', 'icons', 'categories', 'cities', 'id', 'name'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Company id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$this->request->allowMethod(['post', 'delete']);

		try {
			$company = $this->Companies->get((int) $id);
		} catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) {
			$this->Flash->warning(__($exeption->getMessage()), ['plugin' => 'JeffAdmin5']);
			return $this->redirect(['action' => 'index']);
		}

		if ($this->Companies->delete($company)) {
			$this->session->delete('Layout.' . $this->controller . '.LastId');
			//$this->Flash->success(__('The company has been deleted.'), ['plugin' => 'JeffAdmin5']);
			$this->Flash->success(__('The has been deleted.'), ['plugin' => 'JeffAdmin5']);
		} else {
			//$this->Flash->error(__('The company could not be deleted. Please, try again.'), ['plugin' => 'JeffAdmin5']);
			$this->Flash->error(__('The has been deleted. Please check the datas and try again.'), ['plugin' => 'JeffAdmin5']);
		}

        return $this->redirect(['action' => 'index']);
    }
}
