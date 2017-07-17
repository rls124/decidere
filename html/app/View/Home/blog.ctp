<?php echo $this->element('header_second'); ?>
<div class="row">
	<div class="container container-main">
		<div class="row center-align">
			<?php echo $this->Html->image('front/logo-gris.png', $options = array('class'=>"logo-gris")); ?>
			<h1 class="title-about">BUEN VIVIR</h1>
		</div>
		<div class="row content-about content-blog">
			<div class="col l8 m8 s12">
				<div class="row">
					
					<?php foreach ($goods as $good) { ?>
						<div class="col l12 m12 s12">
							<div class="row ">
								<div class="col l5 m6 s12 content-center">
																
									<div class="ih-item circle effect18 right_to_left content-image-product-circle", style="width:auto; height:auto;">
										<a href="<?php echo $this->Html->url(array('controller' => 'Home', 'action' => 'buenvivir', $good['GoodLife']['id']), $full = false); ?>">
								        	<div class="img" style="width:auto; height:auto;">
								        		<?php echo $this->Html->image('good_life/image/thumbnails/square_' . $good['GoodLife']['image'] , $options = array('class'=>'responsive-img')); ?>
								        	</div>
								        	<div class="info">
								          		<div class="info-back">
								            		<h3>Ver mas</h3>
								            		<p><?php  echo $good['GoodLife']['title'] ;  ?></p>
								          		</div>
								        	</div>
								    	</a>
								    </div>

								</div>
								<div class="col l7 m6 s12 content-description-package">
									<h2 class="title-package-list"><?php echo $good['GoodLife']['title']; ?></h2>
									<div class="text-item">
										<?php echo $this->Text->truncate($good['GoodLife']['description'], $length=200,$options=array('ellipsis' => '...', 'exact' => true, 'html' => true)); ?>
									</div>
									<div class="row">
										<?php echo $this->Html->link( 'Leer más', array('controller' => 'Home', 'action' => 'buenvivir', $good['GoodLife']['id']), array('escape'=>false, 'class'=>'hvr-float-shadow')); ?>
										<?php if ( count($good['Comment']) > 0 ) { ?>
											<span class="num-comments"> <?php echo $this->Html->image('front/comment.png', $options = array()); ?> <?php echo count($good['Comment']); ?> Comentarios </span>
										<?php } ?>
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
			<div class="col l4 m4 s12">
				<div class="row">
					
					<div class="fb-page" data-href="https://www.facebook.com/ClinicaParaSanosPlanetaDeLuz" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
						<div class="fb-xfbml-parse-ignore">
							<blockquote cite="https://www.facebook.com/ClinicaParaSanosPlanetaDeLuz">
								<a href="https://www.facebook.com/ClinicaParaSanosPlanetaDeLuz">Planeta de Luz SPA Terapéutico - Hospedaje Ecológico</a>
							</blockquote>
						</div>
					</div>

				</div>
			</div>
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
		$('.nav-link-blog').addClass('selected');
	});
</script>