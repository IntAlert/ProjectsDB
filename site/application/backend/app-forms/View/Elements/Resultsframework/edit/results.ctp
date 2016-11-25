<div ng-controller="ResultsController">
	<div class="item-list-header clearfix">
		<h2>Results</h2>

		<md-button class="md-raised" ng-click="showResultItemDialog()">Add</md-button>

	</div>

	<div ng-hide="data.items.length">
		None
	</div>

	<table ng-show=" data.items.length ">
		<thead>
			<tr>

				<th>
					Date
				</th>

				<th>
					Title
				</th>

				<th>
					What
				</th>

				<th>
					Kind(s) of Impact
				</th>
				<th width="25%"></th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="(i, result) in data.items">
				
				<td>
					{{result.Result.date | date:'dd/MM/yyyy'}}
				</td>

				<td>
					{{result.Result.title}}
				</td>
				
				<td>
					{{result.Result.what}}
				</td>

				<td>
					<span ng-repeat="impact in result.Impact">
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
						ng-click="removeResultItem(result.Result.id)">
						Remove
					</md-button>

				</td>
			</tr>
		</tbody>
		
	</table>
</div>