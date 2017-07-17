<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<?php echo $this->Html->meta('favicon.ico','/img/favicon.ico',array('type' => 'icon')); ?>
	<?php 
		echo $this->Html->css(array('http://fonts.googleapis.com/icon?family=Material+Icons')); 
		echo $this->Html->css(array('materialize.min', 'animate', 'froala/font-awesome.min','froala/froala_editor.min', 'ihover.min', 'carousel/owl.carousel', 'slider/slider', 'admin/template_admin'));
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

		echo $this->Html->script(array('jquery-2.1.4.min.js'));
	?>
</head>
<body>
	<header>
		
	</header>

	<section id="content">
		<main class="row">
		<?php echo $this->element('admin_nav'); ?> 
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</main>
	</section>
	<footer >
		<!--<h5 class="center-align">Administrator 2.0</h5>-->
	</footer>

	<?php 
		echo $this->Html->script(array('materialize.min.js', 'froala/froala_editor.min'));
		echo $this->Html->script(array('slider/wowslider', 'slider/run-slider', 'carousel/owl.carousel.min', 'admin/script_admin'));

	?>
</body>
</html>
