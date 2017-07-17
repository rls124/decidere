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
				<h3>Edit Info Popup</h3>
			</div>
		</div>
		<div class="row">
			
			<?php echo $this->Form->create('Admin', $options = array( 'id'=>'form-edit-info', 'url'=>array('controller'=>'Admin', 'action'=>'infoSave' ) )); ?>
				<input name="data[Admin][id]" type="hidden" value="<?php echo $info['Info']['id']; ?>"/>
				<div class="row">
					<div class="col-lg-2 form-group">
						<?php echo $this->Form->input('page', $options = array( 'class'=>'form-control', 'required'=>'required', 'label'=>'Page Name<span class="req">*</span>', 'div'=>false, 'placeholder'=>'Page Name','value'=>$info['Info']['page'] )); ?>
					</div>
					<div class="col-lg-4" form-group>
						<?php echo $this->Form->input('link', $options = array( 'class'=>'form-control', 'required'=>'required', 'label'=>'Item Link<span class="req">*</span>', 'div'=>false, 'placeholder'=>'Item Link','value'=>$info['Info']['link']  )); ?>
					</div>
					<div class="col-lg-6">
						<?php echo $this->Form->input('name', $options = array( 'class'=>'form-control', 'required'=>'required', 'label'=>'Item Name<span class="req">*</span>', 'div'=>false, 'placeholder'=>'Item Name','value'=>$info['Info']['name']  )); ?>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-12 form-group">
					<?php echo $this->Form->input('content', $options = array('class'=>'form-control', 'required'=>'required', 'placeholder'=>"Message*", 'div'=>false, 'label'=>'Info Description<span class="req">*</span>',  'type'=>'textarea','value'=>$info['Info']['content'] )); ?>
					<span class="req">*</span> Required Field
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

