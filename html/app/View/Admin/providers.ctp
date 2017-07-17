<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName' => 'Dashboard')); ?>
</section>
<section class="admin"  id="providers">

	<div class="container">
		
		<div class="row">
			<?php echo $this->element('admin_nav'); ?>
		</div>

		<h3> <?php echo $this->Html->link('Datasets Categories', array('controller' => 'Admin', 'action' => 'datasets')); ?> / <?php echo $category['Category']['name']; ?></h3>

		<h4>Providers</h4>

		<div class="row">
			<div class="table-responsive">
				<table class="table table-hover table-bordered">
			   		<thead>
			   			<tr>
			   				<th>Name</th>
			   				<th>Description</th>
			   				<th>Is Demo</th>
			   				<th>Actions</th>
			   			</tr>
			   		</thead>
		
			   		<tbody>

			   			<tr class="success">
			   				<?php echo $this->Form->create('Provider', $options = array('id'=>'form-add-dataset-provider', 'url'=>array('controller' => 'Ajax', 'action'=>'saveProviderDataset'  ))); ?>
				   				<td> <?php echo $this->Form->input('name', $options = array('class'=>'form-control', 'label'=>false, "onkeypress"=>"validSpecialCharacters(event);")); ?> </td>
				   				<td> <?php echo $this->Form->input('description', $options = array('class'=>'form-control', 'type'=>'text', 'label'=>false)); ?> </td>
				   				<td class="text-center"> <?php echo $this->Form->checkbox('type'); ?> </td>
				   				<td> <?php echo $this->Form->button('Add', $options = array('class'=>'btn btn-success')); ?> </td>
				   				<?php echo $this->Form->input('category_id', $options = array('type'=>'hidden', 'value'=>$category['Category']['id'])); ?>
			   				<?php echo $this->Form->end(); ?>
			   			</tr>

			   			<!--recorre user for populate table users-->
			   			<?php foreach ($providers as $key => $provider) { ?>

			   				<?php if( $provider['Provider']['type'] == 1 ) { 
			   					$checked_status = 'checked';
			   				} else if($provider['Provider']['type'] == 0) {
			   					$checked_status = false;
			   				} ?>
			   				
				   			<tr>
				   				<?php echo $this->Form->create('Provider', $options = array( 'class' => 'form-provider-edit', 'url'=>array('controller' => 'Ajax', 'action'=>'saveProviderDataset' ) )); ?>

				   					<?php echo $this->Form->input('id', $options = array('value'=>$provider['Provider']['id'])); ?>
					   				
					   				<td> <?php echo $this->Form->input('name', $options = array('value'=>$provider['Provider']['name'], 'label'=>false, 'div'=>false, 'class'=>'form-control', "onkeypress"=>"validSpecialCharacters(event);")); ?> </td>

					   				<td> <?php echo $this->Form->input('description', $options = array('type'=>'text', 'value'=>$provider['Provider']['description'], 'label'=>false, 'div'=>false, 'class'=>'form-control')); ?> </td>

					   				<td class="text-center" >
					   					<?php echo $this->Form->checkbox('type', array('checked'=>$checked_status)); ?>
					   				</td>

					   				<td>
					   					<?php echo $this->Form->button('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>', $options = array('type'=>'submit', 'class'=>'btn btn-primary btn-xs', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Save Changes")); ?>
						   		
						   				<?php echo $this->Form->end(); ?>

										<?php //echo $this->Html->link('<span class="glyphicon glyphicon-usd" aria-hidden="true"></span>', array('controller' => 'Admin', 'action' => 'plans', $provider['Provider']['id']), array('escape' => false, 'class'=>'btn btn-info btn-xs', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Plans") ); ?>

										<?php echo $this->Html->link('<span class="glyphicon glyphicon-usd" aria-hidden="true"></span>', array('controller' => 'Admin', 'action' => 'stripePlanes', $provider['Provider']['id']), array('escape' => false, 'class'=>'btn btn-warning btn-xs', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Plans") ); ?>

				   						<?php echo $this->Form->postLink(__(' <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> '), array('action' => 'delete', $provider['Provider']['id'],'provider', $category['Category']['id']), array('class'=>'btn btn-danger btn-xs', 'escape'=>false, 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Delete"), __('Are you sure to delete the Provider " %s " ?', $provider['Provider']['name'])); ?>

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