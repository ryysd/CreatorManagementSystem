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
	public $helpers = array('TwitterBootstrap.BootstrapHtml', 'TwitterBootstrap.BootstrapForm', 'TwitterBootstrap.BootstrapPaginator', 'Js');
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

	    if ( !isAdminUser($this->getAuthUser()) && 
		(($this->action != "view" && $this->action != "upload" && 
		  $this->action != "delete_attachment" && $this->action != "update_status" && $this->action != "rollback_order_status")
	        )
	       ) {
	        setErrorFlush($this->Session, "you don't have permission to access.");
	        $this->redirect("/dashboard");
	    }
	}
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
                $orderLine = $this->OrderLine->findById($id);
		$this->set('orderLine', $this->OrderLine->read(null, $id));
		$this->set('attachments', $this->OrderLine->Attachment->find('all', array('conditions' => array('Attachment.foreign_key' => $id))));
		$this->set('orderStatuses', $this->OrderLine->OrderStatus->find('list'));
		$this->set('validOrderStatuses', $this->OrderLine->OrderStatus->find('list', 
		    array('conditions' => array('OrderStatus.id >' => $orderLine['OrderLine']['order_status_id']) 
		)));
		$this->set('userNames', $this->OrderLine->User->find('list', array('fields' => array('User.id', 'User.username'))));
	        $logs = $this->OrderLine->OrderLineLog->find('all', 
	            array(
	                'order' => array('OrderStatus.id DESC'),
	                'conditions' => array('OrderLine.id' => $id)
	            )
	        );
		$this->set('orderLineLogs', $logs);
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
		
		$illustrator = $this->OrderLine->User->UserGroup->find('all', array('conditions' => array(
		    'UserGroup.name' => 'Illustrator'
		)));
		$illustrator_id = $illustrator['0']['UserGroup']['id'];

		$users = $this->OrderLine->User->find('list', array('conditions' => array(
		    'User.user_group_id' => $illustrator_id 
		)));
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
		} else {
			$this->request->data = $this->OrderLine->read(null, $id);
		}
		$projects = $this->OrderLine->Project->find('list');
		$orderStatuses = $this->OrderLine->OrderStatus->find('list');
		$illustrator = $this->OrderLine->User->UserGroup->find('all', array('conditions' => array(
		    'UserGroup.name' => 'Illustrator'
		)));
		$illustrator_id = $illustrator['0']['UserGroup']['id'];

		$users = $this->OrderLine->User->find('list', array('conditions' => array(
		    'User.user_group_id' => $illustrator_id 
		)));
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
			if ($project_id != null) {
			        $this->redirect(array('controller' => 'projects', 'action' => 'view', $project_id));
			    }
			else {
			    $this->redirect(array('controller' => 'projects', 'action' => 'index'));
			}
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
		    $this->Session->setFlash(
			__('The image has been uploaded.'),
			'alert',
			array(
			    'plugin' => 'TwitterBootstrap',
			    'class' => 'alert-success'
			)
		    );
		    $this->redirect(array('action' => 'view', $orderLine['OrderLine']['id']));
		} else {
		    $this->Session->setFlash(
			__('The image could not be uploaded. Please, try again.'),
			'alert',
			array(
			    'plugin' => 'TwitterBootstrap',
			    'class' => 'alert-error'
			)
		    );
		    $this->redirect(array('action' => 'view', $orderLine['OrderLine']['id']));
		}
	    }
	}

	public function update_status($id = null) {
	    $this->OrderLine->id = $id;
	    if (!$this->OrderLine->exists()) {
		throw new NotFoundException(__('Invalid %s', __('order line')));
	    }
	    $orderLine = $this->OrderLine->read(null, $id);
	    $attachment = $this->OrderLine->Attachment->findById($this->request->data['OrderLine']['main_attachment_id']);
	    $orderLineLog = array(
		'order_line_id' => $id,
		'attachment_id' => $orderLine['OrderLine']['main_attachment_id'],
		'order_status_id' => $orderLine['OrderLine']['order_status_id']
	    );

	    if($this->request->data){
		$attachment['Attachment']['is_accepted'] = true;
		$attachment['Attachment']['accepted_status_id'] = $this->request->data['OrderLine']['order_status_id'];
		$pre_main_id = $orderLine['OrderLine']['main_attachment_id'];
		$pre_order_id = $orderLine['OrderLine']['order_status_id'];

		if( $this->OrderLine->Attachment->saveAll($attachment) &&
		    $this->OrderLine->saveField('order_status_id', $this->request->data['OrderLine']['order_status_id']) &&
                    $this->OrderLine->saveField('pre_main_attachment_id', $pre_main_id) &&
                    $this->OrderLine->saveField('pre_order_status_id', $pre_order_id) &&
		    $this->OrderLine->saveField('main_attachment_id', $this->request->data['OrderLine']['main_attachment_id']) &&
		    $this->OrderLine->OrderLineLog->saveAll($orderLineLog)
		){
		    $this->Session->setFlash(
			__('The status has been updated.'),
			'alert',
			array(
			    'plugin' => 'TwitterBootstrap',
			    'class' => 'alert-success'
			)
		    );
		    $this->redirect(array('action' => 'view', $orderLine['OrderLine']['id']));
		} else {
		    $this->Session->setFlash(
			__('The status could not be updated. Please, try again.'),
			'alert',
			array(
			    'plugin' => 'TwitterBootstrap',
			    'class' => 'alert-error'
			)
		    );
		    $this->redirect(array('action' => 'view', $orderLine['OrderLine']['id']));
		}
	    }
	}
	
	public function delete_attachment($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->OrderLine->id = $id;
		if (!$this->OrderLine->exists()) {
			throw new NotFoundException(__('Invalid %s', __('order line')));
		}

		if($this->request->data) {
		    if ($this->OrderLine->Attachment->delete($this->request->data['OrderLine']['attachment_id'])) {
		    	$this->Session->setFlash(
		    		__('The %s deleted', __('image')),
		    		'alert',
		    		array(
		    			'plugin' => 'TwitterBootstrap',
		    			'class' => 'alert-success'
		    		)
		    	);
		        $this->redirect(array('action' => 'view', $id));
		    }
		    $this->Session->setFlash(
		    	__('The %s was not deleted', __('image')),
		    	'alert',
		    	array(
		    		'plugin' => 'TwitterBootstrap',
		    		'class' => 'alert-error'
		    	)
		    );
		}
		$this->redirect(array('action' => 'view', $id));
	}

	public function rollback_order_status($id = null) {
	    $this->OrderLine->id = $id;
	    if (!$this->OrderLine->exists()) {
		throw new NotFoundException(__('Invalid %s', __('order line')));
	    }
	    $orderLine = $this->OrderLine->read(null, $id);
	    $attachment = $this->OrderLine->Attachment->findById($this->request->data['OrderLine']['main_attachment_id']);
	    $orderLine['OrderLine']['order_status_id'] = $orderLine['OrderLine']['order_status_id'] - 1;

	    $logs = $this->OrderLine->OrderLineLog->find('all', 
		array(
		    'order' => array('OrderStatus.id DESC'),
		    'conditions' => array('OrderLine.id' => $id)
		)
	    );

	    $pre = $logs[0];

	    if($this->request->data){
		$attachment['Attachment']['is_accepted'] = false;
		$attachment['Attachment']['accepted_status_id'] = null;

		if( $this->OrderLine->OrderLineLog->delete($pre['OrderLineLog']['id']) &&
		    $this->OrderLine->Attachment->saveAll($attachment['Attachment']) &&
		    $this->OrderLine->saveField('order_status_id', $pre['OrderLineLog']['order_status_id']) &&
		    $this->OrderLine->saveField('main_attachment_id', $pre['OrderLineLog']['attachment_id'])){
		    $this->Session->setFlash(
			__('The status has been updated.'),
			'alert',
			array(
			    'plugin' => 'TwitterBootstrap',
			    'class' => 'alert-success'
			)
		    );
		    $this->redirect(array('action' => 'view', $orderLine['OrderLine']['id']));
		} else {
		    $this->Session->setFlash(
			__('The status could not be updated. Please, try again.'),
			'alert',
			array(
			    'plugin' => 'TwitterBootstrap',
			    'class' => 'alert-error'
			)
		    );
		    $this->redirect(array('action' => 'view', $orderLine['OrderLine']['id']));
		}
	    }
	}
}
