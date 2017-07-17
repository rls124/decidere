<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName' => 'Dashboard')); ?>
</section>
<!--END COVER-->
<br />

<section id="shopping-cart">
	<div class="row">

		<div class="container">

			<h1 class="title-dashboard">My Dashboard</h1>

			<div class="row calendar">
			  	<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-0 col-xs-offset-0 col-lg-8 col-md-8 col-sm-12 col-xs-12">
			  		<!--<h1 class="subtitle-dashboard">Datasets</h1>-->
			  		<p class="text-center">Welcome to your personalized Decidere dashboard!  Here you can create new scenarios or run your saved favorite scenarios on any demo datasets or the datasets to which you have subscribed. <br> <br>
					If you have not subscribed to any datasets, you may do so by clicking <?php echo $this->Html->link('here', array('controller' => 'Register', 'action' => 'selectDataset'), array('class'=>'link-dashboard')); ?>
			  		</p>
			  	</div>
			  	<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 text-right">
					<h4><?php echo $this->Html->link('Need Help?', array('controller' => 'Help', 'action' => 'index'), array('class'=>'link-dashboard')); ?></h4>
			  	</div>
			</div>
			<!--check if the provider purchased actives in not empty-->
			<?php if (!empty($providerJson)) { ?>
			

				<?php $search_replace = array('.', ' '); ?> 

				<!--new dashboard-->
				<div class="row">
					
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						
						<?php $count_tab = 0; ?>

						<!--recorre provider for generate tabs header-->
						<?php foreach ($providerJson as $key => $provider) { ?>
							
							<?php if($count_tab == 0){ ?>

								<!--first tab active-->
								<li role="presentation" class="active">
									<a href="#<?php echo str_replace( $search_replace, '_',  $key ) ?>" aria-controls="<?php echo str_replace( $search_replace, '_',  $key ) ?>" role="tab" data-toggle="tab"><?php echo ucwords($key); ?></a>
								</li>

							<?php } else { ?>

								<!--other tabs-->
								<li role="presentation">
									<a href="#<?php echo str_replace( $search_replace, '_',  $key ) ?>" aria-controls="<?php echo str_replace( $search_replace, '_',  $key ) ?>" role="tab" data-toggle="tab"><?php echo ucwords($key); ?></a>
								</li>

							<?php } ?>
							<?php $count_tab++; ?>

						<?php } ?>

					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<?php $count_tab = 0; ?>
						<!--recorre provider for generate tabs content-->
						<?php foreach ($providerJson as $key => $provider) { ?>
						
							<?php $options_dataset_month = array(); ?>

							<!--create tab content -->
							<div role="tabpanel" class="tab-pane-newScenario fade in tab-pane <?php if( $count_tab == 0 ){ echo 'active'; }  ?>" id="<?php echo str_replace( $search_replace, '_', $key ) ?>">

								<?php $count_tab++; ?>

								<?php array_multisort( $provider, SORT_DESC ); ?>
			
								<?php foreach ($provider as $key_dataset => $dataset) {

									//check if dataset has provider, month and year
									if ( count( $dataset ) >= 3) {
										
										//value dataset for pulldown
										$k_dataset = $dataset['0'] . '_' . $dataset['1'] . '_' . $dataset['2'] . '_' . $dataset['3'];

										//display for dataset pulldown
										$v_dataset = $dataset['1'] . ' ' . $dataset['3'];


										$options_dataset_month[$k_dataset] = $v_dataset;
										
									}


								} ?>

								<?php 

								//define flag for header ein false
								$it_has_headers = false;

								//header master in json for compare with others headers
								$header_master = '';

								//datseet header
								$dataset_header = 0;

								//recorre scenarios for search headers favorite 
								foreach ($scenarios as $scenario) {
									//check if scenario belogs to user
									if ($scenario['Scenario']['provider'] === str_replace( $search_replace, '_', $key ) ) { 
										
										//recorre all favorites from scenario
										foreach ($scenario['Favorite'] as $favorite) {


											//check if has get header
											if (!$it_has_headers) {
															
												//decode header from favorites
												$header_master = json_decode( $favorite['headers'] );

												//object to array headers	
												$header = get_object_vars( $header_master );

												//get keys from headers array	
												$keys_header =  array_keys( $header ) ;

												//change flag for indate has headers
												$it_has_headers = true;

												$dataset_header = $scenario['Scenario']['dataset_id'];

												continue 2;
											} 

										}
									}
								}

								?>
		
								<!--row month and form to create new scenario-->
								<div class="row">
									<?php echo $this->Form->create('Scenario', $options = array('url' => array('controller' => 'User', 'action' => 'newScenario') )); ?>
										
										<div class="row calendar">
										  	<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">

										  	</div>

											<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
												<h1 class="title-favorites" >Favorites</h1>
											</div>

										  	<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 ">
										  		
										  		<?php echo $this->Form->button('NEW SCENARIO', $options = array('class'=>'btn btn-warning btn-newScenario btn-margin-bottom animated pulse float-right', 'type' => 'submit')); ?>
										  		<?php echo $this->Form->input('datasetId', array('label'=>false, 'options'=>$options_dataset_month, 'required'=>'required',  'class' => 'combo-dataset float-right ' )); ?>
										  	</div>
										</div>
									<?php echo $this->Form->end(); ?>							
								</div>

								<!--table for favorites-->
								<div class="row">
									<div class="table-responsive">
										<table class="table table-bordered" id="table-dashboard">
									    
												<!--header table for dataset month-->
												<thead>
													<tr>
														<th class="col-lg-2">Scenario Name</th>
														<th class="col-lg-1">Save Date</th>
														<th class="col-lg-1">Period</th>
														<th style="width: 30px;">Decidere Score</th>
														
														<!--check if has header-->
														<?php if ($it_has_headers) { 

															//check if keys_header exist
															if ( isset($keys_header) ) {

																//Count for headers
																$count_header = 0;

																//recorre headers 
																foreach ($keys_header as $kh) {
																	
																	//check if four header 
																	if ($count_header == 4) {
																		//if headers are four break
																		break;
																	} 

																	//increment counter header
																	$count_header++; ?>

																	<!--td for header-->
																	<th> <?php echo str_replace('_', ' ', $header[$kh])  ; ?> </th>

																<?php }

															} 
														} else { ?>
															
															<td colspan="4"></td>

														<?php } ?>


														<!--<td> colspan 4 for options-->	
														<th colspan="4"></th>
													</tr>
												</thead>
								

											<!--body table for dataset month-->
											<tbody>
										
												<!--recorre scenarios-->
												<?php foreach ($scenarios as $keySce => $scenario) { ?>
												
													<!--check if scenario belogs to user-->
													<?php if ($scenario['Scenario']['provider'] === str_replace( $search_replace, '_', $key ) ) { ?>
														
														<!-- <tr> for header scenario-->
														<tr class="tr-scenario success">
															<td> 
																<div class="show-name-scenario" id="show-name-scenario-<?php echo $scenario['Scenario']['id']; ?>">
																	<span class="span-name-scenario">	<?php echo $scenario['Scenario']['name']; ?> </span>
																	<button class="btn btn-primary btn-xs btn-edit-name" data-toggle="tooltip" data-placement="bottom" title="Edit name" onclick="showEditNameScenario(<?php echo $scenario['Scenario']['id']; ?>)">
																		<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
																	</button> 
																</div>
																<div class="edit-name-scenario" id="edit-name-scenario-<?php echo $scenario['Scenario']['id']; ?>">
																	<?php echo $this->Form->create('Scenario', $options = array('class'=>'form-edit-name-scenario',  'url'=>array('controller'=>'Ajax', 'action'=>'editNameScenario') ) ); ?>
																	<?php echo $this->Form->input('id', $options = array('value'=> $scenario['Scenario']['id'])); ?>
																	<div class="input-group">
												   				 		<?php echo $this->Form->input('name', $options = array( 'value'=> $scenario['Scenario']['name'], 'label'=>false, 'class'=>'form-control input-sm', 'div'=>false )); ?>
																      	<span class="input-group-btn">
																        	<?php echo $this->Form->button(' <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>', $options = array('class'=>'btn btn-success btn-sm', 'escape'=>false, "data-toggle"=>"tooltip", "data-placement"=>"bottom", "title"=>"Save")); ?>
																			<?php echo $this->Form->button(' <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', $options = array('type'=>'button', 'class'=>'btn btn-danger btn-sm', 'escape'=>false, "data-toggle"=>"tooltip", "data-placement"=>"bottom", "title"=>"Cancel", 'onclick'=>'showNameScenario(' . $scenario["Scenario"]["id"] . ' );')); ?>
																      	</span>
																    </div>
																	<?php echo $this->Form->end(); ?> 
																</div>
															</td>
															<td> <?php echo date_format( date_create( $scenario['Scenario']['created'] ), 'jS F Y' ) ?> </td>
															<td>
																<?php 
																	$period = explode("_", $scenario['Scenario']['dataset']);
		
																		if ( count($period) >= 3) {
																			
																			echo $period['1'] . ' ' . $period['3'];
																		
																		} else {
																			echo $scenario['Scenario']['dataset'];
																		}
																 ?> 
															</td>

															<!-- fill td for equal to header-->	
															<td colspan="5"></td>
															
															<!--form for run-->
															<?php echo $this->Form->create(null, $options = array( 'url'=>array('controller' =>'User', 'action'=>'runScenario' ) )); ?>

																<?php echo $this->Form->input(null, $options = array('name'=>'scenario_id', 'type'=>'hidden', 'value'=>$scenario['Scenario']['id'])); ?> 

																<td>
																	<?php echo $this->Form->input(null, $options = array('options'=>$scenario['Mappings'], 'name'=>'dataset_match', 'label' =>false)); ?>
																</td>

																<td> <?php echo $this->Form->button('RUN', $options = array( 'class'=>'btn btn-success btn-xs', 'type'=>'submit' )); ?> </td>

															<?php echo $this->Form->end(); ?>
															<td> 
																<?php echo $this->Html->link('EDIT', array('controller' => 'User', 'action' => 'editScenario', $scenario['Scenario']['id'] ), array('class' => 'btn btn-primary btn-xs' ) ); ?>
															</td>
															<td> 			
																<?php echo $this->Form->create('Scenario', $options = array('url'=>array('controller'=>'Ajax', 'action'=>'deleteScenario'), 'class'=>'form-delete-scenario')); ?>
																			
																	<?php echo $this->Form->input('id', $options = array('type'=>'hidden', 'value'=>$scenario['Scenario']['id'])); ?>

																	<?php echo $this->Form->button( ' <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> ' , $options = array('class'=>'btn btn-danger btn-xs', 'escape'=>false, 'type'=>'submit', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Delete Scenario")); ?>

																<?php echo $this->Form->end(); ?>

															</td>

														</tr>

														<!--recorre favorites for scenario-->
														<?php foreach ($scenario['Favorite'] as $keyFav => $favorite) { ?>
															
															<!--check if dataset from header its equal that dataset from scenario actual-->
															<?php //if ($scenario['dataset_id'] == $dataset_header) { ?>
																
																<?php $fav = get_object_vars( json_decode($favorite['favorite']) ); ?>

																<!-- <tr> for favorites-->
																<tr class="tr-favorite tr-favorite-delete" id="<?php echo $favorite['id'] ?>">
																	<!--TDs for scenaio name, scenario save date and period -->
																	<td></td>
																	<td></td>
																	<td>
																		<?php 
																			$period = explode("_", $favorite['period']);
				
																				if ( count($period) >= 3) {
																					
																					echo $period['1'] . ' ' . $period['3'];
																				
																				} else {
																					echo $favorite['period'];
																				}
																		?> 
																	</td>
																	<td>
																		<?php  if( array_key_exists('DecidereScore',  $fav) ) { echo $fav['DecidereScore']; }  ?>
																	</td>
															
																	<!--TDs for favorite-->
																	<?php 

																	//Count for td
																	$count_td_favorite = 0;

																	//recorre headers 
																	foreach ($keys_header as $kh) {
																		
																		//check if four td favorite 
																		if ($count_td_favorite == 4) {
																			//if headers are four break
																			break;
																		} 

																		//increment counter td favorite
																		$count_td_favorite++; ?>

																		<!--td for favorite-->
																		<td> <?php  if( array_key_exists($kh,  $fav) ) { echo $fav[$kh] ; }  ?> </td>

																	<?php }	?>

																	<!--TDs for scenario run and delete-->
																	<td colspan="3"></td>
																	<td>
																		<?php echo $this->Form->create('Favorite', $options = array('url'=>array('controller'=>'Ajax', 'action'=>'deleteFavorite'), 'class'=>'form-delete-favorite')); ?>
																			
																			<?php echo $this->Form->input('id', $options = array('type'=>'hidden', 'value'=>$favorite['id'])); ?>

																			<?php echo $this->Form->button( ' <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ' , $options = array('class'=>'btn-link btn-xs', 'escape'=>false, 'type'=>'submit', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Delete favorite")); ?>

																		<?php echo $this->Form->end(); ?>

																	</td>
																</tr>

															<?php //} else { ?>

															<?php //} ?>


														<?php } ?>
											

													<?php } ?>
												<?php } ?>

											</tbody>
									
										</table>
									</div>
								</div>


							</div>
						<?php } ?>
						
					</div>			
				</div>


			<?php } ?>

			<div class="row">
				<div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-xs-offset-0 col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center">
					<p class="text-foot-register">Decidere is a product of Decidere Analytics, LLC Fort Wayne, Indiana 46805</p>
				</div>
			</div>

		</div>
	</div>

</section>

<?php echo $this->element('side_nav', array('viewName' => 'Dashboard')); ?>
