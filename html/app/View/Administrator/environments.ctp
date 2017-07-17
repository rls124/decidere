<div class="row">
	<blockquote>
		<h5>
			Instalaciones 
			<button class="btn-floating btn waves-effect waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="Nuevo paquete" onclick="showHideNewItem();">
				<i class="material-icons">add</i>
			</button> 
		</h5>
	</blockquote>
</div>

<div class="row new-item fadeIn animated">
	<div class="col l8 m8 s12">
		<div class="card-panel">
			<p class="text-bold">Nueva galeria</p>
	    	<?php echo $this->Form->create('Environment', $options = array('type'=>'file')); ?>
			<div class="row">
	        	<div class="input-field col s12">
					<?php echo $this->Form->input('title', $options = array('class'=>'validate', 'label'=>false, 'required'=>'required', 'div'=>false, 'type'=>'text')); ?>
	          		<label for="EnvironmentTitle">Titulo</label>
	        	</div>
	      	</div>

	      	<div class="row">
	        	<div class="col s12">
	          		<label for="EnvironmentDescription text-bold">Descripción</label>
					<?php echo $this->Form->input('description', $options = array( 'required'=>'required', 'div'=>false, 'label'=>false, 'class'=>'text-editor', 'placeholder'=>'Descripción')); ?>
	        	</div>
	      	</div>
	      	<div class="row right-align">
				<?php echo $this->Form->input('state', $options = array('value'=>'1', 'type'=>'hidden')); ?>
				<?php echo $this->Form->button('Guardar', $options = array('type'=>'submit', 'class'=>'waves-effect waves-light btn'));  ?>
	      	</div>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<div class="row">
	<?php foreach ($environments as $environment) { ?>
		<div class="col l3 m3 s12">
			<div class="card-panel">
				<div class="row">
					<p class="text-bold"> <?php echo $environment['Environment']['title']; ?></p>
					<p> <?php echo $this->Text->truncate($environment['Environment']['description'], $length=40, $options=array('ellipsis' => '...', 'exact' => true, 'html' => true)); ?></p>

				</div>
				<div class="row right-align row-relative">						
					<?php echo $this->Form->postLink(__('<i class="material-icons">delete</i>'), array('action' => 'delete', $environment['Environment']['id'],'environment'), array('class'=>'btn-floating btn red waves-effect waves-light tooltipped', 'escape'=>false, "data-position"=>"bottom", "data-delay"=>"50", "data-tooltip"=>"Eliminar"), __('Esta seguro de eliminar la novedad " %s " ?', $environment['Environment']['title'])); ?>
					<?php echo $this->Html->link('<i class="material-icons">input</i>', array('controller' => 'Administrator', 'action' => 'environmentEdit',$environment['Environment']['id']), array('class'=>'btn-floating btn waves-effect waves-light tooltipped', 'escape'=>false, "data-position"=>"bottom", "data-delay"=>"50", "data-tooltip"=>"Editar")); ?>
				</div>
			</div>
		</div>
	<?php } ?>
</div>

