<table>
	<thead>
		<tr>
			<th>
				Narrative
			</th>

			<th>
				Strategic Pathway
			</th>

			<th>
				Kind(s) of Impact
			</th>
			<th width="25%"></th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="(i, result) in data.results">
			<td>
				{{result.narrative}}
			</td>

			<td>
				{{result.pathway.Pathway.name}}
			</td>

			<td>
				<span ng-repeat="impact in result.impacts">
					{{impact.name}}{{$last ? '' : ', '}}
				</span>
			</td>
			<td>

				<md-button 
					class="md-raised" 
					ng-click="showResultItemDialog(i)">
					Edit
				</md-button>

				<md-button 
					class="md-raised" 
					ng-click="removeResultItem(i)">
					Remove
				</md-button>

			</td>
		</tr>
	</tbody>
	
</table>

<md-button class="md-raised" ng-click="showResultItemDialog()">Add</md-button>
