<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::import('Vendor', 'Stripe', array('file' => 'stripe-php-3.15.0/init.php'));

class ShopController extends AppController {

	public $uses = array('User', 'Plan', 'UserProvider', 'UserToken');
	public $helpers = array('Js', 'Session');
	public $components = array('RequestHandler');

	
	/*public function index($id = null) {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    }

		$title_for_layout = "DECIDERE | SHOP";

		//retrive user token
		$user = $this->User->find('first', array('conditions'=>array('User.id'=>$this->Session->read('Auth.User.id'))));

		//check if is a valid ID
		if ($id != null) {

			//retrive plan
			$plan = $this->Plan->find('first', array('conditions'=>array('Plan.id'=>$id)));

			//check if the $plan is not empty
			if(!empty($plan)){

				//set amout to plan
				$plan['Plan']['amount'] = 1;
				
				//check if exists shopping cart
				if ($this->Session->read('ShoppingCart')) {
					
					//retrive sopping cart
					$shop = $this->Session->read('ShoppingCart');

					//check if the new plan is in shopping cart
					if (!in_array($plan, $shop)) {
						//if plan is not in sopping cart, add plan to shooping cart
						array_push($shop, $plan);
					}
				} else {
					//if sopping cart not exists create an array with new plan
					$shop = array($plan);
				}
				//write session sopping cart with arry plans '$shop'
				$this->Session->write('ShoppingCart', $shop);
			}
		} elseif (!$this->Session->read('ShoppingCart')) {
			$this->redirect( array('controller'=>'Register', 'action'=> 'selectDataset' ) );
		}

		$this->set(compact('title_for_layout', 'user'));
		$this->set('_serialize', array('title_for_layout', 'user'));
	}*/

	public function index($id = null) {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    }

		$title_for_layout = "DECIDERE | SHOP";

		//retrive user token
		$user = $this->User->find('first', array('conditions'=>array('User.id'=>$this->Session->read('Auth.User.id'))));

		//default source
		$default_source = '';

		$stripeKey = $this->stripePublishableApiKey;

		if ( $user['User']['id_stripe'] != '') {
			//set apiKey for stripe
	    	\Stripe\Stripe::setApiKey( $this->stripeApiKey );

	    	try {
		    	//retrive user
				$customer = \Stripe\Customer::retrieve( $user['User']['id_stripe'] );
	    		
				//get default source
				$default_source = $customer->default_source;

				//check if user has default source
				if ($default_source != '') {
					
					//retrive cards 
					$cards = json_encode( $customer->sources->data );

				} else {

					$cards = '';

				}

	    	} catch (Exception $e) {
				die($e);
	    		
	    	}

		}

		//check if is a valid ID
		if ($id != null) {

			//retrive plan
			$plan = $this->Plan->find('first', array('conditions'=>array('Plan.id'=>$id)));

			//check if the $plan is not empty
			if(!empty($plan)){

				//set amout to plan
				$plan['Plan']['amount'] = 1;
				
				//check if exists shopping cart
				if ($this->Session->read('ShoppingCart')) {
					
					//retrive sopping cart
					$shop = $this->Session->read('ShoppingCart');

					//check if the new plan is in shopping cart
					if (!in_array($plan, $shop)) {
						//if plan is not in sopping cart, add plan to shooping cart
						array_push($shop, $plan);
					}
				} else {
					//if sopping cart not exists create an array with new plan
					$shop = array($plan);
				}
				//write session sopping cart with arry plans '$shop'
				$this->Session->write('ShoppingCart', $shop);
			}
		} elseif (!$this->Session->read('ShoppingCart')) {
			$this->redirect( array('controller'=>'Register', 'action'=> 'selectDataset' ) );
		}

		$this->set(compact('title_for_layout', 'user', 'default_source', 'cards', 'stripeKey'));
		$this->set('_serialize', array('title_for_layout', 'user', 'default_source', 'cards', 'stripeKey'));
	}

	public function deleteOfCar($id = null) {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    }
		$shopp = array();
		if ($this->Session->read('ShoppingCart')) {
			if (count($this->Session->read('ShoppingCart'))>0) {
				foreach ($this->Session->read('ShoppingCart') as $shoppItem) {
					if ($shoppItem['Plan']['id'] != $id) {
						$shopp[] = $shoppItem;
					}
				}
				$this->Session->write('ShoppingCart', $shopp);
				$this->redirect('index');
			}
		} else {
			$this->redirect( array('controller'=>'Register', 'action'=> 'selectDataset' ) );
		}
	}


	/*
	//save a single token subscription
	public function saveToken() {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    } 

	    $subscription = '';

	    //read a plan for purchase
	    $plan = $this->Session->read('ShoppingCart');

	    //set apiKey for stripe
	    \Stripe\Stripe::setApiKey( $this->stripeApiKey );

	    $userHasToken = $this->UserToken->find('first', array('conditions'=>array('UserToken.user_id'=> $this->Session->read('Auth.User.id') )));

	    if ($this->request->is(array('post', 'put'))) {

	    	//retrive token from strip.js
	    	$token = $_POST['stripeToken'];

	    	//retrive email from stripe.js
	    	$email = $_POST['stripeEmail'];

		    //check if the user has a stripe id
		    if ( empty($userHasToken) ) {
				
		    	//try create a user
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

					//create userToken
					$userToken = array( 'UserToken' => array( 
						'token' => $customer->id,
						'user_id' => $this->Session->read('Auth.User.id'),
						'sources' => json_encode($customer->sources->data) 
					));

					$this->UserToken->create();

					$this->UserToken->save($userToken);

					//try subscribe user to plan
					try {
						$subscription = \Stripe\Subscription::create(array(
						  "customer" => $customer->id,
						  "plan" => $plan['0']['Plan']['id']
						));
					} catch (Exception $e) {
						$subscription = 'failed';
					}
					if ($subscription != 'failed') {
						
						if ($subscription->status == 'active') {

							$userProvider = array( 'UserProvider' => array( 
								'name' => $plan['0']['Plan']['name'] . ' ' . $plan['0']['Plan']['duration'],
								'user_id' => $this->Session->read('Auth.User.id'),
								'provider_id' => $plan['0']['Provider']['id'],
								'provider' => $plan['0']['Provider']['name'],
								'current_period_end' => $subscription->current_period_end,
								'stripe_subscription' => $subscription->id,
								'demo' => $plan['0']['Provider']['type']
							));

							$this->UserProvider->create();

							$this->UserProvider->save($userProvider);

							$this->Session->delete('ShoppingCart');
							
						} else {
							$subscription  = 'failed';	
						}

					}

				} catch (Exception $e) {
					$customer = array();
				}
		    	
		    } else {

		    	//create new credit card
		    	try {

		    		//id user => token for user stripe
		    		$userStripe = $userHasToken['UserToken']['token'];

					//retrive user
					$customer = \Stripe\Customer::retrieve( $userStripe );
					
					//create a new credit card item
					$newCreditCard = $customer->sources->create(array("source" => $token ));

					//retrive user wit all cards
					$customer = \Stripe\Customer::retrieve( $userStripe );

					//default new credit card
					$customer->default_source = $newCreditCard->id;
					
					//save customer
					$customer->save();  

					//retrive customer for read tokens
					$customer = \Stripe\Customer::retrieve( $userStripe );

					//Save the stripe id to user
					$this->UserToken->id = $userHasToken['UserToken']['id'];

					//save new credit card to userToken
					$this->UserToken->saveField('sources', json_encode($customer->sources->data) );

					//try subscribe user to plan
					try {
						$subscription = \Stripe\Subscription::create(array(
						  "customer" => $customer->id,
						  "plan" => $plan['0']['Plan']['id']
						));
					} catch (Exception $e) {
						$subscription = 'failed';
					}
					if ($subscription != 'failed') {
						
						if ($subscription->status == 'active') {

							$userProvider = array( 'UserProvider' => array( 
								'name' => $plan['0']['Plan']['name'] . ' ' . $plan['0']['Plan']['duration'],
								'user_id' => $this->Session->read('Auth.User.id'),
								'provider_id' => $plan['0']['Provider']['id'],
								'provider' => $plan['0']['Provider']['name'],
								'current_period_end' => $subscription->current_period_end,
								'stripe_subscription' => $subscription->id,
								'demo' => $plan['0']['Provider']['type']
							));

							$this->UserProvider->create();

							$this->UserProvider->save($userProvider);

							$this->Session->delete('ShoppingCart');
							
						} else {
							$subscription = 'failed';	
						}

					}

		    		
		    	} catch (Exception $e) {
		    		$customer = array();
		    	}

		    }

		} else {

			if ( !empty($userHasToken) ) {

				//id user => token for user stripe
		    	$userStripe = $userHasToken['UserToken']['token'];
				
				//retrive user
				$customer = \Stripe\Customer::retrieve( $userStripe );

				//try subscribe user to plan
				try {
					$subscription = \Stripe\Subscription::create(array(
					  "customer" => $customer->id,
					  "plan" => $plan['0']['Plan']['id']
					));
				} catch (Exception $e) {
					$subscription = 'failed';
				}
				if ($subscription != 'failed') {
					
					if ($subscription->status == 'active') {

						$userProvider = array( 'UserProvider' => array( 
							'name' => $plan['0']['Plan']['name'] . ' ' . $plan['0']['Plan']['duration'],
							'user_id' => $this->Session->read('Auth.User.id'),
							'provider_id' => $plan['0']['Provider']['id'],
							'provider' => $plan['0']['Provider']['name'],
							'current_period_end' => $subscription->current_period_end,
							'stripe_subscription' => $subscription->id,
							'demo' => $plan['0']['Provider']['type']
						));

						$this->UserProvider->create();

						$this->UserProvider->save($userProvider);

						$this->Session->delete('ShoppingCart');
						
					} else {
						$subscription = 'failed';	
					}

				}
			}

		}

	    $post = $_POST;

	    $this->set(compact('post', 'customer', 'subscription'));
		$this->set('_serialize', array('post', 'customer', 'subscription'));
		
	}*/


	//save a multiple token subscriptions
	/*public function saveToken() {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    } 

	    $subscription_state = '';

	    $subscriptions_status = array();

	    //read a plan for purchase
	    $shop = $this->Session->read('ShoppingCart');

	    //delete session sopping cart
	    $this->Session->delete('ShoppingCart');

	    //set apiKey for stripe
	    \Stripe\Stripe::setApiKey("sk_test_P88EaWa6FO9jkPAvAGRx3tbX");

	    $userHasToken = $this->UserToken->find('first', array('conditions'=>array('UserToken.user_id'=> $this->Session->read('Auth.User.id') )));

	    if ($this->request->is(array('post', 'put'))) {

	    	//retrive token from strip.js
	    	$token = $_POST['stripeToken'];

	    	//retrive email from stripe.js
	    	$email = $_POST['stripeEmail'];

		    //check if the user has a stripe id
		    if ( empty($userHasToken) ) {
				
		    	//try create a user
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

					//create userToken
					$userToken = array( 'UserToken' => array( 
						'token' => $customer->id,
						'user_id' => $this->Session->read('Auth.User.id'),
						'sources' => json_encode($customer->sources->data) ,
						'default_source' => $customer->default_source,
					));

					//creates a usertoken
					$this->UserToken->create();

					//save a userToken
					$this->UserToken->save($userToken);

					//recorre shopping cart 
					foreach ($shop as $key => $item) {

						$subscription_state = '';
						
						//try subscribe user to plan
						try {
							$subscription = \Stripe\Subscription::create(array(
							  "customer" => $customer->id,
							  "plan" => $item['Plan']['id']
							));

							$subscription_state = 'successful';
						} catch (Exception $e) {
							$subscription_state = 'failed';
						}

						//if the susbscription is defferen to failed
						if ($subscription_state == 'successful') {
							
							if ($subscription->status == 'active') {

								//create a userProvider
								$userProvider = array( 'UserProvider' => array( 
									'name' => $item['Plan']['name'] . ' ' . $item['Plan']['duration'],
									'user_id' => $this->Session->read('Auth.User.id'),
									'provider_id' => $item['Provider']['id'],
									'provider' => $item['Provider']['name'],
									'current_period_end' => $subscription->current_period_end,
									'stripe_subscription' => $subscription->id,
									'demo' => $item['Provider']['type']
								));

								$this->UserProvider->create();

								//if save user provider declare subscription success
								if ($this->UserProvider->save($userProvider)) {
									$subscription_state  = 'successful';
								} else {
									$subscription_state  = 'failed';
								}
								
							} else {
								$subscription_state  = 'failed';
							}
						}

						$subscriptions_item = array(
							'subscription_name' => $item['Plan']['name'], 
							'subscription_periodicity' => $item['Plan']['duration'], 
							'subscription_price' => $item['Plan']['price'], 
							'status' => $subscription_state
						);

						array_push($subscriptions_status, $subscriptions_item);

					}


				} catch (Exception $e) {
					$customer = array();
				}
		    	
		    } else {

		    	//create new credit card
		    	try {

		    		//id user => token for user stripe
		    		$userStripe = $userHasToken['UserToken']['token'];

					//retrive user
					$customer = \Stripe\Customer::retrieve( $userStripe );
					
					//create a new credit card item
					$newCreditCard = $customer->sources->create(array("source" => $token ));

					//retrive user wit all cards
					$customer = \Stripe\Customer::retrieve( $userStripe );

					//default new credit card
					$customer->default_source = $newCreditCard->id;
					
					//save customer
					$customer->save();  

					//retrive customer for read tokens
					$customer = \Stripe\Customer::retrieve( $userStripe );

					//Save the stripe id to user
					$this->UserToken->id = $userHasToken['UserToken']['id'];

					//save new credit card to userToken
					$this->UserToken->save(array('UserToken'=>array('sources'=>json_encode($customer->sources->data), 'default_source'=> $customer->default_source)));
					//$this->UserToken->saveField('sources', json_encode($customer->sources->data) );

					//recorre shopping cart 
					foreach ($shop as $key => $item) {

						$subscription_state = '';
						
						//try subscribe user to plan
						try {
							$subscription = \Stripe\Subscription::create(array(
							  "customer" => $customer->id,
							  "plan" => $item['Plan']['id']
							));

							$subscription_state = 'successful';
						} catch (Exception $e) {
							$subscription_state = 'failed';
						}

						//if the susbscription is defferen to failed
						if ($subscription_state == 'successful') {
							
							if ($subscription->status == 'active') {

								//create a userProvider
								$userProvider = array( 'UserProvider' => array( 
									'name' => $item['Plan']['name'] . ' ' . $item['Plan']['duration'],
									'user_id' => $this->Session->read('Auth.User.id'),
									'provider_id' => $item['Provider']['id'],
									'provider' => $item['Provider']['name'],
									'current_period_end' => $subscription->current_period_end,
									'stripe_subscription' => $subscription->id,
									'demo' => $item['Provider']['type']
								));

								$this->UserProvider->create();

								//if save user provider declare subscription success
								if ($this->UserProvider->save($userProvider)) {
									$subscription_state  = 'successful';
								} else {
									$subscription_state  = 'failed';
								}
								
							} else {
								$subscription_state  = 'failed';
							}
						}

						$subscriptions_item = array(
							'subscription_name' => $item['Plan']['name'], 
							'subscription_periodicity' => $item['Plan']['duration'], 
							'subscription_price' => $item['Plan']['price'], 
							'status' => $subscription_state
						);

						array_push($subscriptions_status, $subscriptions_item);

					}

		    		
		    	} catch (Exception $e) {
		    		$customer = array();
		    	}

		    }

		} else {

			if ( !empty($userHasToken) ) {

				//id user => token for user stripe
		    	$userStripe = $userHasToken['UserToken']['token'];
				
				//retrive user
				$customer = \Stripe\Customer::retrieve( $userStripe );

				//recorre shopping cart 
				foreach ($shop as $key => $item) {

					$subscription_state = '';
					
					//try subscribe user to plan
					try {
						$subscription = \Stripe\Subscription::create(array(
						  "customer" => $customer->id,
						  "plan" => $item['Plan']['id']
						));

						$subscription_state = 'successful';
					} catch (Exception $e) {
						$subscription_state = 'failed';
					}

					//if the susbscription is defferen to failed
					if ($subscription_state == 'successful') {
						
						if ($subscription->status == 'active') {

							//create a userProvider
							$userProvider = array( 'UserProvider' => array( 
								'name' => $item['Plan']['name'] . ' ' . $item['Plan']['duration'],
								'user_id' => $this->Session->read('Auth.User.id'),
								'provider_id' => $item['Provider']['id'],
								'provider' => $item['Provider']['name'],
								'current_period_end' => $subscription->current_period_end,
								'stripe_subscription' => $subscription->id,
								'demo' => $item['Provider']['type']
							));

							$this->UserProvider->create();

							//if save user provider declare subscription success
							if ($this->UserProvider->save($userProvider)) {
								$subscription_state  = 'successful';
							} else {
								$subscription_state  = 'failed';
							}
							
						} else {
							$subscription_state  = 'failed';
						}
					}

					$subscriptions_item = array(
						'subscription_name' => $item['Plan']['name'], 
						'subscription_periodicity' => $item['Plan']['duration'], 
						'subscription_price' => $item['Plan']['price'], 
						'status' => $subscription_state
					);

					array_push($subscriptions_status, $subscriptions_item);

				}
			}

		}


	    $this->set(compact('subscriptions_status', 'customer', 'subscription'));
		$this->set('_serialize', array('subscriptions_status', 'customer', 'subscription'));
		
	}*/


	//save a multiple token subscriptions
	public function saveToken() {
		if(!$this->Session->read('Auth.User.role')) {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    } 

	    $token = '';

	    //if is post
	    if ($this->request->is(array('post', 'put'))) {
	    	//retrive token from strip.js
	    	$token = $_POST['stripeToken'];

	    	//retrive email from stripe.js
	    	$email = $_POST['stripeEmail'];

	    }

	    //retrive user token
		$user = $this->User->find('first', array('conditions'=>array('User.id'=>$this->Session->read('Auth.User.id'))));

		$userStripeId = $user['User']['id_stripe'];

		//read a plan for purchase
	    $shop = $this->Session->read('ShoppingCart');

	    //status create user
	    $items_failed = array();

	    //status for subscriptions
	    $subscriptions_status = array();

	    //state for unique subscription
	    $subscription_state = '';

		//set apiKey for stripe
	    \Stripe\Stripe::setApiKey( $this->stripeApiKey );

	    //check if the user has a stripe id
	    if ( $userStripeId == '' && $token != '') {
			
	    	//try create a user
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
				if ( $this->User->saveField('id_stripe', $customer->id) ) {

					$userStripeId = $customer->id;

				} 

	    	} catch (Exception $e) {
				die($e);
	    	}
	    	
	    } elseif ( $userStripeId != '' && $token != '' ) {
	    	//retrive user
			$customer = \Stripe\Customer::retrieve( $userStripeId );
			
			//create a new credit card item
			$newCreditCard = $customer->sources->create(array("source" => $token ));

			//retrive user wit all cards
			$customer = \Stripe\Customer::retrieve( $userStripeId );

			//default new credit card
			$customer->default_source = $newCreditCard->id;
			
			//save customer
			$customer->save(); 
	    }
	    
	    if ( $userStripeId != '' && !empty($shop)) {
	    	
		    //recorre shopping cart 
			foreach ($shop as $key => $item) {

				$subscription_state = '';
				
				//try subscribe user to plan
				try {
					$subscription = \Stripe\Subscription::create(array(
					  "customer" => $userStripeId,
					  "plan" => $item['Plan']['id']
					));

					$subscription_state = 'successful';
				} catch (Exception $e) {
					$subscription_state = 'failed';
				}

				
				//if the susbscription is defferen to failed
				if ($subscription_state == 'successful') {
					
					/* CORE10-SW-DEC-7 ... Added 'trialing' status */
					/* CORE10-SW-DEC-2 ... */
					/* CORE10-SW-DEC-3 ... */
					if (($subscription->status == 'active') || ($subscription->status == 'trialing'))  {
						//create a userProvider
						$userProvider = array( 'UserProvider' => array( 
							'name' => $item['Plan']['name'] . ' ' . $item['Plan']['duration'],
							'user_id' => $this->Session->read('Auth.User.id'),
							'provider_id' => $item['Provider']['id'],
							'provider' => $item['Provider']['name'],
							'current_period_end' => $subscription->current_period_end,
							'stripe_subscription' => $subscription->id,
							'demo' => $item['Provider']['type']
						));

						$this->UserProvider->create();

						//if save user provider declare subscription success
						if ($this->UserProvider->save($userProvider)) {
							$subscription_state  = 'successful';
						} else {
							$subscription_state  = 'failed';
							array_push($items_failed, $item);
						}

					} else {
						$subscription_state  = 'failed';
					}
				}

				$subscriptions_item = array(
					'subscription_name' => $item['Plan']['name'], 
					'subscription_periodicity' => $item['Plan']['duration'], 
					'subscription_price' => $item['Plan']['price'], 
					'status' => $subscription_state
				);

				array_push($subscriptions_status, $subscriptions_item);

			}    	
	    }
	    
	    
	    if ($items_failed != '') {
	    	//write session sopping cart with arry plans '$shop'
			$this->Session->write('ShoppingCart', $items_failed);
			
			/* CORE10-SW-DEC-13 ... Added 'Add user directed to dashboard on successful purchase' */
			return $this->redirect(array( 'controller'=>'User', 'action'=>'dashboard','?'=>array('msg'=>'purchase')));
	    }

	    $this->set(compact('subscriptions_status', 'customer', 'subscription'));
		$this->set('_serialize', array('subscriptions_status', 'customer', 'subscription'));
		
	}

	public function cancel() {
		# code...
	}

	public function thanks() {
		# code...
	}

	public function listener() {

		//
		// STEP 1 - be polite and acknowledge PayPal's notification
		//
		header('HTTP/1.1 200 OK');

		//
		// STEP 2 - create the response we need to send back to PayPal for them to confirm that it's legit
		//

		$resp = 'cmd=_notify-validate';
		foreach ($_POST as $parm => $var) {
			$var = urlencode(stripslashes($var));
			$resp .= "&$parm=$var";
		}
			
		// STEP 3 - Extract the data PayPal IPN has sent us, into local variables 

		$item_name        = $_POST['item_name'];
		$item_number      = $_POST['item_number'];
		$payment_status   = $_POST['payment_status'];
		$payment_amount   = $_POST['mc_gross'];
		$payment_currency = $_POST['mc_currency'];
		$txn_id           = $_POST['txn_id'];
		$txn_type         = $_POST['txn_type'];
		$receiver_email   = $_POST['receiver_email'];
		$payer_email      = $_POST['payer_email'];
		$user_id	 	  = $_POST['custom'];

		// STEP 4 - Get the HTTP header into a variable and send back the data we received so that PayPal can confirm it's genuine

		$httphead = "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$httphead .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$httphead .= "Content-Length: " . strlen($resp) . "\r\n\r\n";
		 
		// Now create a ="file handle" for writing to a URL to paypal.com on Port 443 (the IPN port)

		$errno ='';
		$errstr='';
		 
		$fh = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);
		//$fh = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);

		// STEP 5 - Nearly done.  Now send the data back to PayPal so it can tell us if the IPN notification was genuine
		 
		if (!$fh) {
		 
			// Uh oh. This means that we have not been able to get thru to the PayPal server.  It's an HTTP failure
			// You need to handle this here according to your preferred business logic.  An email, a log message, a trip to the pub..
		} else 	{
			// Connection opened, so spit back the response and get PayPal's view whether it was an authentic notification	

	        fputs ($fh, $httphead . $resp);

	        $status = $fh;

		    while (!feof($fh)) {

				$readresp = fgets ($fh, 1024);

				if (strcmp ($readresp, "VERIFIED") == 0) {

					//check if merchant email
					if ( $receiver_email == 'lana.beregszazi@decidere.com' AND $payment_status = 'Completed' ) {
						
						
						$dataAll = array( 'User' => $user_id, 'status' => 'verified and paid', 'plan' => $item_name, 'res'=> $resp, 'post'=>$_POST );
						$this->Email = new CakeEmail('smtp2go');
				        //$this->Email->from(array('admin@decidere.com' => 'DECIDERE'));
				        $this->Email->to(array('necogumiel@gmail.com'));
				        $this->Email->subject('paypal ipn');
				        $this->Email->template('dataset');
				        $this->Email->emailFormat('html');
				        $this->Email->viewVars(array('dataAll'=>$dataAll));//envia datos
				       
				       	if(	$this->Email->send()){

				       	}


						$plan = $this->Plan->find('first', array('conditions'=>array('Plan.id'=>$item_number)));

						if(!empty($plan)){
							$userProvider = array( 'UserProvider' => array( 
								'name' => $item_name,
								'user_id' => $user_id,
								'provider_id' => $plan['Plan']['provider_id'],
								'provider' => $plan['Provider']['name'],
								'txn_id' => $txn_id,
								'deadline' => date("Y-m-d H:i:s")
							));
						}

						//instance for create user provider	
						$this->UserProvider->create();

						//save user provider
						$this->UserProvider->save($userProvider);

						

					} else {

						$dataAll = array( 'User' => $user_id, 'status' => 'verified and NO paid', 'res'=> $resp, 'post'=>$_POST );
						$this->Email = new CakeEmail('smtp2go');
				        //$this->Email->from(array('admin@decidere.com' => 'DECIDERE'));
				        $this->Email->to(array('necogumiel@gmail.com'));
				        $this->Email->subject('paypal ipn');
				        $this->Email->template('dataset');
				        $this->Email->emailFormat('html');
				        $this->Email->viewVars(array('dataAll'=>$dataAll));//envia datos
				       
				       	if(	$this->Email->send()){

				       	}

					}
	
				} else if (strcmp ($readresp, "INVALID") == 0) {

					//the ipn is invalid
					$dataAll = array( 'User' => $user_id, 'status' => 'invalid', 'res'=> $resp, 'post'=>$_POST );
					$this->Email = new CakeEmail('smtp2go');
			        //$this->Email->from(array('admin@decidere.com' => 'DECIDERE'));
			        $this->Email->to(array('necogumiel@gmail.com'));
			        $this->Email->subject('paypal ipn');
			        $this->Email->template('dataset');
			        $this->Email->emailFormat('html');
			        $this->Email->viewVars(array('dataAll'=>$dataAll));//envia datos
			       
			       	if(	$this->Email->send()){

			       	}

				}
			}
			fclose ($fh);
		}


		//the ipn is invalid
		$dataAll = array( 'Status' => 'response empty', 'res'=> $resp, 'post'=>$_POST );
		$this->Email = new CakeEmail('smtp2go');
        //$this->Email->from(array('admin@decidere.com' => 'DECIDERE'));
        $this->Email->to(array('necogumiel@gmail.com'));
        $this->Email->subject('paypal ipn');
        $this->Email->template('dataset');
        $this->Email->emailFormat('html');
        $this->Email->viewVars(array('dataAll'=>$dataAll));//envia datos
       
       	if(	$this->Email->send()){

       	}



	}

	public function buy() {
		if(!$this->Session->read('Auth.User.role') or !$this->Session->read('ShoppingCart')  ) {
	    	return $this->redirect(array( 'controller'=>'Admin', 'action'=>'login'));
	    }

	    $discount = 0;

	    if ( $this->Session->read('ShoppingCartDiscount') ) {
	    	
	    	$discount = $this->Session->read('ShoppingCartDiscount');
	    	$this->Session->delete('ShoppingCartDiscount');
	    }


	    $shopp = $this->Session->read('ShoppingCart');	
	    $this->Session->delete('ShoppingCart');
		foreach ($shopp as $shoppItem) {
			
			//check fraudulent price or coupon discount
			if ($shoppItem['Plan']['price'] == 0 || $discount == 100  ) {
				$userProvider = array( 'UserProvider' => array( 
					'name' => $shoppItem['Plan']['name'] . ' ' . $shoppItem['Plan']['duration'],
					'user_id' => $this->Session->read('Auth.User.id'),
					'provider_id' => $shoppItem['Provider']['id'],
					'provider' => $shoppItem['Provider']['name'],
					'demo' => $shoppItem['Provider']['type']
				));

				$this->UserProvider->create();

				$this->UserProvider->save($userProvider);
				
			} else {
				return $this->redirect(array( 'controller'=>'Shop', 'action'=>'index'));
			}

			
		}
		return $this->redirect(array( 'controller'=>'User', 'action'=>'dashboard'));
	}

}
