<div ng-controller="AdvocaciesController">
	<h2>Advocacy and Outreach Summary</h2>

	<table>
		<tr>
			<th>How many male participants in public advocacy meetings</th>
			<td>
				{{data.totals.female_count || 0}}
			</td>
		</tr>

		<tr>
			<th>How many female participants in public advocacy meetings</th>
			<td>
				{{data.totals.male_count || 0}}
			</td>
		</tr>

		<tr ng-repeat="(participant_type, count) in data.totals.participant_types">
			<th>{{participant_type}}</th>
			<td>{{count || 0}}</td>
		</tr>

		<tr>
			<th>Topics</th>
			<td>
				<span ng-repeat="theme in data.totals.themes">
						{{theme.name}}{{$last ? '' : ', '}}
				</span>
				<span ng-if=" !data.totals.themes.length ">
					none
				</span>
			</td>
		</tr>

		<!-- <tr>
			<th>Participant Types</th>
			<td>
				<span ng-repeat="participant_type in data.totals.participant_types">
						{{participant_type.ParticipantType.name}}{{$last ? '' : ', '}}
				</span>
				<span ng-if=" !data.totals.participant_types.length ">
					none
				</span>
			</td>
		</tr> -->


	</table>




	<div class="item-list-header clearfix">
		<h2>Advocacy and Outreach</h2>

		<md-button class="md-raised" ng-click="showAdvocacyItemDialog()">Add Advocacy/Outreach</md-button>

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
					Participant Types
				</th>

				<th>
					Number of Males
				</th>

				<th>
					Number of Females
				</th>

				<th>
					Topics
				</th>

				<th width="25%"></th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="(i, advocacy) in data.items">
				<td>
					{{advocacy.Advocacy.start_date | date:'dd/MM/yyyy'}}
				</td>

				<td>
					{{advocacy.Advocacy.finish_date | date:'dd/MM/yyyy'}}
				</td>

				<td>
					{{advocacy.Advocacy.title}}
				</td>


				<td>
					<span ng-repeat="participant_type in advocacy.ParticipantType | filter:cutOutZero()">
					
						{{participant_type.name}}
						({{participant_type.AdvocaciesParticipantType.count}}){{$last ? '' : ', '}}
					
					</span>
				</td>

				<td>
					{{advocacy.Advocacy.male_count}}
				</td>

				<td>
					{{advocacy.Advocacy.female_count}}
				</td>

				<td>
					<span ng-repeat="theme in advocacy.Theme">
						{{theme.name}}{{$last ? '' : ', '}}
					</span>
					<span ng-if=" !advocacy.Theme.length ">
						none
					</span>
				</td>


				
				<td>

					<md-button 
						class="md-raised" 
						ng-click="showAdvocacyItemDialog(i)">
						Edit
					</md-button>

					<md-button 
						class="md-raised" 
						ng-click="removeAdvocacyItem(advocacy.Advocacy.id)">
						Remove
					</md-button>

				</td>
			</tr>
		</tbody>
		
	</table>

</div>


