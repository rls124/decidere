<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName' => 'account')); ?>
</section>
<!--END COVER-->
<br />

<section id="shopping-cart">
	<div class="row">

		<div class="container">

			<h1 class="title-dashboard">Deactivate my Account</h1>
			
			<div class="row calendar">
			  	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			  		<!--<h1 class="subtitle-dashboard">Datasets</h1>-->
			  	</div>
			  	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-right">
			  	</div>
			</div>

			<!--account-->
			<div class="row">
				<p class="text-center">
					We are sorry to see you go! Are you sure you want to deactivate your personalized Decidere account?.
				</p>
				<div class="row text-center">
					<?php echo $this->Html->link('Cancel', array('controller' => 'User', 'action' => 'account'), array('class'=>'btn btn-danger btn-xs')); ?>
					<?php echo $this->Form->create('User', $options = array('url'=>array('controller'=>'Ajax', 'action'=>'deactivateAccount'), 'class'=>'form-initial', 'id'=>'form-deactivate-account')); ?>
						<?php echo $this->Form->button('Deactivate', $options = array('class'=>'btn btn-primary btn-xs', 'type'=>'submit')); ?>
					<?php echo $this->Form->end(); ?>
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
