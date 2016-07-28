<table>
	<thead>
		<tr>
			<th>
				Title
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
		<tr ng-repeat="(i, training) in data.trainings">
			<td>
				{{training.title}}
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

<md-button class="md-raised" ng-click="showTrainingItemDialog()">Add</md-button>
