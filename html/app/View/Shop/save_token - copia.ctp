<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName' => 'Select_Dataset')); ?>
</section>
<!--END COVER-->

<section id="checkout">
	
	<div class="container">
		
		<h1 class="title-dashboard">Checkout</h1>

		<div class="row">
			
			<?php if ($subscription == 'failed') { ?>

				<h4>Oops!! we have a problem with your payment method</h4>

				<?php $plan = $this->Session->read('ShoppingCart'); ?>

				<p>Plan: <?php echo $plan['0']['Plan']['name']; ?> </p>
				
			<?php } elseif($subscription == '') { ?>

				<script>
					var urlShop =  <?php echo '"' . Router::url(['controller' => 'Shop', 'action' => 'index']) . '"'; ?>  ;
					window.location.href = urlShop;
				</script>

			<?php } else { ?>

				<p class="text-center">Thank you for your purchase, you are redirected to your  <?php echo $this->Html->link('dashboard', array('controller' => 'User', 'action' => 'dashboard')); ?> </p>

				<script>
					var urlDashboard =  <?php echo '"' . Router::url(['controller' => 'User', 'action' => 'dashboard']) . '"'; ?>  ;
					window.setTimeout(function() {
						window.location.href = urlDashboard;
					}, 5000);
				</script>	

			<?php } ?>

		</div>

	</div>

</section>

<?php echo $this->element('side_nav', array('viewName' => 'Select_Dataset')); ?>