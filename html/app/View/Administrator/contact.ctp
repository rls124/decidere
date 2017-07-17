<div class="row">
	<div class="row">
		<div class="row">
			<h3>Editar Información</h3>
		</div>
		<div class="row">
			<?php echo $this->Form->create('CompanyDatum'); ?>
			<?php echo $this->Form->input('id', $options = array('value'=>$companyData['CompanyDatum']['id'])); ?>
			<?php echo $this->Form->input('contact', $options = array('class'=>'froala-editor-large', 'label'=>'Descripción de la empresa: ', 'required'=>'required', 'value'=>$companyData['CompanyDatum']['contact'])); ?>
			
			<?php echo $this->Form->input('history', $options = array('type'=>'hidden', 'value'=>$companyData['CompanyDatum']['history'])); ?>
			<?php echo $this->Form->input('views', $options = array('type'=>'hidden', 'required'=>'required', 'value'=>$companyData['CompanyDatum']['views'])); ?>
			<?php echo $this->Form->submit('Guardar', array('class'=>'btn btn-success form-control')); ?>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>