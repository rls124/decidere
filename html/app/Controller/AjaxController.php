<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('HttpSocket', 'Network/Http');
App::import('Vendor', 'Stripe', array('file' => 'stripe-php-3.15.0/init.php'));

class AjaxController extends AppController {

	public $uses = array('User', 'Dataset', 'Scenario', 'Provider', 'Favorite', 'Matched', 'Category', 'Info', 'Plan', 'UserProvider', 'UserPlan', 'Coupon', 'UserToken');
	public $helpers = array('Js', 'Session');
	public $components = array('RequestHandler');

	public function saveCategoryDataset() {
		//if users is login
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    }

	    //if is reques ajax
		if ($this->request->is('ajax')) {

			if (!isset($this->request->data['Category']['id'])) {
				$category = $this->Category->find('first', array( 'conditions'=>array( 'Category.name' => $this->request->data['Category']['name'] ) ) );
				if (count($category) > 0) {
					$response = array('response' => array( 'status'=>'category exists' ) );
				} else {
					$this->Category->create();
					if ($this->Category->save($this->request->data)) {
			    		$response = array('response' => array( 'status'=>'success add' ) );
			    	} else {
			    		$response = array('response' => array( 'status'=>'error add' ));
			    	}
		    	}
			} else {
				$this->Category->create();
				if ($this->Category->save($this->request->data)) {
		    		$response = array('response' => array( 'status'=>'success edit' ) );
		    	} else {
		    		$response = array('response' => array( 'status'=>'error edit' ));
		    	}
			}


		}

		//set response
		$this->set(compact('response'));
		$this->set('_serialize', array('response'));
	}


	/*public function saveProviderDataset() {
		//if users is login
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    }

	    //if is reques ajax
		if ($this->request->is('ajax')) {
			if (!isset($this->request->data['Provider']['id'])) {
				$provider = $this->Provider->find('first', array( 'conditions'=>array( 'Provider.name' => $this->request->data['Provider']['name'], 'Provider.category_id' => $this->request->data['Provider']['category_id'] ) ) );
				if (count($provider) > 0) {
					$response = array('response' => array( 'status'=>'provider exists' ) );
				} else {
					$this->Provider->create();
					if ($this->Provider->save($this->request->data)) {
			    		$response = array('response' => array( 'status'=>'success add' ) );
			    	} else {
			    		$response = array('response' => array( 'status'=>'error add' ));
			    	}
		    	}
			} else {
				$this->Provider->create();
				if ($this->Provider->save($this->request->data)) {
		    		$response = array('response' => array( 'status'=>'success edit' ) );
		    	} else {
		    		$response = array('response' => array( 'status'=>'error edit' ));
		    	}
			}
		}

		//set response
		$this->set(compact('response'));
		$this->set('_serialize', array('response'));
	}*/

	//save dataset provider
	public function saveProviderDataset() {
		//if users is login
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    }

	    //if is reques ajax
		if ($this->request->is('ajax')) {

			if (!isset($this->request->data['Provider']['id'])) {

				//check if that exists provider
				$provider = $this->Provider->find('first', array( 'conditions'=>array( 'Provider.name' => $this->request->data['Provider']['name'] ) ) );

			} else {
				//check if that exists provider
				$provider = $this->Provider->find('first', array( 'conditions'=>array( 'Provider.name' => $this->request->data['Provider']['name'], 'Provider.id !='=> $this->request->data['Provider']['id'] ) ) );				
			}


			if ( count($provider) > 0 ) {
				$response = array('response' => array( 'status'=>'provider exists' ) );
			} else {
				$this->Provider->create();
				if ($this->Provider->save($this->request->data)) {
					$provider_id = $this->Provider->id;

					if ($this->request->data['Provider']['type'] == 1 ) {
						
						$users = $this->User->find('all');

						if( count ($users) > 0 ) {
							foreach ($users as $key => $value) {

								if ( $this->UserProvider->find('count', array('conditions' => array('UserProvider.user_id' => $value['User']['id'], 'UserProvider.provider_id '=> $provider_id, 'UserProvider.demo'=>1 ) ) ) > 0 ) {
									continue;
								} else {

									$userProvider = array(
										'name' => $this->request->data['Provider']['name'],
										'user_id' => $value['User']['id'],
										'provider_id' => $provider_id,
										'provider' => $this->request->data['Provider']['name'],
										'txn_id' => '',
										'demo' => '1'
									);
									$this->UserProvider->create();
									$this->UserProvider->save($userProvider);

								}

							}
						}

					}
		    		$response = array('response' => array( 'status'=>'success' ) );
		    	} else {
		    		$response = array('response' => array( 'status'=>'error' ));
		    	}
			}
		}

		//set response
		$this->set(compact('response'));
		$this->set('_serialize', array('response'));
	}


	//save dataset plans
	public function savePlanDataset() {
		//if users is login
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    }

	    //if is reques ajax
		if ($this->request->is('ajax')) {
			if (!isset($this->request->data['Plan']['id'])) {
				$plan = $this->Plan->find('first', array( 'conditions'=>array( 'Plan.name' => $this->request->data['Plan']['name'], 'Plan.provider_id' => $this->request->data['Plan']['provider_id'] ) ) );
				if (count($plan) > 0) {
					$response = array('response' => array( 'status'=>'plan exists' ) );
				} else {
					$this->Plan->create();
					if ($this->Plan->save($this->request->data)) {
			    		$response = array('response' => array( 'status'=>'success add' ) );
			    	} else {
			    		$response = array('response' => array( 'status'=>'error add' ));
			    	}
		    	}
			} else {
				$plan = $this->Plan->find('first', array( 'conditions'=>array( 'Plan.name' => $this->request->data['Plan']['name'], 'Plan.provider_id' => $this->request->data['Plan']['provider_id'], 'Plan.id !=' => $this->request->data['Plan']['id'] ) ) );
				if (count($plan) > 0) {
					$response = array('response' => array( 'status'=>'plan exists' ) );
				} else {
					$this->Plan->create();
					if ($this->Plan->save($this->request->data)) {
			    		$response = array('response' => array( 'status'=>'success edit' ) );
			    	} else {
			    		$response = array('response' => array( 'status'=>'error edit' ));
			    	}
		    	}
			}
		}

		//set response
		$this->set(compact('response'));
		$this->set('_serialize', array('response'));
	}

	public function saveCoupons() {
		//if users is login
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    }

	    //if is reques ajax
		if ($this->request->is('ajax')) {
			$this->Coupon->create();
			if ($this->Coupon->save($this->request->data)) {
	    		$response = array('response' => array( 'status'=>'success edit' ) );
	    	} else {
	    		$response = array('response' => array( 'status'=>'error edit' ));
	    	}
		}

		//set response
		$this->set(compact('response'));
		$this->set('_serialize', array('response'));
	}

	public function checkCoupons() {
		//if users is login
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    }

	    //if is reques ajax
		if ($this->request->is('ajax')) {
			
			$coupon = $this->Coupon->find('first', array( 'conditions'=>array( 'Coupon.code' => $this->request->data['coupon'], 'Coupon.state' => '1' ) ) );

			if ( count($coupon) > 0 ) {
				$this->Session->write('ShoppingCartDiscount', (float)$coupon['Coupon']['percentage']);

	    		$response = array('response' => array( 'status'=>'found', 'coupon' => $coupon, 'discount' => $this->Session->read('ShoppingCartDiscount') ) );
	    	} else {
	    		$this->Session->write('ShoppingCartDiscount', 0);
	    		$response = array('response' => array( 'status'=>'not_found', 'coupon' => $coupon, 'discount' => $this->Session->read('ShoppingCartDiscount') ));
	    	}
		}

		//set response
		$this->set(compact('response'));
		$this->set('_serialize', array('response'));
	}

	public function saveUser() {
		//if users is login how admin
		if($this->Session->read('Auth.User.role')!='1') {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    }

	    //if is reques ajax
		if ($this->request->is('ajax')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
	    		$response = array('response' => array( 'status'=>'success edit' ) );
	    	} else {
	    		$response = array('response' => array( 'status'=>'error edit' ));
	    	}
		}

		//set response
		$this->set(compact('response'));
		$this->set('_serialize', array('response'));
	}



	public function contact() {
	    //if is reques ajax
		if ($this->request->is('ajax')) {
			//send mail to admin

			$dataAll = $this->request->data;

			switch ($dataAll['Contact']['subject']) {
				case '1':
					$dataAll['Contact']['subject'] = 'I want to use my own data';
					break;

				case '2':
					$dataAll['Contact']['subject'] = 'Payment Issues';
					break;

				case '3':
					$dataAll['Contact']['subject'] = 'Registration Issues';
					break;

				case '4':
					$dataAll['Contact']['subject'] = 'Issues running scenarios';
					break;

				case '5':
					$dataAll['Contact']['subject'] = 'Other';
					break;

				default:
					$dataAll['Contact']['subject'] = 'Other';
					break;
			}


			$this->Email = new CakeEmail('smtp2go');
	        //$this->Email->from(array('admin@decidere.com' => 'DECIDERE'));
	        $this->Email->to(array('necogumiel@gmail.com', 'lana.beregszazi@decidere.com'));
	        $this->Email->subject( $dataAll['Contact']['subject'] );
	        $this->Email->template('contact');
	        $this->Email->emailFormat('html');
	        $this->Email->viewVars(array('dataAll'=>$dataAll));//envia datos
	       
	       	if(	$this->Email->send()){
	       		$response = array('response' => array( 'status'=>'success' ) );
	       	} else {
	       		$response = array('response' => array( 'status'=>'error' ));
	       	}
		}

		//set response
		$this->set(compact('response'));
		$this->set('_serialize', array('response'));
	}
	


	public function getSessionStatus() {
		if($this->Session->read('ShoppingCart')) {
	    	$status = 'logged';
	    	$session = array('User' => array(
	    		'first_name' => $this->Session->read('Auth.User.first_name'),
	    		'last_name' => $this->Session->read('Auth.User.last_name'),
	    		'role' => $this->Session->read('Auth.User.role')
	    	));
	    } else {
	    	$status = 'no_logged';
	    	$session = null;
	    }

	    $this->set(compact('status', 'session'));
		$this->set('_serialize', array('status', 'session'));

	}


	//edit name scenario from dashboard
	public function editNameScenario() {
		//if users is login
		if($this->Session->read('Auth.User.role')) {
		    //if is reques ajax
			if ($this->request->is('ajax')) {

				$scenario = $this->Scenario->find('first', array( 'conditions'=>array( 'Scenario.id' => $this->request->data['Scenario']['id'], 'Scenario.user_id' => $this->Session->read('Auth.User.id') ) ) );

				if ( count($scenario) > 0 ) { 
					$this->Scenario->id = $this->request->data['Scenario']['id'];
					$this->Scenario->saveField('name', $this->request->data['Scenario']['name']);
					$response = array('response' => array( 'status'=>'success', 'id'=>$this->request->data['Scenario']['id'], 'name'=>$this->request->data['Scenario']['name'] ));
				} else {
		    		$response = array('response' => array( 'status'=>'scenario not found' ));
		    	}		
			}
	    } else {
	    	$response = array('response' => array( 'status'=>'unautorized' ));
	    }

		//set response
		$this->set(compact('response'));
		$this->set('_serialize', array('response'));
	}


	//show / no show provider on dashboard
	public function swithVisibilityUserProvier() {
		//if users is login
		if($this->Session->read('Auth.User.role')) {
		    //if is reques ajax
			if ($this->request->is('ajax')) {

				$user_provider = $this->UserProvider->find('first', array( 'conditions'=>array( 'UserProvider.id' => $this->request->data['UserProvider']['id'], 'UserProvider.user_id' => $this->Session->read('Auth.User.id') ) ) );

				if ( count($user_provider) > 0 ) { 
					$this->UserProvider->id = $this->request->data['UserProvider']['id'];
					$this->UserProvider->saveField('state', $this->request->data['UserProvider']['state']);
					$response = array('response' => array( 'status'=>'success' ));
				} else {
		    		$response = array('response' => array( 'status'=>'user_provider not found' ));
		    	}		
			}
	    } else {
	    	$response = array('response' => array( 'status'=>'unautorized' ));
	    }

		//set response
		$this->set(compact('response'));
		$this->set('_serialize', array('response'));
	}

	
	//delete favorite from dashboard
	public function deleteFavorite() {
		//if users is login
		if($this->Session->read('Auth.User.role')) {
		    //if is reques ajax
			if ($this->request->is('ajax')) {

				$favorite = $this->Favorite->find('first', array( 'conditions'=>array( 'Favorite.id' => $this->request->data['Favorite']['id'], 'Favorite.user_id' => $this->Session->read('Auth.User.id') ) ) );

				if ( count($favorite) > 0 ) { 
					$this->Favorite->id = $this->request->data['Favorite']['id'];
					$this->Favorite->delete();
					$response = array('response' => array( 'status'=>'success', 'id'=>$this->request->data['Favorite']['id'] ));
				} else {
		    		$response = array('response' => array( 'status'=>'favorite not found' ));
		    	}		
			}
	    } else {
	    	$response = array('response' => array( 'status'=>'unautorized' ));
	    }

		//set response
		$this->set(compact('response'));
		$this->set('_serialize', array('response'));
	}


	//delete scenario from dashboard
	public function deleteScenario() {
		//if users is login
		if($this->Session->read('Auth.User.role')) {
		    //if is reques ajax
			if ($this->request->is('ajax')) {

				$scenario = $this->Scenario->find('first', array( 'conditions'=>array( 'Scenario.id' => $this->request->data['Scenario']['id'], 'Scenario.user_id' => $this->Session->read('Auth.User.id') ) ) );

				if ( count($scenario) > 0 ) { 
					$this->Scenario->id = $this->request->data['Scenario']['id'];
					$this->Scenario->delete();
					$response = array('response' => array( 'status'=>'success'));
				} else {
		    		$response = array('response' => array( 'status'=>'scenario not found' ));
		    	}		
			}
	    } else {
	    	$response = array('response' => array( 'status'=>'unautorized' ));
	    }

		//set response
		$this->set(compact('response'));
		$this->set('_serialize', array('response'));
	}



	//delete userprovider from dashboard
	public function deleteUserProviderDashboard() {
		//if users is login
		if($this->Session->read('Auth.User.role')) {
		    //if is reques ajax
			if ($this->request->is('ajax')) {

				$user_provider = $this->UserProvider->find('first', array( 'conditions'=>array( 'UserProvider.id' => $this->request->data['UserProvider']['id'], 'UserProvider.user_id' => $this->Session->read('Auth.User.id') ) ) );


				/* CORE10-SW-DEC-1 ... Fixed 'User deletes his/her subscription but continues being billed.' */			
				$error = false;
				if ( count($user_provider) > 0 ) { 

					if ( $user_provider['UserProvider']['stripe_subscription'] != '' && $user_provider['UserProvider']['current_period_end'] > 0 ) {
						//set apiKey for stripe
						\Stripe\Stripe::setApiKey( $this->stripeApiKey );

						try {
							
							$sub = \Stripe\Subscription::retrieve($user_provider['UserProvider']['stripe_subscription']);
							$sub->cancel();

						} catch (Exception $e) {
							$error = true;
						}

					} 
					if (!$error) {
						$this->UserProvider->id = $this->request->data['UserProvider']['id'];
						$this->UserProvider->delete();
						$response = array('response' => array( 'status'=>'success', 'id'=>$this->request->data['UserProvider']['id'] ));
						
						
						/* CORE10-SW-DEC-10 ... Added 'Add subscription cancellation email notification' */						
						$dataAll = $user_provider;
						$this->Email = new CakeEmail('smtp2go');
				        $this->Email->from(array('admin@decidere.com' => 'DECIDERE'));
				        $this->Email->to(array('admin@decidere.com' => 'DECIDERE'));
				        $this->Email->subject('Decidere Dataset Cancellation');
				        $this->Email->template('cancellation');
				        $this->Email->emailFormat('html');
				        $this->Email->viewVars(array('dataAll'=>$dataAll));//envia datos
				        
				       	if(	$this->Email->send()){
				       	}
						
					} else {
						$response = array('response' => array( 'status'=>'Error cancelling subscription.' ));
					}


				} else {
		    		$response = array('response' => array( 'status'=>'user_provider not found' ));
		    	}		
			}
	    } else {
	    	$response = array('response' => array( 'status'=>'unautorized' ));
	    }

		//set response
		$this->set(compact('response'));
		$this->set('_serialize', array('response'));
	}

	//edit contact info user from uer maneger account
	public function editContactInfoUser() {
		//if users is login
		if($this->Session->read('Auth.User.role')) {
		    //if is reques ajax
			if ($this->request->is('ajax')) {

				//check if is the same id logged
				$this->request->data['User']['id'] = $this->Session->read('Auth.User.id');
				//$this->request->data['User']['id'] = $this->Session->read('Auth.User.id');
				$user = $this->User->find('first', array('conditions' => array('User.id'=> $this->Session->read('Auth.User.id') ) ) );
				$this->request->data['User']['role'] = $user['User']['role'];

				$this->User->create();
				if ($this->User->save($this->request->data)) {
					$user = $this->User->find('first', array('conditions' => array('User.id'=> $this->Session->read('Auth.User.id') ) ) );
					$this->Session->write('Auth', $this->User->read(null, $this->Auth->User('id')));
		    		$response = array('response' => array( 'status'=>'success edit' ) );
		    	} else {
					$username = '';
					$email = '';
					//check if exist email
					if ( $this->User->find('count', array('conditions' => array('User.username' => $this->request->data['User']['username'], 'User.id !='=> $this->Session->read('Auth.User.id') ) ) ) > 0 ) {
						$username = 'unavailable';
					}

					//che if exist email
					if ( $this->User->find('count', array('conditions' => array('User.email' => $this->request->data['User']['email'], 'User.id !='=> $this->Session->read('Auth.User.id') ) ) ) > 0 ) {
						$email = 'unavailable';
					}

					$response = array('response' => array( 'status'=>'error edit' ));
				}	

			}

	    } else {
	    	$response = array('response' => array( 'status'=>'unautorized' ));
	    }

		//set response
		$this->set(compact('response', 'username', 'email'));
		$this->set('_serialize', array('response', 'username', 'email'));
	}

	//change password from page management account user
	public function userChangePassword() {
		//if users is login
		if($this->Session->read('Auth.User.role')) {
		    //if is reques ajax
			if ($this->request->is('ajax')) {

				$user = $this->User->find('first', array( 'conditions'=>array( 'User.id' => $this->Session->read('Auth.User.id'), 'User.password'=>AuthComponent::password($this->request->data['User']['password']) ) ) );

				if ( count($user) > 0 ) {
					$this->User->id = $this->Session->read('Auth.User.id');
					$this->User->saveField('password', $this->request->data['User']['new_password']);
					$response = array('response' => array( 'status'=>'success' ));
				} else {
		    		$response = array('response' => array( 'status'=>'password wrong' ));
		    	}		
			}
	    } else {
	    	$response = array('response' => array( 'status'=>'unautorized' ));
	    }

		//set response
		$this->set(compact('response'));
		$this->set('_serialize', array('response'));
	}


	//deactivte account user
	public function deactivateAccount() {
		//if users is login
		if($this->Session->read('Auth.User.role')) {
		    //if is reques ajax
			if ($this->request->is('ajax')) {

				$url = '#';

				$user = $this->User->find('first', array( 'conditions'=>array( 'User.id' => $this->Session->read('Auth.User.id') ) ) );

				$error = false;
				if ( count($user) > 0 ) {

						if ($user['User']['id_stripe'] != '' ) {
							//set apiKey for stripe
		    				\Stripe\Stripe::setApiKey( $this->stripeApiKey );
		    				try {
		    					$customer = \Stripe\Customer::retrieve($user['User']['id_stripe']);
								$customer->delete();	
		    				} catch (Exception $e) {
								$error = true;
		    				}
						}

					if (!$error) {
						//change id_stripe
						$this->User->id = $this->Session->read('Auth.User.id');
						$this->User->saveField('id_stripe', '');
	
						//delete all providers
						$this->UserProvider->deleteAll(array('UserProvider.user_id' => $this->Session->read('Auth.User.id')), false);
	
						//change state to 0
						$this->User->id = $this->Session->read('Auth.User.id');
						$this->User->saveField('state', 0);
						$url = Router::url(['controller' => 'Admin', 'action' => 'logout']);
						$response = array('response' => array( 'status'=>'success' ));
					} else {
						$response = array('response' => array( 'status'=>'error deactivating user account.' ));
					}
					
				} else {
		    		$response = array('response' => array( 'status'=>'user not found' ));
		    	}		
			}
	    } else {
	    	$response = array('response' => array( 'status'=>'unautorized' ));
	    }

		//set response
		$this->set(compact('response', 'url'));
		$this->set('_serialize', array('response', 'url'));
	}

	//setorder dataset provider on dashboard
	public function setOrderUserProvider() {
		
		//if user is not login
		$response = 'You are not login';
		
		//if users is login
		if($this->Session->read('Auth.User.role')) {

			if ($this->request->is('ajax')) {
				$userProviders = json_decode( $this->request->data['providers'] ) ;

				foreach ($userProviders as $key => $userProvider) {
					$this->UserProvider->updateAll( array('UserProvider.order'=>$userProvider->order ), array('UserProvider.provider' => $userProvider->dataset, 'UserProvider.user_id' => $this->Session->read('Auth.User.id') ) );
					//$this->UserProvider->updateAll( array('UserProvider.order'=>$userProvider->order), array('UserProvider.provider' => 'Fantasy-FB', 'UserProvider.user_id' => 1 ) );
				}

				$response = 'succes';

			}
		}

		//set response
		$this->set(compact('response'));
		$this->set('_serialize', array('response'));
	}


	//set default source for user
	public function setDefaultSource() {
		//if user is not login
		$response = 'unautorized';
		
		//if users is login
		if($this->Session->read('Auth.User.role')) {

			if ($this->request->is('ajax')) {

				$user = $this->User->find('first', array('conditions'=>array('User.id'=>$this->Session->read('Auth.User.id'))));

				if ( $user['User']['id_stripe'] != '' ) {
					
					\Stripe\Stripe::setApiKey( $this->stripeApiKey );

					try {
						
						$customer = \Stripe\Customer::retrieve( $user['User']['id_stripe'] );
						$customer->default_source = $this->request->data['User']['default_source']; // obtained with Stripe.js
						$customer->save();
						$response = 'success';

					} catch (Exception $e) {
						$update_status = 'error';					
						$response = 'error';
					}
				
				}

			}
		}

		//set response
		$this->set(compact('response'));
		$this->set('_serialize', array('response'));
	}


	//delete customer card
	public function deleteCustomerCard() {
		//if user is not login
		$response = 'unautorized';

		//if users is login
		if($this->Session->read('Auth.User.role')) {

			if ($this->request->is('ajax')) {

				$user = $this->User->find('first', array('conditions'=>array('User.id'=>$this->Session->read('Auth.User.id'))));

				if ( $user['User']['id_stripe'] != '' ) {
					
					\Stripe\Stripe::setApiKey( $this->stripeApiKey );

					try {
						$customer = \Stripe\Customer::retrieve( $user['User']['id_stripe'] );
						$result_deleted = $customer->sources->retrieve( $this->request->data['User']['source'] )->delete();
						$response = 'success';

					} catch (Exception $e) {				
						$response = 'error';
					}
				
				}

			}
		}
		

		//set response
		$this->set(compact('response'));
		$this->set('_serialize', array('response'));
	}
	
	public function infoGet() {
		
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			$info = $this->Info->find('first', array('conditions'=>array('Info.link'=>$this->request->data['link'])));
			
			if (count($info) == 0) {
				$info_dataset = array( 
		    		'link' => $this->request->data['link'],
		    		'name' => str_replace("_"," ",$this->request->data['link'])
		    	);
		    	$this->Info->create();
		    	$this->Info->save($info_dataset);
			}
			
			$this->set(compact('info'));
			$this->set('_serialize', array('info'));
			echo json_encode($info);
		}
		
	}

}