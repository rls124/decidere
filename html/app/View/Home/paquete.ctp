<?php echo $this->element('header_second'); ?>
<div class="row">
	<div class="container container-main">
		<div class="row center-align">
			<?php echo $this->Html->image('front/logo-gris.png', $options = array('class'=>"logo-gris")); ?>
			<h1 class="title-about">PAQUETES</h1>
		</div>
		<div class="row content-about">
			<div class="row">
				<h1 class="title-pakage" >
					<?php echo $package['Package']['title']; ?>
					<?php echo $this->Html->link('Consultas', '#modalConsulting', array('class'=>'modal-trigger link-package-get hvr-wobble-horizontal', 'onclick'=>'setNameConsulting( "' . $package["Package"]["title"] . '" )' )); ?>
					<?php echo $this->Html->link('Reservar', '#modalReserve', array('class'=>'modal-trigger link-package-reserve hvr-wobble-horizontal', 'onclick'=>'setNameReserve( "' . $package["Package"]["title"] . '" )')); ?>
					<?php if( $package['Package']['gallery'] != '' ) { ?>
						<?php echo $this->Html->link('Ver galeria', $package['Package']['gallery'] , array('class'=>'link-package-gallery hvr-wobble-horizontal')); ?>
					<?php } ?>
				</h1>
			</div>
			<div class="row content-package-description center-align">
				<div class="row">
					<?php echo $this->Html->image('package/image/' . $package['Package']['image'], $options = array('class'=>'responsive-img')); ?>
				</div>
				<div class="row">
					<?php echo $package['Package']['description']; ?>
				</div>
			</div>
			<div class="row center-align backbutton-package">
				<?php echo $this->Html->link( $this->Html->image('front/back.png', $options = array()), array('controller' => 'Home', 'action' => 'paquetes'), array('escape'=>false, 'class'=>'hvr-float-shadow')); ?>
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
		$('.nav-link-packages').addClass('selected');
	});
</script>

<?php echo $this->element('modals'); ?>