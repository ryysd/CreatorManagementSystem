<?php
class AdminController extends AppController
{
    public
	$uses = Array('User'),
	$components = Array(
	    'Session',
	    'Auth' => Array(
		'loginRedirect' => Array('controller'  => 'projects', 'action' => 'index'),
		'logoutRedirect' => Array('controller' => 'admin', 'action' => 'login'),
		'loginAction' => Array('controller' => 'admin', 'action' => 'login'),
		'authenticate' => Array('Form' => Array('fields' => Array('username' => 'email')))
	    )
	);

    public function beforeFilter()
    {
	parent::beforeFilter();
	$this->layout = 'bootstrap';
	$this->Auth->allow('add', 'login');
    }

    public function index()
    {
	$this->set('title_for_layout', 'ダッシュボード | 管理画面');
    }

    public function login() {
	if($this->request->is('post')) {
	    if($this->Auth->login()) {
		return $this->redirect($this->Auth->redirect());
	    } else {
		$this->Session->setFlash(__('Username or password is incorrect'), 'default', array(), 'auth');
	    }
	}
    }

    public function logout($id = null)
    {
	$this->redirect($this->Auth->logout());
    }

    public function add() {
	if ($this->request->is('post')) {
	    $this->User->create();
	    if ($this->User->save($this->request->data)) {
		$this->Session->setFlash(
		    __('The %s has been saved', __('user')),
		    'alert',
		    array(
			'plugin' => 'TwitterBootstrap',
			'class' => 'alert-success'
		    )
		);
		$this->redirect(array('action' => 'index'));
	    } else {
		$this->Session->setFlash(
		    __('The %s could not be saved. Please, try again.', __('user')),
		    'alert',
		    array(
			'plugin' => 'TwitterBootstrap',
			'class' => 'alert-error'
		    )
		);
	    }
	}
	$roles = $this->User->Role->find('list');
	$this->set(compact('roles'));
    }
}
?>
