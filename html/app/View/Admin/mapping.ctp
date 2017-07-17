<!--COVER-->
<section id="top">
	<?php echo $this->element('nav', array('viewName' => 'Dashboard')); ?>
</section>
<!--END COVER-->

<section class="admin"  id="match">
	
	<div class="container">

		<div class="row">
			<?php echo $this->element('admin_nav'); ?>
		</div>

		<h3>Mapping</h3>

		<div class="row">

			<?php 
				if(isset( $dataset_a ) and isset( $dataset_b )){
					$selected_a = $dataset_a;
					$selected_b = $dataset_b;
				} else {
					$selected_a = null;
					$selected_b = null;
				} 
			?>

		</div>

		<div class="row">
			<div class="table-responsive">
				<table class="table table-hover" id="table-results">
			    
					<thead id="thead-results">
						<?php echo $this->Form->create(null, $options = array('id'=>'formForMapping' )); ?>
						<tr>
							<th><?php echo $this->Form->input('dataset_a_id', $options = array('options'=>$datasets, 'div'=>false, 'name'=>'dataset_a_id', 'selected'=>  $selected_a, 'class'=>'form-control' )); ?></th>
							<th><?php echo $this->Form->input('dataset_b_id', $options = array('options'=>$datasets, 'div'=>false, 'name'=>'dataset_b_id', 'selected'=>  $selected_b, 'class'=>'form-control' )); ?></th>
							<th><?php echo $this->Form->button('Send', $options = array('class'=>'btn btn-primary ', 'type'=>'submit')); ?></th>
						</tr>
						<?php echo $this->Form->end(); ?>
					</thead>

					<tbody id="tbody-results">
						
						<?php if ( isset($rows) ) { ?>
							
							<?php echo $this->Form->create(null, $options = array('id'=>'formOptionsForMapping', 'url' => array('controller'=>'Admin', 'action' => 'saveMapping', $selected_a, $selected_b ))); ?>
							
							<?php for ($i=0; $i < $rows; $i++) {  ?>
								<tr>
									<td><?php echo $this->Form->input(null, $options = array('options'=> $array_a_less, 'name'=>$i.'[]', 'class'=>'combo-for-match combo-for-match-a', 'label'=>'Value in A: ' )); ?></td>
									<td><?php echo $this->Form->input(null, $options = array('options'=> $array_b_less, 'name'=>$i.'[]', 'class'=>'combo-for-match combo-for-match-b', 'label'=>'Value in B: ' )); ?></td>
									<td></td>
								</tr>
							<?php } ?>
								<tr>
									<td></td>
									<td></td>
									<td><?php echo $this->Form->button('Save', $options = array('type'=>'submit', 'class'=>'btn btn-success')); ?></td>
								</tr>
							<?php echo $this->Form->end(); ?>
						<?php } ?>

					</tbody>

				</table>
			</div>
		</div>

		<div class="row">
			<?php foreach ($mappings as $value) { ?>
				<div class="row">
					<h4><?php echo $value['Mapping']['name']; ?></h4>
					<p><?php echo $value['Mapping']['mapping']; ?></p>
				</div>
			<?php } ?>
		</div>

	</div>

</section>
<?php echo $this->element('side_nav', array('viewName' => 'NewScenario')); ?>

