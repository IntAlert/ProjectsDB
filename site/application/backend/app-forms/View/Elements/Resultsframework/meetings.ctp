<h2>Dialog Meeting Summary</h2>

<table>


	<tr>
		<th>Number of sustained dialogue meetings conducted</th>
		<td>{{data.totals.meeting_count || 0}}</td>
	</tr>

	<tr>
		<th>How many female participants took part (cumulative)?</th>
		<td>{{data.totals.male_count || 0}}</td>
	</tr>

	<tr>
		<th>How many female participants took part (cumulative) ?</th>
		<td>{{data.totals.female_count || 0}}</td>
	</tr>

	<tr>
		<th>Number of males for whom trauma-counselling services were provided (cumulative)?</th>
		<td>{{data.totals.male_trauma_count || 0}}</td>
	</tr>

	<tr>
		<th>Number of females for whom trauma-counselling services were provided (cumulative) ?</th>
		<td>{{data.totals.female_trauma_count || 0}}</td>
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
	<h2>Meetings</h2>

	<md-button class="md-raised" ng-click="showDialogueMeetingItemDialog()">Add Dialog Meeting</md-button>

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
				Themes
			</th>

			<th>
				Participant Types
			</th>

			<th>
				Number of Sessions
			</th>

			<th>
				Male Participants
			</th>

			<th>
				Female Participants
			</th>

			<th>
				Male Participants (Trauma-councelled)
			</th>

			<th>
				Female Participants (Trauma-councelled)
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
				{{meeting.Meeting.title}}
			</td>

			<td>
				{{meeting.Meeting.date | date:'dd/MM/yyyy'}}
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
				{{meeting.Meeting.male_trauma_count}}
			</td>

			<td>
				{{meeting.Meeting.female_trauma_count}}
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



