<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName'=> 'other')); ?>
</section>
<!--END COVER-->
<!--NEWS-->
<section id="register">
		<div class="row">
			<div class="row">
				<?php $url = Router::url(['controller' => 'blog', 'action' => 'index.php', 'about']); ?>
				<iframe width="100%"  frameborder="0" style="overflow: hidden; height: 100%; width: 100%; position: absolute;" height="100%" width="100%" src="<?php echo $url; ?>" allowfullscreen id="news-front"></iframe>
			</div>
		</div>

</section>
<!--EN NEWS-->

<?php echo $this->element('side_nav', array('viewName' => 'Register')); ?>

<script type="text/javascript">
	$(function(){
	 	var viewportHeight = $(window).innerHeight();
	 	$('#news-front').css({height:viewportHeight});
		
	})
</script>