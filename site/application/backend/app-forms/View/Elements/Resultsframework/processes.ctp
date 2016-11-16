<h2>Dialog Process Summary</h2>

<table>


	<tr>
		<th>Number of sustained dialogue processes conducted</th>
		<td>{{data.totals.process_count || 0}}</td>
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
		<th>What kinds of groups or entities were involved in the dialogue processes?</th>
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
		<th>Topics in dialogue processes?</th>
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


<div class="instruction-block">
	<p>
		By 'dialogue processes', we mean sustained processes of dialogue in which the same groups of people were brought together over a series of meetings.
	</p>
	<p>
		"Sustained dialogue" signifie un processus continu de sessions de dialogue dans lequel les mêmes groupes de personnes ont été réunis dans une série de réunions. 
	</p>
</div>


<div class="item-list-header clearfix">
	<h2>Processes</h2>

	<md-button class="md-raised" ng-click="showDialogueProcessItemDialog()">Add Dialogue Process</md-button>

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
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="(i, process) in data.items">
			<td>
				{{process.Process.title}}
			</td>

			<td>
				{{process.Process.date | date:'dd/MM/yyyy'}}
			</td>

			<td>
				<span ng-repeat="theme in process.Theme">
					{{theme.name}}{{$last ? '' : ', '}}
				</span>
				<span ng-if=" !process.Theme.length ">
					none
				</span>
			</td>

			<td>
				<span ng-repeat="participant_type in process.ParticipantType">
					{{participant_type.name}}{{$last ? '' : ', '}}
				</span>
				<span ng-if=" !process.ParticipantType.length ">
					none
				</span>
			</td>
			<td>
				{{process.Process.session_count}}
			</td>

			<td>
				{{process.Process.male_count}}
			</td>

			<td>
				{{process.Process.female_count}}
			</td>

			<td>
				{{process.Process.male_trauma_count}}
			</td>

			<td>
				{{process.Process.female_trauma_count}}
			</td>

			<td>
				{{process.Process.conflict_resolution ? 'YES': 'NO'}}
			</td>
			<td>

				<md-button 
					class="md-raised" 
					ng-click="showDialogueProcessItemDialog(i)">
					Edit
				</md-button>

				<md-button 
					class="md-raised" 
					ng-click="removeDialogueProcessItem(process.Process.id)">
					Remove
				</md-button>

			</td>
		</tr>
	</tbody>
	
</table>



