<div class="row content-carousel">
	<div class="container container-carousel">
		<div id="owl-demo" class="owl-carousel">
			<?php foreach ($news as $value) { ?>
				<div class="item ih-item square effect6 from_top_and_bottom my-news">
					<a href="<?php echo $value['Novelty']['link']; ?>">
			        	<div class="img">
			        		<?php echo $this->Html->image('novelty/image/thumbnails/front_'.$value['Novelty']['image'], $options = array("alt"=>$value['Novelty']['caption'], "title"=>$value['Novelty']['link'], 'class'=>'img-responsive')); ?>
			        	</div>
			        	<div class="info">
			          		<h3><?php echo $value['Novelty']['caption']; ?></h3>
			        	</div>
			    	</a>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
