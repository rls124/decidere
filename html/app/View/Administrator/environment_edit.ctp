<div class="row">
	<blockquote>
		<h5>
			<?php echo $this->Html->link('<', array('controller' => 'Administrator', 'action' => 'environments'), array('class'=>'btn-floating btn waves-effect waves-light tooltipped', "data-position"=>"bottom", "data-delay"=>"50", "data-tooltip"=>"Volver a intalaciones")); ?>
			Editar instalación - <?php echo $environment['Environment']['title']; ?>
		</h5>
	</blockquote>
</div>
<div class="row fadeIn animated">
	<div class="col l7 m7 s12">
		<div class="card-panel">
			<p class="text-bold">Editar la galeria</p>
	    	<?php echo $this->Form->create('Environment', $options = array('type'=>'file')); ?>
	    	<?php echo $this->Form->input('id', $options = array('required'=>'required', 'value'=>$environment['Environment']['id'])); ?>
			<div class="row">
	        	<div class="input-field col s12">
					<?php echo $this->Form->input('title', $options = array('class'=>'validate', 'label'=>false, 'required'=>'required', 'div'=>false, 'type'=>'text', 'value'=>$environment['Environment']['title'])); ?>
	          		<label for="EnvironmentTitle">Titulo</label>
	        	</div>
	      	</div>

	      	<div class="row">
	        	<div class="col s12">
	          		<label for="EnvironmentDescription text-bold">Descripción</label>
					<?php echo $this->Form->input('description', $options = array( 'required'=>'required', 'div'=>false, 'label'=>false, 'class'=>'text-editor', 'placeholder'=>'Descripción', 'value'=>$environment['Environment']['description'])); ?>
	        	</div>
	      	</div>
	      	<div class="row right-align">
				<?php echo $this->Form->input('state', $options = array('value'=>'1', 'type'=>'hidden', 'value'=>$environment['Environment']['state'])); ?>
				<?php echo $this->Form->button('Guardar', $options = array('type'=>'submit', 'class'=>'waves-effect waves-light btn'));  ?>
	      	</div>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
	<div class="col l5 m5 s12">
		<div class="card-panel">
			<p class="text-bold">Agregar imagenes (puede seleccionar varias imagenes a la vez)</p>
			<?php echo $this->Form->create('EnvironmentImage', $options = array('type'=>'file', 'class'=>'EnvironmentImageUploadForm', 'id'=>'EnvironmentImageUploadForm', 'url'=>array('controller'=>'Administrator', 'action'=>'saveEnvironmentImage'))); ?>
			<?php echo $this->Form->input('image', $options = array('type'=>'file', 'required'=>'required', 'div'=>false, 'label'=>false, 'multiple'=>true, 'name'=>'data[EnvironmentImage][image][]')); ?>
			<?php echo $this->Form->input('environment_id', $options = array('type'=>'hidden', 'required'=>'required', 'div'=>false, 'label'=>false, 'value'=>$environment['Environment']['id'])); ?>
			<?php echo $this->Form->button('Guardar', $options = array('type'=>'submit', 'class'=>'waves-effect waves-light btn'));  ?>
			<?php echo $this->Form->end(); ?>
			<div class="row">
				<div class="progress" id="content-progress">
					<div class="determinate" style="width: 0%"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row" id="content-environmentImages">
	<?php foreach ($environment['EnvironmentImage'] as $image) { ?>
		<div class="col l3 m3 s12 animated item-imageEnvironment">
			<div class="card-panel">
				<div class="card-image row-relative">
              		<?php echo $this->Html->image('environment_image/image/thumbnails/home_'.$image['image'], $options = array('class'=>'responsive-img')); ?>
					<button class="btn-absolute f-right btn-floating btn red waves-effect waves-light" onclick="deleteItem(this,  <?php echo $image['id']; ?>);">
						<i class="material-icons">delete</i>
					</button>
            	</div>
			</div>
		</div>
	<?php } ?>
</div>
