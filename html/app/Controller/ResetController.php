<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class ResetController extends AppController {


	public $uses = array('User');
	public $helpers = array('Js', 'Session');
	public $components = array('RequestHandler');
	
	public function index() {
		$title_for_layout = "DECIDERE | RESET";
		$this->set(compact('title_for_layout'));
		$this->set('_serialize', array('title_for_layout'));
	}

	public function sent() {
	    $title_for_layout = "DECIDERE | PASSWORD RESET SENT";
		$this->set(compact('title_for_layout', 'users'));
		$this->set('_serialize', array('title_for_layout'));
	}

	
	public function password() {
		$error_message = "";
		if ($this->request->params['pass'][0] != "") {
	    	$user = $this->User->find('first', array('conditions'=>array('User.reset_key'=>$this->request->params['pass'][0])));
	    	$rows = $this->User->find('count', array('conditions'=>array('User.reset_key'=>$this->request->params['pass'][0])));

			$dataAll = $user;
	    	if ($rows === 0) {
				$error_message = "Invalid or expired password reset key.<br/>Please reset your password and try again";		    	
	    	}
			$title_for_layout = "DECIDERE | PASSWORD RESET";
			$this->set(compact('title_for_layout','user','error_message'));
			$this->set('_serialize', array('title_for_layout','user','error_message'));
		}
	}

	public function reset() {
    	$user = $this->User->find('first', array('conditions'=>array('User.reset_key'=>$this->request->data['User']['reset_key'])));
    	$rows = $this->User->find('count', array('conditions'=>array('User.reset_key'=>$this->request->data['User']['reset_key'])));
    	
		if ( $rows > 0 ) {
			$update = array('User' => array( 
				'id' => $user['User']['id'],
	    		'password' => $this->request->data['User']['new_password'],
	    		'reset_key' => ''
		    ));
	    	if ($this->User->save($update)) {
				$response = array('response' => array( 'status'=>'Your password was successfully changed.' ));
			} else {
				$response = array('response' => array( 'status'=>'Error resetting your password, please restart the process and try again.' ));
			}	
			$this->set(compact('title_for_layout','response'));
			$this->set('_serialize', array('title_for_layout','response'));
		}
	}
	
}
