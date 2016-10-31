<h2>Accompaniment Summary</h2>
<table>
	<tr ng-repeat="(participant_type, count) in data.record.accompaniments.totals">
		<th>{{participant_type}}</th>
		<td>{{count || 0}}</td>
	</tr>
</table>




<div class="item-list-header clearfix">
	<h2>Accompaniments</h2>

	<md-button class="md-raised" ng-click="showAccompanimentItemDialog()">Add Accompaniment</md-button>

</div>


<div ng-hide="data.record.accompaniments.items.length">
	None
</div>


<table ng-show=" data.record.accompaniments.items.length ">
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
		<tr ng-repeat="(i, accompaniment) in data.record.accompaniments.items">
			<td>
				{{accompaniment.title}}
			</td>


			<td>
				{{accompaniment.date | date:'dd/MM/yyyy'}}
			</td>


			<td>
				<span ng-repeat="(name, count) in accompaniment.participant_types">
					<span ng-if="count">
						{{name}}
						({{count}}){{$last ? '' : ', '}}
					</span>
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
					ng-click="removeAccompanimentItem(i)">
					Remove
				</md-button>

			</td>
		</tr>
	</tbody>
	
</table>





