<?php
App::uses('AppController', 'Controller');

define("PROJECT_STATUS_PREPARE" , 1);
define("PROJECT_STATUS_PROGRESS", 2);
define("PROJECT_STATUS_COMPLETE", 3);

define("ORDERLINE_STATUS_NOTACCEPTED", 1);
define("ORDERLINE_STATUS_ROUGH"      , 2);
define("ORDERLINE_STATUS_LINE"       , 3);
define("ORDERLINE_STATUS_COLORED"    , 4);
define("ORDERLINE_STATUS_MASTER"     , 5);
/**
 * Projects Controller
 *
 * @property Project $Project
 */
class ProjectsController extends AppController {

/**
 *  Layout
 *
 * @var string
 */
	public $layout = 'bootstrap';

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('TwitterBootstrap.BootstrapHtml', 'TwitterBootstrap.BootstrapForm', 'TwitterBootstrap.BootstrapPaginator');
/**
 * Components
 *
 * @var array
 */
	public $components = Array(
	    'Session',
	    'Auth' => Array(
		'loginRedirect' => Array('controller'  => 'projects', 'action' => 'index'),
		'logoutRedirect' => Array('controller' => 'admin', 'action' => 'login'),
		'loginAction' => Array('controller' => 'admin', 'action' => 'login'),
		'authenticate' => Array('Form' => Array('fields' => Array('username' => 'email')))
	    )
	);

	function beforeFilter() {
	    parent::beforeFilter();

	    $this->updateStatus();
	    // client user can watch project that he created.
	    if ( isIllustratorUser($this->getAuthUser()) || 
		(isClientUser($this->getAuthUser()) && $this->action != "view") || 
		(isClientUser($this->getAuthUser()) && $this->action == "view" && 
		 $this->Project->findById($this->request->params['pass'][0])['User']['id'] != $this->getAuthUser()['User']['id'] ) ) {
		    setErrorFlush($this->Session, "you don't have permission to access.");
		    $this->redirect('/dashboard');
	    }
	}

	function updateStatus() {
	    foreach($this->Project->find('all') as $proj) {
		$project = $proj['Project'];
		$pre_status_id = $project['project_status_id'];
		if ( empty($proj['OrderLine']) ) $project['project_status_id'] = PROJECT_STATUS_PREPARE;
		else {
	            $project['project_status_id'] = PROJECT_STATUS_COMPLETE;
		    foreach($proj['OrderLine'] as $order) {
			if( $order['order_status_id'] != ORDERLINE_STATUS_MASTER ) {
			    $project['project_status_id'] = PROJECT_STATUS_PROGRESS;
			    break;
			}
		    }
		}
		if ( $project['project_status_id'] != $pre_status_id ) $this->Project->save($project);
	    }
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Project->recursive = 0;
		$this->set('projects', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid %s', __('project')));
		}
		$this->set('project', $this->Project->read(null, $id));
		$this->set('orderStatuses', $this->Project->OrderLine->OrderStatus->find('list'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Project->create();
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('project')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('project')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		}
		$projectStatuses = $this->Project->ProjectStatus->find('list');
		$client_id = $this->Project->User->UserGroup->find('all', array('conditions' => array(
		    'UserGroup.name' => 'Client'
		)))['0']['UserGroup']['id'];

		$users = $this->Project->User->find('list', array('conditions' => array(
		    'User.user_group_id' => $client_id 
		)));
		$this->set(compact('projectStatuses'));
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid %s', __('project')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('project')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('project')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		} else {
			$this->request->data = $this->Project->read(null, $id);
		}
		$projectStatuses = $this->Project->ProjectStatus->find('list');
		$users = $this->Project->User->find('list');
		$this->set(compact('projectStatuses'));
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid %s', __('project')));
		}
		if ($this->Project->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('project')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('project')),
			'alert',
			array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			)
		);
		$this->redirect(array('action' => 'index'));
	}
}
