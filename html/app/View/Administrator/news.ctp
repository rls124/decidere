<div class="row">
	<blockquote>
		<h5>Novedades</h5>
	</blockquote>
</div>
<div class="row">
	<div class="col s12 m8 l8">
		<div class="card-panel">
			<p class="text-bold">Vista previa</p>
		
			<div class="row">
				<div id="owl-demo" class="owl-carousel">
					<?php foreach ($news as $value) { ?>
						<div class="item ih-item square effect6 from_top_and_bottom my-news">
							<a href="<?php echo $value['Novelty']['link']; ?>">
					        	<div class="img">
					        		<?php echo $this->Html->image('novelty/image/thumbnails/front_'.$value['Novelty']['image'], $options = array("alt"=>$value['Novelty']['caption'], "title"=>$value['Novelty']['link'], 'class'=>'img-responsive')); ?>
					        	</div>
					        	<div class="info">
					          		<h3><?php echo $value['Novelty']['caption']; ?></h3>
					        	</div>
					    	</a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
    <div class="col s12 m4 l4">
		<div class="card-panel">
	    	<p class="text-bold">Nueva imagen</p>
	    	<?php echo $this->Form->create('Novelty', $options = array('type'=>'file')); ?>
	    	<div class="row">
				<?php echo $this->Form->input('image', $options = array('type'=>'file', 'label'=>'Seleccione la imagen:', 'required'=>'required')); ?>
				<p class="">Tamaño sugerido 320x275</p>
	    	</div>
			<div class="row">
	        	<div class="input-field col s12">
					<?php echo $this->Form->input('caption', $options = array('class'=>'validate', 'label'=>false, 'required'=>'required', 'div'=>false, 'type'=>'text')); ?>
	          		<label for="NoveltyCaption">Descripcion</label>
	        	</div>
	      	</div>
			<div class="row">
	        	<div class="input-field col s12">
					<?php echo $this->Form->input('link', $options = array('class'=>'validate', 'label'=>false, 'required'=>'required', 'div'=>false, 'type'=>'text')); ?>
	          		<label for="NoveltyLink">Link</label>
	        	</div>
	      	</div>
	      	<div class="row right-align">
				<?php echo $this->Form->input('state', $options = array('value'=>'1', 'type'=>'hidden')); ?>
				<?php echo $this->Form->button('Guardar', $options = array('type'=>'submit', 'class'=>'waves-effect waves-light btn'));  ?>
	      	</div>
			<?php echo $this->Form->end(); ?>
		</div>
    </div>
</div>
<div class="row">
	<?php foreach ($news as $value) { ?>
		<div class="col s12 m3 l3">
          	<div class="card-panel">
            	<div class="card-image">
              		<?php echo $this->Html->image('novelty/image/thumbnails/front_'.$value['Novelty']['image'], $options = array('class'=>'responsive-img')); ?>
            	</div>

					<?php echo $this->Form->create('Novelty', $options = array('type'=>'file')); ?>
					<?php echo $this->Form->input('id', $options = array('value'=>$value['Novelty']['id'])); ?>
					<?php echo $this->Form->input('image', $options = array('class'=>'truncate', 'type'=>'file', 'label'=>'Seleccione la imagen:', 'value'=>$value['Novelty']['image'])); ?>
					<p class="label label-primary">Tamaño sugerido 350x300</p>
					<div class="input-field col s12">
						<?php echo $this->Form->input('caption', $options = array('class'=>'validate', 'label'=>false, 'required'=>'required', 'div'=>false, 'type'=>'text', 'value'=>$value['Novelty']['caption'])); ?>
		          		<label for="NoveltyCaption">Descripcion</label>
		        	</div>
					<div class="input-field col s12">
						<?php echo $this->Form->input('link', $options = array('class'=>'validate', 'label'=>false, 'required'=>'required', 'div'=>false, 'type'=>'text', 'value'=>$value['Novelty']['link'])); ?>
		          		<label for="NoveltyLink">Link</label>
		        	</div>
		        	<div class="row right-align">
						<?php echo $this->Form->input('state', $options = array('type'=>'hidden', 'value'=>$value['Novelty']['state'])); ?>
						<?php echo $this->Form->button('Guardar', $options = array('type'=>'submit', 'class'=>'waves-effect waves-light btn'));  ?>
						<?php echo $this->Form->end(); ?>
						<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $value['Novelty']['id'],'novelty'), array('class'=>'waves-effect waves-light btn red', 'escape'=>false, "title"=>"Elimiar novedad"), __('Esta seguro de eliminar la novedad " %s " ?', $value['Novelty']['caption'])); ?>
		        	</div>



          	</div>
        </div>
	<?php } ?>
</div>




