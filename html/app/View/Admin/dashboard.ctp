<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName' => 'Dashboard')); ?>
	<div class="col-xs-12 col-sm-12 col-md-12 no-padding">
		<div class="cover-in">
			<div class="container">
				<div class="col-xs-12 col-sm-12 col-md-12 no-padding mobile-version">
					<div class="row collapsed-nav">
						<a href="" class="animated swing fadeInDown">HOME</a>
						<a href="" class="animated swing fadeInDown">ABOUT</a>
						<a href="" class="animated swing fadeInDown">DATASETS</a>
						<a href="" class="animated swing fadeInDown">HELP</a>
						<a href="" class="animated swing fadeInDown">CONTACT</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--END COVER-->
<br />

<section id="shopping-cart">
	<div class="row">
		<div class="container">

			<h1 class="title-dashboard">My Dashboard</h1>

			<div class="row calendar">
			  	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			  		<h1 class="subtitle-dashboard">Datasets</h1>
			  	</div>
			  	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">

			  	</div>
			</div>

			<div class="row content-tabsDatasets">

				<?php $search_replace = array('.', ' '); ?> 

				<!--var for matches -->
				<?php $cb_matches = array(); ?>
								
				<!--recorre dataet find dataset mappings-->
				<?php foreach ($providers as $provider) {
						
					foreach ($provider['Dataset'] as $key => $dataset) { 

						//matches for one dataset
						$match = array();

						foreach ($dataset['MatchedA'] as $key => $item_match) {
							if($key == 0){
								
								$match[ $item_match['DatasetA']['id'] ] = $item_match['DatasetA']['month']; 
								$match[ $item_match['DatasetB']['id'] ] = $item_match['DatasetB']['month']; 

							} else {
								$match[ $item_match['DatasetB']['id'] ] = $item_match['DatasetB']['month']; 
							}
						}

						//add matches to options
						$cb_matches[ $dataset['id'] ] = $match;

					}
				} ?>
				
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					
					<!--recorre provider for generate tabs header-->
					<?php foreach ($providers as $key => $value) { ?>
						<?php if($key == 0){ ?>

							<!--first tab active-->
							<li role="presentation" class="active">
								<a href="#<?php echo str_replace( $search_replace, '_',  $value['Provider']['name'] ) ?>" aria-controls="<?php echo str_replace( $search_replace, '_',  $value['Provider']['name'] ) ?>" role="tab" data-toggle="tab"><?php echo $value['Provider']['name'] ?></a>
							</li>

						<?php } else { ?>

							<!--other tabs-->
							<li role="presentation">
								<a href="#<?php echo str_replace( ' ', '_',  $value['Provider']['name'] ) ?>" aria-controls="<?php echo str_replace( ' ', '_',  $value['Provider']['name'] ) ?>" role="tab" data-toggle="tab"><?php echo $value['Provider']['name'] ?></a>
							</li>

						<?php } ?>
					<?php } ?>

				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					
					<!--recorre provider for generate tabs content-->
					<?php foreach ($providers as $keyP => $provider) { ?>
						
						<!-- prepare data for table-->
						<?php 							
							//months for dataset
							$dataset_months = array(); 

							//for selected month
							$selected_combo = 0;

							//recorre datasets for months
							foreach ($provider['Dataset'] as $dataset) {
								$dataset_months[ $dataset['id'] ] = $dataset['month'];  	
								$selected_combo = $dataset['id'];														
							}

							//define flag for header ein false
							$it_has_headers = false;

							//header master in json for compare with others headers
							$header_master = '';

							//datseet header
							$dataset_header = 0;

							//recorre scenarios for search headers favorite 
							foreach ($provider['Scenario'] as $scenario) {
								//check if scenario belogs to user
								if ($scenario['user_id'] === $this->Session->read('Auth.User.id') ) { 
									
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

											$dataset_header = $scenario['dataset_id'];

											continue 2;
										} 

									}
								}
							}

						?>

						<!--create tab content -->
						<div role="tabpanel" class="tab-pane-newScenario fade in tab-pane <?php if( $keyP == 0 ){ echo 'active'; }  ?> " id="<?php echo str_replace( $search_replace, '_', $provider['Provider']['name'] ) ?>">
	
							<!--row month and form to create new scenario-->
							<div class="row">
								<?php echo $this->Form->create('Scenario', $options = array('url' => array('controller' => 'Admin', 'action' => 'newScenarioJson') )); ?>
									
									<?php echo $this->Form->input('provider_id', $options = array('type'=>'hidden', 'value'=>$provider['Provider']['id']  )); ?>

									<div class="row calendar">
									  	<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
											<?php echo $this->Form->input('dataset_id', array('label'=>false, 'options'=>$dataset_months, 'required'=>'required',  'class' => 'combo-dataset', 'selected'=> $selected_combo )); ?>
									  	</div>

										<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
											<h1 class="title-favorites" >Favorites</h1>
										</div>

									  	<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 f-right">
									  		<?php echo $this->Form->button('NEW SCENARIO', $options = array('class'=>'btn btn-warning btn-newScenario animated pulse', 'type' => 'submit')); ?>
									  	</div>
									</div>
								<?php echo $this->Form->end(); ?>							
							</div>


							<!--table for favorites-->
							<div class="row">
								<div class="table-responsive">
									<table class="table table-bordered">
								    
											<!--header table for dataset month-->
											<thead>
												<tr>
													<th>Scenario Name</th>
													<th>Save Date</th>
													<th>Period</th>
													
													<!--check if keys_header exist-->
													<?php if ( isset($keys_header) ) {

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

													} ?>

													<!--<td> colspan 4 for options-->	
													<th colspan="4"></th>
												</tr>
											</thead>
							

										<!--body table for dataset month-->
										<tbody>
									
											<!--recorre scenarios-->
											<?php foreach ($provider['Scenario'] as $keySce => $scenario) { ?>
												
												<!--check if scenario belogs to user-->
												<?php if ($scenario['user_id'] === $this->Session->read('Auth.User.id') ) { ?>
													
													<!-- <tr> for header scenario-->
													<tr class="tr-scenario">
														<td> <?php echo $scenario['name']; ?> </td>
														<td> <?php echo $scenario['created'] ?> </td>
														<td> <?php echo $scenario['Dataset']['month']; ?> </td>

														<!-- fill td for equal to header-->	
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														
														<!--form for run-->
														<?php echo $this->Form->create(null, $options = array( 'url'=>array('controller' =>'Admin', 'action'=>'runScenario' ) )); ?>

															<?php echo $this->Form->input(null, $options = array('name'=>'scenario_id', 'type'=>'hidden', 'value'=>$scenario['id'])); ?> 

															<?php echo $this->Form->input(null, $options = array('name'=>'dataset_orgin', 'type'=>'hidden', 'value'=>$scenario['dataset_id'])); ?> 

															<!--check if dataset has matches-->
															<?php if ( count ($cb_matches[ $scenario['Dataset']['id'] ] ) > 0 ) { ?>
																<td> 
																	<?php echo $this->Form->input(null, $options = array('options'=>$cb_matches[ $scenario['Dataset']['id'] ], 'name'=>'dataset_match', 'label' =>false)); ?> 
																</td>
															<!-- if dataset has not matches-->
															<?php } else { ?>
																<td>
																	<?php echo $scenario['Dataset']['month']; ?>
																	<?php echo $this->Form->input(null, $options = array('name'=>'dataset_match', 'type'=>'hidden', 'value'=>$scenario['dataset_id'])); ?> 
																</td>
															<?php } ?>


														<td> <?php echo $this->Form->button('RUN', $options = array( 'class'=>'btn btn-success btn-xs', 'type'=>'submit' )); ?> </td>

														<?php echo $this->Form->end(); ?>
														<td> 
															<?php echo $this->Html->link('EDIT', array('controller' => 'Admin', 'action' => 'editScenario', $scenario['id'] ), array('class' => 'btn btn-primary btn-xs' ) ); ?>
														</td>
														<td> 
															<?php echo $this->Form->postLink(__(' <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> '), array('action' => 'delete', $scenario['id'],'scenario'), array('class'=>'btn btn-danger btn-xs', 'escape'=>false), __('Are you sure to delete the Scenario " %s " ?', $scenario['name'])); ?>
														</td>

													</tr>

													<!--recorre favorites for scenario-->
													<?php foreach ($scenario['Favorite'] as $keyFav => $favorite) { ?>
														
														<!--check if dataset from header its equal that dataset from scenario actual-->
														<?php //if ($scenario['dataset_id'] == $dataset_header) { ?>
															
															<?php $fav = get_object_vars( json_decode($favorite['favorite']) ); ?>

															<!-- <tr> for favorites-->
															<tr class="tr-favorite">
																<!--TDs for scenaio name, scenario save date and period -->
																<td></td>
																<td></td>
																<td> <?php echo $favorite['period'] ?> </td>
														
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
																<td colspan="4"></td>
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



			<div class="row">
				<div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-xs-offset-0 col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center">
					<p class="text-foot-register">Decidere is a product of Decidere Analytics, LLC Fort Wayne, Indiana 46805</p>
				</div>
			</div>

		</div>
	</div>

	<div class="row">
	</div>

</section>

<?php echo $this->element('side_nav', array('viewName' => 'Dashboard')); ?>
