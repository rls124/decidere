<?php echo $this->Form->create('User', $options = array()); ?>
<?php echo $this->Form->input('email', $options = array()); ?>
<?php echo $this->Form->input('username', $options = array()); ?>
<?php echo $this->Form->input('password', $options = array()); ?>
<?php echo $this->Form->input('role', $options = array()); ?>
<?php echo $this->Form->input('phone', $options = array()); ?>
<?php echo $this->Form->end('Guardar'); ?>