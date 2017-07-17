<div class="row">
	<blockquote>
		<h5>
			Testimonios
			<button class="btn-floating btn waves-effect waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="Nuevo testimonio" onclick="showHideNewItem();">
				<i class="material-icons">add</i>
			</button> 
		</h5>
	</blockquote>
</div>
<div class="row new-item fadeIn animated">
	<div class="col s12 m12 l12">
		<div class="card-panel">
	    	<p class="text-bold">Nuevo testimonio</p>
	    	<?php echo $this->Form->create('Testimonial', $options = array('type'=>'file')); ?>
			<div class="row">
	        	<div class="input-field col s12">
					<?php echo $this->Form->input('name', $options = array('class'=>'validate', 'label'=>array('text'=>'Nombre'), 'required'=>'required', 'div'=>false, 'type'=>'text')); ?>
	        	</div>
	      	</div>
	      	<div class="row">
	        	<div class="input-field col s12">
					<?php echo $this->Form->input('text', $options = array('class'=>'validate', 'label'=>false, 'required'=>'required', 'div'=>false, 'type'=>'text')); ?>
	          		<label for="NoveltyCaption">Descripcion</label>
	        	</div>
	      	</div>
			<div class="row">
	        	<div class="col s12 m6 l6">
					<?php echo $this->Form->input('state', $options = array('class'=>'validate with-gap', 'legend'=>false, 'required'=>'required', 'type'=>'radio', 'options'=>array('1'=>'Publicar', '2'=>'No publicar'), 'value'=>'1'  )); ?>
	        	</div>
	        	<div class="col s12 m6 l6">
					<?php echo $this->Form->input('type_content', $options = array('class'=>'validate with-gap', 'legend' => false, 'required'=>'required', 'type'=>'radio', 'options'=>array('1'=>'Imagen', '2'=>'Video'), 'value'=>'1', 'onchange'=>'changeTypeTestimonial(this);' )); ?>
				</div>
	      	</div>
	    	<div class="row">
	    		<div class="col l12 m12 s12 content-input-image-testimonials">
					<p class="">Imagen: (Tamaño sugerido 200x130)</p>
					<?php echo $this->Form->input('image', $options = array('type'=>'file', 'label'=>false, 'div'=>false)); ?>
	    		</div>
	    		<div class="input-field col l12 m12 s12 content-input-video-testimonials">
	    			<?php echo $this->Form->input('video', $options = array('type'=>'text', 'label'=>'Ingrese el codigo Embed de Youtube.com', 'div'=>false)); ?>
	    		</div>
	    	</div>
	      	<div class="row right-align">
				<?php echo $this->Form->button('Guardar', $options = array('type'=>'submit', 'class'=>'waves-effect waves-light btn'));  ?>
	      	</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>

<div class="row">
	<?php foreach ($testimonials as $testimonial) { ?>
		<div class="row">
			<div class="card-panel">
				<div class="row">
					<?php echo $this->Form->create('Testimonial', $options = array('type'=>'file')); ?>
						<div class="col l3">
							<?php echo $this->Form->input('id', $options = array('value'=>$testimonial['Testimonial']['id'])); ?>
							<p>Testimonio de: <span> <?php echo $testimonial['Testimonial']['name'] ?></span></p>
							<?php if ($testimonial['Testimonial']['type_content'] == '1') {
								echo "Tipo: Imagen"; 
							} else if($testimonial['Testimonial']['type_content'] == '2') {
								echo "Tipo: Video"; 
							} ?>
							<?php if ($testimonial['Testimonial']['type_content'] == '1') {
								echo $this->Html->image('testimonial/image/'.$testimonial['Testimonial']['image'], $options = array('class'=>'responsive-img materialboxed')); ?>
								<div class="col l12 m12 s12">
									<p class="">Imagen: (Tamaño sugerido 200x130)</p>
									<?php echo $this->Form->input('image', $options = array('type'=>'file', 'label'=>false, 'div'=>false, 'value'=>$testimonial['Testimonial']['image'])); ?>
					    		</div>
							<?php } else if($testimonial['Testimonial']['type_content'] == '2'){  ?>
								<div class="video-container">
									<?php echo $testimonial['Testimonial']['video']; ?>
								</div>
								<div class="input-field col l12 m12 s12">
					    			<?php echo $this->Form->input('video', $options = array('label'=>'Ingrese el codigo Embed de Youtube.com', 'div'=>false, 'value'=>$testimonial['Testimonial']['video'], 'class'=>'materialize-textarea validate', 'rows'=>'1')); ?>
					    		</div>
							<?php }?>
						</div>
						
						<div class="col l9">
							<div class="input-field">
								<?php echo $this->Form->input('text', $options = array('value'=>$testimonial['Testimonial']['text'], 'label'=>'Descripción', 'div'=>false, 'type'=>'text')); ?>
							</div>
							<div class="row">
								<?php echo $this->Form->input('state', $options = array('class'=>'with-gap', 'legend'=>false, 'required'=>'required', 'type'=>'radio', 'options'=>array('1'=>'Publicar', '2'=>'No publicar'), 'value'=>$testimonial['Testimonial']['state'], 'id'=>'TestimonialState-'.$testimonial['Testimonial']['id']  )); ?>
				        	</div>
				        	<div>
								<?php echo $this->Form->button('<i class="material-icons">input</i>', $options = array('type'=>'submit', 'escape'=>false, 'class'=>'btn-floating btn waves-effect waves-light tooltipped', "data-position"=>"bottom", "data-delay"=>"50", "data-tooltip"=>"Guardar")); ?>
					<?php echo $this->Form->end(); ?>
								<?php echo $this->Form->postLink(__('<i class="material-icons">delete</i>'), array('action' => 'delete', $testimonial['Testimonial']['id'],'testimonial'), array('class'=>'btn-floating btn red waves-effect waves-light tooltipped', 'escape'=>false, "data-position"=>"bottom", "data-delay"=>"50", "data-tooltip"=>"Eliminar"), __('Esta seguro de eliminar el testimonio de " %s " ?', $testimonial['Testimonial']['name'])); ?>
				        	</div>
						</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>