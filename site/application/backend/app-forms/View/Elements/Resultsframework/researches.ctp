<h2>Research Summary</h2>
<table>

	<tr>
		<th>Number of research reports or other papers produced by Alert to improve understanding and peacebuilding approaches on particular geographic contexts or issues?</th>
		<td>{{data.record.researches.totals.count || 0}}</td>
	</tr>

	<tr>
		<th>Topics</th>
		<td>
			<span ng-repeat="theme in data.record.researches.totals.themes">
					{{theme.Theme.name}}{{$last ? '' : ', '}}
			</span>
			<span ng-if=" !data.researches.totals.themes.length ">
				none
			</span>
		</td>
	</tr>

	<tr>
		<th>Countries</th>
		<td>
			<span ng-repeat="territory in data.record.researches.totals.countries">
					{{territory.Territory.name}}{{$last ? '' : ', '}}
			</span>
			<span ng-if=" !data.researches.totals.countries.length ">
				none
			</span>
		</td>
	</tr>

</table>


<h2>Research</h2>
<table ng-show=" data.record.researches.items.length ">
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
				Territories
			</th>
			<th width="25%"></th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="(i, research) in data.record.researches.items">
			<td>
				{{research.title}}
			</td>

			<td>
				{{research.date | date:'dd/MM/yyyy'}}
			</td>

			<td>
				<span ng-repeat="theme in research.themes">
					{{theme.Theme.name}}{{$last ? '' : ', '}}
				</span>
				<span ng-if=" !research.themes.length ">
					none
				</span>
			</td>

			<td>
				<span ng-repeat="country in research.countries">
					{{country.Territory.name}}{{$last ? '' : ', '}}
				</span>
				<span ng-if=" !research.countries.length ">
					none
				</span>
			</td>
			<td>

				<md-button 
					class="md-raised" 
					ng-click="showResearchItemDialog(i)">
					Edit
				</md-button>

				<md-button 
					class="md-raised" 
					ng-click="removeResearchItem(i)">
					Remove
				</md-button>

			</td>
		</tr>
	</tbody>
	
</table>

<md-button class="md-raised" ng-click="showResearchItemDialog()">Add</md-button>
