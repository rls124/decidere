<div class="container">
	<div class="row">
		<h3 class="center-align">Bienvenido al administrador</h3>
		<?php echo $this->Session->flash('auth'); ?>  
	</div>
	<div class="row">
		<div class="row">
			<?php echo $this->Form->create('User'); ?>
			<div class="input-field">
				<?php echo $this->Form->input('username', array('class'=>'form-control', 'label'=>'Usuario', 'div'=>false)); ?>
			</div>
			<div class="input-field">
				<?php echo $this->Form->input('password', array('class'=>'form-control', 'label'=>'Contraseña', 'div'=>false)); ?>
			</div>
		</div>
		<div class="row right" >

				<?php echo $this->Html->link('Volver al sitio', "/", array('class'=>'waves-effect waves-light btn')); ?>

				<?php echo $this->Form->button('ENTRAR', array('type'=>'submit', 'class'=>'waves-effect waves-light btn',)); ?>

			<?php echo $this->Form->end(); ?>
		</div>

	</div>
</div>
