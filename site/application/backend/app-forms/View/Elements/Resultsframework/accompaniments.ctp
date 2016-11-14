<h2>Accompaniment Summary</h2>
<table>
	<tr ng-repeat="(i, participant_type) in FormOptions.participant_types">
		<th>{{participant_type.ParticipantType.name}}</th>
		<td>{{data.totals.participant_type_counts[participant_type.ParticipantType.id] || 0}}</td>
	</tr>
</table>




<div class="item-list-header clearfix">
	<h2>Accompaniments</h2>

	<md-button class="md-raised" ng-click="showAccompanimentItemDialog()">Add Accompaniment</md-button>

</div>


<div ng-hide="data.items.length">
	None
</div>


<table ng-show=" data.items.length ">
	<thead>
		<tr>
			<th>
				Title
			</th>

			<th>
				Date
			</th>

			<th>
				Participant Types
			</th>

			<th width="25%"></th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="(i, accompaniment) in data.items">
			<td>
				{{accompaniment.Accompaniment.title}}
			</td>


			<td>
				{{accompaniment.Accompaniment.date | date:'dd/MM/yyyy'}}
			</td>


			<td>
				<span ng-repeat="participant_type in accompaniment.ParticipantType | filter:cutOutZero()">
				
					{{participant_type.name}}
					({{participant_type.AccompanimentsParticipantType.count}}){{$last ? '' : ', '}}
				
				</span>
			</td>
			
			<td>

				<md-button 
					class="md-raised" 
					ng-click="showAccompanimentItemDialog(i)">
					Edit
				</md-button>

				<md-button 
					class="md-raised" 
					ng-click="removeAccompanimentItem(accompaniment.Accompaniment.id)">
					Remove
				</md-button>

			</td>
		</tr>
	</tbody>
	
</table>





