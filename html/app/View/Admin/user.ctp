<script type="text/javascript">var urlResetPassword =  <?php echo '"' . Router::url(['controller' => 'Admin', 'action' => 'resetPassword', 'ext'=>'json']) . '"'; ?>  ;</script>
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

		<h3>User</h3>

		<div class="row">
			<?php echo $this->Form->create('User', $options = array( 'id'=>'form-edit-user', 'url'=>array('controller'=>'Ajax', 'action'=>'saveUser' ) )); ?>
				<div class="col-lg-3">
					<?php echo $this->Form->input('id', $options = array( 'value'=>$user['User']['id'] )); ?>
					<?php echo $this->Form->input('first_name', $options = array('class'=>'form-control', 'value'=>$user['User']['first_name'])); ?>
					<?php echo $this->Form->input('last_name', $options = array('class'=>'form-control', 'value'=>$user['User']['last_name'])); ?>
					<?php echo $this->Form->input('phone', $options = array('class'=>'form-control', 'value'=>$user['User']['phone'])); ?>
				</div>
				<div class="col-lg-3">
					<?php echo $this->Form->input('email', $options = array('class'=>'form-control', 'value'=>$user['User']['email'])); ?>
					<?php echo $this->Form->input('username', $options = array('class'=>'form-control', 'value'=>$user['User']['username'])); ?>
					<p> <?php echo $this->Html->link(' <i class="fa fa-key fa-fw fa-rotate-90"></i>  Reset Password', 'javascript:void(0);', array('class'=>'btn btn-success btn-xs btn-admin-user', 'escape'=>false, 'onclick'=>'adminResetPassword( ' . $user["User"]["id"] . ' )' )); ?> </p>
				</div>
				<div class="col-lg-3">
					<?php echo $this->Form->input('company', $options = array('class'=>'form-control', 'value'=>$user['User']['company'])); ?>
					<?php echo $this->Form->input('role', $options = array( 'class'=>'form-control', 'value'=>$user['User']['role'], 'type'=>'select', 'options'=>array('1'=>'Admin', '3'=>'Operator', '2'=>'User') )); ?>
					<p class="btn-admin-user"> <strong> Created: </strong> <?php echo date_format( date_create( $user['User']['created'] ), 'jS F Y' ); ?> </p>
				</div>
				<div class="col-lg-3 text-right">
					<?php echo $this->Form->button('Save', $options = array('class'=>'btn btn-primary btn-admin-user', 'type'=>'submit')); ?>
				</div>
			<?php echo $this->Form->end(); ?>
		</div>

		<h3>Datasets - Private Plans</h3>

		<div class="row">
			
			<div class="table-responsive">
				<table class="table table-hover table-bordered">
			   		<thead>
			   			<tr>
			   				<th>Category</th>
			   				<th>Provider</th>
			   				<th>Plan</th>
			   				<th>Access</th>
			   			</tr>
			   		</thead>
		
			   		<tbody>
			   			<!--recorre plans for populate table plans-->
			   			<?php foreach ($plans as $key => $plan) { ?>

			   				<?php if( in_array($plan['Plan']['id'], $user_plans ) ) { 
			   					$checked_status = true;
			   				} else {
			   					$checked_status = false;
			   				} ?>
				   			
				   			<tr>
				   				<td> <?php echo $plan['Provider']['Category']['name']?> </td>
				   				<td> <?php echo $plan['Provider']['name'] ?> </td>
				   				<td> <?php echo $plan['Plan']['price'] ?> </td>
				   				<td>
									<?php echo $this->Form->create(null, $options = array('url' => array('controller'=>'Admin', 'action'=>'updateUserPlan'), 'class'=>'user-plan' )); ?>
				   						<?php echo $this->Form->input('plan_id', $options = array('type'=>'hidden', 'value'=>$plan['Plan']['id'], 'name'=>'plan_id' )); ?>
				   						<?php echo $this->Form->input('user_id', $options = array( 'type'=>'hidden', 'value'=>$user['User']['id'], 'name'=>'user_id' )); ?>
				   						<?php echo $this->Form->input('relation', $options = array('name'=>'relation', 'type'=>'checkbox', 'label'=>false, 'div'=>false, 'class'=>'checkbox-toggle',  'onchange'=>" sendFormUserPlan( this.form ); ", 'checked'=>$checked_status )); ?> </td>
									<?php echo $this->Form->end(); ?>
				   			</tr>

			   			<?php } ?>
			   		</tbody>
				</table>
			</div>
			
		</div>

	</div>



</section>
<?php echo $this->element('side_nav', array('viewName' => 'NewScenario')); ?>
