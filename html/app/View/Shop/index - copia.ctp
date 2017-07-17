<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName' => 'Select_Dataset')); ?>
</section>

<section id="cart">
	
	<div class="container">

		<h1 class="title-dashboard">Shopping cart</h1>
		
		<div class="row" id="topCar">
			<?php $items = $this->Session->read('ShoppingCart'); ?>
			<?php if (count($items)>0) { ?>
				<div class="row hidden-xs hidden-sm title-items-car">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<p class="subtitle-dashboard">Dataset</p>
					</div>
					<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-0 col-xs-offset-0 col-lg-1 col-md-1 col-sm-4 col-xs-4">
						<!--<p class="subtitle-dashboard">Quantity</p>-->
					</div>
					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
						<p class="subtitle-dashboard" style="text-align : right;">Price</p>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-4 col-xs-4">
						
					</div>
				</div>
				<div class="row">
				
				<?php echo $this->Form->create(null, $options = array( 'url'=>'https://www.paypal.com/cgi-bin/webscr', 'id'=>'formShopping' )); ?>

					<?php echo $this->Form->input('cmd', $options = array('value' => '_xclick-subscriptions', 'name'=>'cmd', 'type'=>'hidden')); ?>

					<?php echo $this->Form->input('charset', $options = array('value' => 'utf-8', 'name'=>'charset', 'type'=>'hidden')); ?>

					<?php echo $this->Form->input('custom', $options = array('value' => $this->Session->read('Auth.User.id'), 'name'=>'custom', 'type'=>'hidden')); ?>

					<?php $notify_url = $this->Html->url(array('controller' => 'Shop', 'action' => 'listener'), $full = true); ?> 

					<?php echo $this->Form->input('notify_url', $options = array('value'=>$notify_url, 'name'=>'notify_url', 'type'=>'hidden')); ?>	

					<?php echo $this->Form->input('business', $options = array('value' => 'lana.beregszazi@decidere.com', 'name'=>'business', 'type'=>'hidden')); ?>
					
					<?php echo $this->Form->input('currency_code', $options = array('value' => 'USD', 'name'=>'currency_code', 'type'=>'hidden')); ?>

					<?php echo $this->Form->input('add', $options = array('value' => '1', 'name'=>'add', 'type'=>'hidden')); ?>

					<?php echo $this->Form->input('no_shipping', $options = array('value'=>'1', 'name'=>'no_shipping', 'type'=>'hidden')); ?>

					<?php $url_return = $this->Html->url(array('controller' => 'Shop', 'action' => 'thanks'), $full = true); ?> 

					<?php echo $this->Form->input('return', $options = array('value'=>$url_return, 'name'=>'return', 'type'=>'hidden')); ?>	

					<?php $url_cancel_return = $this->Html->url(array('controller' => 'Shop', 'action' => 'index'), $full = true); ?> 

					<?php echo $this->Form->input('cancel_return', $options = array('value'=>$url_cancel_return, 'name'=>'cancel_return', 'type'=>'hidden')); ?>

					<?php echo $this->Form->input('lc', $options = array('value'=>'US', 'name'=>'lc', 'type'=>'hidden')); ?>

					<?php echo $this->Form->input('src', $options = array('value'=>'1', 'name'=>'src', 'type'=>'hidden')); ?>

					<?php echo $this->Form->input('sra', $options = array('value'=>'1', 'name'=>'sra', 'type'=>'hidden')); ?>	

					<?php $subtotal = 0; ?>

					<script type="text/javascript">var shopping_cart =  <?= json_encode( $this->Session->read('ShoppingCart') ); ?>  ;</script>

					<?php foreach ($items as $key => $item) { ?>

						<?php 
							if ($item['Plan']['duration'] == 'Monthly' ) {
								echo $this->Form->input('t3', $options = array('value'=>'M', 'name'=>'t3', 'type'=>'hidden'));
							} elseif ($item['Plan']['duration'] == 'Annual') {
								echo $this->Form->input('t3', $options = array('value'=>'Y', 'name'=>'t3', 'type'=>'hidden'));
							}
						?>

						<?php echo $this->Form->input('p3', $options = array('value'=>'1', 'name'=>'p3', 'type'=>'hidden')); ?>

						<!--get subtotal-->
						<?php $subtotal = str_replace(',', '.', $item['Plan']['price']); ?>

						<?php $plan_name = $item['Plan']['name']; ?>

						<div class="row content-item-car">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

								<?php echo $this->Form->input('item_number', $options = array('value'=>$item['Plan']['id'], 'name'=>'item_number', 'type'=>'hidden')); ?>

								<input type="hidden" value="<?php echo $item['Plan']['name']; ?>" name="item_name">

								<?php if ($this->Session->read('ShoppingCartDiscount')) { 
									$amount_plan = $item['Plan']['price'] - ( $item['Plan']['price'] * ( $this->Session->read('ShoppingCartDiscount') / 100 ) );
								} else {
									$amount_plan = $item['Plan']['price'];
								} ?>
								<!--<input type="hidden" class='amount_plan_<?php //echo $key; ?>' name="amount_<?php //echo $key+1; ?>" value="<?php //echo  number_format((float)$amount_plan, 2, '.', ''); ?>" />--> 

								<?php echo $this->Form->input('a3', $options = array('value'=>number_format((float)$amount_plan, 2, '.', '') , 'name'=>'a3', 'type'=>'hidden', 'class'=>'a3'. $key )); ?>

								<div class="row item-dataset">
									<p class="item-dataset-premium">Premium</p>
									<span class="sub-item-dataset-premium"></span>
									<h2 class="title-item-dataset-premium"><?php echo $item['Plan']['name']; ?></h2>
									<p class="description-item-dataset-premium"> <?php echo $item['Plan']['description']; ?> </p>
									<div class="col-50">
										<p class="item-dataset-premium-period"><?php echo $item['Plan']['duration']; ?> <span> <?php echo $item['Plan']['discount']; ?> </span> </p>
									</div>
									<div class="col-50 f-right">
										<?php //echo $this->Html->link( $this->Html->image('purchase.png', $options = array()) , array('controller' => 'Shop', 'action' => 'index', $item['Plan']['id']), array('escape'=>false)); ?>
									</div>
								</div> 	
							</div>
							<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-0 col-xs-offset-0 col-lg-1 col-md-1 col-sm-4 col-xs-4">
								<!--<input type="number" step="1" min="1" value="<?php //echo $item['Plan']['amount'] ?>" class="form-control input-shopping input-text-shopping" name="quantity_<?php //echo $key+1 ?>">-->
							</div>
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 text-right shop-show-price_<?php echo $key; ?> ">
								$<?php echo $item['Plan']['price'] ?>
							</div>
							<div class="col-lg-1 col-md-1 col-sm-4 col-xs-4 content-trash">
			
								<?php echo $this->Html->link('<span class="glyphicon glyphicon-trash"></span>', array('controller' => 'Shop', 'action' => 'deleteOfCar', $item['Plan']['id']), array('class'=>'delete-item-car hvr-buzz-out', 'escape'=>false, "data-toggle"=>"tooltip", "data-placement"=>"bottom", "title"=>"Remove from cart")  ); ?>

							</div>					
						</div>
					<?php } ?>

					<div class="row content-item-car">
						<div class="col-lg-offset-8 col-md-offset-8 col-xs-offset-8 col-xs-offset-0 col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<?php $link_terms = $this->Html->link('Terms and Conditions', array('controller' => 'Register', 'action' => 'terms'), array('target'=>'blank') ); ?>
							<?php echo $this->Form->input('agree_terms', $options = array('type' => 'checkbox', 'label' => 'I agree to the ' . $link_terms . ' of Use' , 'id' => 'checkbox-terms', 'onchange'=>'changeAgreeTerms(this);', 'div'=>true)); ?>
						</div>
					</div>
				
				<?php echo $this->Form->end(); ?>

				</div>


				<div class="row content-item-car">

					<script type="text/javascript">var subtotal_shop =  <?= $subtotal; ?>  ;</script>
					
					<!--subtotal-->
					<div class="row">
						<div class="col-lg-offset-8 col-md-offset-8 col-sm-offset-0 col-xs-offset-0 col-lg-1 col-md-1 col-sm-4 col-xs-4">
							<p class="subtitle-dashboard">Subtotal</p>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 text-right">
							<p id="shop-subtotal" > $<?php echo $subtotal; ?> </p>
						</div>
					</div>

					<!--Discount-->
					<div class="row">
						<div class="col-lg-offset-8 col-md-offset-8 col-sm-offset-0 col-xs-offset-0 col-lg-1 col-md-1 col-sm-4 col-xs-4">
							<p class="subtitle-dashboard">Discount</p>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 text-right">
							<?php if ($this->Session->read('ShoppingCartDiscount')) { ?>
								<p id="shop-discount" > <?php echo $this->Session->read('ShoppingCartDiscount'); ?>% </p>
							<?php } else { ?>
								<p id="shop-discount" > 0% </p>
							<?php } ?>
						</div>
						<div class="col-lg-1 col-md-1 col-sm-4 col-xs-4">
							<a href="#"  data-toggle="modal" data-target="#modalCoupon" class="btn btn-primary btn-xs  tooltip-class" data-placement="bottom" title="Add Coupon"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span></a>
						</div>
					</div>

					<!--Total-->
					<div class="row">
						<div class="col-lg-offset-8 col-md-offset-8 col-sm-offset-0 col-xs-offset-0 col-lg-1 col-md-1 col-sm-4 col-xs-4">
							<p class="subtitle-dashboard">Total</p>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 text-right">
							<?php if ($this->Session->read('ShoppingCartDiscount')) { ?>
								<p id="shop-total" > $<?php echo  $subtotal - ( $subtotal * ( $this->Session->read('ShoppingCartDiscount') / 100 ) ); ?></p>
							<?php } else { ?>
								<p id="shop-total" > $<?php echo $subtotal ; ?> </p>
							<?php } ?>
						</div>
					</div>

				</div>
				

				<div class="row title-items-car text-right" id="cotizar">

					<?php echo $this->Html->link('Add more items', array('controller' => 'Register', 'action' => 'selectDataset', 'ext'=>'html'), array('class'=>'btn-add-product-car btn btn-warning btn-newScenario animated pulse')); ?>

					<?php if ($this->Session->read('ShoppingCartDiscount') == 100 || $subtotal == 0 ) {
						echo $this->Html->link('Purchase free', array('controller' => 'Shop', 'action' => 'buy'), array('class'=>'btn-add-product-car btn btn-success animated disabled btn-purchase', 'id'=>'btnShopCoupon'));
					} else {
						echo $this->Html->link('Purchase free', array('controller' => 'Shop', 'action' => 'buy'), array('class'=>'btn-add-product-car btn btn-success animated disabled btn-purchase', 'style'=>'display:none;', 'id'=>'btnShopCoupon'));
					} ?>
	
					<?php if ( empty($userTokens) ) { ?>
						<?php echo $this->Form->create(null, $options = array('url'=>array('controller'=>'Shop', 'action'=>'saveToken'), 'class'=>'form-initial')); ?>
						  <script
						    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
						    data-key="pk_test_gLFUcc8x7nexUpwNdfUAORWv"
						    data-amount="<?php echo str_replace('.', '', $subtotal); ?>"
						    data-name="Decidere"
						    data-description="<?php echo $plan_name; ?>"
						    data-image="/img/documentation/checkout/marketplace.png"
						    data-locale="auto">
						  </script>
						<?php echo $this->Form->end(); ?>
					<?php } else { 

						echo $this->Form->create(null, $options = array('url'=>array('controller'=>'Shop', 'action'=>'saveToken'), 'class'=>'form-initial')); ?>
						  <script
						    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
						    data-key="pk_test_gLFUcc8x7nexUpwNdfUAORWv"
						    data-amount="<?php echo str_replace('.', '', $subtotal); ?>"
						    data-name="Decidere"
						    data-description="<?php echo $plan_name; ?>"
						    data-image="/img/documentation/checkout/marketplace.png"
						    data-locale="auto">
						  </script>
						<?php echo $this->Form->end();

						echo $this->Html->link(' Purchase', array('controller' => 'Shop', 'action' => 'saveToken'), array('class'=>'btn-add-product-car btn btn-info animated disabled btn-purchase', 'escape'=>false));
					} ?>

					<?php echo $this->Html->link( $this->Html->image( 'https://www.paypalobjects.com/webstatic/en_US/btn/btn_pponly_142x27.png' , $options = array()) , 'javascript:void(0);', array('onclick'=>'sendCart();', 'escape'=>false, 'class'=>'btn disabled animated btn-purchase', 'id'=>'btnCheckoutPaypal' ) ); ?>

				</div>
			<?php } ?>
		</div>

		<div class="row">
		<?php //$sources = json_decode($userTokens['UserToken']['sources']); ?>
			<?php //print_r($sources); ?>
		</div>

		<div class="row">
			<div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-xs-offset-0 col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center">
				<p class="text-foot-register">Decidere is a product of Decidere Analytics, LLC Fort Wayne, Indiana 46805</p>
			</div>
		</div>

	</div>

</section>

<?php echo $this->element('side_nav', array('viewName' => 'Dashboard')); ?>