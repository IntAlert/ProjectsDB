<div ng-controller="ProcessesController">
	
	<h2>Dialogue Process Summary</h2>

	<table>


		<tr>
			<th>Number of sustained dialogue processes conducted</th>
			<td>{{data.totals.process_count || 0}}</td>
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
			By "dialogue processes", we mean sustained processes of dialogue in which the same groups of people were brought together over a series of meetings.
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
					Start Date
				</th>

				<th>
					Finish Date
				</th>

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

				<th title="The dialogue seek to resolve a specific conflict issue between groups or entities">
					Conflict resolution?
				</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="(i, process) in data.items">
				<td>
					{{process.Process.start_date | date:'dd/MM/yyyy'}}
				</td>

				<td>
					{{process.Process.finish_date | date:'dd/MM/yyyy'}}
				</td>


				<td>
					{{process.Process.title}}
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

</div>

