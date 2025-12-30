<?php
declare(strict_types=1);

namespace App\Controller\Admin;


use App\Controller\Admin\AppController;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * Icons Controller
 *
 * @property \App\Model\Table\IconsTable $Icons
 */
class IconsController extends AppController
{
	//public $defaultOrder 	 = ['Pagecategories.name' => 'asc', 'Pages.pos' => 'asc'];	// For example
	public $defaultOrder 	 = ['id' => 'asc'];
	public $targetPath		 = '';
	public $iconDir			 = '';
	public $iconFilename	 = '';

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

		$this->iconDir 		= 'icons';
		$this->iconFilename = '_icon.';	// id . $this->iconFilename . ext;

		$this->set('icon_dir', $this->iconDir);		
		$this->set('icon_filename', $this->iconFilename);

		$this->targetPath = WWW_ROOT . 'img' . DS . $this->iconDir . DS;

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

		$this->set('title', __('Browse the') . ': ' . __('Icons'));
		
		$this->config['paginate_limit'] = 100;
		$queryParams 	 = $this->request->getQuery();
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

		$this->paginate['Icons']['page'] 	= $page;
		
		if($sort !== null && $direction !== null){
			$this->paginate['Icons']['order'] 	= [$sort => $direction];
		}else{
			$this->paginate['Icons']['order'] 	= $this->defaultOrder;
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
			$query = $this->Icons->find()
				->where([
					//$conditions,
					'OR' => [
						'name LIKE' => '%' . $search .  '%',
						//'title LIKE' => '%' . $search .  '%',
						//'value' => (integer) $search,			// Must be convert to integer
					]
				]);
		}else{
			$query = $this->Icons->find()->where($conditions);
		}
		// ############################# /.QUERY ###########################################


		// ############################# PAGINATE ############################################
		try {
			$this->paginate['Icons']['limit'] = $this->config['paginate_limit'];
			$this->paginate['Icons']['maxLimit'] = $this->config['paginate_limit'];
			$icons = $this->paginate($query);
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

		if(empty($icons->toArray())){
			return $this->redirect(['action' => 'add']);
		}
		
		$this->set(compact('icons'));
    }

    /**
     * View method
     *
     * @param string|null $id Icon id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		//Configure::write('Theme.admin.config.header_buttons_in_action.view', array_merge(Configure::read('Theme.admin.config.header_buttons_in_action.view'), 
		//	['back' => true, 'add' => true, 'edit' => true, 'save' => false, 'view' => false, 'delete' => true]
		//));

		try {
			$icon = $this->Icons->get((int) $id, contain: ['Categories', 'Companies', 'Persons']);
		} catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) {
			$this->Flash->warning(__($exeption->getMessage()), ['plugin' => 'JeffAdmin5']);
			return $this->redirect(['action' => 'index']);
		}

		$this->set('title', __('View the') . ': ' . __('icon') . ' ' . __('record'));
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
		$name = $icon->name;
		$this->set(compact('icon', 'id', 'name'));
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
		
		$this->set('title', __('Add new') . ': ' . __('icon') . ' ' . __('record'));
        $icon = $this->Icons->newEmptyEntity();
        if ($this->request->is('post')) {
			$data = $this->request->getData();
			//debug($data);
            $icon = $this->Icons->patchEntity($icon, $data);
			//dd($icon);
			/*
				if(...){
					$icon->setErrors('field', __('Message'));
				}
			*/
			//dd($icon->getErrors());
            if (!$icon->hasErrors() && $this->Icons->save($icon)) {
                //$this->Flash->success(__('The icon has been saved.'), ['plugin' => 'JeffAdmin5']);
                $this->Flash->success(__('The save has been: OK'), ['plugin' => 'JeffAdmin5']);
				$this->session->write('Layout.' . $this->controller . '.LastId', $icon->id);

                //return $this->redirect(['action' => 'add']);
                return $this->redirect([
					'controller' => $this->controller,
					'action' => 'index',
					'#' => $icon->id
				]);

            }
            //$this->Flash->error(__('The icon could not be saved. Please, try again.'), ['plugin' => 'JeffAdmin5']);
            $this->Flash->error(__('The save has been not. Please check the datas and try again.'), ['plugin' => 'JeffAdmin5']);
        }
        $this->set(compact('icon'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Icon id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		//Configure::write('Theme.admin.config.header_buttons_in_action.edit', array_merge(Configure::read('Theme.admin.config.header_buttons_in_action.edit'), 
		//	['back' => true, 'add' => true, 'edit' => false, 'save' => true, 'view' => true, 'delete' => true]
		//));

		try {
			$icon = $this->Icons->get((int) $id, contain: []);
		} catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) {
			$this->Flash->warning(__($exeption->getMessage()), ['plugin' => 'JeffAdmin5']);
			return $this->redirect(['action' => 'index']);
		}

		$this->set('title', __('Edit the') . ': ' . __('icon') . ' ' . __('record'));
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
			
		if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
			//debug($data);
			$icon = $this->Icons->patchEntity($icon, $data);
			//dd($icon);
			/*
				if(...){
					$icon->setError('field', __('Message'));
				}
			*/

			$file_icon = $this->request->getData('file_icon');
			//debug($file_icon);
			//dd($file_banner);

			if ($file_icon instanceof \Laminas\Diactoros\UploadedFile && $file_icon->getError() === UPLOAD_ERR_OK) {
				$ext = pathinfo($file_icon->getClientFilename(), PATHINFO_EXTENSION);

				$filename = $file_icon->getClientFilename();
				$icon_file_name = $icon->id . $this->iconFilename . $ext;

				$icon->ext = $ext;
				$icon->filename = $filename;	// Felesleges, de itt van
			}
			//dd($icon);

			//dd($icon->getErrors());
			if (!$icon->hasErrors() && $this->Icons->save($icon)) {
				if ($file_icon instanceof \Laminas\Diactoros\UploadedFile && $file_icon->getError() === UPLOAD_ERR_OK) {
					if(file_exists($this->targetPath . $icon_file_name)){
						unlink($this->targetPath . $icon_file_name);
					}

					$file_icon->moveTo($this->targetPath . $icon_file_name);

					chmod($this->targetPath . $icon_file_name, 0664);
				}

				$this->Flash->success(__('The save has been: OK'), ['plugin' => 'JeffAdmin5']);

				//return $this->redirect(['action' => 'index']);
				return $this->redirect([
					'controller' => $this->controller,
					'action' => 'index',
					'#' => $icon->id
				]);

			}
			//$this->Flash->error(__('The icon could not be saved. Please, try again.'), ['plugin' => 'JeffAdmin5']);
			$this->Flash->error(__('The save has been not. Please check the datas and try again.'), ['plugin' => 'JeffAdmin5']);
        }
		$name = $icon->name;
        $this->set(compact('icon', 'id', 'name'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Icon id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$this->request->allowMethod(['post', 'delete']);

		try {
			$icon = $this->Icons->get((int) $id);
		} catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) {
			$this->Flash->warning(__($exeption->getMessage()), ['plugin' => 'JeffAdmin5']);
			return $this->redirect(['action' => 'index']);
		}

		if ($this->Icons->delete($icon)) {
			$this->session->delete('Layout.' . $this->controller . '.LastId');
			//$this->Flash->success(__('The icon has been deleted.'), ['plugin' => 'JeffAdmin5']);
			$this->Flash->success(__('The has been deleted.'), ['plugin' => 'JeffAdmin5']);
		} else {
			//$this->Flash->error(__('The icon could not be deleted. Please, try again.'), ['plugin' => 'JeffAdmin5']);
			$this->Flash->error(__('The has been deleted. Please check the datas and try again.'), ['plugin' => 'JeffAdmin5']);
		}

        return $this->redirect(['action' => 'index']);
    }
}
