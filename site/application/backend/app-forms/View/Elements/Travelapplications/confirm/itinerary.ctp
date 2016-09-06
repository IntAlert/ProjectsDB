<h2>Itinerary</h2>
<div class="itinerary-item" ng-repeat="(i, itinerary_item) in formData.itinerary">


	<h3>Leg #{{i+1}}</h3>
	
	<table>
		<tbody>
			<tr>
				<th>
					Start
				</th>
				<td>
					{{itinerary_item.start | date : "dd/MM/yyyy"}}
				</td>
			</tr>
			<tr>


				<th>
					Finish
				</th>
				<td>
					{{itinerary_item.finish | date : "dd/MM/yyyy"}}
				</td>
			</tr>
			<tr>


				<th>
					Origin
				</th>
				<td>
					{{itinerary_item.origin.Territory.name || "Not Specified"}}
				</td>
			</tr>
			<tr>


				<th>
					Destination
				</th>
				<td>
					{{itinerary_item.destination.Territory.name}}
				</td>
			</tr>
			<tr>


				<th>
					Transport Details
				</th>
				<td>
					{{itinerary_item.transport.detail}}
				</td>
			</tr>
			<tr>


				<th>
					Transport Phone numbers
				</th>
				<td>
					{{itinerary_item.transport.phone}}
				</td>
			</tr>
			<tr>


				<th>
					Transport Email Address(es)
				</th>
				<td>
					{{itinerary_item.transport.email}}
				</td>
			</tr>
			<tr>


				<th>
					Accommodation
				</th>
				<td>
					{{itinerary_item.accommodation.detail}}
				</td>
			</tr>
			<tr>


				<th>
					Accommodation Email Address(es)
				</th>
				<td>
					{{itinerary_item.accommodation.email}}
				</td>
			</tr>
			<tr>


				<th>
					Accommodation Phone numbers
				</th>
				<td>
					{{itinerary_item.accommodation.phone}}
				</td>
			</tr>

		</tbody>
	</table>
</div>