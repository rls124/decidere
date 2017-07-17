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

<section class="admin"  id="match">
	
	<div class="container">

		<div class="row">
			<?php echo $this->element('admin_nav'); ?>
		</div>

		<h3>Create User</h3>

		<div class="row">
			<?php echo $this->Form->create('User', $options = array('id'=>'adminRegisterUser')); ?>
				<div class="row">
					<div class="col-lg-4">
						<?php echo $this->Form->input('first_name', $options = array( 'class'=>'form-control', 'label'=>false, 'div'=>false, 'placeholder'=>'First Name' )); ?>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('last_name', $options = array( 'class'=>'form-control', 'label'=>false, 'div'=>false, 'placeholder'=>'Last Name' )); ?>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('phone', $options = array( 'class'=>'form-control', 'label'=>false, 'div'=>false, 'placeholder'=>'Phone' )); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4">
						<?php echo $this->Form->input('company', $options = array( 'class'=>'form-control', 'label'=>false, 'div'=>false, 'placeholder'=>'Company' )); ?>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('email', $options = array( 'class'=>'form-control', 'label'=>false, 'div'=>false, 'placeholder'=>'Email' )); ?>
					</div>
					<div class="col-lg-4 input-register" id="form-register-username">
						<?php echo $this->Form->input('username', $options = array( 'class'=>'form-control', 'label'=>false, 'div'=>false, 'placeholder'=>'Username' )); ?>
						<p class="error-input-register-admin animated shake"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4">
						<?php echo $this->Form->input('role', $options = array( 'class'=>'form-control', 'label'=>false, 'div'=>false, 'type'=>'select', 'options'=>array('1'=>'Admin', '3'=>'Operator', '2'=>'User') )); ?>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('subscribed_to_news', $options = array('type' => 'checkbox', 'label' => array('text'=>'Subscribe to news', 'class'=>'') , 'id' => 'checkbox-subscribed', 'div'=>array('class'=>'input checkbox div-check-subscribed'), 'class'=>'form-login-checkbox', 'checked'=>'checked')); ?>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->button('Save', $options = array('type'=>'submit', 'class'=>'admin-user-register btn btn-success')); ?>
					</div>
				</div>
			<?php echo $this->Form->end(); ?>
		</div>

	</div>

</section>
<?php echo $this->element('side_nav', array('viewName' => 'NewScenario')); ?>

