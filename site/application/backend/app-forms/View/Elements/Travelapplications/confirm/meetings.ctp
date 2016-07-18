<h2>Meetings</h2>

<table>
	<thead>
		<tr>
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


		<tr>
			<td>
				<!-- Date -->
				{{schedule_item.date | date : "dd/MM/yyyy" }}


			</td>

			<td>
				<!-- Time -->
				{{schedule_item.time}}
			</td>

			<td>
				<!-- Organisation and contact -->
				{{schedule_item.org_contact}}
			</td>

			<td>
				<!-- Full Address -->
				
				{{schedule_item.address}}
			</td>

			<td>
				<!-- Email -->
				{{schedule_item.email}}
			</td>

			<td>
				<!-- Confirmed -->
				{{schedule_item.confirmed ? 'Confirmed' : 'Not confirmed'}}
			</td>

		</tr>

		
	</tbody>
</table>