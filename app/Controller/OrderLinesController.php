<?php
App::uses('AppController', 'Controller');
/**
 * OrderLines Controller
 *
 * @property OrderLine $OrderLine
 */
class OrderLinesController extends AppController {

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
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->OrderLine->recursive = 0;
		$this->set('orderLines', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->OrderLine->id = $id;
		if (!$this->OrderLine->exists()) {
			throw new NotFoundException(__('Invalid %s', __('order line')));
		}
		$this->set('orderLine', $this->OrderLine->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($project_id = null) {
		if ($this->request->is('post')) {
			$this->OrderLine->create();
			if ($this->OrderLine->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('order line')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				if ($project_id != null) {
				    $this->redirect(array('controller' => 'projects', 'action' => 'view', $project_id));
				}
				else {
				    $this->redirect(array('controller' => 'projects', 'action' => 'index'));
				}
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('order line')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		}
		if ($project_id != null) {
		    $projects = $this->OrderLine->Project->find('list', array('conditions' => array('Project.id' => $project_id)));
		}
		else { 
		    $projects = $this->OrderLine->Project->find('list');
		}
		$orderStatuses = $this->OrderLine->OrderStatus->find('list');
		$users = $this->OrderLine->User->find('list');
		$this->set(compact('projects', 'orderStatuses', 'users'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->OrderLine->id = $id;
		if (!$this->OrderLine->exists()) {
			throw new NotFoundException(__('Invalid %s', __('order line')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->OrderLine->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('order line')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('order line')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		} else {
			$this->request->data = $this->OrderLine->read(null, $id);
		}
		$projects = $this->OrderLine->Project->find('list');
		$orderStatuses = $this->OrderLine->OrderStatus->find('list');
		$users = $this->OrderLine->User->find('list');
		$this->set(compact('projects', 'orderStatuses', 'users'));
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
		$this->OrderLine->id = $id;
		if (!$this->OrderLine->exists()) {
			throw new NotFoundException(__('Invalid %s', __('order line')));
		}
		if ($this->OrderLine->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('order line')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('order line')),
			'alert',
			array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			)
		);
		$this->redirect(array('action' => 'index'));
	}

	public function upload($id = null) {
	    $this->OrderLine->id = $id;
	    if (!$this->OrderLine->exists()) {
		throw new NotFoundException(__('Invalid %s', __('order line')));
	    }
	    $orderLine = $this->OrderLine->read(null, $id);

	    if($this->request->data){
		// $obj['Attachment'] = $this->request->data['Attachment'];
		$this->request->data['OrderLine'] = $orderLine['OrderLine'];
		if($this->OrderLine->saveAll($this->request->data)){
		    echo "<pre>";
		    print_r($this->OrderLine->findById($id)['Attachment']);
		    echo "</pre>";
		    $this->Session->setFlash(
			__('The image has been uploaded.'),
			'alert',
			array(
			    'plugin' => 'TwitterBootstrap',
			    'class' => 'alert-success'
			)
		    );
		} else {
		    $this->Session->setFlash(
			__('The image could not be uploaded. Please, try again.'),
			'alert',
			array(
			    'plugin' => 'TwitterBootstrap',
			    'class' => 'alert-error'
			)
		    );
		}
	    }
	}
}
