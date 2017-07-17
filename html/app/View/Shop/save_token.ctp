<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName' => 'Select_Dataset')); ?>
</section>
<!--END COVER-->

<section id="checkout">
	
	<div class="container">
		<br/>
		<h1 class="title-dashboard">The purchase was processed</h1>

		<div class="row">
			<?php //print_r($subscriptions_status); ?>

			<div class="panel panel-primary">
			  	<div class="panel-heading">Result of purchase</div>
			  	<div class="panel-body">

					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="table-account">
							<thead>
								<tr>
									<th>Plan</th>
									<th>Periodicity</th>
									<th>Price</th>
									<th>Status</th>
									<th>Message</th>
								</tr>
							</thead>
							 <tbody>
							 	
								<?php foreach ($subscriptions_status as $key => $value) { ?>
									
									<?php if ($value['status'] == 'successful') {
										$status = 'Successful purchase';
										$message = 'Thank you for your purchase';
										$class_label = 'label-success';
									} elseif ($value['status'] == 'failed') {
										$status = 'Failed purchase';
										$message = 'An error occurred when purchasing, please try again';
										$class_label = 'label-danger';
									} ?>

									<tr>
										<td> <?php echo $value['subscription_name']; ?>  </td>
										<td> <?php echo $value['subscription_periodicity']; ?>  </td>
										<td> <?php echo $value['subscription_price']; ?>  </td>
										<td>  <span class="label <?php echo $class_label; ?>"><?php echo $status; ?></span> </td>
										<td> <?php echo $message; ?> </td>
									</tr>
								<?php } ?>
							 </tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
	</div>

</section>

<?php echo $this->element('side_nav', array('viewName' => 'Select_Dataset')); ?>