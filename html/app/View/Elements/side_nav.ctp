<div id="main-sidebar" class="main-sidebar " style="display:none;">
    <nav>
		<ul class="ul-sidenav-btn-close">
			<li>
				<a href="javascript:void(0);" class="close-sb">
				  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</a>
			</li>
		</ul>
        <ul class="ul-sidenav">
            <?php if($viewName == 'About'){ ?>
                
                <li> <?php echo $this->Html->link('HOME', array('controller' => 'Home', 'action' => 'index', '#'=>'top'), array('class'=>'close-sb')); ?> </li>
                              
                <li> <?php echo $this->Html->link('ABOUT' , array('controller' => 'About', 'action' => 'index')); ?> </li>
                
                <li> <?php echo $this->Html->link('DATASETS', array('controller' => 'Datasets', 'action' => 'index') ); ?> </li>

                <li> <?php echo $this->Html->link('NEWS', array('controller' => 'News', 'action' => 'index') ); ?> </li>

                <li> <?php echo $this->Html->link('HELP', array('controller' => 'Help', 'action' => 'index', '#'=>'top'), array('class'=>'close-sb')); ?> </li>
                
                <li> <?php echo $this->Html->link('FAQ', array('controller' => 'Help', 'action' => 'faq') ); ?> </li>        

                <li> <?php echo $this->Html->link('JOIN', array('controller' => 'Register', 'action' => 'index'), array('class'=>"close-sb")); ?></li>  

                <li><a href="#" data-toggle="modal" data-target="#modal-contact" class="close-sb">CONTACT</a></li>          
            
            <?php } else { ?>
            
                <li> <?php echo $this->Html->link('HOME', array('controller' => 'Home', 'action' => 'index', '#'=>'top'), array('class'=> 'close-sb')); ?> </li>
                
                <li> <?php echo $this->Html->link('ABOUT' , array('controller' => 'About', 'action' => 'index')); ?> </li>
                
                <li> <?php echo $this->Html->link('DATASETS', array('controller' => 'Datasets', 'action' => 'index'), array('class'=>"close-sb")) ; ?></li>

                <li> <?php echo $this->Html->link('NEWS', array('controller' => 'News', 'action' => 'index'), array('class'=>"close-sb") ); ?> </li>
                
                <li> <?php echo $this->Html->link('HELP', array('controller' => 'Help', 'action' => 'index', '#'=>'top'), array('class'=>'close-sb')); ?> </li>

                <li> <?php echo $this->Html->link('FAQ', array('controller' => 'Help', 'action' => 'faq') ); ?> </li>        

                <li> <?php echo $this->Html->link('JOIN', array('controller' => 'Register', 'action' => 'index'), array('class'=>"close-sb")); ?></li>

                <li><a href="#" data-toggle="modal" data-target="#modal-contact" class="close-sb">CONTACT</a></li>
    
            <?php } ?>
    
        </ul>
    </nav>
</div>