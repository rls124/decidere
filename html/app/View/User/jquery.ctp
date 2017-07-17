<script type="text/javascript">var periodFavorite =  <?php echo json_encode( $period ); ?> ;</script>
<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName' => 'NewScenario')); ?>
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
<!-- END COVER-->
<br />

<section>
	<div class="container">
		<div class="row header-new-scenario">
			
			<h3 class="subtitle-newscenario">Decidere: <?php echo ucwords( $period_for_show ); ?></h3>
			<?php echo $this->Html->link('Back to dashboard', array('controller' => 'User', 'action' => 'dashboard'), array('class'=>'btn btn-primary btn-xs back-to-dashboard')); ?>
		</div>
		
		<!--this is new form from API-->

		<div class="row">

			<?php if (!empty($columnInfo)) { ?>
				
				<div class="row">

					<?php echo $this->Form->create(null, $options = array('url'=> array('controller'=>'User', 'action'=>'jqueryTest'), 'id'=>'form-post', 'class'=>"form-horizontal" )); ?>			

					<?php //echo $this->Form->create(null, $options = array('url'=> array('controller'=>'User', 'action'=>'getResults'), 'id'=>'newScenario', 'class'=>"form-horizontal", 'type'=>'file' )); ?>		

						<!--ID dataset-->
						<?php echo $this->Form->input('datasetId', $options = array('type'=>'hidden', 'value'=>$dataset_id, 'name' => 'datasetId', 'id' => 'datasetId' )); ?>

						<?php echo $this->Form->input('dataset_id', $options = array('type'=>'hidden', 'value'=>0, 'name' => 'dataset_id', 'id' => 'dataset_id' )); ?>

						<?php echo $this->Form->input('dataset', $options = array('type'=>'hidden', 'value'=>$dataset_id, 'name' => 'dataset', 'id' => 'dataset_id' )); ?>

						<?php echo $this->Form->input('provider_id', $options = array('type'=>'hidden', 'value'=>0, 'name' => 'provider_id', 'id' => 'provider_id' )); ?>

						<?php echo $this->Form->input('provider', $options = array('type'=>'hidden', 'value'=>strstr($dataset_id, '_', true), 'name' => 'provider', 'id' => 'dataset_id' )); ?>

						<?php echo $this->Form->input('scenario_name', $options = array('type'=>'hidden', 'value'=>strstr($dataset_id, '_', true) . '_' . date("m-d-y"), 'id'=>'scenario_name', 'name'=>'scenario_name' )); ?>

						<?php echo $this->Form->input('scenario_val', $options = array('type'=>'hidden', 'name' => 'scenario_val', 'id' => 'scenario_val')); ?>

						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist" id="ul-tabs-providers">
							<li role="presentation" class="active">
								<a href="#screening" aria-controls="screening" role="tab" data-toggle="tab">Screening</a>
							</li>
							<li role="presentation" >
								<a href="#weighting" aria-controls="weighting" role="tab" data-toggle="tab">Weighting</a>
							</li>
							<li role="presentation">
								<a href="#result" aria-controls="result" role="tab" id="link-tab-results" class="animated rubberBand" data-toggle="tab">Results</a>
							</li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
							
							<!--Tab for screeneable inputs-->
							<div role="tabpanel" class="tab-pane-newScenario tab-pane active" id="screening">
								
								<div class="row">
									
									<div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-0 col-lg-10 col-md-10 col-sm-10 col-xs-12">

										<?php echo $this->Form->input(null, $options = array('type'=>'checkbox', 'value'=>"ungrouped", 'checked'=>"checked", 'name'=>"screening_group_check__ungrouped", 'id'=>"screening_group_check__ungrouped", 'label'=>false, 'class'=>'no-show')); ?>

										<?php foreach ($columnInfo as $key => $input) {
											if ($input->IsScreenable == 1) {
												
												if ($input->DataType == 'character') { ?>

													<div class="form-group">
													    <label for="" class="col-lg-4 control-label"><?php echo $input->DisplayName; ?></label>
													    <div class="col-lg-7">
													      <?php 
																echo $this->Form->input(
																	$input->Column, 
																	$options = array(
																	'label'=> false, 
																	'class'=>'chosen-select form-control', 
																	'type'=>'select', 
																	'options'=>$input->options, 
																	'multiple'=>'multiple',  
																	'div'=>false, 
																	'name'=> 'screening_select_' . $input->Column, 
																	'id'=> 'screening_select_' . $input->Column )
																);     
															?>
													    </div>
													</div>


													
												<?php } elseif ($input->DataType == 'numeric') { ?>
													
													<div class="form-group">
													    <label for="" class="col-lg-4 control-label"><?php echo $input->DisplayName; ?></label>
													    <div class="col-lg-7">
													      	<?php 
																echo $this->Form->input(
																	$input->Column, 
																	$options = array( 
																	'label'=> false, 
																	'class'=>'input-range   form-control', 
																	'data-min'=>$input->RangeStart, 
																	'data-max'=>$input->RangeEnd, 
																	'data-step'=>$input->StepSize, 
																	'div'=>false, 
																	'name' => 'screen_slider_' . $input->Column, 
																	'id' => 'screen_slider_' . $input->Column )
																);    
															?>
													    </div>
													</div>
													

												<?php }

											}

										} ?>



										<!-- send button in tab screenable-->
										<div class="form-group">
										    <div class="col-lg-11 text-right">
										    	<a href="#weighting" aria-controls="weighting" role="tab" data-toggle="tab" class="btn btn-default">Next</a>
										    </div>
										</div>

									</div>

								</div>

							</div>

							<!--tab weight-->
							<div role="tabpanel" class="tab-pane-newScenario tab-pane" id="weighting">
								
								<div class="row">
								
									<div class="col-lg-10">
										
										<!--row for weight ungroup inputs-->
										<div class="row">
											
											<div class="row title-weighting-criteria hidden-xs hidden-sm">
												<!--input numeric for weighting-->
												<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
													
													<div class="col-lg-6 text-center hidden-ipad">
														<label class="control-label">Criteria</label>
													</div>
													<div class="col-lg-6 text-center">
														<label class="control-label">Percentage Importance</label>
													</div>
												</div>
												<!--inputs weight matching-->
												<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
													<label class="control-label">Matching Values</label>
												</div>
											</div>

											<?php foreach ($columnInfo as $key => $input) {
												if ($input->IsWeightable == 1 && $input->Group == 'Ungrouped' ) { ?>
													
													<div class="row">
														<!--input numeric for weighting-->
														<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
															<div class="form-group">
															    <label for="" class="col-lg-6 control-label"><?php echo $input->DisplayName; ?></label>
															    <div class="col-lg-6">
															      <?php 

															      	//input for weight ungroup
																	echo $this->Form->input(
																		$input->Column, 
																		$options = array(
																			'label'=> false, 
																			'type'=>"number", 
																			'step'=>"any", 
																			'class'=>'  form-control new-scenario-weight', 
																			'min'=>'0', 
																			'value'=>'0', 
																			'name'=>'group_weight_' . $input->Column, 
																			'id'=>'group_weight_' . $input->Column,
																			'div'=>false
																			)
																		); 

																	//input hidden for input ungroup with value 100		
																	echo $this->Form->input(
																		$input->Column,  
																		$options = array(
																			'label'=> false, 
																			'type'=>"hidden", 
																			'step'=>"any", 
																			'class'=>'  form-control', 
																			'min'=>'0', 
																			'value'=>'100', 
																			'name'=>'weight_grp_' . $input->Column . '__col_' . $input->Column,
																			'id'=>'weight_grp_' . $input->Column . '__col_' . $input->Column,
																			'div'=>false
																			)
																		);

																	 ?>
															    </div>

															</div>	
														</div>

														<!--inputs weight matching-->
														<?php if ($input->DataType == 'character' ) { ?>
															<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 matching-ipad">
																<div class="form-group">
																	<div class="col-lg-12">
																		<?php 
																			echo $this->Form->input(
																				$input->Column, 
																				$options = array(
																				'label'=> false, 
																				'class'=>'chosen-select form-control', 
																				'type'=>'select', 
																				'options'=>$input->options, 
																				'multiple'=>'multiple',  
																				'div'=>false, 
																				'name'=> 'weighting_select_' . $input->Column, 
																				'id'=> 'weighting_select_' . $input->Column )
																			);     
																		?>	
																	</div>
																</div>
															</div>
														<?php } ?>

													</div>

												<?php }

											} ?>


										</div>

										
										<!-- row for weigth in group -->
										<div class="row">
												
											<!-- chaeck for groups -->
											<?php if ( !empty($coulmnInfoGrouped) ) {

												//get groups name
												$groups = array_keys($coulmnInfoGrouped);
												
												//recorre array groups
												foreach ($groups as $group) { ?>

													<div class="row">
														<!-- content check for group-->
														<div class="row">
															<div class="col-lg-offset-0 col-md-offset-0 col-sm-offset-0 col-xs-offset-0 col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
																<!--check for group-->
																<?php echo $this->Form->input($group, $options = array( 'name' => 'weighting_group_check__' . $group, 'id' => 'weighting_group_check__' . $group,  'type' => 'checkbox', 'div'=>false, 'value'=> $group, 'onclick'=>'showHideWeightGroup( this, "'. $group .'" );')); ?>
																
															</div>
														</div>

														
														<div class="row content-input-weight-group no-show" id="content-input-weight-group-<?php echo $group; ?>" >
															<!-- input for value grooup-->
															<div class="row">
																<div class="col-lg-6">
																	<?php echo $this->Form->input($group, $options = array('name' => 'group_weight_' . $group, 'id' => 'group_weight_' . $group, 'type'=>'number', 'min'=>'0', 'max'=>'100', 'label'=>' Percentage Importance for the Group: ', 'div'=>false, 'class' => 'new-scenario-weight', 'value'=>0)); ?>
																</div>
																<div class="col-lg-6">
																	<div class="progress progress-ios">
																		<div id="bar-chart-weight-new-scenario-<?php echo $group; ?>" class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%; max-width:100%;" >
																			<span class="sr-only">0</span>
																		</div>
																	</div>
																</div>
															</div>
															<!--title for group-->
															<div class="row hidden-xs hidden-sm">
																<!--input numeric for weighting-->
																<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
																	<div class="col-lg-6 text-center hidden-ipad">
																		<label class="control-label">Criteria</label>
																	</div>
																	<div class="col-lg-6 text-center">
																		<label class="control-label">Percentage Importance</label>
																	</div>

																</div>
																<!--inputs weight matching-->
																<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
																	<label class="control-label">Matching Values</label>
																</div>
															</div>

															<div class="row">
																<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
																	<!--recorre internal fields for this group-->
																	<?php foreach ($coulmnInfoGrouped[$group] as $field) { ?>
																		<div class="form-group">
																		    <label for="" class="col-lg-6 control-label"><?php echo $field->DisplayName; ?></label>
																		    <div class="col-lg-6">
																		      <?php 
																				echo $this->Form->input(
																					$field->Column, 
																					$options = array(
																						'label'=> false, 
																						'type'=>"number", 
																						'step'=>"any", 
																						'class'=>'form-control new-scenario-weight-group-' . $group, 
																						'min'=>'0',
																						'value'=>'0',
																						'name'=>'weight_grp_' . $group . '__col_' . $field->Column ,
																						'id'=>'weight_grp_' . $group . '__col_' . $field->Column, 
																						'div'=>false,
																						'onChange' => 'changeBarChartIndicatorGroup("'. $group .'");'
																					)); 
																				 ?>

																		    </div>
																		</div>
																	<?php } ?>
																</div>

																<!--inputs weight matching-->
																<?php if ($field->DataType == 'character' ) { ?>
																	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 matching-ipad">
																		<div class="form-group">
																			<div class="col-lg-12">
																				<?php 
																					echo $this->Form->input(
																						$field->Column, 
																						$options = array(
																						'label'=> false, 
																						'class'=>'chosen-select form-control', 
																						'type'=>'select', 
																						'options'=>$field->options, 
																						'multiple'=>'multiple',  
																						'div'=>false, 
																						'name'=> 'weighting_select_' . $field->Column, 
																						'id'=> 'weighting_select_' . $field->Column )
																					);     
																				?>	
																			</div>
																		</div>
																	</div>
																<?php } ?>

															</div>
															
														</div>

													</div>
												<?php } 
												
											} ?>
											
										</div>

										<div class="row">
											
											<div class="form-group">
											    <div class="col-sm-offset-2 col-sm-10 text-right">
											    	<a href="#screening" aria-controls="screening" role="tab" data-toggle="tab" class="btn btn-default">Back</a>
													<?php echo $this->Form->button('Send', $options = array('type'=>'submit', 'class'=>"btn btn-primary", 'onclick'=>'setValueScenarioVal();')); ?>
											    </div>
											</div>
											
										</div>


									</div>


									<div class="col-lg-2">
										
										<?php if (!empty($columnInfo)) { ?>
											<!--indicator for weight desktop less that 100-->
											<div class="row content-chart hidden-xs hidden-sm">
												<div class="chart" id="chart-pie-weight-new-scenario" data-percent="0">
													<p class="amount-pie-chart">0</p>
												</div>
											</div>

											<!--indicator for weight desktop more that 100-->
											<div class="row content-chart hidden-xs hidden-sm">
												<div class="chart animated flash infinite" id="chart-pie-weight-new-scenario-more-less" data-percent="0">
													<p class="amount-pie-chart">0</p>
												</div>
											</div>

											<!--indicator for weight desktop more that 100-->
											<div class="row content-chart hidden-xs hidden-sm">
												<div class="chart" id="chart-pie-weight-new-scenario-success" data-percent="0">
													<p class="amount-pie-chart">0</p>
												</div>
											</div>


											<div class="row content-chart-sm hidden-md hidden-lg">
												<div class="progress">
													<div id="chart-pie-weight-new-scenario-sm" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%; max-width:100%;">
														<span class="sr-only">0</span>
													</div>
												</div>
											</div>
										<?php } ?>

									</div>
								

								</div>

							</div>

							<!--tab result-->
							<div role="tabpanel" class="tab-pane-newScenario tab-pane" id="result">
								
								<div class="row">
									
									<div class="table-responsive" id="content-table-results">
										<table class="table table-hover" id="table-results">
									    
											<thead id="thead-results">
												<tr>
													<!--here headers from response-->
												</tr>
											</thead>

											<tbody id="tbody-results">
												<!-- here response-->
											</tbody>

										</table>
									</div>

									<a href="javascript:void(0);" class="btn btn-success" onclick="saveResults();" id="btn-save-reults">Save</a>

								</div>

							</div>

						</div>
					<?php echo $this->Form->end(); ?>
				</div>
				
			<?php } ?>

		</div>

	</div>
</section>

<?php echo $this->element('side_nav', array('viewName' => 'NewScenario')); ?>

<div class="row">
	<pre id="show-result">
		show-result
	</pre>
</div>