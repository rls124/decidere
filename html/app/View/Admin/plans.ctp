<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName' => 'Dashboard')); ?>
</section>
<section id="providers">

	<div class="container">
		
		<div class="row">
			<?php echo $this->element('admin_nav'); ?>
		</div>

		<h3> <?php echo $this->Html->link('Datasets Categories', array('controller' => 'Admin', 'action' => 'datasets')); ?> / <?php echo $this->Html->link($provider['Category']['name'], array('controller' => 'Admin', 'action' => 'providers', $provider['Category']['id'])); ?> / <?php echo $provider['Provider']['name']; ?></h3>

		<h4>Plans</h4>

		<div class="row">
			<div class="table-responsive">
				<table class="table table-hover table-bordered table-striped">
			   		<thead>
			   			<tr>
			   				<th>Stripe Id</th>
			   				<th>Name</th>
			   				<th class="col-lg-4">Description</th>
			   				<th>Price</th>
			   				<th>Duration</th>
			   				<th>Discount</th>
			   				<th>Type</th>
			   				<th>Actions</th>
			   			</tr>
			   		</thead>
		
			   		<tbody>

			   			<tr class="success">
			   				<?php echo $this->Form->create('Plan', $options = array('id'=>'form-add-dataset-plan', 'url'=>array('controller' => 'Ajax', 'action'=>'savePlanDataset' ) )); ?>
				   				<td> <?php echo $provider['Provider']['id']; ?></td>
				   				<td> <?php echo $this->Form->input('name', $options = array('class'=>'form-control', 'label'=>false)); ?> </td>
				   				<td class="col-lg-4"> <?php echo $this->Form->input('description', $options = array('class'=>'form-control auto-size', 'rows'=>'1', 'label'=>false)); ?> </td>
				   				<td> <?php echo $this->Form->input('price', $options = array('type'=>'number', 'step'=>'0.01', 'min'=>0 , 'class'=>'form-control', 'label'=>false)); ?> </td>
				   				<td> <?php echo $this->Form->input('duration', $options = array('class'=>'', 'label'=>false, 'type'=>'select', 'options'=>array('Monthly'=>'Monthly', 'Annual'=>'Annual' ) )); ?> </td>
				   				<td> <?php echo $this->Form->input('discount', $options = array('class'=>'form-control', 'label'=>false)); ?> </td>
				   				<td> <?php echo $this->Form->input('type', $options = array('class'=>'', 'label'=>false, 'type'=>'select', 'options'=>array('1'=>'Public', '2'=>'Private'))); ?> </td>
				   				<td> <?php echo $this->Form->button('Add', $options = array('class'=>'btn btn-success')); ?> </td>
				   				<?php echo $this->Form->input('provider_id', $options = array('type'=>'hidden', 'value'=>$provider['Provider']['id'])); ?>
			   				<?php echo $this->Form->end(); ?>
			   			</tr>

			   			<!--recorre user for populate table users-->
			   			<?php foreach ($plans as $key => $plan) { ?>

							<?php switch ($plan['Plan']['type']) {
								case '1':
									$type = 'Public';
									$class_label = 'label-success';
									break;

								case '2':
									$type = 'Private';
									$class_label = 'label-danger';
									break;
								
								default:
									$type = 'Undefined';
									$class_label = 'label-warning';
									break;
							} ?>

			   				
			   			
							<tr>
				   				<?php echo $this->Form->create('Plan', $options = array( 'class' => 'form-plan-edit', 'url'=>array('controller' => 'Ajax', 'action'=>'savePlanDataset' ) )); ?>
									
				   					<?php echo $this->Form->input('id', $options = array('value'=>$plan['Plan']['id'])); ?>

				   					<?php echo $this->Form->input('provider_id', $options = array('type'=>'hidden', 'value'=>$plan['Plan']['provider_id'])); ?>
					   				
					   				<td> <?php echo $provider['Provider']['id']; ?></td>
				   				
				   					<td> <?php echo $this->Form->input('name', $options = array('value'=>$plan['Plan']['name'], 'label'=>false, 'div'=>false, 'class'=>'form-control')); ?> </td>

					   				<td class="col-lg-4"> <?php echo $this->Form->input('description', $options = array('value'=>$plan['Plan']['description'], 'label'=>false, 'div'=>false, 'class'=>'form-control auto-size', 'rows'=>'1' )); ?> </td>

					   				<td> <?php echo $this->Form->input('price', $options = array('type'=>'number', 'step'=>'0.01', 'min'=>0, 'value'=>$plan['Plan']['price'], 'label'=>false, 'div'=>false, 'class'=>'form-control' )); ?> </td>

					   				<td> <?php echo $this->Form->input('duration', $options = array( 'class'=>'', 'label'=>false, 'div'=>false, 'type'=>'select', 'options'=>array('Monthly'=>'Monthly', 'Annual'=>'Annual' ), 'default'=> $plan['Plan']['duration'])); ?> </td>

					   				<td> <?php echo $this->Form->input('discount', $options = array('value'=>$plan['Plan']['discount'], 'label'=>false, 'div'=>false, 'class'=>'form-control' )); ?> </td>

					   				<td> <?php echo $this->Form->input('type', $options = array('type'=>'select', 'value'=>$plan['Plan']['type'], 'label'=>false, 'div'=>false, 'class'=>'', 'options'=>array('1'=>'Public', '2'=>'Private') )); ?> </td>

					   				<td>
					   					<?php echo $this->Form->button('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>', $options = array('type'=>'submit', 'class'=>'btn btn-primary btn-xs', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Save Changes")); ?>
						   		
						   				<?php echo $this->Form->end(); ?>

				   						<?php echo $this->Form->postLink(__(' <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> '), array('action' => 'delete', $plan['Plan']['id'],'plan', $provider['Provider']['id']), array('class'=>'btn btn-danger btn-xs', 'escape'=>false, 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Delete"), __('Are you sure to delete the Plan " %s " ?', $plan['Plan']['name'])); ?>
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