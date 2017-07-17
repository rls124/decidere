<?php echo $this->element('header_second'); ?>
<div class="row">
	<div class="container container-main">
		<div class="row center-align">
			<?php echo $this->Html->image('front/logo-gris.png', $options = array('class'=>"logo-gris")); ?>
			<h1 class="title-about">CONTACTO</h1>
		</div>
		<div class="row content-about">
			<div class="col l12 m12 s12">
				<div class="about">
					AQUI CONTACTO FORM
				</div>
			</div>
		</div>
	</div>

	<?php echo $this->element('carousel', array($news)); ?>
	
	<div class="container container-main">
		<div class="row">
			testimonios
		</div>
		<div class="row" >
			<?php echo $this->element('footer', array($companyData)); ?>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('.nav-link-contact').addClass('selected');
	});
</script>