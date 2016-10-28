<div layout="row"><h3>Regions</h3></div>
<div layout="row">
    <ul class="territories-selector">
		<li ng-repeat="region in FormOptions.regions">
			<md-checkbox 
				checklist-model="data.record.geography.regions" 
				checklist-value="region"
				>
	            {{region.Territory.name}}
			</md-checkbox>
		</li>
	</ul>
</div>


<div layout="row"><h3>Countries</h3></div>
<div layout="row">
    <ul class="territories-selector">
		<li ng-repeat="country in FormOptions.countries">
			<md-checkbox 
				checklist-model="data.record.geography.territories" 
				checklist-value="country"
				>
	            {{country.Territory.name}}
			</md-checkbox>
		</li>
	</ul>
</div>