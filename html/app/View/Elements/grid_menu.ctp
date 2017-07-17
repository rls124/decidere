<div class="dropdown-menu">

	  	<div class="row">
		  	<div class="md-col-12">
				<?php echo $this->Html->link( '<span aria-hidden="true">Dashboard</span>' , 
					array('controller' => 'User', 'action' => 'dashboard' ), 
					// array('escape' => false, 'class' => 'btn btn-orange', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"User Dashboard" )); 
					array('escape' => false, 'class' => 'btn btn-orange', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom")); 
				?>    		
				<?php 
					echo $this->Html->link(
    					'Subscriptions',
    					'/User/account#subscriptions',
    					['class' => 'btn btn-orange md-col-6 sm-col-12']
					);
					// echo $this->Html->link( '<span aria-hidden="true">Subscription</span>' , 
					// array('controller' => 'User', 'action' => 'account', '#' => 'subscriptions'), 
					// array('escape' => false, 'class' => 'btn btn-orange', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"User Subscriptions" )); 
					// array('escape' => false, 'class' => 'btn btn-orange', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom")); 
				?>    		
		  	</div>
	  	</div>

	  	<div class="row">
		  	<div class="md-col-12">
				<?php echo $this->Html->link( '<span aria-hidden="true">Find Dataset</span>' , 
					array('controller' => 'Register', 'action' => 'selectDataset'), 
					// array('escape' => false, 'class' => 'btn btn-orange md-col-6 sm-col-12', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Find Datasets" )); 
					array('escape' => false, 'class' => 'btn btn-orange md-col-6 sm-col-12', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom")); 
				?>    		
				<?php echo $this->Html->link( '<span aria-hidden="true">Account</span>' , 
					array('controller' => 'User', 'action' => 'account'), 
					// array('escape' => false, 'class' => 'btn btn-orange md-col-6 sm-col-12', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Account Page" )); 
					array('escape' => false, 'class' => 'btn btn-orange md-col-6 sm-col-12', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom")); 
				?>    		
		  	</div>
	  	</div>



	  	<div class="row">
		  	<div class="md-col-12">
			  	<?php  if ($this->Session->read('Auth.User.role') == "1") { 
						echo $this->Html->link( '<span aria-hidden="true">Admin</span>' , 
						array('controller' => 'Admin', 'action' => 'index'), 
						// array('escape' => false, 'class' => 'btn btn-orange', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Administrator Page" )); 
						array('escape' => false, 'class' => 'btn btn-orange', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom")); 
				 	} 
				 ?>	
				<?php echo $this->Html->link( '<span aria-hidden="true">Help</span>' , 
					array('controller' => 'Help', 'action' => 'index'),
					// array('escape' => false, 'class' => 'btn btn-orange', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Help Page" )); 
					array('escape' => false, 'class' => 'btn btn-orange', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom")); 
				?>    		
			</div>
	  	</div>

	 
</div>