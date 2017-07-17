<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::import('Vendor', 'phpmailer', array('file' => 'phpmailer'.DS.'PHPMailerAutoload.php'));

class RegisterController extends AppController {

	public $uses = array('User', 'Category', 'UserProvider', 'UserPlan', 'Provider', 'UserDataset');
	public $helpers = array('Js', 'Session');
	public $components = array('RequestHandler');
	
	public function index() {
		$title_for_layout = "DECIDERE | REGISTER";
		$this->set(compact('title_for_layout'));
		$this->set('_serialize', array('title_for_layout'));
	}

	public function registerUser(){
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$user = $this->User->findById($this->User->id);
				$user = $user['User'];
				$this->Auth->login($user);
				$this->Session->setFlash(__('Registered user'));
				return $this->redirect(array('action'=>'selectDataset'));
			} else {
				$this->Session->setFlash(__('Failed to register the user'));
				return $this->redirect(array('action'=>'index'));
			}
		}
	}

	public function registerUserAjax(){
		if ($this->request->is('ajax')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$user = $this->User->findById($this->User->id);

				//get providers datasets demo
				$providers_demo = $this->Provider->find('all', array('conditions'=>array('Provider.type'=>'1')));

				if ( count($providers_demo) > 0 ) { 
					foreach ($providers_demo as $value) {
						$userProvider = array(
							'name' => $value['Provider']['name'],
							'user_id' => $user['User']['id'],
							'provider_id' => $value['Provider']['id'],
							'provider' => $value['Provider']['name'],
							'txn_id' => '',
							'demo' => '1'
						);
						$this->UserProvider->create();
						$this->UserProvider->save($userProvider);
					}
				} 

				//send mail to admin

				$dataAll = $user;
				
				//Send Welcome Email to New User
				$this->Email = new CakeEmail('smtp2go');
		        $this->Email->from(array('info@decidere.com' => 'DECIDERE'));
		        $this->Email->to(array($user['User']['email']));
		        $this->Email->cc(array('admin@decidere.com'));
		        $this->Email->subject('Decidere Welcome');
		        $this->Email->template('welcome');
		        
		        $this->Email->emailFormat('html');
		        $this->Email->viewVars(array('dataAll'=>$dataAll));//envia datos
		       	if(	$this->Email->send()){
		       	}	

				//Send Notification Email to Admin
				$this->Email = new CakeEmail('smtp2go');
		        //$this->Email->from(array('info@decidere.com' => 'DECIDERE'));
		        $this->Email->to(array('admin@decidere.com'));
		        $this->Email->subject('New user Registered');
		        $this->Email->template('register');
		        $this->Email->emailFormat('html');
		        $this->Email->viewVars(array('dataAll'=>$dataAll));//envia datos
		       	if(	$this->Email->send()){
		       	}	

				$user = $user['User'];
				$this->Auth->login($user);
				$status_register = 'Register Correct';
				$url = Router::url(['controller' => 'Register', 'action' => 'selectDataset']);
				$this->set(compact('status_register', 'url'));
				$this->set('_serialize', array('status_register', 'url'));
				
			} else {
				$username = '';
				$email = '';
				//check if exist email
				if ( $this->User->find('count', array('conditions' => array('User.username' => $this->request->data['User']['username'] ) ) ) > 0 ) {
					$username = 'unavailable';
				}

				//che if exist email
				if ( $this->User->find('count', array('conditions' => array('User.email' => $this->request->data['User']['email'] ) ) ) > 0 ) {
					$email = 'unavailable';
				}

				$status_register = 'Error register';
				$this->set(compact('status_register', 'username', 'email'));
				$this->set('_serialize', array('status_register', 'username', 'email'));
			}
		}
	}


	public function selectDataset(){
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    }
	    //get all providers availables
	    $providers_current = json_encode( $this->Provider->find('list') );

	    $user_dataset_current = $this->UserDataset->find('first', array('conditions' => array('UserDataset.user_id' => $this->Session->read('Auth.User.id'))));

	    if ( !empty( $user_dataset_current )) {
	    	
	    	$user_dataset = array( 'UserDataset' => array( 
	    		'id' => $user_dataset_current['UserDataset']['id'],
	    		'user_id' => $this->Session->read('Auth.User.id'),
	    		'providers' => $providers_current
	    	));
	    } else {
	    	$user_dataset = array( 'UserDataset' => array( 
	    		'user_id' => $this->Session->read('Auth.User.id'),
	    		'providers' => $providers_current
	    	));
	    }
    	$this->UserDataset->create();
    	$this->UserDataset->save($user_dataset);

    	$this->Session->write('CurrentProviders', $providers_current);
    	$this->Session->write('UserCurrentProviders', $providers_current);
	    

	    $categories = $this->Category->find('all', array('recursive'=>2));
		$user_plans = array();
		$user_providers = $this->UserProvider->find('list', array('conditions'=>array('UserProvider.user_id' => $this->Session->read('Auth.User.id')), 'fields'=>array('UserProvider.name')));		
		foreach ($user_providers as $key => $plan){
			$str = str_replace(' Annual', '', $plan);
			$str = str_replace(' Monthly', '', $str);
			array_push($user_plans,$str);
		}
	    $title_for_layout = "DECIDERE | Select Your Dataset";
		$this->set(compact('title_for_layout', 'categories', 'user_plans'));
		$this->set('_serialize', array('title_for_layout', 'categories', 'user_plans'));
	}


	public function terms() {
		$title_for_layout = 'DECIDERE | TERMS AND CONDITIONS';
		$this->set(compact('title_for_layout'));
		$this->set('_serialize', array('title_for_layout'));
	}

}
