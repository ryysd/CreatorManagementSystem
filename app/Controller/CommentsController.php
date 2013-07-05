<?php
App::uses('AppController', 'Controller');
/**
 * Comments Controller
 *
 * @property Comment $Comment
 */
class CommentsController extends AppController {

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

	function beforeFilter() {
	    parent::beforeFilter();

	    if ( !isAdminUser($this->getAuthUser()) && $this->action != 'add' ) {
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
		$this->Comment->recursive = 0;
		$this->set('comments', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Comment->id = $id;
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Invalid %s', __('comment')));
		}
		$this->set('comment', $this->Comment->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Comment->create();
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('comment')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
                                $comment = $this->request->data['Comment'];
				$fromUser = $this->Comment->User->findById($comment['user_id']);
				$order = $this->Comment->OrderLine->findById($comment['order_line_id']);
				$illustrators = $order['User'];
				$project = $this->Comment->OrderLine->Project->findById($order['Project']['id']);
				$client = $project['User'];

				$this->sendNotifyMails(array_merge(array($client), $illustrators), $project['Project'], $order['OrderLine'],"", $fromUser['User'], $comment['content']);
				$this->redirect(array('controller' => 'OrderLines', 'action' => 'view', $this->request->data['Comment']['order_line_id']));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('comment')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
				$this->redirect(array('controller' => 'OrderLines', 'action' => 'view', $this->request->data['Comment']['order_line_id']));
			}
		}
		$users = $this->Comment->User->find('list');
		$orderLines = $this->Comment->OrderLine->find('list');
		$attachments = $this->Comment->Attachment->find('list');
		$this->set(compact('users', 'orderLines', 'attachments'));
	}

	public function sendNotifyMails($toUsers, $project, $order, $order_tab_id, $fromUser, $comment) {
	    foreach ($toUsers as $user) {
		if ($user['id'] != $fromUser['id']) {
		    $this->sendNotifyMail($user, $project, $order, $order_tab_id, $fromUser, $comment);
		}
	    }
	}
	public function sendNotifyMail($toUser, $project, $order, $order_tab_id, $fromUser, $comment) {
	    $to           = $toUser['email'];
	    $to_name      = $toUser['username'];
	    $project_name = $project['title'];
	    $project_url  = Router::url("/", true)."projects/view/".$project['id'];
	    $illust_name  = $order['title'];
	    $illust_url   = Router::url("/", true)."order_lines/view/".$order['id'];
	    $order_tab_name = "tab";
	    $from_name    = $fromUser['username'];
	    
	    $data = array(
		'to_name'      => $to_name,
		'project_name' => $project_name,
		'project_url'  => $project_url,
		'illust_name'  => $illust_name,
		'illust_url'   => $illust_url,
		'illust_id'    => $order_tab_name,
		'from_name'    => $from_name,
		'comment'      => $comment
	    );
            $subject = "[PicHub] Comment Updated.";
	    $this->sendEmail($to, $subject, "notify_comment", "email", $data);
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Comment->id = $id;
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Invalid %s', __('comment')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('comment')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('comment')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		} else {
			$this->request->data = $this->Comment->read(null, $id);
		}
		$users = $this->Comment->User->find('list');
		$orderLines = $this->Comment->OrderLine->find('list');
		$attachments = $this->Comment->Attachment->find('list');
		$this->set(compact('users', 'orderLines', 'attachments'));
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
		$this->Comment->id = $id;
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Invalid %s', __('comment')));
		}
		if ($this->Comment->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('comment')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('comment')),
			'alert',
			array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			)
		);
		$this->redirect(array('action' => 'index'));
	}
}
