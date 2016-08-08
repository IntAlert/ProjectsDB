<table>
	<tr>
		<th>How many male participants in public advocacy meetings</th>
		<td>
			{{data.advocacies.totals.female_count}}
		</td>
	</tr>

	<tr>
		<th>How many female participants in public advocacy meetings</th>
		<td>
			{{data.advocacies.totals.male_count}}
		</td>
	</tr>

	<tr ng-repeat="(participant_type, count) in data.advocacies.totals.participant_types">
		<th>{{participant_type}}</th>
		<td>{{count || 0}}</td>
	</tr>
</table>



<h2>Advocacy and Outreach</h2>
<table>
	<thead>
		<tr>
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
		<tr ng-repeat="(i, advocacy) in data.advocacies.items">
			<td>
				{{advocacy.title}}
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
	{{data.advocacies | json}}
</pre>