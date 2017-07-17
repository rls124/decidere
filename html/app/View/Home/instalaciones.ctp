<?php echo $this->element('header_second'); ?>
<div class="row">
	<div class="container container-main">
		<div class="row center-align">
			<?php echo $this->Html->image('front/logo-gris.png', $options = array('class'=>"logo-gris")); ?>
			<h1 class="title-about">INSTALACIONES</h1>
		</div>
		<div class="row content-about content-envoriments">
			<?php foreach ($environments as $environment) { ?>
				<?php if( count($environment['EnvironmentImage']) > 0 ) { ?>
					<div class="col l4 m4 s12 center-align item-environment">
						<h2 class="title-environment"><?php echo $environment['Environment']['title']; ?></h2>
						<?php echo $this->Html->link( $this->Html->image( 'environment_image/image/thumbnails/home_' . $environment['EnvironmentImage']['0']['image'], $options = array('class'=>'responsive-img')), array('controller' => 'Home', 'action' => 'instalacion', $environment['Environment']['id']), array('escape'=>false, 'class' => 'hvr-curl-top-right')); ?>
					
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>

	<?php echo $this->element('carousel', array($news)); ?>
	
	<div class="container container-main">
		<div class="row">
			<?php echo $this->element('testimonials', array($testimonials)); ?>
		</div>
		<div class="row" >
			<?php echo $this->element('footer', array($companyData)); ?>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('.nav-link-environment').addClass('selected');
	});
</script>