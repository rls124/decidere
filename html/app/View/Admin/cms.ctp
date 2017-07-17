<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName' => 'Dashboard')); ?>
</section>
<!--END COVER-->
<section>

	<div class="container">
		<div class="row">
			<?php echo $this->element('admin_nav'); ?>
		</div>
		
		<h3>CMS</h3>

		<div class="row">
			<?php $url = Router::url(['controller' => 'blog', 'action' => 'wp-admin']); ?>
		
			<iframe width="100%" height="1000px" src="<?php echo $url; ?>" frameborder="0" allowfullscreen></iframe>
		</div>

	</div>
</section>
<?php echo $this->element('side_nav', array('viewName' => 'NewScenario')); ?>









