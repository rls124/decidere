<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName' => 'account')); ?>
</section>
<!--END COVER-->
<br />

<section id="shopping-cart">
	<div class="row">

		<div class="container">

			<h1 class="title-dashboard">My Account</h1>
			
			<div class="row calendar">
			  	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			  		<!--<h1 class="subtitle-dashboard">Datasets</h1>-->
			  	</div>
			  	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-right">
			  	</div>
			</div>

			<!--account-->
			<div class="row">
				
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist" id="tabs-profile">

					<!--first tab active-->
					<li role="presentation"  class="active">
						<a href="#profile" aria-controls="Profile" role="tab" data-toggle="tab">Profile</a>
					</li>
					<li role="presentation">
						<a href="#subscriptions" aria-controls="subscriptions" role="tab" data-toggle="tab">Subscriptions</a>
					</li>
					<li role="presentation">
						<a href="#payment" aria-controls="payment" role="tab" data-toggle="tab">Payment Info</a>
					</li>

				</ul>

				<!-- Tab panes -->
				<div class="tab-content">

					<!--create tab content -->
					<div role="tabpanel" class="tab-pane-newScenario fade in tab-pane active" id="profile">

						<!--table for favorites-->
						<div class="panel panel-primary">
							<div class="panel-heading">Contact Info</div>
							<div class="panel-body">
							    <?php echo $this->Form->create('User', $options = array('class'=>'form-horizontal', 'id'=>'form-update-info', 'url'=>array('controller'=>'Ajax', 'action'=>'editContactInfoUser'))); ?>
							    	<?php echo $this->Form->input('id', $options = array('value'=>$user['User']['id'])); ?>
								<div class="form-group">
								  	<?php echo $this->Form->label('first_name', 'First name', array('class'=>'col-sm-2 control-label')); ?>
								    <?php echo $this->Form->input('first_name', $options = array('class'=>'form-control col-sm-10', 'div'=>array('class'=>'col-sm-8'), 'label'=>false, 'required'=>'required', 'value'=>$user['User']['first_name'])); ?>
								</div>
								<div class="form-group">
								  	<?php echo $this->Form->label('last_name', 'Last name', array('class'=>'col-sm-2 control-label')); ?>
								    <?php echo $this->Form->input('last_name', $options = array('class'=>'form-control col-sm-10', 'div'=>array('class'=>'col-sm-8'), 'label'=>false, 'required'=>'required', 'value'=>$user['User']['last_name'])); ?>
								</div>
								<div class="form-group" id='form-edit-username'>
								  	<?php echo $this->Form->label('username', 'Username', array('class'=>'col-sm-2 control-label')); ?>
								  	<div class="col-sm-8 required">
									    <?php echo $this->Form->input('username', $options = array('class'=>'form-control input-edit-contact-info col-sm-10', 'div'=>false, 'label'=>false, 'required'=>'required', 'value'=>$user['User']['username'])); ?>
									    <p class="error-input-edit-info-contact animated shake"></p>
								  	</div>
								</div>
								<div class="form-group">
								  	<?php echo $this->Form->label('email', 'Email', array('class'=>'col-sm-2 control-label')); ?>
								    <?php echo $this->Form->input('email', $options = array('class'=>'form-control col-sm-10', 'div'=>array('class'=>'col-sm-8'), 'label'=>false, 'required'=>'required', 'value'=>$user['User']['email'])); ?>
								</div>
								<div class="form-group">
								  	<?php echo $this->Form->label('phone', 'Phone', array('class'=>'col-sm-2 control-label')); ?>
								    <?php echo $this->Form->input('phone', $options = array('class'=>'form-control col-sm-10', 'div'=>array('class'=>'col-sm-8'), 'label'=>false, 'required'=>'required', 'value'=>$user['User']['phone'])); ?>
								</div>
								<div class="form-group">
								  	<?php echo $this->Form->label('company', 'Company', array('class'=>'col-sm-2 control-label')); ?>
								    <?php echo $this->Form->input('company', $options = array('class'=>'form-control col-sm-10', 'div'=>array('class'=>'col-sm-8'), 'label'=>false, 'required'=>'required', 'value'=>$user['User']['company'])); ?>
								</div>
								<div class="form-group">
									<?php if ($user['User']['subscribed_to_news'] == 1 ) {
										$subscribed = 'checked';
									} else {
										$subscribed = false;
										} ?>
									<div class="col-sm-offset-2 col-sm-10">
									    <div class="checkbox">
									    	<label>
									      	<?php echo $this->Form->input('subscribed_to_news', $options = array('class'=>'', 'div'=>false, 'label'=>'Subscribe me to news', 'type'=>'checkbox', 'checked'=>$subscribed)); ?>
									      	</label>
									    </div>
									</div>
								</div>
								<div class="form-group">
								    <div class="col-sm-offset-2 col-sm-10">
								      <?php echo $this->Form->button('Save', $options = array('class'=>'btn btn-default submit-edit-info', 'type'=>'submit')); ?>
								    </div>
								</div>
							<?php echo $this->Form->end(); ?>	
							</div>
						</div>

						<div class="panel panel-primary">
						  <div class="panel-heading">Security</div>
						  <div class="panel-body">
						    <h4>Update Password</h4>

						    <?php echo $this->Form->create('User', $options = array('class'=>'form-horizontal', 'id'=>'form-update-password', 'url'=>array('controller'=>'Ajax', 'action'=>'userChangePassword'))); ?>
								
								<div class="form-group" id="input-password-update">
								  	<?php echo $this->Form->label('password', 'Current password', array('class'=>'col-sm-2 control-label')); ?>
								    <?php echo $this->Form->input('password', $options = array('class'=>'form-control col-sm-10 input-edit-password', 'div'=>array('class'=>'col-sm-4'), 'label'=>false, 'required'=>'required')); ?>
								    <p class="error-input-edit-password animated shake"></p>
								</div>
								<div class="form-group">
								  	<?php echo $this->Form->label('new_password', 'New Password', array('class'=>'col-sm-2 control-label')); ?>
								    <?php echo $this->Form->input('new_password', $options = array('class'=>'form-control col-sm-10', 'div'=>array('class'=>'col-sm-4'), 'label'=>false, 'required'=>'required', 'type'=>'password', 'id'=>'new_password')); ?>
								</div>
								<div class="form-group">
								  	<?php echo $this->Form->label('confirm_password', 'Confirm Password', array('class'=>'col-sm-2 control-label')); ?>
								    <?php echo $this->Form->input('confirm_password', $options = array('class'=>'form-control col-sm-10', 'div'=>array('class'=>'col-sm-4'), 'label'=>false, 'required'=>'required', 'type'=>'password', 'id'=>'confirm_password')); ?>
								</div>
								<div class="form-group">
								    <div class="col-sm-offset-2 col-sm-10">
								      <?php echo $this->Form->button('Update', $options = array('class'=>'btn btn-default submit-edit-info', 'type'=>'submit')); ?>
								    </div>
								</div>

						    <?php echo $this->Form->end(); ?>
						  </div>
						</div>
						

						<div class="panel panel-primary">
						  <div class="panel-heading">Extra Options</div>
						  <div class="panel-body">

						    <p> <?php echo $this->Html->link('Deactivate account', array('controller' => 'User', 'action' => 'deactivate')); ?></p>
						  </div>
						</div>
					</div>

					<div role="tabpanel" class="tab-pane-newScenario fade in tab-pane" id="subscriptions">

						<!--table for favorites-->
						<div class="panel panel-primary">
						  	<div class="panel-heading">Datasets paid and demo</div>
						  	<div class="panel-body">
						    
								<div class="row">
									<div class="table-responsive">
										<table class="table table-bordered table-hover" id="table-account">
									    
											<!--header table for dataset month-->
											<thead>
												<tr>
													<th>Dataset</th>
													<th class="col-lg-2">Created</th>
													<th class="col-lg-2">Expires in</th>
													<th class="col-lg-2">Show on Dashboard</th>
													<th class="col-lg-2">Actions</th>
												</tr>
											</thead>
								

											<!--body table for dataset month-->
											<tbody>
										
												<!--recorre scenarios-->
												<?php foreach ($user_providers as $keyUP => $user_provider) { ?>

													<?php if (!empty($user_provider['Provider']  )) { ?>

														<?php if( $user_provider['UserProvider']['state'] == 1 ) { 
										   					$checked_status = 'checked';
										   				} else if($user_provider['UserProvider']['state'] == 0) {
										   					$checked_status = false;
										   				} ?>
															
														<!-- <tr> for header scenario-->
														<tr class="tr-datasetProvider" id="<?php echo $user_provider['UserProvider']['id']; ?>">
															<td> 
																<?php echo $user_provider['Provider']['description']; ?>

																<?php if ($user_provider['UserProvider']['demo'] == 0) { ?>
																	<span class="label label-success">Premium</span>		
																<?php } elseif ($user_provider['UserProvider']['demo'] == 1 ) { ?>
																	<span class="label label-warning">Demo</span>
																<?php } ?>
															</td>

															<td class="td-table-account"> 
																<?php echo date_format( date_create( $user_provider['UserProvider']['created'] ), 'jS F Y | H:i:s' ) ?>
															</td>

															<td class="td-table-account">

																<?php

																	if ($user_provider['UserProvider']['current_period_end'] > 0) {
																		$date_end = new DateTime();

																		$date_end->setTimestamp($user_provider['UserProvider']['current_period_end']);
																		echo $date_end->format('jS F Y | H:i:s') . "\n";
																	} else { ?>
																		<span class="label label-info">Never</span>
																<?php } ?>
															</td>

															<td class="text-center">
																<?php echo $this->Form->create('UserProvider', $options = array('url'=>array('controller'=>'Ajax', 'action'=>'swithVisibilityUserProvier'), 'class'=>'form-switchShow-userprovider')); ?>
																	<?php echo $this->Form->input('id', $options = array('type'=>'hidden', 'value'=>$user_provider['UserProvider']['id'])); ?>

																	<?php echo $this->Form->checkbox('state', array('checked'=>$checked_status)); ?>
															</td>

															<td>
																	<?php echo $this->Form->button( ' <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ' , $options = array('class'=>'btn btn-success btn-xs', 'escape'=>false, 'type'=>'submit', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Save")); ?>

																<?php echo $this->Form->end(); ?>
																
																<?php echo $this->Form->create('UserProvider', $options = array('url'=>array('controller'=>'Ajax', 'action'=>'deleteUserProviderDashboard'), 'class'=>'form-delete-userprovider form-initial')); ?>
																						
																	<?php echo $this->Form->input('id', $options = array('type'=>'hidden', 'value'=>$user_provider['UserProvider']['id'])); ?>

																	<?php echo $this->Form->button( ' <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> ' , $options = array('class'=>'btn btn-danger btn-xs', 'escape'=>false, 'type'=>'submit', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Delete Dataset Provider")); ?>

																<?php echo $this->Form->end(); ?>

															</td>

														</tr>

													<?php } ?>

												<?php } ?>

												<!------------------------------>

											</tbody>
									
										</table>
									</div>
								</div>
	
							</div>
						</div>

					</div>

					<div role="tabpanel" class="tab-pane-newScenario fade in tab-pane" id="payment">

						<?php //$creditCards = json_decode( $customer->sources->data ); ?>


						<div class="panel panel-primary">
						  	<div class="panel-heading">Credit cards</div>
						  	<div class="panel-body">
								<div class="row">

									<p class="text-right">

										<?php $urlImage = Router::url(['controller' => 'Home', 'action' => 'index']) . 'img/logo-soppingcart.jpg'; ?>

										<?php echo $this->Form->create(null, $options = array('url'=>array('controller'=>'User', 'action'=>'addCreditCard'), 'class'=>'')); ?>
										  <script
										    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
										    data-key="<?php echo $stripeKey; ?>"
										    data-image="<?php echo $urlImage; ?>"
										    data-name="Decidere"
										    data-locale="auto"
										    data-panel-label="Add Card"
  											data-label="Add Card"
  											data-allow-remember-me=false
  											data-email="<?php echo  $user['User']['email']; ?>"
										    >
										  </script>
										<?php echo $this->Form->end(); ?>

									</p>
									
									<?php if ($cards != '') { ?>
									<?php $cards = json_decode( $cards ); ?>
									<div class="table-responsive">
										<table class="table table-bordered table-hover" id="table-account">
											<thead>
												<tr>
													<th>Brand</th>
													<th>Type</th>
													<th>Credit card number</th>
													<th>Default for Payments</th>
													<th>Actions</th>
												</tr>
											</thead>
											
											<tbody>

												<?php foreach ($cards as $key => $card) { ?>
						
													<?php switch ($card->brand) {
														case 'Visa':
															$image = 'cards/Visa.png';
															break;

														case 'Visa (debit)':
															$image = 'cards/Visa.png';
															break;

														case 'MasterCard':
															$image = 'cards/Maestro.png';
															break;

														case 'MasterCard (debit)':
															$image = 'cards/Maestro.png';
															break;

														case 'MasterCard (prepaid)':
															$image = 'cards/Maestro.png';
															break;

														case 'American Express':
															$image = 'cards/AmericanExpress.png';
															break;

														case 'Discover':
															$image = 'cards/Discover.png';
															break;

														case 'Diners Club':
															$image = 'cards/DinersClub.png';
															break;

														case 'JCB':
															$image = 'cards/JCB.png';
															break;
														
														default:
															$image = 'cards/card.png';
															break;
													} ?>

													<tr>
														<td> <?php echo $this->Html->image($image, $options = array('alt'=>'Credit card', 'style'=>'width:40px; height:auto;' )); ?> <?php echo $card->brand; ?></td>
														<td><?php echo  ucfirst ( $card->brand . ' ' . $card->funding . ' ' . $card->object); ?></td>
														<td>...<?php echo $card->last4; ?></td>
														
														<td>
															<?php if (  $default_source == $card->id ) { ?>
																<span class="label label-success">Default</span>
															<?php } else { ?>

																<?php echo $this->Form->create('User', $options = array( 'url'=>array('controller'=>'Ajax', 'action'=>'setDefaultSource'), 'class'=>'form-setDefaultSource' )); ?>
																	<?php echo $this->Form->input('default_source', $options = array('value'=>$card->id, 'type'=>'hidden')); ?>

																	<?php echo $this->Form->button(' <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Make default ', $options = array('type'=>'submit', 'class'=>'btn btn-default btn-xs', 'escape'=>false)); ?>

																<?php echo $this->Form->end(); ?>
															<?php } ?>
														</td>
														<td> 
															<?php echo $this->Form->create('User', $options = array( 'url'=>array('controller'=>'Ajax', 'action'=>'deleteCustomerCard'), 'class'=>'form-deleteCustomerCard' )); ?>
																<?php echo $this->Form->input('source', $options = array('value'=>$card->id, 'type'=>'hidden')); ?>

																<?php echo $this->Form->button('Delete', $options = array('type'=>'submit', 'class'=>'btn btn-danger btn-xs', 'escape'=>false)); ?>

															<?php echo $this->Form->end(); ?>
														</td>
													</tr>
												<?php } ?>
											</tbody>

									    </table>
									</div>
										
									<?php } ?>

								</div>	

						  	</div>
						</div>
					</div>

				</div>	

			</div>

			<div class="row">
				<div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-xs-offset-0 col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center">
					<p class="text-foot-register">Decidere is a product of Decidere Analytics, LLC Fort Wayne, Indiana 46802</p>
				</div>
			</div>

		</div>
	</div>

</section>

<?php echo $this->element('side_nav', array('viewName' => 'Dashboard')); ?>


<script>
	$(function() { 
	    // //for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
	    // $('#tabs-profile').find('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	    //     // save the latest tab; use cookies if you like 'em better:
	    //     localStorage.setItem('lastTab', $(this).attr('href'));
	    // });

	    // // go to the latest tab, if it exists:
	    // var lastTab = localStorage.getItem('lastTab');
	    // if (lastTab) {
	    //     $('[href="' + lastTab + '"]').tab('show');
	    // }
	});

</script>