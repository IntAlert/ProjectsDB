<div ng-controller="ExportController">

	<h2>Export data for this project</h2>


	<div layout="row">
		<div class="filter dates" flex="30">

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
				  		md-placeholder="End date"
				    ></md-datepicker>
				</div>
		    </div>
		</div>
		<div flex="70">
			<!-- Export buttons -->
			<div>
				<md-button 
					class="md-raised" 
					ng-click="exportTrainingData()"
				>
					Export Selected Training Data
				</md-button>
			</div>

			<div>
				<md-button 
					class="md-raised" 
					ng-click="exportAccompanimentData()"
				>
					Export Selected Accompaniment Data
				</md-button>
			</div>

			<div>
				<md-button 
					class="md-raised" 
					ng-click="exportDialogueProcessData()"
				>
					Export Selected Dialogue Process Data
				</md-button>
			</div>

			<div>
				<md-button 
					class="md-raised" 
					ng-click="exportDialogueMeetingData()"
				>
					Export Selected Dialogue Meeting Data
				</md-button>
			</div>

			<div>
				<md-button 
					class="md-raised" 
					ng-click="exportResearchData()"
				>
					Export Selected Research Data
				</md-button>
			</div>

			<div>
				<md-button 
					class="md-raised" 
					ng-click="exportAdvocacyData()"
				>
					Export Selected Advocacy Data
				</md-button>
			</div>

			<div>
				<md-button 
					class="md-raised" 
					ng-click="exportOtherActivityData()"
				>
					Export Selected Other Activities Data
				</md-button>
			</div>

			<div>
				<md-button 
					class="md-raised" 
					ng-click="exportResultData()"
				>
					Export Selected Results Data
				</md-button>
			</div>


		</div>
	</div>

</div>