<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $helpers = array(
	'Session',
	'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
	'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
	'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator',
    'Js', 'Usermgmt.UserAuth'),
    );

    public $layout = 'TwitterBootstrap.default';
    public $components = array('Session','RequestHandler', 'Usermgmt.UserAuth');

    function beforeFilter() {
	$this->layout = 'bootstrap';

	$this->userAuth();
	if($this->UserAuth->isLogged()) {
	    $this->set('authUser', $this->getAuthUser());
	}
    }

    protected function getAuthUser() {
	return $this->UserAuth->getUser();
    }

    private function userAuth(){
	$this->UserAuth->beforeFilter($this);
    }

    public function sendEmail($to, $subject, $text_template, $layout_template, $data) {
	$email = new CakeEmail('gmail');
	$email->charset = "ISO-2022-JP";
	$mailRespons = $email->config(array('log' => 'emails'))
	    ->template($text_template, $layout_template)
	    ->viewVars($data)
	    ->from(array('freedomspeech.pichub@gmail.com' => 'PicHub'))
	    ->to(/*$to*/"ry.ysd01@gmail.com")
	    ->subject($subject)
	    ->send();
    }
}
