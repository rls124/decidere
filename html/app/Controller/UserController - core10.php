<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('HttpSocket', 'Network/Http');
App::import('Vendor', 'HttpClient', array('file' => 'HttpClient.class.php'));
App::import('Vendor', 'Stripe', array('file' => 'stripe-php-3.15.0/init.php'));

class UserController extends AppController { 

	public $uses = array('User', 'Dataset', 'Scenario', 'Provider', 'Favorite', 'Mapping', 'Category', 'Plan', 'UserProvider', 'UserPlan', 'Coupon', 'UserDataset');
	public $helpers = array('Js', 'Session');
	public $components = array('RequestHandler');


	//dashboard from API datasets
	public function dashboard() {

/*
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    }
*/

	    //get scenarios from user
	    $scenarios = $this->Scenario->find('all', array('conditions' => array('Scenario.user_id' => $this->Session->read('Auth.User.id') ), 'order'=>array('Scenario.created'=>'DESC') ));

	    //get providers purchased actives no demo from user
	    $user_providers = $this->UserProvider->find('list', array('conditions' => array('UserProvider.user_id' => $this->Session->read('Auth.User.id'), 'UserProvider.state' => 1 ), 'fields' => array('UserProvider.provider'), 'order'=>array('UserProvider.order'=>'ASC') ));

	    //get providers purchased actives no demo from user
	    //$user_providers_demo = $this->UserProvider->find('list', array('conditions' => array('UserProvider.user_id' => $this->Session->read('Auth.User.id'), 'UserProvider.state' => 1, 'UserProvider.demo' => 1 ), 'fields' => array('UserProvider.provider') ));

		//prepare request 
		$HttpSocket = new HttpSocket();
	    
		//get dataset list from server decidere
	    //$datasetListJson = $HttpSocket->get('http://lin.decidere.com/cgi-bin/R/datasetList');
	    $datasetListJson = $HttpSocket->get( $this->urlDatasetList );

		//clean response by get only body from request
		$datasetListJson = json_decode( $datasetListJson['body'] ); 
	    //declare array for adds datasets agroup by provider
	    $providerJson = array();



		if ( count($user_providers) > 0  ) {
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
		}


		$providerJson = array_merge(array_flip( $user_providers ), $providerJson);

		//--------------------------set current dataset ---------------------------
		$this->viewDatasets($providerJson);
		//--------------------------set current dataset ---------------------------

		//get all mappings
		$mappings = $this->Mapping->find('all', array('conditions' => array('Mapping.state' => 1 ) ) );
		//declare empty array for mappings
		$mappings_dataset = array();

		//recorre mappings for agroup by datasets
		foreach ($mappings as $key => $mapping) {
			if ( !array_key_exists( $mapping['Mapping']['dataset_a'] , $mappings_dataset) ) {
				
				$mappings_dataset[$mapping['Mapping']['dataset_a']] = array();

				array_push( $mappings_dataset[$mapping['Mapping']['dataset_a']], $mapping['Mapping']); 

			} else {
				array_push( $mappings_dataset[$mapping['Mapping']['dataset_a']], $mapping['Mapping']); 
			}
		}

		//recorre scenarios for add mappings
		foreach ($scenarios as $keyS => $scenario) {

			$scenarios[$keyS]['Mappings'] = array();

			$mapping_scenario = array();
			
			$mapping_scenario[ $scenario['Scenario']['dataset'] ] = $this->formatPeriod( $scenario['Scenario']['dataset'] )  ;

			if ( array_key_exists( $scenario['Scenario']['dataset'] , $mappings_dataset) ) {

				foreach ($mappings_dataset[ $scenario['Scenario']['dataset'] ] as $keyMap => $mapping) {
					$mapping_scenario[ $mapping['dataset_b'] ] =   $this->formatPeriod( $mapping['dataset_b']); 
				}
			} 
			ksort($mapping_scenario) ;
			array_push( $scenarios[$keyS]['Mappings'], $mapping_scenario); 

		}
	    $title_for_layout = "DECIDERE | DASHBOARD";
		$this->set(compact('title_for_layout', 'providerJson', 'scenarios', 'mappings_dataset', 'user_providers', 'datasetListJson'));
		$this->set('_serialize', array('title_for_layout', 'providerJson', 'scenarios', 'mappings_dataset', 'user_providers', 'datasetListJson'));

	}


	public function formatPeriod($dataset='') {
		
		$period = explode("_", $dataset);
		
		if ( count($period) >= 3) {
			
			return $period['1'] . ' ' . $period['3'];
		
		} else {
			return $dataset;
		}
	}

	public function viewDatasets($datasets_current = null) {
		
/*
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array( 'controller'=> 'Admin', 'action'=>'login'));
	    }
*/

		$user_dataset_current = $this->UserDataset->find('first', array('conditions' => array('UserDataset.user_id' => $this->Session->read('Auth.User.id'))));
	    if ( !empty( $user_dataset_current )) {
	    	
	    	$user_dataset = array( 'UserDataset' => array( 
	    		'id' => $user_dataset_current['UserDataset']['id'],
	    		'user_id' => $this->Session->read('Auth.User.id'),
	    		'datasets' => json_encode( $datasets_current )
	    	));
	    } else {
	    	$user_dataset = array( 'UserDataset' => array( 
	    		'user_id' => $this->Session->read('Auth.User.id'),
	    		'datasets' => json_encode( $datasets_current )
	    	));
	    }
    	$this->UserDataset->create();
    	$this->UserDataset->save($user_dataset);

    	if( !empty($datasets_current) ) {
	    	$this->Session->write('CurrentDatasets', json_encode($datasets_current) );
	    	$this->Session->write('UserCurrentDatasets', json_encode($datasets_current));
	    } else {
	    	$this->Session->write('CurrentDatasets', '{}');
	    	$this->Session->write('UserCurrentDatasets', '{}');
	    }
	}

	//new Scenario from API datasets
	public function newScenario() {

		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array( 'controller'=> 'Admin', 'action'=>'login'));
	    }


	    if ($this->request->is('post')) {
	    	//get Dataset ID from post
			$dataset_id = $this->request->data['Scenario']['datasetId'];

			$period = $dataset_id;
	    	
	    	//get column info from API prepare client http
	    	$HttpSocket = new HttpSocket();

			//prepare data for post
			$data = array('datasetId' => $dataset_id);
		
	    	//get column info from decidere.com
	    	//$columnInfo = $HttpSocket->post('http://lin.decidere.com/cgi-bin/R/columnInfo', $data);
	    	$columnInfo = $HttpSocket->post( $this->urlColumnInfo, $data);
	    
	    	//decode column_info response body
	    	$columnInfo = json_decode( $columnInfo->body() );    

	    	//get options screeables from decidere.com 
	    	//$screenables_options = $HttpSocket->post('http://lin.decidere.com/cgi-bin/R/screenableLists', $data);
	    	$screenables_options = $HttpSocket->post( $this->urlScreenableLists , $data);

	    	//decode screenables options response body
	    	$screenables_options = json_decode( $screenables_options->body() );  

	    	$columnInfo = $this->addOptions($columnInfo, $screenables_options);

	    	$coulmnInfoGrouped = $this->agroupCriterian( $columnInfo );


	    	$period_for_show = $this->formatPeriod( $dataset_id );
		    
	    } else {
	    	return $this->redirect(array('action'=>'dashboard'));
	    }

	    $title_for_layout = "DECIDERE | NEW SCENARIO";
		$this->set(compact('title_for_layout', 'columnInfo', 'coulmnInfoGrouped', 'period', 'dataset_id', 'period_for_show'));
		$this->set('_serialize', array('title_for_layout', 'columnInfo', 'coulmnInfoGrouped', 'period', 'dataset_id', 'period_for_show'));

	}

	public function getPeriod($dataset_id = null) {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array('controller'=>'Admin', 'action'=>'login'));
	    }

	}

	//add options to criterian inputs
	public function addOptions($columnInfo = null, $screenables_options = null) {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    }

	    //recorre columninfo
	    foreach ($columnInfo as $key => $column) {

	    	//check if is type character
	    	if ($column->DataType == 'character') {
		    	
		    	//recorre screenable options
		    	foreach ($screenables_options as $key => $options) {
		    		
		    		//check if column is equal to columName from options
		    		if($column->Column == $options->columnName['0']) {
		    			$column->{'options'} = $options->options;
		    			break;
		    		}

		    	}
	    		
	    	}

	    }
	    return $columnInfo;
	}


	//agroup criterian inputs
	public function agroupCriterian ($columnInfo = null) {
		
		//array for groups
		$criterianByGroup = array();

		//recorre fullcriterian
		foreach ($columnInfo as $column) {

			//check if group different thta ugrouped
			if($column->CleanGroupName != 'ungrouped') {

				//check if not exist group in criterianByGroup
				if (!array_key_exists( $column->CleanGroupName,  $criterianByGroup)) {
					
					//if not exist, create group how array in criterianByGroup
					$criterianByGroup[$column->CleanGroupName]	= array();				

					//add criterio to group
					array_push( $criterianByGroup[$column->CleanGroupName] , $column); 

				} else {
					//add criterio to group
					array_push( $criterianByGroup[$column->CleanGroupName] , $column); 
				}

			}
		}
		//return all grouped criterian
		return $criterianByGroup;
	}

	//save new scenario
	public function saveAsScenario() {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    }
	    if ($this->request->is('ajax')) {

			$scenario = array('Scenario' => array( 
	    		'name' => $this->request->data['scenario_name'], 
	    		'dataset_id' =>0,
	    		'provider_id' => 0,
	    		'scenario' => $this->request->data['scenario_val'],
	    		'provider' => $this->request->data['provider'],
	    		'dataset' => $this->request->data['dataset'],
	    		'user_id' => $this->Session->read('Auth.User.id')
	    	));

	    	$this->Scenario->create();

	    	if ($this->Scenario->save($scenario)) {
	    		$response = array('response' => array( 'status'=>'success', 'id'=>$this->Scenario->id) );
	    	} else {
	    		$response = array('response' => 'error-----');
	    	}

	    	//$response = $this->request->data;

	    	$this->set(compact('response'));
			$this->set('_serialize', array('response'));
	    }
	}



	public function updateScenario() {
		
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    }
	    if ($this->request->is('ajax')) {

			$scenario = array('Scenario' => array( 
				'id' => $this->request->data['scenario_id'],
	    		'scenario' => $this->request->data['scenario_val']
	    	));

	    	if ($this->Scenario->save($scenario)) {
	    		$response = array('response' => array( 'status'=>'success', 'id'=>$this->Scenario->id) );
	    	} else {
	    		$response = array('response' => 'error-----');
	    	}

	    	$this->set(compact('response'));
			$this->set('_serialize', array('response'));
	    }
	}



	//save new results
	/*public function saveResults() {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array(  'controller'=>'Admin', 'action'=>'login'));
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
	    		$url = Router::url(['controller' => 'User', 'action' => 'dashboard']);
	    		$response = array('response' => array( 'status'=>'success', 'id'=>$this->Favorite->id) );
	    	} else {
	    		$response = array('response' => 'error');
	    	}

	    	$this->set(compact('response', 'url'));
			$this->set('_serialize', array('response', 'url'));

	    }
	}*/

	//save new results
	public function saveResults() {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array(  'controller'=>'Admin', 'action'=>'login'));
	    }
	    if ($this->request->is('ajax')) {

	    	$favorites = json_decode( $this->request->data['favorites'] );

	    	foreach ($favorites as $key => $value) {
	    		
				$favorite = array('Favorite' => array( 
		    		'headers' => json_encode( $this->request->data['headers']), 
		    		'favorite' => json_encode($value),
		    		'scenario_id' =>  $this->request->data['scenario_id'],
		    		'period' =>  $this->request->data['period'],
		    		'user_id' => $this->Session->read('Auth.User.id')
		    	));

		    	$this->Favorite->create();

		    	if ($this->Favorite->save($favorite)) {
		    		$url = Router::url(['controller' => 'User', 'action' => 'dashboard']);
		    		$response = array('response' => array( 'status'=>'success', 'id'=>$this->Favorite->id) );
		    	} else {
		    		$response = array('response' => 'error');
		    	}
	    	}

	    	$this->set(compact('response', 'url'));
			$this->set('_serialize', array('response', 'url'));

	    }
	}

	//edit scenario
	public function editScenario($id = null) {


		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array('controller'=>'Admin', 'action'=>'login'));
	    }
	    
	    
	    $title_for_layout = "DECIDERE | EDIT SCENARIO";
	    if($id != null){
	    	
	    	//retrive scenario 
	    	$scenario = $this->Scenario->find('first', array('conditions' => array('Scenario.id' => $id ) ));

	    	//get Dataset ID from scenario
			$dataset_id = $scenario['Scenario']['dataset'];

			$period = $dataset_id;
		    
		    //get column info from API prepare client http
	    	$HttpSocket = new HttpSocket();

			//prepare data for post
			$data = array('datasetId' => $dataset_id);

	    	//get column info from decidere.com
	    	//$columnInfo = $HttpSocket->post('http://lin.decidere.com/cgi-bin/R/columnInfo', $data);
	    	$columnInfo = $HttpSocket->post( $this->urlColumnInfo , $data);

	    	//decode column_info response body
	    	$columnInfo = json_decode( $columnInfo->body() );    

	    	//get options screeables from decidere.com 
	    	//$screenables_options = $HttpSocket->post('http://lin.decidere.com/cgi-bin/R/screenableLists', $data);
	    	$screenables_options = $HttpSocket->post( $this->urlScreenableLists , $data);

	    	//decode screenables options response body
	    	$screenables_options = json_decode( $screenables_options->body() );  

	    	$columnInfo = $this->addOptions($columnInfo, $screenables_options);

	    	$coulmnInfoGrouped = $this->agroupCriterian( $columnInfo );


	    } else {
	    	return $this->redirect(array('action'=>'dashboard'));
	    }

		$this->set(compact('title_for_layout', 'scenario',  'columnInfo', 'coulmnInfoGrouped', 'period', 'dataset_id' ));
		$this->set('_serialize', array('title_for_layout', 'scenario',  'columnInfo', 'coulmnInfoGrouped', 'period', 'dataset_id' ));
	}


	//RUN Scenario
	public function runScenario() {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array('controller'=>'Admin', 'action'=>'login'));
	    }
	    $title_for_layout = "DECIDERE | RUN SCENARIO - " . $this->Session->read('Auth.User.username');
	    if ($this->request->is('post') ) {
	    	
	    	//get data from reques
	    	$request_data = $this->request->data;

	    	//get scenario for run
	    	$scenario = $this->Scenario->find('first', array( 'conditions' => array( 'Scenario.id' => $request_data['scenario_id'] ) ) );

	    	//check if dataset origin is equal to dataset match
	    	if($scenario['Scenario']['dataset'] == $request_data['dataset_match']){
	    		
	    		//flag for matchin or not
	    		$forMaping = false;

	    		//dataset_id for R server
	    		$dataset_id = $scenario['Scenario']['dataset'];

				$period = $scenario['Scenario']['dataset'];

	    		//prepare data for post
				$data = array('datasetId' => $scenario['Scenario']['dataset']);

	    	} else {

	    		//flag for matching or not
	    		$forMaping = true;

	    		//dataset_id for R server
	    		$dataset_id =  $request_data['dataset_match'];

	    		//get match from to datasets
	    		$mapping = $this->Mapping->find('first',  array('conditions' => array( 'Mapping.dataset_a' => $scenario['Scenario']['dataset'], 'Mapping.dataset_b' => $request_data['dataset_match'] ) ) );

				$period = $request_data['dataset_match'];

	    		//prepare data for post
				$data = array('datasetId' => $request_data['dataset_match']);

	    	}

		    //get column info from API prepare client http
	    	$HttpSocket = new HttpSocket();

	    	//get column info from decidere.com
	    	//$columnInfo = $HttpSocket->post('http://lin.decidere.com/cgi-bin/R/columnInfo', $data);
	    	$columnInfo = $HttpSocket->post( $this->urlColumnInfo , $data);

	    	//decode column_info response body
	    	$columnInfo = json_decode( $columnInfo->body() );    

	    	//get options screeables from decidere.com 
	    	//$screenables_options = $HttpSocket->post('http://lin.decidere.com/cgi-bin/R/screenableLists', $data);
	    	$screenables_options = $HttpSocket->post( $this->urlScreenableLists , $data);

	    	//decode screenables options response body
	    	$screenables_options = json_decode( $screenables_options->body() );  

	    	$columnInfo = $this->addOptions($columnInfo, $screenables_options);

	    	$coulmnInfoGrouped = $this->agroupCriterian( $columnInfo );

	    }

	    $this->set(compact('title_for_layout', 'scenario', 'forMaping', 'mapping', 'columnInfo', 'coulmnInfoGrouped', 'period', 'dataset_id'));
		$this->set('_serialize', array('title_for_layout', 'scenario', 'forMaping', 'mapping', 'columnInfo', 'coulmnInfoGrouped', 'period', 'dataset_id'));
	}



	//account
	public function account() {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array('controller'=>'Admin', 'action'=>'login'));
	    }

	    $user_providers = $this->UserProvider->find('all', array('conditions'=>array('UserProvider.user_id'=>$this->Session->read('Auth.User.id')), 'order'=>array('UserProvider.order'=>'ASC') ));
	    $user = $this->User->find('first', array('conditions'=>array('User.id'=>$this->Session->read('Auth.User.id'))));
	    $stripeKey = $this->stripePublishableApiKey;
	    
	    if ($user['User']['id_stripe'] !='') {
	    	\Stripe\Stripe::setApiKey( $this->stripeApiKey );
	    	try {
	    		$customer = \Stripe\Customer::retrieve( $user['User']['id_stripe'] );
	    		$cards = json_encode($customer->sources->data);
	    		$default_source = $customer->default_source;
	    	} catch (Exception $e) {
	    		$customer = '';
	    		$cards = '';
	    	}
	    } else {
	    	$customer = '';
	    	$cards = '';
	    }

	    $this->set(compact('user_providers', 'user', 'customer', 'cards', 'default_source', 'stripeKey'));
		$this->set('_serialize', array('user_providers', 'user', 'customer', 'cards', 'default_source', 'stripeKey'));

	}


	//add credit card for user
	public function addCreditCard() {

		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array('controller'=>'Admin', 'action'=>'login'));
	    }

    	if ($this->request->is('post') ) {
    		//retrive token from strip.js
	    	$token = $_POST['stripeToken'];

	    	//retrive email from stripe.js
	    	$email = $_POST['stripeEmail'];

    		$user = $this->User->find('first', array('conditions'=>array('User.id'=>$this->Session->read('Auth.User.id'))));

    		//set apiKey for stripe
    		\Stripe\Stripe::setApiKey( $this->stripeApiKey );

    		//if user has stripe id (token)
    		if ($user['User']['id_stripe'] != '' ) {
    			try {
    				$customer = \Stripe\Customer::retrieve( $user['User']['id_stripe'] );
    				//create a new credit card item
					$newCreditCard = $customer->sources->create(array("source" => $token ));

    			} catch (Exception $e) {
    				
    			}
    		} else {
    			try {
    				//create a user on stripe
					$customer = \Stripe\Customer::create(array(
					  "source" => $token, // obtained from Stripe.js
					  "email" => $email,
					  "description" => "User " . $this->Session->read('Auth.User.username')
					));

					//Save the stripe id to user
					$this->User->id = $this->Session->read('Auth.User.id');

					//add customer id to user
					$this->User->saveField('id_stripe', $customer->id);

    			} catch (Exception $e) {
    				
    			}
    		}

		}

		return $this->redirect(array('controller'=>'User', 'action'=>'account'));

	}

	//deactivate account
	public function deactivate() {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array('controller'=>'Admin', 'action'=>'login'));
	    }

	    $user = $this->User->find('first', array('conditions'=>array('User.id'=>$this->Session->read('Auth.User.id'))));

	    $this->set(compact('user'));
		$this->set('_serialize', array('user'));

	}



	//delete
	public function delete($id = null, $type = null, $id_url=null) {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array('controller'=>'Admin', 'action'=>'login'));
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


}