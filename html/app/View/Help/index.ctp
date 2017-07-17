<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName'=> 'other')); ?>
</section>
<!--END COVER-->
<!--NEWS-->
<section id="register">
	<?php if ( $this->Session->read('Auth.User') ) { ?>
		
		<div class="row">
			<div class="row">
				<?php $url = Router::url(['controller' => 'blog', 'action' => 'index.php', 'help']); ?>
				<iframe width="100%"  frameborder="0" style="overflow: hidden; height: 100%; width: 100%; position: absolute;" height="100%" width="100%" src="<?php echo $url; ?>" allowfullscreen id="news-front"></iframe>
			</div>
		</div>

	<?php } else { ?>

		<p class="text-center">
			Please <?php echo $this->Html->link('login', '#', array('data-toggle'=>"modal", 'data-target'=>"#myModal", 'class'=>'link-dashboard')); ?> or <?php echo $this->Html->link('register', array('controller' => 'Register', 'action' => 'index'), array('class'=>'link-dashboard')); ?> for a no cost Decidere account to access the help page
		</p>

	<?php } ?>


</section>
<!--EN NEWS-->

<?php echo $this->element('side_nav', array('viewName' => 'Register')); ?>

<script type="text/javascript">
	$(function(){
	 	var viewportHeight = $(window).innerHeight();
	 	$('#news-front').css({height:viewportHeight});
		
	})
</script>