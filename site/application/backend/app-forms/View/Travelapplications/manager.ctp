<div class="travelapplications index">
	<h2><?php echo __('Travel Applications'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('applicant_user_id', 'Applicant'); ?></th>
			<th><?php echo $this->Paginator->sort('manager_user_id', 'Approving Manager'); ?></th>
			<th>Destinations</th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($travelapplications as $travelapplication): ?>
	<tr>
		<td>
			<?php echo $travelapplication['Applicant']['name_formal'] ?>
		</td>
		<td>
			<?php echo $travelapplication['ApprovingManager']['name_formal'] ?>
		</td>

		<td>
			<?php 
				$destination_csv = [];
				foreach ($travelapplication['TravelapplicationItinerary'] as $itinerary) {
					$destination_csv[] = $itinerary['Destination']['name'];
				}

				echo implode($destination_csv, ', ') 
			?>
		</td>

		<td><?php echo $this->Time->nice($travelapplication['Travelapplication']['created']); ?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $travelapplication['Travelapplication']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>