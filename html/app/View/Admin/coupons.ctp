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

<section class="admin"  id="coupons">
	
	<div class="container">
		
		<div class="row">
			<?php echo $this->element('admin_nav'); ?>
		</div>

		<h3>Coupons</h3>

		<div class="row">
			
			<div class="table-responsive">
				<table class="table table-hover table-bordered">
			   		<thead>
			   			<tr>
			   				<th class="col-lg-4">Code</th>
			   				<th>Percentage</th>
			   				<th>State</th>
			   				<th>Deadline</th>
			   				<th>Actions</th>
			   			</tr>
			   		</thead>
		
			   		<tbody>

			   			<tr>
			   				<?php echo $this->Form->create('Coupon', $options = array()); ?>
				   				<td>
									<!-- /input-group -->
				   					<div class="input-group">
				   				 		<?php echo $this->Form->input('code', $options = array('class'=>'form-control', 'label'=>false, 'div'=>false, 'id'=>'code-couponNew',  'autocomplete'=>"off" )); ?> 
								      	<span class="input-group-btn">
								        	<button class="btn btn-default" onclick="generateCupon( 'couponNew' );" type="button">Generate</button>
								      	</span>
								    </div>

								</td>
				   				<td> <?php echo $this->Form->input('percentage', $options = array('class'=>'form-control', 'label'=>false, 'type'=>'number', 'step'=>'any', 'min'=>'0', 'max'=>'100', 'value'=>'0')); ?> </td>
				   				<td> <?php echo $this->Form->input('state', $options = array('class'=>'form-control', 'label'=>false, 'type'=>'select', 'options'=>array('1'=>'Active', '2'=>'Inactive'))); ?> </td>
				   				<td> <?php echo $this->Form->input('deadline', $options = array('class'=>'datetime-picker form-control', 'label'=>false, 'type'=>'text', 'autocomplete'=>"off" )); ?> </td>
				   				<td> <?php echo $this->Form->button('Add', $options = array('class'=>'btn btn-success')); ?> </td>
			   				<?php echo $this->Form->end(); ?>
			   			</tr>

			   			<!--recorre user for populate table users-->
			   			<?php foreach ($coupons as $key => $coupon) { ?>
	   				
				   			
			   				<tr>
				   				<?php echo $this->Form->create('Coupon', $options = array( 'class' => 'form-coupon-edit', 'url'=>array('controller' => 'Ajax', 'action'=>'saveCoupons' ) )); ?>

				   					<?php echo $this->Form->input('id', $options = array('value'=>$coupon['Coupon']['id'])); ?>
					   				
					   				<td>

					   					<div class="input-group">
					   				 		<?php echo $this->Form->input('code', $options = array('value'=>$coupon['Coupon']['code'], 'label'=>false, 'div'=>false, 'class'=>'form-control', 'id'=>'code-'.$coupon['Coupon']['id'],  'autocomplete'=>"off"  )); ?>
									      	<span class="input-group-btn">
									        	<button class="btn btn-default" type="button" onclick="generateCupon( '<?php echo $coupon['Coupon']['id']; ?>' );" >Generate</button>
									      	</span>
									    </div><!-- /input-group -->

					   				</td>

					   				<td> <?php echo $this->Form->input('percentage', $options = array('value'=>$coupon['Coupon']['percentage'], 'label'=>false, 'div'=>false, 'class'=>'form-control', 'type'=>'number', 'step'=>'any', 'min'=>'0', 'max'=>'100')); ?> </td>

					   				<td> <?php echo $this->Form->input('state', $options = array( 'type'=>'select', 'options'=>array('1'=>'Active', '2'=>'Inactive'), 'value'=>$coupon['Coupon']['state'], 'label'=>false, 'div'=>false, 'class'=>'form-control' )); ?> </td>

					   				<td> <?php echo $this->Form->input('deadline', $options = array('value'=>$coupon['Coupon']['deadline'], 'label'=>false, 'type'=>'text', 'div'=>false, 'class'=>'form-control datetime-picker', 'autocomplete'=>"off"  )); ?> </td>

					   				<td>
					   					<?php echo $this->Form->button('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>', $options = array('type'=>'submit', 'class'=>'btn btn-primary btn-xs', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Save Changes")); ?>
						   		
						   				<?php echo $this->Form->end(); ?>

				   						<?php echo $this->Form->postLink(__(' <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> '), array('action' => 'delete', $coupon['Coupon']['id'],'coupon'), array('class'=>'btn btn-danger btn-xs', 'escape'=>false, 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Delete"), __('Are you sure to delete the Coupon " %s " ?', $coupon['Coupon']['code'])); ?>
						   			</td>
				   			</tr>

			   			<?php } ?>
			   		</tbody>
				</table>
			</div>

		</div>

	</div>

</section>

<?php echo $this->element('side_nav', array('viewName' => 'NewScenario')); ?>