<div ng-controller="OtherActivitiesController">
	<h2>Other Activities Summary</h2>

	<table>

		<tr>
			<th>Number of activities</th>
			<td>{{data.totals.session_count || 0}}</td>
		</tr>

		<tr>
			<th>How many men took part (cumulative)?</th>
			<td>{{data.totals.male_count || 0}}</td>
		</tr>

		<tr>
			<th>How many women took part (cumulative) ?</th>
			<td>{{data.totals.female_count || 0}}</td>
		</tr>

		<tr>
			<th>How many gender-unspecified people took part (cumulative) ?</th>
			<td>{{data.totals.transgender_count || 0}}</td>
		</tr>

		<tr>
			<th>What kinds of groups or entities were involved in these activities?</th>
			<td>
				<span ng-repeat="participant_type in data.totals.participant_types">
						{{participant_type.name}}{{$last ? '' : ', '}}
				</span>
				<span ng-if=" !data.totals.participant_types.length ">
					none
				</span>
			</td>
		</tr>

	</table>





	<div class="item-list-header clearfix">
		<h2>Other Activities</h2>

		<md-button class="md-raised" ng-click="showDialogueOtherActivityItemDialog()">Add Other Activity</md-button>

	</div>

	<div ng-hide="data.items.length">
		None
	</div>

	<table ng-show=" data.items.length ">
		<thead>
			<tr>

				<th>
					Start Date
				</th>

				<th>
					Finish Date
				</th>


				<th>
					Activity Title
				</th>

				<th>
					Activity Type
				</th>

				<th>
					Participants
				</th>

				<th>
					Men
				</th>

				<th>
					Women
				</th>

				<th>
					Transgender
				</th>

				<th width="25%"></th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="(i, other_activity) in data.items">

				<td>
					{{other_activity.OtherActivity.start_date | date:'dd/MM/yyyy'}}
				</td>

				<td>
					{{other_activity.OtherActivity.finish_date | date:'dd/MM/yyyy'}}
				</td>


				<td>
					{{other_activity.OtherActivity.title}}
				</td>

				<td>
					{{other_activity.OtherActivity.type}}
				</td>

				<td>
					<span ng-repeat="participant_type in other_activity.ParticipantType">
						{{participant_type.name}}{{$last ? '' : ', '}}
					</span>
					<span ng-if=" !other_activity.ParticipantType.length ">
						none
					</span>
				</td>

				<td>
					{{other_activity.OtherActivity.male_count}}
				</td>

				<td>
					{{other_activity.OtherActivity.female_count}}
				</td>

				<td>
					{{other_activity.OtherActivity.transgender_count}}
				</td>

				<td>

					<md-button 
						class="md-raised" 
						ng-click="showDialogueOtherActivityItemDialog(i)">
						Edit
					</md-button>

					<md-button 
						class="md-raised" 
						ng-click="removeDialogueOtherActivityItem(other_activity.OtherActivity.id)">
						Remove
					</md-button>

				</td>
			</tr>
		</tbody>
		
	</table>
</div>
