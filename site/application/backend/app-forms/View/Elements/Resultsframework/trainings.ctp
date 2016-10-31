<h2>Training Summary</h2>
<table>
	<tr>
		<th>How many training and learning events were carried out within the project, whether by Alert or partners?</th>
		<td>{{data.record.trainings.totals.event_count || 0}}</td>
	</tr>

	<tr>
		<th>How many male participants took part?</th>
		<td>{{data.record.trainings.totals.male_count || 0}}</td>
	</tr>

	<tr>
		<th>How many female participants took part?</th>
		<td>{{data.record.trainings.totals.female_count || 0}}</td>
	</tr>
	<tr>
		<th>Themes</th>
		<td>
			<span ng-repeat="theme in data.record.trainings.totals.themes">
					{{theme.Theme.name}}{{$last ? '' : ', '}}
			</span>
			<span ng-if=" !data.trainings.totals.themes.length ">
				none
			</span>
		</td>
	</tr>

	<tr>
		<th>Participant Types</th>
		<td>
			<span ng-repeat="participant_type in data.record.trainings.totals.participant_types">
					{{participant_type.name}}{{$last ? '' : ', '}}
			</span>
			<span ng-if=" !data.trainings.totals.participant_types.length ">
				none
			</span>
		</td>
	</tr>
</table>


<div class="item-list-header clearfix">
	<h2>Training</h2>

	<md-button 
		class="md-raised" 
		ng-click="showTrainingItemDialog()">Add Training</md-button>

</div>

<div ng-hide="data.record.trainings.items.length">
	None
</div>

<table ng-show=" data.record.trainings.items.length ">
	<thead>
		<tr>
			<th>
				Title
			</th>

			<th>
				Date
			</th>

			<th>
				Themes
			</th>

			<th>
				Partipant Types
			</th>

			<th>
				Male Participants
			</th>

			<th>
				Female Participants
			</th>
			<th width="25%"></th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="(i, training) in data.record.trainings.items">
			<td>
				{{training.title}}
			</td>

			<td>
				{{training.date | date:'dd/MM/yyyy'}}
			</td>

			<td>
				<span ng-repeat="theme in training.themes">
					{{theme.Theme.name}}{{$last ? '' : ', '}}
				</span>
				<span ng-if=" !training.themes.length ">
					none
				</span>
			</td>

			<td>
				<span ng-repeat="participant_type in training.participant_types">
					{{participant_type.name}}{{$last ? '' : ', '}}
				</span>
				<span ng-if=" !training.participant_types.length ">
					none
				</span>
			</td>

			<td>
				{{training.male_count || 0}}
			</td>

			<td>
				{{training.female_count || 0}}
			</td>
			<td>

				<md-button 
					class="md-raised" 
					ng-click="showTrainingItemDialog(i)">
					Edit
				</md-button>

				<md-button 
					class="md-raised" 
					ng-click="removeTrainingItem(i)">
					Remove
				</md-button>

			</td>
		</tr>
	</tbody>
	
</table>
