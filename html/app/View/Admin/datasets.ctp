<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName' => 'Dashboard')); ?>
</section>
<!--END COVER-->
<section class="admin">

	<div class="container">
		<div class="row">
			<?php echo $this->element('admin_nav'); ?>
		</div>
		
		<h3>Datasets Categories</h3>

		<div class="row">
			<div class="table-responsive">
				<table class="table table-hover table-bordered">
			   		<thead>
			   			<tr>
			   				<th>Category</th>
			   				<th>Description</th>
			   				<th>Actions</th>
			   			</tr>
			   		</thead>
		
			   		<tbody>

			   			<tr class="success">
			   				<?php echo $this->Form->create('Category', $options = array('id'=>'form-add-dataset-category', 'url'=>array('controller'=>'Ajax', 'action'=>'saveCategoryDataset'))); ?>
				   				<td> <?php echo $this->Form->input('name', $options = array('class'=>'form-control', 'label'=>false)); ?> </td>
				   				<td> <?php echo $this->Form->input('description', $options = array('class'=>'form-control', 'type'=>'text', 'label'=>false)); ?> </td>
				   				<td> <?php echo $this->Form->button('Add', $options = array('class'=>'btn btn-success')); ?> </td>
			   				<?php echo $this->Form->end(); ?>
			   			</tr>

			   			<!--recorre user for populate table users-->
			   			<?php foreach ($categories as $key => $category) { ?>
			   				
			   			<tr>
			   				<?php echo $this->Form->create('Category', $options = array( 'class' => 'form-category-edit', 'url'=>array('controller' => 'Ajax', 'action'=>'saveCategoryDataset' ) )); ?>

			   					<?php echo $this->Form->input('id', $options = array('value'=>$category['Category']['id'])); ?>
				   				
				   				<td> <?php echo $this->Form->input('name', $options = array('value'=>$category['Category']['name'], 'label'=>false, 'div'=>false, 'class'=>'form-control')); ?> </td>

				   				<td> <?php echo $this->Form->input('description', $options = array('type'=>'text', 'value'=>$category['Category']['description'], 'label'=>false, 'div'=>false, 'class'=>'form-control')); ?> </td>

				   				<td>
				   					<?php echo $this->Form->button('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>', $options = array('type'=>'submit', 'class'=>'btn btn-primary btn-xs', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Save Changes")); ?>
					   		
					   				<?php echo $this->Form->end(); ?>

									<?php echo $this->Html->link('<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>', array('controller' => 'Admin', 'action' => 'providers', $category['Category']['id']), array('escape' => false, 'class'=>'btn btn-default btn-xs', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Providers") ); ?>

				   					<?php echo $this->Form->postLink(__(' <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> '), array('action' => 'delete', $category['Category']['id'],'category'), array('class'=>'btn btn-danger btn-xs', 'escape'=>false, 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Delete"), __('Are you sure to delete the Category " %s " ?', $category['Category']['name'])); ?>
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
