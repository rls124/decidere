<script type="text/javascript">var urlDashboard =  <?php echo '"' . Router::url(['controller' => 'User', 'action' => 'dashboard']) . '"'; ?>  ;</script>
<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName' => 'Select_Dataset')); ?>
</section>

<section id="cart">
	
	<div class="container">

		<h1 class="title-dashboard">Thanks for your purchase</h1>

		<script>
			setTimeout(function () {
                window.location = urlDashboard;
                
            }, 5000)
		</script>
		
	</div>


</section>

<?php echo $this->element('side_nav', array('viewName' => 'Dashboard')); ?>