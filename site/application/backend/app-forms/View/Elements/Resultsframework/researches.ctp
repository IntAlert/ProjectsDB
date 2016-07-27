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
				Territories
			</th>
			<th width="25%"></th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="(i, research) in data.researches">
			<td>
				{{research.title}}
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
