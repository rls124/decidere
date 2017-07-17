<?php if($this->Session->read('Auth.User.role')) { ?>

	<?php if($viewName == 'Register'){ ?>
	
				<nav class="navigation navigation-inverse <?php echo $viewName;?>">
					<div class="nav-flex">
				    	<div class="flex-item">
						 	<a href="javascript:void(0);" onclick="" class="toggle-sidebar">
								<?php echo $this->Html->image('nav-button.png', $options = array('class'=>'', 'alt'=>'Menu')); ?>
							</a>
						</div>
						<div class="flex-item">
						 	<?php echo $this->Html->link($this->Html->image('decidere-logo.png', $options = array('class' => 'decidere-logo')), '/', array('class' => 'navigationbar-brand', 'escape' => false)); ?>
						</div>
						
						<div class="flex-item">
				        	<?php echo $this->Html->link( $this->Session->read('Auth.User.first_name') . ' ' . $this->Session->read('Auth.User.last_name') , array('controller' => 'User', 'action' => 'account'), array('class'=>'a-login')); ?>
						</div>
						
						<div class="flex-item">
							<span class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<span class="glyphicon glyphicon-th grid-menu-icon"></span>
								</a>
								<?php echo $this->element('grid_menu'); ?>
							</span>
						</div>
						<div class="flex-item">
				        	<?php echo $this->Html->link('Log Out', array('controller' => 'Admin', 'action' => 'logout'), array('class'=>'a-login')); ?>
					    </div>
					</div>
				</nav>



	<?php } else if ($viewName == 'Home'){ ?>
	
				<nav class="navigation navigation-inverse <?php echo $viewName;?>">
					<div class="nav-flex">
				    	<div class="flex-item">
						 	<a href="javascript:void(0);" onclick="" class="toggle-sidebar">
								<?php echo $this->Html->image('nav-button.png', $options = array('class'=>'', 'alt'=>'Menu')); ?>
							</a>
						</div>
						<div class="flex-item">
						 	<?php echo $this->Html->link($this->Html->image('decidere-logo.png', $options = array('class' => 'decidere-logo')), '/', array('class' => 'navigationbar-brand', 'escape' => false)); ?>
						</div>
						
						<div class="flex-item">
				        	<?php echo $this->Html->link( $this->Session->read('Auth.User.first_name') . ' ' . $this->Session->read('Auth.User.last_name') , array('controller' => 'User', 'action' => 'account'), array('class'=>'a-login')); ?>
						</div>
						
						<div class="flex-item">
							<span class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<span class="glyphicon glyphicon-th grid-menu-icon"></span>
								</a>
								<?php echo $this->element('grid_menu'); ?>
							</span>
						</div>
						<div class="flex-item">
				        	<?php echo $this->Html->link('Log Out', array('controller' => 'Admin', 'action' => 'logout'), array('class'=>'a-login')); ?>
					    </div>
					</div>
				</nav>


	<?php } else if($viewName != 'Register') { ?>
	
	


			
				<nav class="navigation navigation-inverse <?php echo $viewName;?>">
					<div class="nav-flex">
				    	<div class="flex-item">
						 	<a href="javascript:void(0);" onclick="" class="toggle-sidebar">
								<?php echo $this->Html->image('nav-button.png', $options = array('class'=>'', 'alt'=>'Menu')); ?>
							</a>
						</div>
						<div class="flex-item">
						 	<?php echo $this->Html->link($this->Html->image('decidere-logo.png', $options = array('class' => 'decidere-logo')), '/', array('class' => 'navigationbar-brand', 'escape' => false)); ?>
						</div>
						
						<div class="flex-item">
				        	<?php echo $this->Html->link( $this->Session->read('Auth.User.first_name') . ' ' . $this->Session->read('Auth.User.last_name') , array('controller' => 'User', 'action' => 'account'), array('class'=>'a-login')); ?>
						</div>
						
						<div class="flex-item">
							<span class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<span class="glyphicon glyphicon-th grid-menu-icon"></span>
								</a>
								<?php echo $this->element('grid_menu'); ?>
							</span>
						</div>
						<div class="flex-item">
				        	<?php echo $this->Html->link('Log Out', array('controller' => 'Admin', 'action' => 'logout'), array('class'=>'a-login')); ?>
					    </div>
					</div>
				</nav>

	<?php } ?>
	
	
<?php } else { ?>

	<?php if($viewName != 'Register' && $viewName != 'Home'){ ?>

		
		<nav class="navigation news navigation-inverse <?php echo $viewName;?>">
			<div class="nav-flex">
		    	<div class="flex-item">
				 	<a href="javascript:void(0);" onclick="" class="toggle-sidebar">
						<?php echo $this->Html->image('nav-button.png', $options = array('class'=>'', 'alt'=>'Menu')); ?>
					</a>
				</div>
				<div class="flex-item">
				 	<?php echo $this->Html->link($this->Html->image('decidere-logo.png', $options = array('class' => 'decidere-logo')), '/', array('class' => 'navigationbar-brand', 'escape' => false)); ?>
				</div>
				
				<div class="flex-item">
		        	<a href="#" class="a-login" data-toggle="modal" data-target="#myModal">Log In</a>
				</div>
				<div class="flex-item">
		        	<?php echo $this->Html->link( $this->Form->button('Request Access', 
							$options = array('class'=>'btn btn-orange btn-newScenario animated rubberBand', 'type' => 'submit')) , 
								array('controller' => 'Register', 'action' => 'index'), array('escape'=>false, 'class'=>'hvr-pulse-grow')); ?>
			    </div>
			</div>
		</nav>
		
		
	<?php } else { ?>

<?php if($viewName == 'Home'){ ?>



		
		<nav class="navigation navigation-inverse <?php echo $viewName;?>">
			<div class="nav-flex">
		    	<div class="flex-item">
				 	<a href="javascript:void(0);" onclick="" class="toggle-sidebar">
						<?php echo $this->Html->image('nav-button.png', $options = array('class'=>'', 'alt'=>'Menu')); ?>
					</a>
				</div>
				<div class="flex-item">
				 	<?php echo $this->Html->link($this->Html->image('decidere-logo.png', $options = array('class' => 'decidere-logo')), '/', array('class' => 'navigationbar-brand', 'escape' => false)); ?>
				</div>
				
				<div class="flex-item">
		        	<a href="#" class="a-login" data-toggle="modal" data-target="#myModal">Log In</a>
				</div>
				<div class="flex-item">
		        	<?php echo $this->Html->link( $this->Form->button('Request Access', 
							$options = array('class'=>'btn btn-orange btn-newScenario animated rubberBand', 'type' => 'submit')) , 
								array('controller' => 'Register', 'action' => 'index'), array('escape'=>false, 'class'=>'hvr-pulse-grow')); ?>
			    </div>
			</div>
		</nav>


<?php } else { ?>

		<nav class="navigation news navigation-inverse <?php echo $viewName;?>">
			<div class="nav-flex">
		    	<div class="flex-item">
				 	<a href="javascript:void(0);" onclick="" class="toggle-sidebar">
						<?php echo $this->Html->image('nav-button.png', $options = array('class'=>'', 'alt'=>'Menu')); ?>
					</a>
				</div>
				<div class="flex-item">
				 	<?php echo $this->Html->link($this->Html->image('decidere-logo.png', $options = array('class' => 'decidere-logo')), '/', array('class' => 'navigationbar-brand', 'escape' => false)); ?>
				</div>
				
				<div class="flex-item">
					<label>Already have an account ?</label>
				</div>
				<div class="flex-item">
		        	<a href="#" class="a-login" data-toggle="modal" data-target="#myModal">Log In</a>
				</div>
			</div>
		</nav>
		



<?php } } } ?>

