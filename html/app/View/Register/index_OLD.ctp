<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName'=> 'Register')); ?>
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

<!--FORM REGISTER-->
<section id="register">
	<div class="row">
		<div class="container">
			<div class="row text-center">
				<h1 class="title-register">Register yourself or your organization for a MyDecidere account</h1>
			</div>
			<div class="row">
				<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-0 col-xs-offset-0 col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<?php echo $this->Form->create('User', $options = array('url'=>array('controller'=>'Register', 'action'=>'registerUserAjax'), 'id' => 'RegisterUser' )); ?>
						<div class="row">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<?php echo $this->Form->input('first_name', $options = array('placeholder'=>"First name*", 'class'=>"form-control form-login", 'label'=>false, 'div'=>false)); ?>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<?php echo $this->Form->input('last_name', $options = array('placeholder'=>"Last name*", 'class'=>"form-control form-login", 'label'=>false, 'div'=>false)); ?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<?php echo $this->Form->input('phone', $options = array('placeholder'=>"Phone number*", 'class'=>"form-control form-login", 'label'=>false, 'div'=>false)); ?>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<?php echo $this->Form->input('company', $options = array('placeholder'=>"Company*", 'class'=>"form-control form-login", 'label'=>false, 'div'=>false)); ?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 input-register" id="form-register-username">
									<?php echo $this->Form->input('username', $options = array('placeholder'=>"Username*", 'class'=>"form-control form-login", 'label'=>false, 'div'=>false)); ?>
									<p class="error-input-register animated shake"></p>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 input-register" id="form-register-email">
									<?php echo $this->Form->input('email', $options = array('placeholder'=>"Email adress*", 'class'=>"form-control form-login", 'label'=>false, 'div'=>false)); ?>
									<p class="error-input-register animated shake"></p>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<?php echo $this->Form->input('password', $options = array('placeholder'=>"Password*", 'class'=>"form-control form-login", 'label'=>false, 'div'=>false, 'id'=>'password_register')); ?>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<input type="password" required placeholder="Re-type password*" id="confirm_password" class="form-control form-login">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<p class="p-info-register info-required">* Required field</p>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<p class="p-info-register">Special Request</p>
									<?php echo $this->Form->input('request', $options = array('class'=>"form-control form-login", 'label'=>false, 'div'=>false, 'cols'=>'30', 'rows'=>'4')); ?>
								</div>
							</div>
							<div class="row text-center ">
								<button type="submit" class="submit-register hvr-float-shadow">
									<img src="img/btn-next.png" alt="">
								</button>
							</div>
						</div>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-xs-offset-0 col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center">
					<p class="text-foot-register">Decidere is a product of Decidere Analytics, LLC Fort Wayne, Indiana 46805</p>
				</div>
			</div>
		</div>
	</div>
</section>
<!--EN FORM REGISTER-->

<?php echo $this->element('modals'); ?>
<?php echo $this->element('side_nav', array('viewName' => 'Register')); ?>
