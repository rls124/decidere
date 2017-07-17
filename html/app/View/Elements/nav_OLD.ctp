<div class="content-nav">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-3">
		<a href="javascript:void(0);" onclick="" class="hvr-grow btn-toggle-sidenav toggle-sidebar">
			<!--img src="img/nav-button.png" alt="Menu"-->
			<?php echo $this->Html->image('nav-button.png', $options = array('class'=>'', 'alt'=>'Menu')); ?>
		</a>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-7">
		<h1 class="logo-nav-text text-center animated flipInX">
		<?php echo $this->Html->link('DECIDERE', '/'); ?>
		</h1>
	</div>
	<div id="menu-desktop" class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right ">
		<?php if($this->Session->read('Auth.User.role')=='2') { ?>
		
		<span class="sp-have-account">
		<?php echo $this->Session->read('Auth.User.first_name') . ' ' . $this->Session->read('Auth.User.last_name'); ?>
		</span>
		
		<?php /*echo $this->Html->link('My Dashboard', array('controller' => 'Admin', 'action' => 'dashboard'), array('class'=>"a-login"));*/ ?>

		<?php echo $this->Html->link('Log Out', array('controller' => 'Admin', 'action' => 'logout'), array('class'=>'a-login')); ?>

		<?php } else { ?>

		<?php if($viewName == 'Register'){ ?>

		<span class="sp-have-account">
		Already have an account ?
		</span>

		<a class="a-login" data-toggle="modal" data-target="#myModal">Log In</a>
		
		<?php } else { ?>
		<a class="a-login" data-toggle="modal" data-target="#myModal">Log In</a>
		
		<?php echo $this->Html->link( $this->Html->image('btn-join.png', $options = array('class'=>'animated rubberBand', 'alt'=>'Join')) , array('controller' => 'Register', 'action' => 'index'), array('escape'=>false, 'class'=>'hvr-pulse-grow')); ?>

		<?php } }?>
	</div>


	<div id="menu-mobile" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?php if($this->Session->read('Auth.User.role')=='2') { ?>
			<span class="sp-have-account">
			<?php echo $this->Session->read('Auth.User.first_name') . ' ' . $this->Session->read('Auth.User.last_name'); ?>
			</span>

			<?php echo $this->Html->link('Log Out', array('controller' => 'Admin', 'action' => 'logout'), array('class'=>'a-login')); ?>
			<?php } else { ?>
			<?php if($viewName == 'Register'){ ?>
			<span class="sp-have-account">
			Already have an account ?
			</span>

			<a class="a-login" data-toggle="modal" data-target="#myModal">Log In</a>
			
			<?php } else { ?>
			<a class="a-login" data-toggle="modal" data-target="#myModal">Log In</a>
			<?php echo $this->Html->link( $this->Html->image('btn-join.png', $options = array('class'=>'animated rubberBand', 'alt'=>'Join')) , array('controller' => 'Register', 'action' => 'index'), array('escape'=>false, 'class'=>'hvr-pulse-grow')); ?>
			<?php } }?>
	</div>
</div>