
<div layout="row"><h3>Themes</h3></div>
<div layout="row">
    <ul class="themes-selector">
		<li ng-repeat="theme in FormOptions.themes">
			
			<md-checkbox 
				checklist-model="data.record.themes.items" 
				checklist-value="theme"
			>
	            {{theme.Theme.name}}
			</md-checkbox>

		</li>
	</ul>
</div>

<div layout="row" layout-wrap>
	<div flex="50">
		<h3>Primary Strategic Pathway</h3>
		<md-radio-group ng-model="local.pathways.primaryId" ng-change="updatePathways()">
	      
	      <md-radio-button 
	      	ng-repeat="pathway in FormOptions.pathways"
	      	ng-value="pathway.Pathway.id" 
	      	class="md-primary">
	      		{{pathway.Pathway.name}}
	      </md-radio-button>

	    </md-radio-group>
	</div>

	<div flex="50">
		<h3>Secondary Strategic Pathway</h3>
		<md-radio-group ng-model="local.pathways.secondaryId" ng-change="updatePathways()">
	      
	      <md-radio-button 
	      	ng-repeat="pathway in FormOptions.pathways"
	      	ng-value="pathway.Pathway.id" 
	      	class="md-primary">
	      		{{pathway.Pathway.name}}
	      </md-radio-button>

	    </md-radio-group>
	</div>

</div>
