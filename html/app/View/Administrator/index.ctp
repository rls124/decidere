<div class="row">
	<blockquote>
		<h5>Planeta de luz</h5>
	</blockquote>
</div>
<div class="row">
	<div class="col s12 m8 l8">
		<div class="card-panel">
	    	<p class="text-bold">Quienes somos</p>
	    	<?php echo $this->Form->create('CompanyData', $options = array('type'=>'file')); ?>
	    	<?php echo $this->Form->input('id', $options = array('value'=>$companyData['CompanyData']['id'])); ?>
			<?php echo $this->Form->input('about', $options = array('label'=>'Quienes somos:', 'required'=>'required', 'div'=>false, 'label'=>false, 'class'=>'text-editor', 'value'=>$companyData['CompanyData']['about'])); ?>
			<p class="text-bold">Informacion de contacto</p>
			<?php echo $this->Form->input('contact', $options = array('label'=>'Quienes somos:', 'required'=>'required', 'div'=>false, 'label'=>false, 'class'=>'text-editor', 'value'=>$companyData['CompanyData']['contact'])); ?>
			<?php echo $this->Form->button('Guardar', $options = array('type'=>'submit', 'class'=>'waves-effect waves-light btn'));  ?>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	<div class="col s12 m4 l4">
		<div class="card-panel">
			<p class="text-bold">Opciones extras</p>
			<p>Vistas: <?php echo $companyData['CompanyData']['views'] ?></p>
			<p>Webmail : <?php echo $this->Html->link('Entrar', array('controller' => '', 'action' => '')); ?></p>
		</div>
	</div>
</div>
<div class="row"></div>