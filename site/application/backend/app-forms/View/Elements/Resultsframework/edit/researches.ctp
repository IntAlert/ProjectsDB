<div ng-controller="ResearchesController">

	<h2>Research Summary</h2>
	<table>

		<tr>
			<th>Number of research reports or other papers produced by Alert to improve understanding and peacebuilding approaches on particular geographic contexts or issues?</th>
			<td>{{data.totals.count || 0}}</td>
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

	</table>






	<div class="item-list-header clearfix">
		<h2>Research</h2>

		
		<md-button class="md-raised" ng-click="showResearchItemDialog()">Add</md-button>

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
					Themes
				</th>

				<th width="25%"></th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="(i, research) in data.items">
				<td>
					{{research.Research.date | date:'dd/MM/yyyy'}}
				</td>


				<td>
					{{research.Research.title}}
				</td>


				<td>
					<span ng-repeat="theme in research.Theme">
						{{theme.name}}{{$last ? '' : ', '}}
					</span>
					<span ng-if=" !research.Theme.length ">
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
						ng-click="removeResearchItem(research.id)">
						Remove
					</md-button>

				</td>
			</tr>
		</tbody>
		
	</table>
</div>