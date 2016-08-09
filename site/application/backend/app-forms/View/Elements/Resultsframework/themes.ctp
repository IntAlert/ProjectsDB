
<div layout="row"><h3>Themes</h3></div>
<div layout="row">
    <ul class="themes-selector">
		<li ng-repeat="theme in FormOptions.themes">
			
			<md-checkbox 
				checklist-model="data.themes" 
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
		<md-radio-group ng-model="data.pathways.primary">
	      <md-radio-button 
	      	ng-repeat="pathway in FormOptions.pathways"
	      	ng-value="pathway" class="md-primary">{{pathway.Pathway.name}}</md-radio-button>
	    </md-radio-group>
	</div>

	<div flex="50">
		<h3>Secondary Strategic Pathway</h3>
		<md-radio-group ng-model="data.pathways.secondary">
	      <md-radio-button 
	      	ng-repeat="pathway in FormOptions.pathways"
	      	ng-value="pathway" class="md-primary">{{pathway.Pathway.name}}</md-radio-button>
	    </md-radio-group>
	</div>

</div>

<pre>{{themes | json}}</pre>