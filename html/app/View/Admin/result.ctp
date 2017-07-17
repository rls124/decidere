<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName' => 'NewScenario')); ?>
	<div class="col-xs-12 col-sm-12 col-md-12 no-padding">
		<div class="cover-in">
			<div class="container">
				<div class="col-xs-12 col-sm-12 col-md-12 no-padding mobile-version">
					<div class="row collapsed-nav">
						<a href="" class="animated swing fadeInDown">HOME</a>
						<a href="" class="animated swing fadeInDown">ABOUT</a>
						<a href="" class="animated swing fadeInDown">DATASETS</a>
						<a href="" class="animated swing fadeInDown">HELP</a>
						<a href="" class="animated swing fadeInDown">CONTACT</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END COVER-->
<br />

<section>
	<div class="container">
		<div class="row">
			<h3>Results</h3>
		</div>

		<!--view results-->
		<div class="row">
			<?php print_r( $results ); ?>
		</div>

	</div>
</section>