<div 
	class="travelapplications index"
	ng-app="travelapplicationList"
	ng-cloak
	ng-controller="TravelapplicationAdminController">

	<div class="travelapplication-search-nav">
		<div 
			layout="row" 
			layout-align="space-between center">

			
			<!-- Country -->
			<div flex="30">

				<md-input-container layout="column" flex>
					<label>Country</label>
					<md-select 
						ng-change="getTravelapplications()"
						ng-model="query.country">
						<md-option ng-value="-1">
							All
						</md-option>
						<md-option 
							ng-repeat="country in FormOptions.countries.all" 
							ng-value="country.Territory.id">
						{{country.Territory.name}}
						</md-option>
					</md-select>
				</md-input-container>

			</div>
			


			
			<!-- Applicant -->
			<div flex="30">
				<md-input-container layout="column" flex>
					<label>Applicant</label>
					<md-select 
						ng-change="getTravelapplications()"
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
			

			
			<!-- Contact -->
			<div flex="30">
				<md-input-container layout="column" flex>
					<label>Contact</label>
					<md-select 
						ng-change="getTravelapplications()"
						ng-model="query.contact">
						<md-option ng-value="-1">
							<em>All</em>
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
					ng-change="getTravelapplications()"
					aria-label="Disabled checkbox" 
					ng-model="query.allDates">
	            All dates?
	          </md-checkbox>
			</div>

			<!-- Date -->
			<div class="date">
					<md-datepicker 
						ng-change="getTravelapplications()"
						ng-model="query.date" 
						ng-show=" !query.allDates "
						md-placeholder="Enter date"
						md-open-on-focus>
					</md-datepicker>
			</div>

			<div flex="5"></div>
		</div>
	</div>

	

	<?php echo $this->element('/Travelapplications/index'); ?>
	

	</div>

</div>

<? echo $this->Html->script('/js/travelapplications/app-list.js') ;?>


<? echo $this->Html->script('/js/travelapplications/services/TravelapplicationsService.js') ;?>
<? echo $this->Html->script('/js/shared/services/CountriesService.js') ;?>

<? echo $this->Html->script('/js/shared/services/Office365UsersService.js') ;?>

<? echo $this->Html->script('/js/travelapplications/TravelapplicationAdminController.js') ;?>

<?php echo $this->Html->script('shared/services/NonInteractiveDialogService'); ?>

