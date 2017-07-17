

<?php 
	if ($this->Session->read('Auth.User.role') != "1") {
		die("Unauthorized Access");
	}
?>




<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName' => 'Dashboard')); ?>
</section>
<!--END COVER-->




<section id="adminPanel">
	
	<div class="container">
		
		<div class="row">
			<?php echo $this->element('admin_nav'); ?>
		</div>

	</div>

</section>
<?php echo $this->element('side_nav', array('viewName' => 'NewScenario')); ?>