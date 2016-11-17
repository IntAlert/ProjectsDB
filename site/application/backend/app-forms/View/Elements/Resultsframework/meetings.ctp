<div ng-controller="MeetingsController">
	<h2>Dialogue Meeting Summary</h2>

	<table>


		<tr>
			<th>Number of sustained dialogue meetings conducted</th>
			<td>{{data.totals.meeting_count || 0}}</td>
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
			<th>The dialogue sought to resolve a specific conflict issue between groups or entities </th>
			<td>{{data.totals.conflict_resolution ? 'YES': 'NO'}}</td>
		</tr>

		<tr>
			<th>What kinds of groups or entities were involved in the dialogue meetings?</th>
			<td>
				<span ng-repeat="participant_type in data.totals.participant_types">
						{{participant_type.name}}{{$last ? '' : ', '}}
				</span>
				<span ng-if=" !data.totals.participant_types.length ">
					none
				</span>
			</td>
		</tr>

		<tr>
			<th>Topics in dialogue meetings?</th>
			<td>
				<span ng-repeat="theme in data.totals.themes">
						{{theme.name}}{{$last ? '' : ', '}}
				</span>
				<span ng-if=" !data.totals.themes.length ">
					none
				</span>
			</td>
		</tr>

	</table>





	<div class="item-list-header clearfix">
		<h2>Dialogue Meetings</h2>

		<md-button class="md-raised" ng-click="showDialogueMeetingItemDialog()">Add Dialogue Meeting</md-button>

	</div>

	<div ng-hide="data.items.length">
		None
	</div>

	<table ng-show=" data.items.length ">
		<thead>
			<tr>

				<th>
					Date
				</th>


				<th>
					Title
				</th>

				<th>
					Themes
				</th>

				<th>
					Participants
				</th>

				<th>
					Sessions
				</th>

				<th>
					Men
				</th>

				<th>
					Women
				</th>

				<th title="The dialogue seek to resolve a specific conflict issue between groups or entities">
					Conflict resolution?
				</th>
				<th width="25%"></th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="(i, meeting) in data.items">

				<td>
					{{meeting.Meeting.date | date:'dd/MM/yyyy'}}
				</td>


				<td>
					{{meeting.Meeting.title}}
				</td>

				<td>
					<span ng-repeat="theme in meeting.Theme">
						{{theme.name}}{{$last ? '' : ', '}}
					</span>
					<span ng-if=" !meeting.Theme.length ">
						none
					</span>
				</td>

				<td>
					<span ng-repeat="participant_type in meeting.ParticipantType">
						{{participant_type.name}}{{$last ? '' : ', '}}
					</span>
					<span ng-if=" !meeting.ParticipantType.length ">
						none
					</span>
				</td>
				<td>
					{{meeting.Meeting.session_count}}
				</td>

				<td>
					{{meeting.Meeting.male_count}}
				</td>

				<td>
					{{meeting.Meeting.female_count}}
				</td>

				<td>
					{{meeting.Meeting.conflict_resolution ? 'YES': 'NO'}}
				</td>
				<td>

					<md-button 
						class="md-raised" 
						ng-click="showDialogueMeetingItemDialog(i)">
						Edit
					</md-button>

					<md-button 
						class="md-raised" 
						ng-click="removeDialogueMeetingItem(meeting.Meeting.id)">
						Remove
					</md-button>

				</td>
			</tr>
		</tbody>
		
	</table>
</div>
