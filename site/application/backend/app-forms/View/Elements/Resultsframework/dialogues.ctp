<h2>Dialog Summary</h2>

<table>


	<tr>
		<th>Number of sustained dialogue processes conducted</th>
		<td>{{data.record.dialogues.totals.process_count || 0}}</td>
	</tr>

	<tr>
		<th>Number of separate dialogue meetings, including mediation sessions, facilitated / organised?</th>
		<td>{{data.record.dialogues.totals.meeting_count || 0}}</td>
	</tr>


	<tr>
		<th>How many female participants took part (cumulative)?</th>
		<td>{{data.record.dialogues.totals.male_count || 0}}</td>
	</tr>

	<tr>
		<th>How many female participants took part (cumulative) ?</th>
		<td>{{data.record.dialogues.totals.female_count || 0}}</td>
	</tr>

	<tr>
		<th>Number of males for whom trauma-counselling services were provided (cumulative)?</th>
		<td>{{data.record.dialogues.totals.male_trauma_count || 0}}</td>
	</tr>

	<tr>
		<th>Number of females for whom trauma-counselling services were provided (cumulative) ?</th>
		<td>{{data.record.dialogues.totals.female_trauma_count || 0}}</td>
	</tr>

	<tr>
		<th>The dialogue sought to resolve a specific conflict issue between groups or entities </th>
		<td>{{data.record.dialogues.totals.conflict_resolution ? 'YES': 'NO'}}</td>
	</tr>

	<tr>
		<th>What kinds of groups or entities were involved in the dialogue processes?</th>
		<td>
			<span ng-repeat="participant_type in data.record.dialogues.totals.participant_types_process">
					{{participant_type.name}}{{$last ? '' : ', '}}
			</span>
			<span ng-if=" !data.dialogues.totals.participant_types_process.length ">
				none
			</span>
		</td>
	</tr>

	<tr>
		<th>Topics in dialogue processes?</th>
		<td>
			<strong>DO NOT RECORD???</strong>
			<span ng-repeat="theme in data.record.dialogues.totals.themes_process">
					{{theme.Theme.name}}{{$last ? '' : ', '}}
			</span>
			<span ng-if=" !data.dialogues.totals.themes_process.length ">
				none
			</span>
		</td>
	</tr>

	<tr>
		<th>Kinds of participants / groups involved in dialogue meetings?</th>
		<td>
			<span ng-repeat="participant_type in data.record.dialogues.totals.participant_types_meeting">
					{{participant_type.name}}{{$last ? '' : ', '}}
			</span>
			<span ng-if=" !data.dialogues.totals.participant_types_meeting.length ">
				none
			</span>
		</td>
	</tr>

	<tr>
		<th>Topics in dialogue meetings?</th>
		<td>
			<span ng-repeat="theme in data.record.dialogues.totals.themes_meeting">
					{{theme.Theme.name}}{{$last ? '' : ', '}}
			</span>
			<span ng-if=" !data.dialogues.totals.themes_meeting.length ">
				none
			</span>
		</td>
	</tr>
</table>





<div class="item-list-header clearfix">
	<h2>Processes</h2>

	<md-button class="md-raised" ng-click="showDialogueProcessItemDialog()">Add Dialog Process</md-button>

</div>

<div ng-hide="data.record.dialogues.processes.items.length">
	None
</div>

<table ng-show=" data.record.dialogues.processes.items.length ">
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
		<tr ng-repeat="(i, dialogue) in data.record.dialogues.processes.items">
			<td>
				{{dialogue.title}}
			</td>

			<td>
				{{dialogue.date | date:'dd/MM/yyyy'}}
			</td>

			<td>
				<span ng-repeat="theme in dialogue.themes">
					{{theme.Theme.name}}{{$last ? '' : ', '}}
				</span>
				<span ng-if=" !dialogue.themes.length ">
					none
				</span>
			</td>

			<td>
				<span ng-repeat="participant_type in dialogue.participant_types">
					{{participant_type.name}}{{$last ? '' : ', '}}
				</span>
				<span ng-if=" !dialogue.participant_types.length ">
					none
				</span>
			</td>
			<td>
				{{dialogue.session_count}}
			</td>

			<td>
				{{dialogue.male_count}}
			</td>

			<td>
				{{dialogue.female_count}}
			</td>

			<td>
				{{dialogue.male_trauma_count}}
			</td>

			<td>
				{{dialogue.female_trauma_count}}
			</td>

			<td>
				{{dialogue.conflict_resolution ? 'YES': 'NO'}}
			</td>
			<td>

				<md-button 
					class="md-raised" 
					ng-click="showDialogueProcessItemDialog(i)">
					Edit
				</md-button>

				<md-button 
					class="md-raised" 
					ng-click="removeDialogueProcessItem(i)">
					Remove
				</md-button>

			</td>
		</tr>
	</tbody>
	
</table>






<div class="item-list-header clearfix">
	<h2>Meetings</h2>

	<md-button class="md-raised" ng-click="showDialogueProcessItemDialog()">Add Dialog Meeting</md-button>

</div>

<div ng-hide="data.record.dialogues.meetings.items.length">
	None
</div>

<table ng-show=" data.record.dialogues.meetings.items.length ">
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
		<tr ng-repeat="(i, dialogue) in data.record.dialogues.meetings.items">
			<td>
				{{dialogue.title}}
			</td>

			<td>
				{{dialogue.date | date:'dd/MM/yyyy'}}
			</td>

			<td>
				<span ng-repeat="theme in dialogue.themes">
					{{theme.Theme.name}}{{$last ? '' : ', '}}
				</span>
				<span ng-if=" !dialogue.themes.length ">
					none
				</span>
			</td>

			<td>
				<span ng-repeat="participant_type in dialogue.participant_types">
					{{participant_type.name}}{{$last ? '' : ', '}}
				</span>
				<span ng-if=" !dialogue.participant_types.length ">
					none
				</span>
			</td>
			<td>
				{{dialogue.session_count}}
			</td>

			<td>
				{{dialogue.male_count}}
			</td>

			<td>
				{{dialogue.female_count}}
			</td>

			<td>
				{{dialogue.male_trauma_count}}
			</td>

			<td>
				{{dialogue.female_trauma_count}}
			</td>

			<td>
				{{dialogue.conflict_resolution ? 'YES': 'NO'}}
			</td>
			<td>

				<md-button 
					class="md-raised" 
					ng-click="showDialogueMeetingItemDialog(i)">
					Edit
				</md-button>

				<md-button 
					class="md-raised" 
					ng-click="removeDialogueMeetingItem(i)">
					Remove
				</md-button>

			</td>
		</tr>
	</tbody>
	
</table>
