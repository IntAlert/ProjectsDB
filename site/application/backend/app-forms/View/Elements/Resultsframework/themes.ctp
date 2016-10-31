


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
		<strategic-pathway-selector 
			pathways="FormOptions.pathways" 
			ng-model="data.record.pathways.primary">

		</strategic-pathway-selector>
		
	</div>

	<div flex="50">
		<h3>Secondary Strategic Pathway</h3>
		<strategic-pathway-selector 
			pathways="FormOptions.pathways" 
			ng-model="data.record.pathways.secondary">

		</strategic-pathway-selector>
	</div>

</div>
