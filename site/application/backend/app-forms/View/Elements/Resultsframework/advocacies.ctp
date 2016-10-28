<table>
	<tr>
		<th>How many male participants in public advocacy meetings</th>
		<td>
			{{data.record.advocacies.totals.female_count || 0}}
		</td>
	</tr>

	<tr>
		<th>How many female participants in public advocacy meetings</th>
		<td>
			{{data.record.advocacies.totals.male_count || 0}}
		</td>
	</tr>

	<tr ng-repeat="(participant_type, count) in data.record.advocacies.totals.participant_types">
		<th>{{participant_type}}</th>
		<td>{{count || 0}}</td>
	</tr>

	<tr>
		<th>Topics</th>
		<td>
			<span ng-repeat="theme in data.record.advocacies.totals.themes">
					{{theme.Theme.name}}{{$last ? '' : ', '}}
			</span>
			<span ng-if=" !data.advocacies.totals.themes.length ">
				none
			</span>
		</td>
	</tr>

	<!-- <tr>
		<th>Participant Types</th>
		<td>
			<span ng-repeat="participant_type in data.record.advocacies.totals.participant_types">
					{{participant_type.name}}{{$last ? '' : ', '}}
			</span>
			<span ng-if=" !data.record.advocacies.totals.participant_types.length ">
				none
			</span>
		</td>
	</tr> -->


</table>



<h2>Advocacy and Outreach</h2>
<table ng-show=" data.record.advocacies.items.length ">
	<thead>
		<tr>
			<th>
				Title
			</th>

			<th>
				Date
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
		<tr ng-repeat="(i, advocacy) in data.record.advocacies.items">
			<td>
				{{advocacy.title}}
			</td>

			<td>
				{{advocacy.date | date:'dd/MM/yyyy'}}
			</td>

			<td>
				<span ng-repeat="(name, count) in advocacy.participant_types">
					<span ng-if="count">
						{{name}}
						({{count}}){{$last ? '' : ', '}}
					</span>
				</span>
			</td>

			<td>
				{{advocacy.male_count}}
			</td>

			<td>
				{{advocacy.female_count}}
			</td>

			<td>
				<span ng-repeat="theme in advocacy.themes">
					{{theme.Theme.name}}{{$last ? '' : ', '}}
				</span>
				<span ng-if=" !advocacy.themes.length ">
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
					ng-click="removeAdvocacyItem(i)">
					Remove
				</md-button>

			</td>
		</tr>
	</tbody>
	
</table>

<md-button class="md-raised" ng-click="showAdvocacyItemDialog()">Add Advocacy/Outreach</md-button>




<pre>
	{{data.record.advocacies | json}}
</pre>