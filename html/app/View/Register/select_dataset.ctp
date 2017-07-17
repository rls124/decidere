<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName' => 'Select_Dataset')); ?>
</section>
<!--END COVER-->
<br />

<section id="shopping-cart">
	<div class="row">
		<div class="container">

			<div class="row content-title-shopping-cart">
				<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-0 col-xs-offset-0 col-lg-8 col-md-8 col-sm-6 col-xs-12"></div>
				<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 f-right">
					
					<?php echo $this->Html->link( $this->Form->button('Checkout', 
							$options = array('class'=>'btn btn-warning btn-newScenario btn-margin-bottom animated pulse float-right', 'type' => 'submit')),
							array('controller' => 'Shop', 'action' => 'index'), array('escape'=>false)); ?>

				</div>
			</div>
			<div class="row">
					
				<div>
				  <?php $search_replace = array('.', ' '); ?> 
				  <ul class="nav nav-tabs" role="tablist">

					  <!-- Nav tabs -->
						<?php foreach ($categories as $key => $value) { ?>
							<?php if($key == 0){ ?>

								<!--first tab active-->
								<li role="presentation" class="active">
									<a href="#<?php echo str_replace( $search_replace, '_',  $value['Category']['name'] ) ?>" aria-controls="<?php echo str_replace( $search_replace, '_',  $value['Category']['name'] ) ?>" role="tab" data-toggle="tab"><?php echo $value['Category']['name'] ?></a>
								</li>

							<?php } else { ?>

								<!--other tabs-->
								<li role="presentation">
									<a href="#<?php echo str_replace( ' ', '_',  $value['Category']['name'] ) ?>" aria-controls="<?php echo str_replace( ' ', '_',  $value['Category']['name'] ) ?>" role="tab" data-toggle="tab"><?php echo $value['Category']['name'] ?></a>
								</li>

							<?php } ?>
						<?php } ?>
				    
				  </ul>

				  <!-- Tab panes -->
					<?php foreach ($categories as $key => $value) { ?>
						
						<div role="tabpanel" class="tab-pane animated fadeIn row  <?php if( $key == 0 ){ echo 'active'; }  ?> " id="<?php echo str_replace( $search_replace, '_', $value['Category']['name'] ) ?>">
							<div class="p20">
							<?php foreach ($value['Provider'] as $key => $provider) {
								
								if ( count($provider['Plan'] ) > 0 ) {
									foreach ($provider['Plan'] as $key => $plan) { ?>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="row item-dataset">
													<p class="item-dataset-premium"> 
														<?php echo $provider['name'] ?> 
													</p>
													<span class="sub-item-dataset-premium"></span>
													<div style="display: inline">
														<h2 class="title-item-dataset-premium"><?php echo $plan['name']; ?></h2></div>
													<p class="description-item-dataset-premium"> <?php echo $plan['description']; ?> </p>
													<div class="col-50">
														<p class="item-dataset-premium-price">$<?php echo $plan['price']; ?> </p>
														<p class="item-dataset-premium-period"><?php echo $plan['duration']; ?> <span> <?php echo $plan['discount']; ?> </span> </p>
													</div>
													<div class="col-50 f-right">
														<?php if (!in_array($plan['name'], $user_plans)){  ?>
															<?php if( in_array($plan['name'], $user_plans ) or $plan['type'] == '1'  ) { 
																echo $this->Html->link( $this->Html->image('purchase.png', $options = array()) , array('controller' => 'Shop', 'action' => 'index', $plan['id']), array('escape'=>false));
															} else {
																echo $this->Html->link( $this->Html->image('request-access.png', $options = array()) , 'javascript:void(0);' , array('escape'=>false)); 
	
															} ?>
														<?php } else { ?>
															<span class="label label-danger label-purchased">Purchased</span>
														<?php } ?>
													</div>
												</div>
											</div>
									<?php }
									}
								} ?>
							</div>
							<br clear="all"/>
						</div>

					<?php } ?>
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

<?php echo $this->element('side_nav', array('viewName' => 'Select_Dataset')); ?>
