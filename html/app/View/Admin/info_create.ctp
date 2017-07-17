<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName' => 'Dashboard')); ?>
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
<!--END COVER-->

<section class="admin"  id="match">
	
	<div class="container">
		<div class="row">
			<?php echo $this->element('admin_nav'); ?>
		</div>
		<div class="row">
			<div class="col-lg-4 form-group">
				<h3>Create Info Popup</h3>
			</div>
		</div>
		<div class="row">
			<?php echo $this->Form->create('Admin', $options = array( 'id'=>'form-edit-info', 'url'=>array('controller'=>'Admin', 'action'=>'infoSave' ) )); ?>
				<input name="data[Admin][id]" type="hidden" value="0"/>
				<div class="row">
					<div class="col-lg-4 form-group">
						<?php echo $this->Form->input('page', $options = array( 'class'=>'form-control', 'label'=>false, 'div'=>false, 'placeholder'=>'Page Name' )); ?>
					</div>
					<div class="col-lg-4" form-group>
						<?php echo $this->Form->input('link', $options = array( 'class'=>'form-control', 'label'=>false, 'div'=>false, 'placeholder'=>'Item Link' )); ?>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('name', $options = array( 'class'=>'form-control', 'label'=>false, 'div'=>false, 'placeholder'=>'Item Name' )); ?>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-12 form-group">
					<?php echo $this->Form->input('content', $options = array('class'=>'form-control', 'placeholder'=>"Message*", 'div'=>false, 'label'=>false, 'type'=>'textarea')); ?>
					</div>
				</div>
				<div class="col-lg-4 form-group">
					<?php echo $this->Form->button('Save', $options = array('type'=>'submit', 'class'=>'admin-user-register btn btn-success')); ?>
				</div>
			<?php echo $this->Form->end(); ?>
		</div>

	</div>

</section>
<?php echo $this->element('side_nav', array('viewName' => 'NewScenario')); ?>

