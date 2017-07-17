<div class="row">
	<blockquote>
		<h5>Imágenes de Slider</h5>
	</blockquote>
</div>
<div class="row">
	<div class="col s12 m6 l6">
		<div class="card-panel">
			<p class="text-bold">Vista previa</p>
		
			<div id="wowslider-container1">
				<div class="ws_images">
					<ul>
						<?php foreach ($sliders as $slider) { ?>
							<li><?php echo $this->Html->image('slider/image/thumbnails/front_'.$slider['Slider']['image'], $options = array('class'=>'col s12')); ?></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>

	</div>
    <div class="col s12 m6 l6">
    	<div class="card-panel">
	    	<p class="text-bold">Nueva imagen</p>
	    	<?php echo $this->Form->create('Slider', $options = array('type'=>'file')); ?>
			<?php echo $this->Form->input('image', $options = array('type'=>'file', 'label'=>'Seleccione la imagen:', 'required'=>'required', 'div'=>false, 'label'=>false)); ?>
			<p>Tamaño sugerido 1600x825</p>
			<?php echo $this->Form->button('Guardar', $options = array('type'=>'submit', 'class'=>'waves-effect waves-light btn'));  ?>
			<?php echo $this->Form->end(); ?>
		</div>
    </div>
</div>
<div class="row">
	<?php foreach ($sliders as $slider) { ?>
		<div class="col s12 m3 l3">
          	<div class="card">
            	<div class="card-image">
              		<?php echo $this->Html->image('slider/image/thumbnails/front_'.$slider['Slider']['image'], $options = array('class'=>'')); ?>
            	</div>
            	<div class="right-align">
            		<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $slider['Slider']['id'],'slider'), array('class'=>'waves-effect waves-light btn red', "title"=>"Elimiar Imagen"), __('Esta seguro de eliminar la imagen %s?', $slider['Slider']['id'])); ?>
            	</div>
          	</div>
        </div>
	<?php } ?>
</div>
