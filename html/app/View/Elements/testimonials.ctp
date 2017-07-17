<div class="row" id="testimonials-div">
	

	<div class="row divider-footer" id="">
			
	</div>
	<div class="row center-align">
		<h2 class="title-testimonials">Testimonios</h2>
	</div>
	<div class="row content-slider-testimonials">
		<div class="bxslider">
			<?php foreach ($testimonials as $testimonial) { ?>
				<div class="row item-testimonial">
					<div class="col l8 m8 s12 right-align">
			  			<p class=""> <?php echo $testimonial['Testimonial']['created']; ?></p>
						<p class=""> <?php echo $testimonial['Testimonial']['text']; ?></p>
						<p class="testimonial-author"> <?php echo $testimonial['Testimonial']['name']; ?></p>
					</div>
					<div class="col l4 m4 s12">
						<div class="row content-media-testimonials">
							<?php if ($testimonial['Testimonial']['type_content'] == '1' ) { ?>
								<?php echo $this->Html->image('testimonial/image/' . $testimonial['Testimonial']['image'], $options = array('class'=>'responsive-img')); ?>	
							<?php } else if ($testimonial['Testimonial']['type_content'] == '2') { ?>
								<div class="video-container">
									<?php echo $testimonial['Testimonial']['video']; ?>
								</div>
							<?php }  ?>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
	<div class="row center-align">
		<?php echo $this->Html->link('<i class="material-icons">add</i>', '#modalTestimonial', array('class'=>'modal-trigger btn-floating btn-large btn waves-effect waves-light tooltipped', 'data-position'=>"bottom", 'data-delay'=>"50", 'data-tooltip'=>"Agregar mi testimonio", 'escape'=>false)); ?>
	</div>

	<!--Modal for consulting-->
	<div id="modalTestimonial" class="modal modal-fixed-footer">
		<?php echo $this->Form->create('Testimonial', $options = array('id'=>'formNewTestimonial')); ?>
			<div class="modal-content">
				
				<h4 class="title-modal">Mandanos tu testimonio</h4>
				<div class="input-field">
					<?php echo $this->Form->input('name', $options = array('type'=>'text', 'class'=>'validate', 'label'=>'Nombre', 'required'=>'required')); ?>
				</div>
				<div class="input-field">
					<div class="input-field">
						<?php echo $this->Form->input('text', $options = array('div'=>false, 'class'=>"materialize-textarea validate", 'label'=>array('text'=>'Comentario'), 'rows'=>'1')); ?>
					</div>
				</div>
				<div class="input-field">
					<?php echo $this->Form->input('type_content', $options = array('class'=>'validate with-gap', 'legend' => false, 'required'=>'required', 'type'=>'radio', 'options'=>array('1'=>'Imagen', '2'=>'Video'), 'value'=>'1', 'onchange'=>'changeTypeTestimonial(this);' )); ?>
				</div>
				<div class="col l12 m12 s12 content-input-image-testimonials">
					<p class="">Imagen: (Tamaño sugerido 200x130)</p>
					<?php echo $this->Form->input('image', $options = array('type'=>'file', 'label'=>false, 'div'=>false)); ?>
	    		</div>
	    		<div class="input-field col l12 m12 s12 content-input-video-testimonials">
	    			<?php echo $this->Form->input('video', $options = array('type'=>'text', 'label'=>'Ingrese el codigo Embed de Youtube.com', 'div'=>false)); ?>
	    		</div>
			</div>
			<div class="modal-footer">
				<?php echo $this->Form->button('Enviar', $options = array('type'=>'submit', 'class'=>'waves-effect waves-green btn-flat')); ?>
				<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>