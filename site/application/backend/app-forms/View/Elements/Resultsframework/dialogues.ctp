

<table>


	<tr>
		<th>Number of sustained dialogue processes conducted</th>
		<td>{{data.dialogues.totals.process_count || 0}}</td>
	</tr>

	<tr>
		<th>Number of separate dialogue meetings, including mediation sessions, facilitated / organised?</th>
		<td>{{data.dialogues.totals.meeting_count || 0}}</td>
	</tr>


	<tr>
		<th>How many female participants took part (cumulative)?</th>
		<td>{{data.dialogues.totals.male_count || 0}}</td>
	</tr>

	<tr>
		<th>How many female participants took part (cumulative) ?</th>
		<td>{{data.dialogues.totals.female_count || 0}}</td>
	</tr>

	<tr>
		<th>Number of males for whom trauma-counselling services were provided (cumulative)?</th>
		<td>{{data.dialogues.totals.male_trauma_count || 0}}</td>
	</tr>

	<tr>
		<th>Number of females for whom trauma-counselling services were provided (cumulative) ?</th>
		<td>{{data.dialogues.totals.female_trauma_count || 0}}</td>
	</tr>

	<tr>
		<th>The dialogue sought to resolve a specific conflict issue between groups or entities </th>
		<td>{{data.dialogues.totals.conflict_resolution ? 'YES': 'NO'}}</td>
	</tr>
</table>




<h2>Processes</h2>
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
		<tr ng-repeat="(i, dialogue) in data.dialogues.processes.items">
			<td>
				{{dialogue.title}}
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

<md-button class="md-raised" ng-click="showDialogueProcessItemDialog()">Add Dialog Process</md-button>



<h2>Meetings</h2>
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
		<tr ng-repeat="(i, dialogue) in data.dialogues.meetings.items">
			<td>
				{{dialogue.title}}
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

<md-button class="md-raised" ng-click="showDialogueMeetingItemDialog()">Add Dialog Meeting</md-button>




<pre>{{data.dialogues | json}}</pre>