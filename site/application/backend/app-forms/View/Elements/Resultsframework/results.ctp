<h2>Results</h2>
<table ng-show=" data.record.results.items.length ">
	<thead>
		<tr>
			<th>
				Title
			</th>

			<th>
				Date
			</th>

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
		<tr ng-repeat="(i, result) in data.record.results.items">
			<td>
				{{result.title}}
			</td>

			<td>
				{{result.date | date:'dd/MM/yyyy'}}
			</td>
			
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
