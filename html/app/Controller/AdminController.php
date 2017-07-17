<?php
	

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('HttpSocket', 'Network/Http');
App::import('Vendor', 'Stripe', array('file' => 'stripe-php-3.15.0/init.php'));

class AdminController extends AppController {

	public $uses = array('User', 'Dataset', 'Scenario', 'Provider', 'Favorite', 'Matched', 'Category', 'Info', 'Plan', 'UserProvider', 'UserPlan', 'Coupon', 'Mapping', 'UserDataset');
	public $helpers = array('Js', 'Session');
	public $components = array('RequestHandler'/*, 'Stripe.Stripe'*/);

	public function tls() {
		\Stripe\Stripe::setApiKey("pk_live_oOipIA6iDhI2l3zNm1MblNqC");
		\Stripe\Stripe::$apiBase = "https://api-tls12.stripe.com";
	}


	public function index() {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array('action'=>'login'));
	    } else {
			$title_for_layout = "DECIDERE | ADMIN";
			$this->set(compact('title_for_layout'));
			$this->set('_serialize', array('title_for_layout'));    	
	    }	
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
			return $this->redirect($this->Auth->redirect());
			}
		$this->Session->setFlash(__('Usuario o contraseña incorrecto, por favor intenta nuevamente!'));
		 return $this->redirect(array('action' => 'index'));	
		}
	}

	public function loginAjax() {
		if ( ($this->request->is('ajax')) ) {
			if ($this->Auth->login()) {

				if( $this->Session->read('Auth.User.state') == 0 ){
					$this->Auth->logout(); 
					$status_login = 'Your account is deactivated';
					$this->set(compact('status_login'));
					$this->set('_serialize', array('status_login'));
				} else {
					$this->notifications();

					//status login
					$status_login = 'Login Correct';

					//url for redirect
					$url = Router::url(['controller' => 'User', 'action' => 'dashboard']);

					$this->set(compact('status_login', 'url'));
					$this->set('_serialize', array('status_login', 'url'));
				}

			} else {
				$status_login = 'Username or password incorrect';
				$this->set(compact('status_login'));
				$this->set('_serialize', array('status_login'));
			}
		}
	}



	public function forgotAjax() {
		
    	$user = $this->User->find('first', array('conditions'=>array('User.email'=>$this->request->data['User']['email'])));
		$update = array('User' => array( 
			'id' => $user['User']['id'],
    		'reset_key' => md5(uniqid(rand(), true))
    	));
    	
    	if ($this->User->save($update)) {
	    	
	    	$dataAll = $this->User->find('first', array('conditions'=>array('User.id'=>$user['User']['id'])));
	    	$dataAll['domain'] =  $_SERVER['SERVER_NAME'];
			$this->Email = new CakeEmail('smtp2go');
	        $this->Email->to(array($user['User']['email']));
	        $this->Email->subject('Decidere Password Reset');
	        $this->Email->template('forgot_password');
	        $this->Email->emailFormat('html');
	        $this->Email->viewVars(array('dataAll'=>$dataAll));//envia datos
	       	if(	$this->Email->send()){
		    }
			return $this->redirect('/reset/sent');
    	} else {
    		$response = array('response' => 'error-----');
    	}

	}


	public function notifications() {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array('action'=>'login'));
	    }

		//-------------for notification from new provider------------------------------------------------
	    //get all providers availables
	    $providers_current = json_encode( $this->Provider->find('list') );
	    //write session with providers availables
	    $this->Session->write('CurrentProviders', $providers_current);

	    //get all providers watched by user
	    $user_dataset_current = $this->UserDataset->find('first', array('conditions' => array('UserDataset.user_id' => $this->Session->read('Auth.User.id'))));
	    
	    //write session with providers watched by user
	    if( !empty($user_dataset_current) ) {
	    	
	    	if ( $user_dataset_current['UserDataset']['providers'] != '' ) {
	    		$this->Session->write('UserCurrentProviders', $user_dataset_current['UserDataset']['providers']);
	    	} else {
	    		$this->Session->write('UserCurrentProviders', '{}');	
	    	}

	    	if ( $user_dataset_current['UserDataset']['datasets'] != '' AND $user_dataset_current['UserDataset']['datasets'] != '[]' ) {
	    		$this->Session->write('UserCurrentDatasets', $user_dataset_current['UserDataset']['datasets']);
	    	} else {
	    		$this->Session->write('UserCurrentDatasets', '{}');	
	    	}

	    } else {
	    	$this->Session->write('UserCurrentProviders', '{}');
	    	$this->Session->write('UserCurrentDatasets', '{}');
	    }
	    //-------------for notification from new provider------------------------------------------------

	    
	    //-------------for notification from new version of dataset purchased----------------------------

	    
	    //get providers purchased actives from user
		$user_providers = $this->UserProvider->find('list', array('conditions' => array('UserProvider.user_id' => $this->Session->read('Auth.User.id'), 'UserProvider.state' => 1 ), 'fields' => array('UserProvider.provider') ));

	    //prepare request 
		$HttpSocket = new HttpSocket();
	    
		//get dataset list from server decidere
	    //$datasetListJson = $HttpSocket->get('http://lin.decidere.com/cgi-bin/R/datasetList');
	    $datasetListJson = $HttpSocket->get( $this->urlDatasetList );
	    


		//clean response by get only body from request
		$datasetListJson = json_decode( $datasetListJson['body'] ); 

		//declare array for adds datasets agroup by provider
	    $providerJson = array();




	    //recorre dataset list
	    foreach ( $datasetListJson as $key => $dataset) {

	    	//check if dataset is in provider purchased actives from user
	    	if ( in_array( $dataset['0'] , $user_providers) ) {

				//check if provider not exist in providerJson
				if ( !array_key_exists( $dataset['0'] , $providerJson) ) {
					
					//declare array key with name provider
					$providerJson[$dataset['0']] = array();

					//add provider to key array with name of provider
					array_push( $providerJson[$dataset['0']], $dataset); 

				} else {
					//add provider to key array with name of provider
					array_push( $providerJson[$dataset['0']], $dataset); 
				}
	    		
	    	}

		}
		if( !empty($providerJson) ) {
	    	$this->Session->write('CurrentDatasets', json_encode($providerJson) );
	    } else {
	    	$this->Session->write('CurrentDatasets', '{}');
	    }

	    //-------------for notification from new version of dataset purchased----------------------------
	}

	public function logout() {
		$this->Session->write('ShoppingCart', array());
		return $this->redirect($this->Auth->logout());
	}

	public function users() {
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    $this->paginate();
	    $title_for_layout = "DECIDERE | ADMIN - USERS";
	    $users = $this->User->find('all', array( 'recursive'=>2 ) );
		$this->set(compact('title_for_layout', 'users'));
		$this->set('_serialize', array('title_for_layout', 'users'));
	}

	public function user($id = null) {
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    $title_for_layout = "DECIDERE | ADMIN - USERS";

	    if($id != null) {
	    	$user = $this->User->find('first', array('conditions' => array('User.id' => $id ) ) );
	    	$user_plans = $this->UserPlan->find('list', array('conditions'=>array('UserPlan.user_id' => $id), 'fields'=>array('UserPlan.plan_id')));                             
	    	$plans = $this->Plan->find('all', array('conditions'=>array('Plan.type !=' => '1' ), 'recursive'=>2  ));
	    } else {
	    	return $this->redirect(array('action'=>'users'));
	    }

		$this->set(compact('title_for_layout', 'user', 'plans', 'user_plans'));
		$this->set('_serialize', array('title_for_layout', 'user', 'plans', 'user_plans'));
	}

	public function createUser() {
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array('action'=>'login'));
	    }

		if ($this->request->is('ajax')) {

			//generate password
			$password = $this->generatePassword(6);

			//add password to user
			$this->request->data['User']['password'] = $password;


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

				//set user  no hash
				$user['User']['password'] = $password;

				//send mail to new user

				$dataAll = $user;
				$this->Email = new CakeEmail('smtp2go');
		        //$this->Email->from(array('admin@decidere.com' => 'DECIDERE'));
		        $this->Email->to(array($user['User']['email']));
		        $this->Email->subject('Your new account in DECIDERE was created');
		        $this->Email->template('new_register');
		        $this->Email->emailFormat('html');
		        $this->Email->viewVars(array('dataAll'=>$dataAll));//envia datos
		       
		       	if(	$this->Email->send()){

		       	}	

				$status_register = 'Register Correct';
				$url = Router::url(['controller' => 'Admin', 'action' => 'users']);
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

	//generate password
	public function generatePassword($length = 8) {
	    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	    $count = mb_strlen($chars);

	    for ($i = 0, $result = ''; $i < $length; $i++) {
	        $index = rand(0, $count - 1);
	        $result .= mb_substr($chars, $index, 1);
	    }

	    return $result;
	}

	public function coupons() {
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array('action'=>'login'));
	    }

	    //if is post request
	    if ($this->request->is(array('post', 'put'))) {
			$this->Coupon->create();
			if ($this->Coupon->save($this->request->data)) {
				$this->Session->setFlash(('The coupon was saved'));
				return $this->redirect(array('action' => 'coupons'));
			} else {
				$this->Session->setFlash(('The coupon was not saved.'));
				return $this->redirect(array('action' => 'coupons'));
			}
		}

	    $title_for_layout = "DECIDERE | ADMIN - COUPONS";
          
	    $coupons = $this->Coupon->find('all');

		$this->set(compact('title_for_layout', 'coupons'));
		$this->set('_serialize', array('title_for_layout', 'coupons'));
	}

	public function addUserDataset() {
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is(array('post', 'put'))) {

	    	$data = $this->request->data;
			//deleteall user provider
			$this->UserProvider->deleteAll(array('UserProvider.user_id' => $data['user']), false);

			if(isset($data['providers'])) {
				foreach ($data['providers'] as $key => $provider) {
					$user_provider = array('UserProvider' => array( 
			    		'user_id' => $data['user'], 
			    		'provider_id' => $provider,
			    	));
					$this->UserProvider->create();
					$this->UserProvider->save($user_provider);

				}
			}
	       	return $this->redirect(array('action' => 'user', $data['user']));

		}
		$this->set(compact('title_for_layout', 'data'));
		$this->set('_serialize', array('title_for_layout', 'data'));
	}

	public function updateUserPlan() {
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	     if ($this->request->is('ajax')) {

			$userPlan = array('UserPlan' => array( 
	    		'user_id' => $this->request->data['user_id'], 
	    		'plan_id' => $this->request->data['plan_id']
	    	));

			if( $this->request->data['relation'] == '1' ) {

				$this->UserPlan->create();

		    	if ($this->UserPlan->save($userPlan)) {
		    		$response = array('response' => array( 'status'=>'success insert', 'id'=>$this->UserPlan->id) );
		    	} else {
		    		$response = array('response' => 'error');
		    	}

				
			} else if($this->request->data['relation'] == '0') {

				$this->UserPlan->deleteAll(array('UserPlan.user_id' => $this->request->data['user_id'], 'UserPlan.plan_id' => $this->request->data['plan_id'] ), false );
				$response = array('response' => array( 'status'=>'success delete') );

			}

	    	//$response = $userPlan;

	    	$this->set(compact('response'));
			$this->set('_serialize', array('response'));
	    }
	}

	public function datasets() {
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array('action'=>'login'));
	    }

		//if is post request
	    if ($this->request->is(array('post', 'put'))) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(('The category was saved'));
				return $this->redirect(array('action' => 'datasets'));
			} else {
				$this->Session->setFlash(('The category was not saved.'));
				return $this->redirect(array('action' => 'datasets'));
			}
		}
	    $title_for_layout = "DECIDERE | ADMIN - DATASETS";

	    $categories = $this->Category->find('all');

		$this->set(compact('title_for_layout', 'categories'));
		$this->set('_serialize', array('title_for_layout', 'categories'));
	}

	public function dataset_edit($id = null) {
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    $title_for_layout = "DECIDERE | ADMIN - DATASET EDIT";

	    if($id != null) {
	    	$category = $this->Category->find('first', array('conditions' => array('Category.id' => $id ) ) );
	    } else {
	    	return $this->redirect(array('action'=>'datasets'));
	    }

		$this->set(compact('title_for_layout', 'category'));
		$this->set('_serialize', array('title_for_layout', 'category'));
	}

	public function providers($id = null) {
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array('action'=>'login'));
	    }

	    $title_for_layout = "DECIDERE | ADMIN - DATASET PROVIDER";

	    if($id != null) {
		    if ($this->request->is(array('post', 'put'))) {
				$this->Provider->create();
				if ($this->Provider->save($this->request->data)) {
					$this->Session->setFlash(('The provider was saved'));
					return $this->redirect(array('action' => 'providers', $id));
				} else {
					$this->Session->setFlash(('The provider was not saved.'));
					return $this->redirect(array('action' => 'providers', $id));
				}
			}
	    	$providers = $this->Provider->find('all', array('conditions' => array('Provider.category_id' => $id ), 'recursive'=>1 ) );
	    	$category = $this->Category->find('first', array('conditions'=>array('Category.id'=>$id)));
	    } else {
	    	return $this->redirect(array('action'=>'datasets'));
	    }

		$this->set(compact('title_for_layout', 'providers', 'category'));
		$this->set('_serialize', array('title_for_layout', 'providers', 'category'));
	}

	public function plans($id = null) {
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is(array('post', 'put'))) {
			$this->Plan->create();
			if ($this->Plan->save($this->request->data)) {
				$this->Session->setFlash(('The plan was saved'));
				return $this->redirect(array('action' => 'plans', $id));
			} else {
				$this->Session->setFlash(('The plan was not saved.'));
				return $this->redirect(array('action' => 'plans', $id));
			}
		}

	    $title_for_layout = "DECIDERE | ADMIN - DATASET PROVIDER PLANS";

	    if($id != null) {
	    	$plans = $this->Plan->find('all', array('conditions' => array('Plan.provider_id' => $id ), 'recursive'=>1 ) );
	    	$provider = $this->Provider->find('first', array('conditions'=>array('Provider.id'=>$id)));
	    } else {
	    	return $this->redirect(array('action'=>'datasets'));
	    }

		$this->set(compact('title_for_layout', 'plans', 'provider'));
		$this->set('_serialize', array('title_for_layout', 'plans', 'provider'));
	}

	public function cms() {
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    return $this->redirect(array('controller'=> 'articles','action'=>'wp-admin'));
	}

	public function resetPassword() {
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array('action'=>'login'));
	    }

	    if ($this->request->is('ajax')) {

	    	$status = 'The request could not be processed please try again';

	    	//find user
	    	$user = $this->User->find('first', array('conditions'=>array('User.id'=>$this->request->data['id'])));

	    	//check if user exists
	    	if (count($user) > 0 ) {

	    		$status = 'The user was found';

				//generate password
				$password = $this->generatePassword(6);
	    		
	    		//prepare model for savefield
	    		$this->User->id = $this->request->data['id'];
	    		//save new password
	    		if ($this->User->saveField('password', $password)) {
	    		 	
	    			$status = 'The password was changed';

	    			//set user  no hash
					$user['User']['password'] = $password;

					//send mail to new user

					$dataAll = $user;
					$this->Email = new CakeEmail('smtp2go');
			        //$this->Email->from(array('admin@decidere.com' => 'DECIDERE'));
			        $this->Email->to(array($user['User']['email']));
			        $this->Email->subject('New password for your account in DECIDERE');
			        $this->Email->template('new_password');
			        $this->Email->emailFormat('html');
			        $this->Email->viewVars(array('dataAll'=>$dataAll));//envia datos
			       
			       	if(	$this->Email->send()){
			       		$status = 'The password was changed and was sent to user';
			       	}

	    		} else {
	    			$status = 'The password was not changed';
	    		} 

	    	} else {

	    		$status = 'The user was not found';
	    	}


			$this->set(compact('status'));
			$this->set('_serialize', array('status'));
		}


	}

	public function dashboard() {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    $title_for_layout = "DECIDERE | DASHBOARD";
	    $providers = $this->Provider->find('all', array('recursive'=>3, 'conditions' => array('Provider.state' => '1' ) ));
		$this->set(compact('title_for_layout', 'providers'));
		$this->set('_serialize', array('title_for_layout', 'providers'));
	}

	//prepare options for creteria in form new scenario
	public function prepareOptions($criteria = array(), $options = array()) {
		
		//get key options
		$indexOptions = array_keys($options);

		//array temp for results
		$arrayTemp = array();
		
		//recorre array criteria
		foreach ($criteria as $criterion) {

			//check if criterian exist in arrayTemp
			$pushInArray = false;
			
			foreach ($indexOptions as $index) {
				
				//if ( $criterion['Column'] == $index && ($criterion['IsScreenable'] == 'TRUE' OR $criterion['DataType'] == 'character') ) {
				if ( $criterion['Column'] == $index && $criterion['DataType'] == 'character' ) {

					$criterion['options'] = array_unique( $options[$index] );

					array_push($arrayTemp,  $criterion ) ;

					$pushInArray = true;

					break;

				}

			}

			if ($pushInArray == false) {
				
				array_push( $arrayTemp,  $criterion ) ;

			}

		}

		return $arrayTemp;
	}	

	//agroup options 
	public function agroupCriterianbyCleanGroupName ($fullCriterian = array()) {
		
		//define var empty array criterian by group 
		$criterianByGroup = array();

		//recorre fullcriterian
		foreach ($fullCriterian as $criterion) {

			//check if group different thta ugrouped
			if($criterion['CleanGroupName'] != 'ungrouped') {

				//check if not exist group in criterianByGroup
				if (!array_key_exists( $criterion['CleanGroupName'],  $criterianByGroup)) {
					
					//if not exist, create group how array in criterianByGroup
					$criterianByGroup[$criterion['CleanGroupName']]	= array();				

					//add criterio to group
					array_push( $criterianByGroup[$criterion['CleanGroupName']] , $criterion); 

				} else {
					//add criterio to group
					array_push( $criterianByGroup[$criterion['CleanGroupName']] , $criterion); 
				}

			}
		}
		//return all grouped criterian
		return $criterianByGroup;
	}

	//save new scenario
	public function saveScenario() {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is('ajax')) {

			$scenario = array('Scenario' => array( 
	    		'name' => $this->request->data['scenario_name'], 
	    		'dataset_id' => $this->request->data['dataset_id'],
	    		'provider_id' => $this->request->data['provider_id'],
	    		'scenario' => $this->request->data['scenario_val'],
	    		'user_id' => $this->Session->read('Auth.User.id')
	    	));

	    	$this->Scenario->create();

	    	if ($this->Scenario->save($scenario)) {
	    		$response = array('response' => array( 'status'=>'success', 'id'=>$this->Scenario->id) );
	    	} else {
	    		$response = array('response' => 'error');
	    	}

	    	$this->set(compact('response'));
			$this->set('_serialize', array('response'));
	    }
	}

	//save new results
	public function saveResults() {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is('ajax')) {

			$favorite = array('Favorite' => array( 
	    		'headers' => json_encode( $this->request->data['headers'] ), 
	    		'favorite' => json_encode( $this->request->data['favorite'] ),
	    		'scenario_id' =>  $this->request->data['scenario_id'],
	    		'period' =>  $this->request->data['period'],
	    		'user_id' => $this->Session->read('Auth.User.id')
	    	));

	    	$this->Favorite->create();

	    	if ($this->Favorite->save($favorite)) {
	    		$url = Router::url(['controller' => 'Admin', 'action' => 'dashboard']);
	    		$response = array('response' => array( 'status'=>'success', 'id'=>$this->Favorite->id) );
	    	} else {
	    		$response = array('response' => 'error');
	    	}

	    	$this->set(compact('response', 'url'));
			$this->set('_serialize', array('response', 'url'));

	    }
	}

	//obtain results for scenario
	public function result() {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is('post')) {
	    	//$url = 'http://lin.decidere.com/cgi-bin/R/process';
	    	$HttpSocket = new HttpSocket();
	    	
	    	$params =  $this->request->data['scenario_val'];

	    	$results = $HttpSocket->get( $this->urlRProcess, $params );

	    	//$results =  $params ;
	    	
	    	$this->set(compact('results'));
			$this->set('_serialize', array('results'));
	    }
	}

	//mapping datasets
	public function mapping() {
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array('action'=>'login'));
	    }

	    $title_for_layout = "DECIDERE | MAPPING";
	    
	    //get all matchs
	    $mappings = $this->Mapping->find('all');

	    $HttpSocket = new HttpSocket();
	    
	    //get all datasets
	    //$datasetListJson = $HttpSocket->get('http://lin.decidere.com/cgi-bin/R/datasetList');
	    $datasetListJson = $HttpSocket->get( $this->urlDatasetList );

		//get body datasets from request
		$datasetListJson = json_decode( $datasetListJson['body'] ); 

		//Empty array for datasets
		$datasets = array();

		//recorre datasetListJson for get dataset
		foreach ( $datasetListJson as $key => $dataset) {
			
			//check if dataset has three variable
			if (count($dataset) >= 3 ) {

				//add item dataset to dataset array
				$datasets[$dataset['0'] . '_' . $dataset['1'] . '_' . $dataset['2'] . '_' . $dataset['3'] ] = ucwords( $dataset['0'] . ' ' . $dataset['1'] . ' ' . $dataset['3'] ) ;
			}

		}

	    if ($this->request->is('post')) {
	    	
	    	$dataset_a = $this->request->data['dataset_a_id'];

	    	$dataset_b = $this->request->data['dataset_b_id'];

	    	//get column info from API prepare client http
	    	$HttpSocket = new HttpSocket();

			//prepare data for post
			$data_a = array('datasetId' => $dataset_a);

	    	//get column info from decidere.com
	    	//$columnInfo_a = $HttpSocket->post('http://lin.decidere.com/cgi-bin/R/columnInfo', $data_a);
	    	$columnInfo_a = $HttpSocket->post( $this->urlColumnInfo , $data_a);

	    	//decode column_info response body
	    	$array_a = json_decode( $columnInfo_a->body() );  

	    	//--------------------------

	    	//get column info from API prepare client http
	    	$HttpSocket = new HttpSocket();

			//prepare data for post
			$data_b = array('datasetId' => $dataset_b);

	    	//get column info from decidere.com
	    	//$columnInfo_b = $HttpSocket->post('http://lin.decidere.com/cgi-bin/R/columnInfo', $data_b);
	    	$columnInfo_b = $HttpSocket->post( $this->urlColumnInfo , $data_b);

	    	//decode column_info response body
	    	$array_b = json_decode( $columnInfo_b->body() );  


			//array for criteria in a and not in b
			$array_a_less = array('0'=>'Unmatched');

			foreach ($array_a as $value_a) {
				
				//check if the value appears in screening or weighting
				if ($value_a->IsScreenable == 1 or $value_a->IsWeightable == 1) {
					$exist = false;
					foreach ($array_b as $value_b) {
						if($value_a->Column === $value_b->Column) {
							$exist = true;
							continue;
						}
					}
					if (!$exist) {
						array_push($array_a_less, $value_a->Column);
					}
				}
			}

			//array for criteria in b and not in a
			$array_b_less = array('0'=>'Unmatched');

			foreach ($array_b as $value_b) {
				
				//check if the value appears in screening or weighting
				if ($value_b->IsScreenable == 1 or $value_b->IsWeightable == 1) {
					$exist = false;
					foreach ($array_a as $value_a) {
						if($value_b->Column === $value_a->Column) {
							$exist = true;
							continue;
						}
					}
					if (!$exist) {
						array_push($array_b_less, $value_b->Column);
					}
				}
			}

			//check wich is more large
			if( count( $array_a_less ) > count( $array_b_less ) ){
				$rows = count( $array_a_less );
			} else {
				$rows = count( $array_b_less );
			}
	    }


    	$this->set(compact('datasets', 'mappings', 'array_a', 'dataset_a', 'dataset_b', 'array_a_less', 'array_b_less', 'rows'));
		$this->set('_serialize', array('datasets', 'mappings', 'array_a', 'dataset_a', 'dataset_b', 'array_a_less', 'array_b_less', 'rows'));
	}

	//save match
	public function saveMapping($dataset_a=null, $dataset_b=null) {
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is('post') and ( $dataset_a != null and $dataset_b != null ) ) {
    	

	    	$mapping = array('Mapping' => array( 
	    		'name' => 'Map - '. ucwords( str_replace('_', ' ', $dataset_a) ) . ' - ' . ucwords( str_replace('_', ' ', $dataset_b) ), 
	    		'dataset_a' => $dataset_a,
	    		'dataset_b' => $dataset_b,
	    		'mapping' =>  json_encode( $this->request->data )
	    	));

	    	$this->Mapping->create();

	    	if ($this->Mapping->save($mapping)) {
	    		return $this->redirect(array('action'=>'mapping'));
	    	} else {
	    		return $this->redirect(array('action'=>'mapping'));
	    	}

	    }
	}

	//match
	public function match() {
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array('action'=>'login'));
	    }

	    $title_for_layout = "DECIDERE | MATCH";
	    if ($this->request->is('post')) {
	    	
	    	$dataset_a = $this->Dataset->find('first', array('conditions'=>array( 'Dataset.id' => $this->request->data['dataset_a_id'])));

	    	$dataset_b = $this->Dataset->find('first', array('conditions'=>array( 'Dataset.id' => $this->request->data['dataset_b_id'])));

		    //get csv a
		    $file_a = WWW_ROOT . 'uploads/datasets/' . $dataset_a['Dataset']['column_info'];
			$csv_a = file_get_contents($file_a);
			$array_a = array_map("str_getcsv", explode("\n", $csv_a));

			//get csv b
			$file_b = WWW_ROOT . 'uploads/datasets/' . $dataset_b['Dataset']['column_info'];
			$csv_b = file_get_contents($file_b);
			$array_b = array_map("str_getcsv", explode("\n", $csv_b));

			//array for criteria in a and not in b
			$array_a_less = array('0'=>'Unmatched');

			foreach ($array_a as $value_a) {
				
				//check if the value appears in screening or weighting
				if( array_key_exists( '4', $value_a) ) {

					if ($value_a['4'] == "TRUE" or $value_a['5'] == "TRUE") {
						$exist = false;
						foreach ($array_b as $value_b) {
							if($value_a['0'] === $value_b['0']) {
								$exist = true;
								continue;
							}
						}
						if (!$exist) {
							array_push($array_a_less, $value_a['0']);
						}
					}
				}

			}

			//array for criteria in b and not in a
			$array_b_less = array('0'=>'Unmatched');

			foreach ($array_b as $value_b) {
				
				//check if the value appears in screening or weighting
				if( array_key_exists( '4', $value_b) ) {

					if ($value_b['4'] == "TRUE" or $value_b['5'] == "TRUE") {
						$exist = false;
						foreach ($array_a as $value_a) {
							if($value_b['0'] === $value_a['0']) {
								$exist = true;
								continue;
							}
						}
						if (!$exist) {
							array_push($array_b_less, $value_b['0']);
						}
					}
				}

			}

			//check wich is more large
			if( count( $array_a_less ) > count( $array_b_less ) ){
				$rows = count( $array_a_less );
			} else {
				$rows = count( $array_b_less );
			}


	    }
	    $datasets = $this->Dataset->find('all');
	    $matches = $this->Matched->find('all');

    	$this->set(compact('datasets', 'matches', 'array_a', 'dataset_a', 'dataset_b', 'c', 'array_a_less', 'array_b_less', 'rows'));
		$this->set('_serialize', array('datasets', 'matches', 'array_a', 'dataset_a', 'dataset_b', 'c', 'array_a_less', 'array_b_less', 'rows'));
	}

	//save match
	public function saveMatch($a=null, $b=null) {
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is('post') and ( $a != null and $b != null ) ) {
	    	
	    	//dataset a
	    	$dat_name_a = $this->Dataset->find('first', array( 'conditions' =>array('Dataset.id' => $a ) ));
	    	
	    	//dataset b
	    	$dat_name_b = $this->Dataset->find('first', array( 'conditions' =>array('Dataset.id' => $b ) ));
	    	

	    	$match = array('Matched' => array( 
	    		'name' => 'Map - '.$dat_name_a['Dataset']['name'] . ' - ' .$dat_name_b['Dataset']['name'], 
	    		'dataset_a_id' => $a,
	    		'dataset_b_id' => $b,
	    		'match' =>  json_encode( $this->request->data )
	    	));

	    	$this->Matched->create();

	    	if ($this->Matched->save($match)) {
	    		return $this->redirect(array('action'=>'match'));
	    	} else {
	    		return $this->redirect(array('action'=>'match'));
	    	}

	    }

	    $this->set(compact('resp', 'dataset_a_id'));
		$this->set('_serialize', array('resp', 'dataset_a_id'));
	}

	//Create new plan with stripe
	public function stripePlanes($id = null) {
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    if ($this->request->is(array('post', 'put'))) {
			$this->Plan->create();
			if ($this->Plan->save($this->request->data)) {
				$this->Session->setFlash(('The plan was saved'));
				return $this->redirect(array('action' => 'plans', $id));
			} else {
				$this->Session->setFlash(('The plan was not saved.'));
				return $this->redirect(array('action' => 'plans', $id));
			}
		}

	    $title_for_layout = "DECIDERE | ADMIN - DATASET PROVIDER PLANS";

	    if($id != null) {
	    	$plans = $this->Plan->find('all', array('conditions' => array('Plan.provider_id' => $id ), 'recursive'=>1 ) );
	    	$provider = $this->Provider->find('first', array('conditions'=>array('Provider.id'=>$id)));
	    } else {
	    	return $this->redirect(array('action'=>'datasets'));
	    }

		$this->set(compact('title_for_layout', 'plans', 'provider'));
		$this->set('_serialize', array('title_for_layout', 'plans', 'provider'));
	}

	public function saveStripePlan() {

		//if users is login
		if($this->Session->read('Auth.User.role')!='1') {
	    	//if usr are not autorized or not login
	    	$response = 'unauthorized';

	    } else {

		    //if is reques ajax
			if ($this->request->is('ajax')) {

				if (!isset($this->request->data['Plan']['id'])) {

					//check if that exists plan
					$plan = $this->Plan->find('first', array( 'conditions'=>array( 'Plan.name' => $this->request->data['Plan']['name'], 'Plan.provider_id' => $this->request->data['Plan']['provider_id'] ) ) );

				} else {
					//check if that exists provider
					$plan = $this->Plan->find('first', array( 'conditions'=>array( 'Plan.name' => $this->request->data['Plan']['name'], 'Plan.provider_id' => $this->request->data['Plan']['provider_id'], 'Plan.id !=' => $this->request->data['Plan']['id'] ) ) );
				}

				if (count($plan) > 0) {
					$response = 'plan exists';
				} else {
					$this->Plan->create();
					if ($this->Plan->save($this->request->data)) {
						//obtain the id plan
						$plan_id = $this->Plan->id;

						$response = 'success local';

						$interval = '';

						if ($this->request->data['Plan']['duration'] == 'Monthly' ) {
							$interval = 'month';
						} elseif ($this->request->data['Plan']['duration'] == 'Annual') {
							$interval = 'year';
						}
						//Retrive plan from stripe
			        	\Stripe\Stripe::setApiKey( $this->stripeApiKey );
						
			        	try {
						
							$plan_stripe = \Stripe\Plan::retrieve($plan_id);
							$plan_stripe->name = $this->request->data['Plan']['name'];
							$plan_stripe->save();

							$response = 'success stripe edit';
			        		
			        	} catch (Exception $e) {
			        		
							$amount = (String)$this->request->data['Plan']['price']; 
							$amount = str_replace('.', '', $amount);
							$amount = str_replace(',', '', $amount);
	        	

				        	$plan_stripe = \Stripe\Plan::create(array(
								"amount" => $amount,
								"interval" => $interval,
								"name" => $this->request->data['Plan']['name'],
								"currency" => "usd",
								"id" => $plan_id)
							);

							$response = 'success stripe add';
			        	}
			    		
			    	} else {
			    		$response = 'error';
			    	}
		    	}
			}
	    }


		//set response
		$this->set(compact('response', 'plan_stripe'));
		$this->set('_serialize', array('response', 'plan_stripe'));

	}

	//delete
	public function delete($id = null, $type = null, $id_url=null) {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array('action'=>'login'));
	    }
		$flag = false;
		$model = "";
		$message = "";
		$url = "";
		switch ($type) {
			case 'scenario':
				$model = 'Scenario';
				$flag = true;
				$message = 'The scenario';
				$url = "dashboard";
				break;

			case 'category':
				$model = 'Category';
				$flag = true;
				$message = 'The category';
				$url = "datasets";
				break;

			case 'provider':
				$model = 'Provider';
				$flag = true;
				$message = 'The provider';
				$url = "providers/".$id_url;
				break;

			case 'plan':
				$model = 'Plan';
				$flag = true;
				$message = 'The plan';
				$url = "stripePlanes/".$id_url;
				break;

			case 'coupon':
				$model = 'Coupon';
				$flag = true;
				$message = 'The coupon';
				$url = "coupons";
				break;

			case 'user':
				$model = 'User';
				$flag = true;
				$message = 'The user';
				$url = "users";
				break;

			default:
				return $this->redirect(array('action' => 'index'));
				break;
		}

		if ($flag==true) {
			$this->$model->id = $id;
			if (!$this->$model->exists()) {
				$this->Session->setFlash(__($message.' no valid'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this->$model->delete($id, true)) {
				$this->Session->setFlash(( $message.'  was successfully deleted.'));
			} else {
				$this->Session->setFlash(('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$message.' no pudo eliminarse.'), 'default', array('class'=>'alert alert-danger alert-dismissible fade in'));
			}
			return $this->redirect(array('action' => $url));
		} else {
			return $this->redirect(array('action' => $url));
		}		
	}
	
	public function info() {

		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    $this->paginate();
	    $title_for_layout = "DECIDERE | ADMIN - INFO POPUPS";
	    $info = $this->Info->find('all', array( 'recursive'=>2,'order'=>'page, name')  );
		$this->set(compact('title_for_layout', 'info'));
		
		$this->set('_serialize', array('title_for_layout', 'info'));
		
	}


	public function infoCreate() {
		
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array('action'=>'login'));
	    }
	    $this->paginate();
	    $title_for_layout = "DECIDERE | ADMIN - INFO CREATE";
	    $info = $this->Info->find('all', array( 'recursive'=>2 ) );
	    
		$this->set(compact('title_for_layout', 'info'));
		$this->set('_serialize', array('title_for_layout', 'info'));		
		
	}

	public function infoEdit($id = null) {
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array('action'=>'login'));
	    }

		$info = $this->Info->find('first', array('conditions'=>array('Info.id'=>$id)));
		    $this->paginate();
		    $title_for_layout = "DECIDERE | ADMIN - INFO EDIT";
		    
			$this->set(compact('title_for_layout', 'info'));
			$this->set('_serialize', array('title_for_layout', 'info'));			
	}




	public function infoSave() {
		
		$this->autoRender = false;
		
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    }
	    
		$infoDataset = array('Info' => array( 
    		'id' => $this->request->data['Admin']['id'], 
    		'page' => $this->request->data['Admin']['page'], 
    		'link' => $this->request->data['Admin']['link'], 
    		'name' => $this->request->data['Admin']['name'], 
    		'content' => $this->request->data['Admin']['content']
    	));

	   	$this->Info->save($infoDataset);

		return $this->redirect(array( 'controller'=>'Admin', 'action'=>'info'));
	}
	
	public function infoUpdate() {
		
		$this->autoRender = false;
		
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    }
	    
		$infoDataset = array('Info' => array( 
    		'id' => $this->request->data['Admin']['id'], 
    		'page' => $this->request->data['Admin']['page'], 
    		'link' => $this->request->data['Admin']['link'], 
    		'name' => $this->request->data['Admin']['name'], 
    		'content' => $this->request->data['Admin']['content']
    	));

	   	$this->Info->save($infoDataset);
	   	
		return $this->redirect(array( 'controller'=>'Admin', 'action'=>'info'));
	}


	public function infoDelete($id=null) {
		
		$this->autoRender = false;
		
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    }

	    
      	$this->Info->delete($id,true);
		return $this->redirect(array( 'controller'=>'Admin', 'action'=>'info'));
	}


}
