<?php echo $this->element('header_second'); ?>
<div class="row">
	<div class="container container-main">
		<div class="row center-align">
			<?php echo $this->Html->image('front/logo-gris.png', $options = array('class'=>"logo-gris")); ?>
			<h1 class="title-about">INSTALACIONES</h1>
		</div>
		<div class="row content-about">
			<div class="row">
				<h1 class="title-pakage center-align" >
					<?php echo $environment['Environment']['title']; ?>					
				</h1>
			</div>
			<div class="row contetn-items-gallery">
				<div id="lightgallery">
					<?php foreach ($environment['EnvironmentImage'] as $image) { ?>
						<div class="col l3 m3 s12 item-gallery">
					  		<a rel="gallery-1" class="swipebox" href="/CADES/PLANETA_DELUZ/img/environment_image/image/<?php echo $image['image']; ?>">
					      		<?php echo $this->Html->image( 'environment_image/image/thumbnails/home_' . $image['image'] , $options = array('class'=>'responsive-img hvr-grow')); ?>
					  		</a>
						</div>
					<?php } ?>
				</div>

			</div>
			<div class="row center-align backbutton-package">
				<?php echo $this->Html->link( $this->Html->image('front/back.png', $options = array()), array('controller' => 'Home', 'action' => 'instalaciones'), array('escape'=>false, 'class'=>'hvr-float-shadow')); ?>
			</div>
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

