<?php echo $this->element('header_second'); ?>
<div class="row">
	<div class="container container-main">
		<div class="row center-align">
			<?php echo $this->Html->image('front/logo-gris.png', $options = array('class'=>"logo-gris")); ?>
			<h1 class="title-about">BUEN VIVIR</h1>
		</div>
		<div class="row content-about content-blog">
			<div class="col l8 m8 s12">

				<div class="row content-package-blog ">
					<div class="row">
						<?php echo $this->Html->image('good_life/image/' . $good['GoodLife']['image'], $options = array('class'=>'responsive-img')); ?>
					</div>
					<h1 class="title-blog" >
						<?php echo $good['GoodLife']['title']; ?>
					</h1>
					<p><?php echo date('jS F Y \a\t G:i', strtotime($good['GoodLife']['created'])); ?></p>
					<div class="row">
						<?php echo $good['GoodLife']['description']; ?>
					</div>
				</div>

				<div class="row content-form-comment">
					<?php echo $this->Form->create('Comment'); ?>
						<div class="col l12 m12 s12">
							<div class="input-field">
								<?php echo $this->Form->input('name', $options = array('type'=>'text', 'div'=>false, 'label'=>false, 'class'=>'validate')); ?>
								<label for="data[Comment][name]">Nombre</label>
							</div>
							<div class="input-field">
								<?php echo $this->Form->input('email', $options = array('div'=>false, 'label'=>false, 'class'=>'validate' )); ?>
								<label for="data[Comment][email]">Email</label>
							</div>
							<div class="">
								<?php echo $this->Form->input('gender', $options = array('type'=>'radio', 'legend' => false, 'class'=>'validate with-gap', 'options'=>array('1'=>'Hombre', '2'=>'Mujer'), 'value'=>'1' )); ?>
							</div>
							<div class="input-field">
								<?php echo $this->Form->input('comment', $options = array('div'=>false, 'class'=>"materialize-textarea validate", 'label'=>array('text'=>'Comentario'), 'rows'=>'1')); ?>
							</div>
							<?php echo $this->Form->button('Enviar', $options = array('type'=>'submit', 'class'=>'waves-effect waves-light btn ')); ?>
						</div>
					<?php echo $this->Form->end(); ?>
				</div>

			</div>

			<div class="col l4 m4 s12">
				<div class="row">
					
					<div class="fb-page" data-href="https://www.facebook.com/ClinicaParaSanosPlanetaDeLuz" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
						<div class="fb-xfbml-parse-ignore">
							<blockquote cite="https://www.facebook.com/ClinicaParaSanosPlanetaDeLuz">
								<a href="https://www.facebook.com/ClinicaParaSanosPlanetaDeLuz">Planeta de Luz SPA Terapéutico - Hospedaje Ecológico</a>
							</blockquote>
						</div>
					</div>

				</div>
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
		$('.nav-link-blog').addClass('selected');
	});
</script>

