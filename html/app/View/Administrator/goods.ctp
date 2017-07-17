<div class="row">
	<blockquote>
		<h5>
			Buen vivir 
			<button class="btn-floating btn waves-effect waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="Nuevo paquete" onclick="showHideNewItem();">
				<i class="material-icons">add</i>
			</button> 
		</h5>
	</blockquote>
</div>
<div class="row new-item fadeIn animated">
	<div class="col l4 m4 s12">
		<div class="card-panel">
			<p class="text-bold">Nuevo item</p>
	    	<?php echo $this->Form->create('GoodLife', $options = array('type'=>'file')); ?>
			<div class="row">
	        	<div class="input-field col s12">
					<?php echo $this->Form->input('title', $options = array('class'=>'validate', 'label'=>false, 'required'=>'required', 'div'=>false, 'type'=>'text')); ?>
	          		<label for="PackageTitle">Titulo</label>
	        	</div>
	      	</div>
	    	<div class="row">
	    		<div class="col s12">
					<?php echo $this->Form->input('image', $options = array('type'=>'file', 'label'=>false, 'required'=>'required')); ?>
				</div>
	    	</div>
	      	<div class="row right-align">
				<?php echo $this->Form->input('state', $options = array('value'=>'1', 'type'=>'hidden')); ?>
				<?php echo $this->Form->button('Guardar', $options = array('type'=>'submit', 'class'=>'waves-effect waves-light btn'));  ?>
	      	</div>
		</div>
	</div>
	<div class="col l8 m8 s12">
		<div class="card-panel">
			<p class="text-bold">Descripción</p>
			<?php echo $this->Form->input('description', $options = array('label'=>'Descripción:', 'required'=>'required', 'div'=>false, 'label'=>false, 'class'=>'text-editor', 'placeholder'=>'Descripción')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
<div class="row">
	<?php foreach ($goods as $good) { ?>
		<div class="row">
			<div class="col l3 m3 s12">
				<div class="card-panel">
					<div class="row row-relative center-align">
						<?php echo $this->Html->image('good_life/image/thumbnails/home_'.$good['GoodLife']['image'], $goodoptions = 	array('class'=>'responsive-img')); ?>

					</div>
					<div class="row">
						<?php echo $good['GoodLife']['title']; ?>
					</div>
					<div class="row right-align row-relative">
						<?php echo $this->Html->link('Comentarios', array('controller' => 'Administrator', 'action' => 'comments', $good['GoodLife']['id']), array('escape'=>false, 'class'=>'btn waves-effect waves-light fl-left')); ?>
						<?php echo $this->Form->postLink(__('<i class="material-icons">delete</i>'), array('action' => 'delete', $good['GoodLife']['id'],'goodlife'), array('class'=>'btn-floating btn red waves-effect waves-light tooltipped', 'escape'=>false, "data-position"=>"bottom", "data-delay"=>"50", "data-tooltip"=>"Eliminar"), __('Esta seguro de eliminar la novedad " %s " ?', $good['GoodLife']['title'])); ?>
						<button class="btn-floating btn waves-effect waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="Editar" onclick="showHideEditItem(<?php echo $good['GoodLife']['id'] ?>);">
							<i class="material-icons">input</i>
						</button> 
					</div>
				</div>
			</div>
			<div class="col l9 m9 s12 edit-item animated zoomIn" id="edit-item-<?php echo $good['GoodLife']['id']; ?>">
				<dvi class="row">
					<div class="col l4 m4 s12">
						<div class="card-panel">
							<?php echo $this->Form->create('GoodLife', $options = array('type'=>'file')); ?>
							<div class="row">
					        	<div class="input-field col s12">
									<?php echo $this->Form->input('id', $options = array('value'=>$good['GoodLife']['id'])); ?>
									<?php echo $this->Form->input('title', $options = array('class'=>'validate', 'label'=>false, 'required'=>'required', 'div'=>false, 'type'=>'text', 'value'=>$good['GoodLife']['title'])); ?>
					          		<label for="PackageTitle">Titulo</label>
					        	</div>
					      	</div>
					    	<div class="row">
					    		<div class="col s12">
									<?php echo $this->Form->input('image', $options = array('type'=>'file', 'label'=>false, 'value'=>$good['GoodLife']['image'])); ?>
								</div>
					    	</div>
					      	<div class="row right-align">
								<?php echo $this->Form->input('state', $options = array('value'=>'1', 'type'=>'hidden', 'value'=>$good['GoodLife']['state'])); ?>
								<?php echo $this->Form->button('Guardar', $options = array('type'=>'submit', 'class'=>'waves-effect waves-light btn'));  ?>
					      	</div>
						</div>
					</div>
					<div class="col l8 m8 s12">
						<div class="card-panel">
							<?php echo $this->Form->input('description', $options = array('label'=>'Descripción:', 'required'=>'required', 'div'=>false, 'label'=>false, 'class'=>'text-editor-load', 'placeholder'=>'Descripción', 'value'=>$good['GoodLife']['description'])); ?>
						</div>
						<?php echo $this->Form->end(); ?>
					</div>
				</dvi>
			</div>
		</div>
	<?php } ?>
</div>
