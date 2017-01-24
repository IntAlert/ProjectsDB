<h2>Itinerary</h2>

<?php foreach ($travelapplicationObj->itinerary as $i => $itineraryItem): ?>


<div>


	<h3>Leg #<?php echo $i + 1; ?></h3>
	
	<table width="100%">
		<tbody>
			<tr width="50%">
				<th>
					Start
				</th>
				<td>
					<?php echo $this->Time->format($itineraryItem->start, '%d/%m/%Y');?>
				</td>
			</tr>
			<tr width="50%">


				<th>
					Finish
				</th>
				<td>
					<?php echo $this->Time->format($itineraryItem->finish, '%d/%m/%Y');?>
				</td>
			</tr>
			<tr width="50%">


				<th>
					Origin
				</th>
				<td>
					<?php echo $itineraryItem->origin->Territory->name;?>
				</td>
			</tr>
			<tr width="50%">


				<th>
					Destination
				</th>
				<td>
					<?php echo $itineraryItem->destination->Territory->name;?>
				</td>
			</tr>
			<tr width="50%">


				<th>
					Transport Details
				</th>
				<td>
					<?php echo $itineraryItem->transport->detail;?>
				</td>
			</tr>
			<tr width="50%">


				<th>
					Transport Phone numbers
				</th>
				<td>
					<?php echo property_exists($itineraryItem->transport, 'phone') ? $itineraryItem->transport->phone : 'n/a';?>
				</td>
			</tr>
			<tr width="50%">


				<th>
					Transport Email Address(es)
				</th>
				<td>
					<?php echo property_exists($itineraryItem->transport, 'email') ? $itineraryItem->transport->email : 'n/a';?>
				</td>
			</tr>
			<tr width="50%">


				<th>
					Accommodation
				</th>
				<td>
					<?php echo $itineraryItem->accommodation->detail;?>
				</td>
			</tr>
			<tr width="50%">


				<th>
					Accommodation Email Address(es)
				</th>
				<td>
					<?php echo $itineraryItem->accommodation->email;?>
				</td>
			</tr>
			<tr width="50%">


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