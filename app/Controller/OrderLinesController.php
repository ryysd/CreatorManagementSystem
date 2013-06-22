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
	public $components = array('Session');
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
	public function add() {
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
		}
		$projects = $this->OrderLine->Project->find('list');
		$orderStatuses = $this->OrderLine->OrderStatus->find('list');
		$this->set(compact('projects', 'orderStatuses'));
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
		$this->set(compact('projects', 'orderStatuses'));
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
}
