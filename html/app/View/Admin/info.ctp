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
		<h3>Info Popups <?php echo $this->Html->link( '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>' , 
								array('controller' => 'Admin', 'action' => 'infoCreate' ), 
								array('escape' => false, 'class' => 'btn btn-primary btn-xs', 
								'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Create new info popup" )  ); ?>  </h3>
		
		<div class="row">
			
			
			<div class="table-responsive" style="border-top:1px solid #ddd;">
				
				<table class="table table-hover table-bordered" id="table-results">
					<thead id="thead-results">
						<tr>
							<th>Link</th>
							<th>Page</th>
							<th>Title</th>
							<th style="width:70px;">Actions</th>
						</tr>
					</thead>

					<tbody id="tbody-results">
			   			<?php foreach ($info as $r) { ?>
							<tr>
								<td><?php echo $r['Info']['link']?></td>
								<td><?php echo $r['Info']['page']?></td>
								<td><?php echo $r['Info']['name']?></td>
								<td>
									<a href="/admin/infoEdit/<?php echo $r['Info']['id']?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Popup Content"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a>			
									
								

			   					<?php echo $this->Form->postLink(__(' <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> '),
				   					array('action' => 'infoDelete', $r['Info']['id']),
				   					 array('class'=>'btn btn-danger btn-xs', 'escape'=>false, 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"Delete"), __('Are you sure to delete the Item " %s " ?', $r['Info']['name'])); ?>								
									
											
									<?php echo $this->Form->end(); ?>
									
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

