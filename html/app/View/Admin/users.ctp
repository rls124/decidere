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

<section class="admin" id="match">
	
	<div class="container">

		<div class="row">
			<?php echo $this->element('admin_nav'); ?>
		</div>

		<h3>Users <?php echo $this->Html->link( '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>' , array('controller' => 'Admin', 'action' => 'createUser' ), array('escape' => false, 'class' => 'btn btn-primary btn-xs', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Create new" )  ); ?>  </h3>

		<div class="row">
			<div class="table-responsive">
				<table id="table-users" class="table table-hover table-bordered">
			   		<thead>
			   			<tr>
			   				<th class="user-table-header"> Username</th>
			   				<th class="user-table-header"> First Name</th>
			   				<th class="user-table-header"> Last Name</th>
			   				<th class="user-table-header"> Email</th>
			   				<th class="user-table-header"> Company</th>
			   				<th class="user-table-header">Subscribed Datasets</th>
			   				<th class="user-table-header">News Subsc.</th>
			   				<th class="user-table-header">Actions</th>
			   			</tr>
			   		</thead>
		
			   		<tbody>

			   			<!--recorre user for populate table users-->
			   			<?php foreach ($users as $user) { ?>

						<?php $plans = ''; ?>

			   			<?php if ( count($user['UserPlan']) > 0 ) {
			   				foreach ($user['UserPlan'] as $key => $userPlan) {
			   					if ( count( $userPlan['Plan'] ) > 0 ) {
			   						$plans = $plans . $userPlan['Plan']['name'] . ' $' .$userPlan['Plan']['price'] . '<br>';
			   					}
			   				}
			   			} ?>

			   			<!--Get list subscribed datasets-->
						<?php $providers = ''; ?>

			   			<?php if ( !empty($user['UserProvider']) ) {
			   				foreach ($user['UserProvider'] as  $userProvider) {
			   					$providers = $providers . '&#9679;' . $userProvider['provider'] . '<br>';
			   				}
			   			} ?>

			   			<?php $subscribed = ''; ?>

			   			<?php if ( $user['User']['subscribed_to_news'] == '1' ) {
							$subscribed = 'Yes'; 			   				
			   			} else if( $user['User']['subscribed_to_news'] == '0' ) {
			   				$subscribed = 'No';	
			   			}?>
			   				
			   			<tr>
			   				<td> <?php echo $user['User']['username'] ?> </td>
			   				<td> <?php echo $user['User']['first_name'] ?> </td>
			   				<td> <?php echo $user['User']['last_name'] ?> </td>
			   				<td> <?php echo $user['User']['email'] ?> </td>
			   				<td> <?php echo $user['User']['company'] ?> </td>
			   				<td> <?php echo $providers; ?> </td>
			   				<td> <?php echo $subscribed; ?> </td>
			   				<td>
			   					<?php echo $this->Html->link('<i class="fa fa-key fa-rotate-90"></i>', 'javascript:void(0);' , array('escape'=>false, 'class'=>'btn btn-success btn-xs', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Reset Password", 'onclick'=>'adminResetPassword( ' . $user["User"]["id"] . ' )')); ?> 

			   					<?php echo $this->Html->link( '<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>' , array('controller' => 'Admin', 'action' => 'user', $user['User']['id'] ), array('escape' => false, 'class' => 'btn btn-default btn-xs', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Admin" )  ); ?> 

			   					<?php echo $this->Form->postLink(__(' <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> '), array('action' => 'delete', $user['User']['id'],'user'), array('class'=>'btn btn-danger btn-xs', 'escape'=>false, 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Delete"), __('Are you sure to delete the User " %s " ?', $user['User']['username'])); ?>
			   				</td>
			   			</tr>
			   			<?php } ?>
			   		</tbody>
				</table>
			</div>
		</div>
	</div>

</section>
<?php echo $this->element('side_nav', array('viewName' => 'NewScenario')); ?>

