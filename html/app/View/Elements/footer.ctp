<div class="row" id="footer">
	<div class="row divider-footer" id="">
		
	</div>
	<div class="row">
		<div class="col l4 m4 s12">
			<h4 class="title-footer">CONTENIDO</h4>
			<ul>
				<li class="li-footer"><?php echo $this->Html->link('Inicio', array('controller' => '', 'action' => ''), array('class'=>'p-index')); ?></li>
				<li class="li-footer"><?php echo $this->Html->link('Quienes Somos', array('controller' => '', 'action' => ''), array('class'=>'p-index')); ?></li>
				<li class="li-footer"><?php echo $this->Html->link('Programas', array('controller' => '', 'action' => ''), array('class'=>'p-index')); ?></li>
				<li class="li-footer"><?php echo $this->Html->link('Instalaciones', array('controller' => '', 'action' => ''), array('class'=>'p-index')); ?></li>
				<li class="li-footer"><?php echo $this->Html->link('Buen vivir', array('controller' => '', 'action' => ''), array('class'=>'p-index')); ?></li>
				<li class="li-footer"><?php echo $this->Html->link('Galeria de imágenes', array('controller' => '', 'action' => ''), array('class'=>'p-index')); ?></li>
				<li class="li-footer"><?php echo $this->Html->link('Testimonios', array('controller' => '', 'action' => ''), array('class'=>'p-index')); ?></li>
				<li class="li-footer"><?php echo $this->Html->link('Reservas', array('controller' => '', 'action' => ''), array('class'=>'p-index')); ?></li>
			</ul>
		</div>
		<div class="col l4 m4 s12">
			<h4 class="title-footer">CONTACTOS</h4>
			<div class="p-index"><?php echo $companyData['CompanyData']['contact']; ?></div>
		</div>
		<div class="col l4 m4 s12 center-align">
			<?php echo $this->Html->image('front/logo-footer.png', $options = array('class'=>'responsive-img logo-footer')); ?>
			<p class="p-index">Cochabamba - Bolivia</p>
			<p><?php echo $this->Html->link('www.planetadeluz.com', array('controller' => '', 'action' => ''), array('class'=>'link-footer')); ?></p>
		</div>
		
	</div>
	<div class="row center-align">
		visitas 0000 - webmail - Cades.net
	</div>
</div>

<div class="preloader-wrapper big active" id="spinnerModals">
	<div class="spinner-layer spinner-blue">
	<div class="circle-clipper left">
	  <div class="circle"></div>
	</div><div class="gap-patch">
	  <div class="circle"></div>
	</div><div class="circle-clipper right">
	  <div class="circle"></div>
	</div>
	</div>

	<div class="spinner-layer spinner-red">
	<div class="circle-clipper left">
	  <div class="circle"></div>
	</div><div class="gap-patch">
	  <div class="circle"></div>
	</div><div class="circle-clipper right">
	  <div class="circle"></div>
	</div>
	</div>

	<div class="spinner-layer spinner-yellow">
	<div class="circle-clipper left">
	  <div class="circle"></div>
	</div><div class="gap-patch">
	  <div class="circle"></div>
	</div><div class="circle-clipper right">
	  <div class="circle"></div>
	</div>
	</div>

	<div class="spinner-layer spinner-green">
	<div class="circle-clipper left">
	  <div class="circle"></div>
	</div><div class="gap-patch">
	  <div class="circle"></div>
	</div><div class="circle-clipper right">
	  <div class="circle"></div>
	</div>
	</div>
</div>