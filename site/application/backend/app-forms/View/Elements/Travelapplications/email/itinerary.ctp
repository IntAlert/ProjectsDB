<h2>Itinerary</h2>

<?php foreach ($travelapplicationObj->itinerary as $i => $itineraryItem): ?>


<div>


	<h3>Leg #<?php echo $i + 1; ?></h3>
	
	<table>
		<tbody>
			<tr>
				<th>
					Start
				</th>
				<td>
					<?php echo $this->Time->format($itineraryItem->start, '%d/%m/%Y');?>
				</td>
			</tr>
			<tr>


				<th>
					Finish
				</th>
				<td>
					<?php echo $this->Time->format($itineraryItem->finish, '%d/%m/%Y');?>
				</td>
			</tr>
			<tr>


				<th>
					Origin
				</th>
				<td>
					<?php echo $itineraryItem->origin->Territory->name;?>
				</td>
			</tr>
			<tr>


				<th>
					Destination
				</th>
				<td>
					<?php echo $itineraryItem->destination->Territory->name;?>
				</td>
			</tr>
			<tr>


				<th>
					Transport Details
				</th>
				<td>
					<?php echo $itineraryItem->transport->detail;?>
				</td>
			</tr>
			<tr>


				<th>
					Transport Phone numbers
				</th>
				<td>
					<?php echo $itineraryItem->transport->phone;?>
				</td>
			</tr>
			<tr>


				<th>
					Transport Email Address(es)
				</th>
				<td>
					<?php echo $itineraryItem->transport->email;?>
				</td>
			</tr>
			<tr>


				<th>
					Accommodation
				</th>
				<td>
					<?php echo $itineraryItem->accommodation->detail;?>
				</td>
			</tr>
			<tr>


				<th>
					Accommodation Email Address(es)
				</th>
				<td>
					<?php echo $itineraryItem->accommodation->email;?>
				</td>
			</tr>
			<tr>


				<th>
					Accommodation Phone numbers
				</th>
				<td>
					<?php echo $itineraryItem->accommodation->phone;?>
				</td>
			</tr>

		</tbody>
	</table>
</div>

<?php endforeach; // ($travelapplicationObj->itinerary as $itinerary): ?>