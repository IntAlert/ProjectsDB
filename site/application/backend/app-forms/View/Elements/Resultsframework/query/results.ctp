<div ng-controller="ResultsQueryController">

	<div layout="row">
	  <div flex="25" class="filters">
	    

	  <div class="filter dates">
		<!-- All dates -->
	    <md-checkbox ng-model="query.dates.all">
	  		All Dates
	  	</md-checkbox>

	  	<div ng-hide="query.dates.all">
	  		<div>
	  			<label>From: </label>
			    <!-- Start Date -->
			  	<md-datepicker 
			  		ng-model="query.dates.start" 
			  		md-max-date="query.dates.finish"
			  		md-placeholder="Start date"
			    ></md-datepicker>
			</div>

			<div>
				<label>To: </label>
			  	<!-- End Date -->
			  	<md-datepicker 
			  		ng-model="query.dates.finish" 
			  		md-min-date="query.dates.start"
			  		md-placeholder="Finish date"
			    ></md-datepicker>
			</div>
	    </div>
	   </div>

	   <div class="filter participant_types">
		  	<!-- All Participant Types -->
		  	<md-checkbox ng-model="query.participant_types.all">
		  		All Participant Types
		  	</md-checkbox>

		  	<!-- Participant Type -->
		  	<md-select 
		  		ng-model="query.participant_types.selected" 
		  		ng-hide="query.participant_types.all">
			  	<md-option ng-value="null"> Select Participant Type </md-option>
			  	<md-option 
			  		ng-repeat="participant_type in FormOptions.participant_types"
			  		ng-value="participant_type"
			  	>
				  	{{participant_type.ParticipantType.name}}

				</md-option>
			</md-select>
		</div>

		<div class="filter territories">
			<!-- All Departments -->
		  	<md-checkbox ng-model="query.departments.all">
		  		All Project Departments
		  	</md-checkbox>

		  	<!-- Department -->
		  	<md-select 
		  		ng-model="query.departments.selected" 
		  		ng-hide="query.departments.all">
			  	<md-option ng-value="null"> Select Project Department </md-option>
			  	<md-option 
			  		ng-repeat="department in FormOptions.departments"
			  		ng-value="department"
			  	>
				  	{{department.Department.name}}

				</md-option>
			</md-select>
		</div>

		<div class="filter territories">
			<!-- All Territories -->
		  	<md-checkbox ng-model="query.territories.all">
		  		All Project Territories
		  	</md-checkbox>

		  	<!-- Territory -->
		  	<md-select 
		  		ng-model="query.territories.selected" 
		  		ng-hide="query.territories.all">
			  	<md-option ng-value="null"> Select Project Territory </md-option>
			  	<md-option 
			  		ng-repeat="territory in FormOptions.countries"
			  		ng-value="territory"
			  	>
				  	{{territory.Territory.name}}

				</md-option>
			</md-select>
		</div>

		<div class="filter pathways">
			<!-- All Pathways -->
		  	<md-checkbox ng-model="query.pathways.all">
		  		All Project Pathways
		  	</md-checkbox>

		  	<!-- Pathway -->
		  	<md-select 
		  		ng-model="query.pathways.selected" 
		  		ng-hide="query.pathways.all">
			  	<md-option ng-value="null"> Select Project Pathway </md-option>
			  	<md-option 
			  		ng-repeat="pathway in FormOptions.pathways"
			  		ng-value="pathway"
			  	>
				  	{{pathway.Pathway.name}}

				</md-option>
			</md-select>
		</div>

		<!-- Search -->
		<md-button 
			ng-click="updateQuery()"
			class="md-primary md-raised"
		>
			Query
		</md-button>

	  </div>


	  <div flex-offset="5" flex="70">
		<div 
			ng-if=" !state.data_loading "
			ui-grid="gridOptions" 
			ui-grid-exporter
			class="grid"

		></div>

		<div class="api_urls" ng-if=" !state.data_loading ">
			<h2>Get this data via the API</h2>
			

			<!-- CSV -->
			<label>CSV</label>
			<div>
				<!-- Target -->
				<input type="text" id="api-csv-results" readonly ng-value="data.api_urls.csv">

				<!-- Trigger -->
				<button class="btn" ngclipboard data-clipboard-target="#api-csv-results">
				    Copy to clipboard
				</button>
			</div>

			<!-- JSON -->
			<label>JSON</label>
			<div>
				<!-- Target -->
				<input type="text" id="api-json-results" readonly ng-value="data.api_urls.json">

				<!-- Trigger -->
				<button class="btn" ngclipboard data-clipboard-target="#api-json-results">
				    Copy to clipboard
				</button>
			</div>

		</div>


		<div class="grid_data_loading" ng-show=" state.data_loading ">
			<md-progress-circular md-mode="indeterminate"></md-progress-circular>	
		</div>	

	  </div>


	</div>


</div>

