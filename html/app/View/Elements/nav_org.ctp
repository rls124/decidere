<?php if($this->Session->read('Auth.User.role')) { ?>
	<?php if($viewName == 'Register'){ ?>
		<nav class="navigation navigation-inverse">
		  <br />
		  <br />
		  <div class="col-lg-12 col-md-12 col-sm-12 col-xs12">
		  	<div class="container">
		    	<!-- Brand and toggle get grouped for better mobile display -->
		    	<div class="col-lg-12 col-md-12 col-sm-8 col-xs-8 col-lg-offset-0 col-md-offset-0 col-sm-offset-3 col-xs-offset-3">
				 	<div>
				 	<a href="javascript:void(0);" onclick="" class="hvr-grow btn-toggle-sidenav toggle-sidebar">
					<!--img src="img/nav-button.png" alt="Menu"-->
					<?php echo $this->Html->image('nav-button.png', $options = array('class'=>'', 'alt'=>'Menu')); ?>
					</a>
					</div>
					<div style="text-align:center;">
				 	<h1 class="logo-nav-text animated flipInX text-center">
					<?php echo $this->Html->link($this->Html->image('decidere-logo.png', $options = array('class' => 'decidere-logo')), '/', array('class' => 'navigationbar-brand', 'escape' => false)); ?>
					</h1>
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-8 col-xs-8 col-lg-offset-0 col-md-offset-0 col-sm-offset-3 col-xs-offset-3">
					<div class="text-center">
						<span class="menu-desktop">
							<?php echo $this->Html->link( $this->Session->read('Auth.User.first_name') . ' ' . $this->Session->read('Auth.User.last_name') , array('controller' => 'User', 'action' => 'account'), array('class'=>'a-login')); ?>
				        </span>
				        <span class="dropdown grid-menu-desktop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
            					<span class="glyphicon glyphicon-th grid-menu-icon"></span>
       					 	</a>
       					 	<?php echo $this->element('grid_menu'); ?>
       					</span>
				        <span class="menu-desktop2">
				        	<?php echo $this->Html->link('Log Out', array('controller' => 'Admin', 'action' => 'logout'), array('class'=>'a-login')); ?>
				       	</span>
					</div>
			    </div>
			  </div><!-- /.container-fluid -->
			</div>
		</nav>

	<?php } else { ?>
		<?php if($viewName == 'Home'){ ?>
			<nav class="navigation">
			  <br />
			  <br />
			  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			  	<div class="container">
			    	<!-- Brand and toggle get grouped for better mobile display -->
			    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			    		<div>
					 	<a href="javascript:void(0);" onclick="" class="hvr-grow btn-toggle-sidenav toggle-sidebar">
						<!--img src="img/nav-button.png" alt="Menu"-->
						<?php echo $this->Html->image('nav-button.png', $options = array('class'=>'', 'alt'=>'Menu')); ?>
						</a>
						</div>
						<div style="text-align:center;">
					 	<h1 class="logo-nav-text animated flipInX text-center">
						<?php echo $this->Html->link($this->Html->image('decidere-logo.png', $options = array('class' => 'decidere-logo')), '/', array('class' => 'navigationbar-brand', 'escape' => false)); ?>
						</h1>
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="text-center">
							<span class="menu-desktop">
					        	<?php echo $this->Html->link( $this->Session->read('Auth.User.first_name') . ' ' . $this->Session->read('Auth.User.last_name') , array('controller' => 'User', 'action' => 'account'), array('class'=>'a-login')); ?>
					        </span>
				        	<span class="dropdown grid-menu-desktop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
            					<span class="glyphicon glyphicon-th grid-menu-icon"></span>
       					 	</a>
       					 	<?php echo $this->element('grid_menu'); ?>
       					</span>
					        <span class="menu-desktop2">
					        	<?php echo $this->Html->link('Log Out', array('controller' => 'Admin', 'action' => 'logout'), array('class'=>'a-login')); ?>
					       	</span>
						</div>
				    </div>
				  </div><!-- /.container-fluid -->
				</div>
			</nav>


		<?php } else { ?>

			<?php if($viewName != 'Register'){ ?>
				<nav class="navigation navigation-inverse">
				  <br />
				  <br />
				  <div class="col-lg-12 col-md-12 col-sm-12 col-xs12">
				  	<div class="container">
				    	<!-- Brand and toggle get grouped for better mobile display -->
				    	<div class="col-lg-12 col-md-12 col-sm-8 col-xs-8 col-lg-offset-0 col-md-offset-0 col-sm-offset-3 col-xs-offset-3">
						 	<div>
						 	<a href="javascript:void(0);" onclick="" class="hvr-grow btn-toggle-sidenav toggle-sidebar">
							<!--img src="img/nav-button.png" alt="Menu"-->
							<?php echo $this->Html->image('nav-button.png', $options = array('class'=>'', 'alt'=>'Menu')); ?>
							</a>
						 	</div>
						 	<div style="text-align:center;">
					 	    <h1 class="logo-nav-text animated flipInX text-center">
							<?php echo $this->Html->link($this->Html->image('decidere-logo.png', $options = array('class' => 'decidere-logo')), '/', array('class' => 'navigationbar-brand', 'escape' => false)); ?>
							</h1>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-8 col-xs-8 col-lg-offset-0 col-md-offset-0 col-sm-offset-3 col-xs-offset-3">
							<div class="text-center">
								<span class="menu-desktop">
						        	<?php echo $this->Html->link( $this->Session->read('Auth.User.first_name') . ' ' . $this->Session->read('Auth.User.last_name') , array('controller' => 'User', 'action' => 'account'), array('class'=>'a-login')); ?>
						        </span>
						       <span class="dropdown grid-menu-desktop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
            					<span class="glyphicon glyphicon-th grid-menu-icon"></span>
       					 	</a>
       					 	<?php echo $this->element('grid_menu'); ?>
       					</span>
						        <span class="menu-desktop2">
						        	<?php echo $this->Html->link('Log Out', array('controller' => 'Admin', 'action' => 'logout'), array('class'=>'a-login')); ?>
						       	</span>
							</div>
					    </div>
					  </div><!-- /.container-fluid -->
					</div>
				</nav>
			<?php } ?>
		<?php } ?>
	<?php } ?>
<?php } else { ?>

	<?php if($viewName != 'Register' && $viewName != 'Home'){ ?>
		<nav class="navigation navigation-inverse">
		  <br />
		  <br />
		  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		  	<div class="container">
		    	<!-- Brand and toggle get grouped for better mobile display -->
		    	<div class="col-lg-12 col-md-12 col-sm-8 col-xs-8 col-lg-offset-0 col-md-offset-0 col-sm-offset-3 col-xs-offset-3">
				 	<div>
				 	<a href="javascript:void(0);" onclick="" class="hvr-grow btn-toggle-sidenav toggle-sidebar">
					<!--img src="img/nav-button.png" alt="Menu"-->
					<?php echo $this->Html->image('nav-button.png', $options = array('class'=>'', 'alt'=>'Menu')); ?>
					</a>
					</div>
					<div style="text-align:center;">
				 	<?php echo $this->Html->link($this->Html->image('decidere-logo.png', $options = array('class' => 'decidere-logo')), '/', array('class' => 'navigationbar-brand', 'escape' => false)); ?>
					</h1>
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-8 col-xs-8 col-lg-offset-0 col-md-offset-0 col-sm-offset-3 col-xs-offset-3">
					<div class="text-center">
						<span class="menu-desktop">
				        	<a href="#" class="a-login" data-toggle="modal" data-target="#myModal">Log In</a>
				        </span>
				        <span class="menu-desktop2">
				        	<?php echo $this->Html->link( $this->Html->image('btn-join.png', $options = array('class'=>'animated rubberBand', 'alt'=>'Join')) , array('controller' => 'Register', 'action' => 'index'), array('escape'=>false, 'class'=>'hvr-pulse-grow')); ?>
				       	</span>
					</div>
			    </div>
			  </div><!-- /.container-fluid -->
			</div>
		</nav>
	<?php } else { ?>

<?php if($viewName == 'Home'){ ?>

	<nav class="navigation">
	  <br />
	  <br />
	  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	  	<div class="container">
	    	<!-- Brand and toggle get grouped for better mobile display -->
	    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			 	<div>
			 	<a href="javascript:void(0);" onclick="" class="hvr-grow btn-toggle-sidenav toggle-sidebar">
				<!--img src="img/nav-button.png" alt="Menu"-->
				<?php echo $this->Html->image('nav-button.png', $options = array('class'=>'', 'alt'=>'Menu')); ?>
				</a>
				</div>
				<div style="text-align:center;">
			 	<h1 class="logo-nav-text animated flipInX text-center">
				<?php echo $this->Html->link($this->Html->image('decidere-logo.png', $options = array('class' => 'decidere-logo')), '/', array('class' => 'navigationbar-brand', 'escape' => false)); ?>
				</h1>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="text-center">
					<span class="menu-desktop">
			        	<a href="#" class="a-login" data-toggle="modal" data-target="#myModal">Log In</a>
			        </span>
			        <span class="menu-desktop2">
			        	<?php echo $this->Html->link( $this->Html->image('btn-join.png', $options = array('class'=>'animated rubberBand', 'alt'=>'Join')) , array('controller' => 'Register', 'action' => 'index'), array('escape'=>false, 'class'=>'hvr-pulse-grow')); ?>
			       	</span>
				</div>
		    </div>
		  </div><!-- /.container-fluid -->
		</div>
	</nav>

<?php } else { ?>
	
	<nav class="navigation navigation-inverse">
	  <br />
	  <br />
	  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	  	<div class="container">
	    	<!-- Brand and toggle get grouped for better mobile display -->
	    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			 	<div>
			 	<a href="javascript:void(0);" onclick="" class="hvr-grow btn-toggle-sidenav toggle-sidebar">
				<!--img src="img/nav-button.png" alt="Menu"-->
				<?php echo $this->Html->image('nav-button.png', $options = array('class'=>'', 'alt'=>'Menu')); ?>
				</a>
				</div>
				<div style="text-align:center;">
			 	<h1 class="logo-nav-text animated flipInX text-center">
				<?php echo $this->Html->link($this->Html->image('decidere-logo.png', $options = array('class' => 'decidere-logo')), '/', array('class' => 'navigationbar-brand', 'escape' => false)); ?>
				</h1>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="text-center">
			       	<span class="menu-desktop">
						<a  href="javascript:void(0);" class="a-login">
						Already have an account ?
						</a>
			        </span>
			        <span class="menu-desktop2">
			        	<a href="#" class="a-login" data-toggle="modal" data-target="#myModal">Log In</a>
			       	</span>
				</div>
		    </div>
		  </div><!-- /.container-fluid -->
		</div>
	</nav>


<?php } } } ?>

