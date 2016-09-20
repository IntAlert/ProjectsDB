<div 
	class="travelapplications index"
	ng-app="travelapplicationList"
	ng-cloak
	ng-controller="TravelapplicationIndexController">


	<div class="travelapplication-search-nav">

		<div 
			layout="row" 
			layout-align="space-between center">

			
			<!-- Mine/Managed -->
			<div flex="30">

				<md-radio-group ng-model="query.mode">

					<md-radio-button 
						ng-click="getMyTravelapplications()"
						value="mine" >
						My Trips
					</md-radio-button>

					<md-radio-button 
						ng-click="getManagedTravelapplications()"
						value="managed">
						Trips where I am manager
					</md-radio-button>

			    </md-radio-group>
	
			</div>
			
			<!-- Applicant -->
			<div flex="30">
				<md-input-container 
					ng-hide=" query.mode == 'mine' "
					layout="column" flex>
					<label>Applicant</label>
					<md-select 
						ng-change="getManagedTravelapplications()"
						ng-model="query.applicant_o365_object_id">
						<md-option ng-value="-1">
							All
						</md-option>
						<md-option 
							ng-repeat="user in FormOptions.users.all" 
							ng-value="user.objectId">
							{{user.displayName}}
						</md-option>
					</md-select>
				</md-input-container>
			</div>
			
			

			<div class="all-dates" flex="20">
				<md-checkbox 
					ng-change="getManagedTravelapplications()"
					ng-hide=" query.mode == 'mine' "
					aria-label="Disabled checkbox" 
					ng-model="query.allDates">
	            All dates?
    </md-checkbox>
			</div>

			<!-- Date -->
			<div class="date">
					<md-datepicker 
						ng-change="getManagedTravelapplications()"
						ng-model="query.date" 
						ng-hide=" query.mode == 'mine' || query.allDates "
						md-placeholder="Enter date"
						md-open-on-focus>
					</md-datepicker>
			</div>

			<div flex="5"></div>
		</div>
	</div>



	<?php echo $this->element('/Travelapplications/index'); ?>

</div>


<? echo $this->Html->script('/js/travelapplications/app-list.js') ;?>


<? echo $this->Html->script('/js/travelapplications/services/TravelapplicationsService.js') ;?>
<? echo $this->Html->script('/js/shared/services/CountriesService.js') ;?>

<? echo $this->Html->script('/js/shared/services/Office365UsersService.js') ;?>

<? echo $this->Html->script('/js/travelapplications/TravelapplicationIndexController.js') ;?>

<?php echo $this->Html->script('shared/services/NonInteractiveDialogService'); ?>

