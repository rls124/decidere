<?php echo $this->element('header_second'); ?>
<div class="row">
	<div class="container container-main">
		<div class="row center-align">
			<?php echo $this->Html->image('front/logo-gris.png', $options = array('class'=>"logo-gris")); ?>
			<h1 class="title-about">PAQUETES</h1>
		</div>
		<div class="row content-about">
			<?php foreach ($packages as $package) { ?>
				<div class="col l12 m12 s12">
					<div class="row ">
						<div class="col l4 m4 s12 content-center">
														
							<div class="ih-item circle effect18 right_to_left content-image-product-circle">
								<a href="<?php echo $this->Html->url(array('controller' => 'Home', 'action' => 'paquete', $package['Package']['id']), $full = false); ?>">
						        	<div class="img">
						        		<?php echo $this->Html->image('package/image/thumbnails/square_' . $package['Package']['image'] , $options = array('class'=>'responsive-img')); ?>
						        	</div>
						        	<div class="info">
						          		<div class="info-back">
						            		<h3>Ver mas</h3>
						            		<p><?php  echo $package['Package']['title'] ;  ?></p>
						          		</div>
						        	</div>
						    	</a>
						    </div>

						</div>
						<div class="col l8 m8 s12 content-description-package">
							<h2 class="title-package-list"><?php echo $package['Package']['title']; ?></h2>
							<div class="text-item">
								<?php echo $this->Text->truncate($package['Package']['description'], $length=200,$options=array('ellipsis' => '...', 'exact' => true, 'html' => true)); ?>
							</div>
							<div class="row">
								<?php echo $this->Html->link( $this->Html->image('front/view-more.png', $options = array()), array('controller' => 'Home', 'action' => 'paquete', $package['Package']['id']), array('escape'=>false, 'class'=>'hvr-float-shadow')); ?>

								<?php echo $this->Html->link( $this->Html->image('front/reserve.png', $options = array()), '#modalReserve', array('escape'=>false, 'class'=>'modal-trigger hvr-float-shadow', 'onclick'=>'setNameReserve( \'' . $package["Package"]["title"] . '\' )')); ?>

								<?php echo $this->Html->link( $this->Html->image('front/consult.png', $options = array()), '#modalConsulting', array('escape'=>false, 'class'=>'modal-trigger hvr-float-shadow', 'onclick'=>'setNameConsulting( \'' . $package["Package"]["title"] . '\' )')); ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="void col l4 m4 s0">
							
						</div>
						<div class="divider-item-package col l8 m8 s12">
							
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>

	<?php echo $this->element('carousel', array($news)); ?>
	
	<div class="container container-main">
		<div class="row">
			<?php echo $this->element('testimonials', array($testimonials)); ?>
		</div>
		<div class="row" >
			<?php echo $this->element('footer', array($companyData)); ?>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('.nav-link-packages').addClass('selected');
	});
</script>

<?php echo $this->element('modals'); ?>