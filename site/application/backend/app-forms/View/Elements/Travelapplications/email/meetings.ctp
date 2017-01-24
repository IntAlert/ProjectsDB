<?php if (count($travelapplicationObj->schedule)): ?>
<h2>Meetings</h2>
<table>
	<thead>
		<tr width="50%">
			<th>
				Date
			</th>

			<th>
				Time
			</th>

			<th>
				Organisation and contact
			</th>

			<th>
				Full Address
			</th>

			<th>
				Email
			</th>

			<th>
				Confirmed
			</th>
		</tr>
			
	</thead>

	<tbody 
		ng-repeat="(i, schedule_item) in formData.schedule"
	>

<?php foreach($travelapplicationObj->schedule as $meeting): ?>
		<tr width="50%">
			<td>
				<!-- Date -->
				<?php echo $this->Time->format($meeting->date, '%d/%m/%Y'); ?>

			</td>

			<td>
				<!-- Time -->
				<?php echo $meeting->time; ?>
			</td>

			<td>
				<!-- Organisation and contact -->
				<?php echo $meeting->org_contact; ?>
			</td>

			<td>
				<!-- Full Address -->
				
				<?php echo $meeting->address; ?>
			</td>

			<td>
				<!-- Email -->
				<?php echo $meeting->email; ?>
			</td>

			<td>
				<!-- Confirmed -->
				<?php echo property_exists($meeting, 'confirmed') && $meeting->confirmed ? 'Confirmed' : 'No'; ?>
			</td>

		</tr>
<?php endforeach; //($travelapplicationObj->schedule as $meeting): ?>
		
	</tbody>
</table>
<?php endif; // ($travelapplicationObj->meetings): ?>