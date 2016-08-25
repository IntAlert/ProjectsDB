<div 
	class="travelapplications index"
	ng-app="travelapplication"
	ng-controller="TravelapplicationListController">


	<h2><?php echo __('Travel Applications'); ?></h2>

	
	<pre>{{query | json}}</pre>

	<div class="search-bar" layout="row">


		<form action="" name="travelapplicationForm" method="get">

			<!-- Country -->
			<div flex>

				<md-input-container>
					<label>Country</label>
					<md-select ng-model="query.country">
						<md-option ng-value="-1">
							<em>All</em>
						</md-option>
						<md-option 
							ng-repeat="country in FormOptions.countries.all" 
							ng-value="country.Territory.id">
						{{country.Territory.name}}
						</md-option>
					</md-select>
				</md-input-container>

			</div>

			<div flex>
				<md-checkbox 
					aria-label="Disabled checkbox" 
					ng-model="query.allDates">
	            All dates?
	          </md-checkbox>
			</div>

			<!-- Date -->
			<div flex>
					<md-datepicker 
						ng-model="query.date" 
						ng-disabled="query.allDates"
						md-placeholder="Enter date"
						md-open-on-focus>
					</md-datepicker>
			</div>

			 <!-- Applicant -->
			<div flex>
				<md-input-container>
					<label>Applicant</label>
					<md-select ng-model="query.applicant">
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

			<!-- Contact -->
			<div flex>
				<md-input-container>
					<label>Contact</label>
					<md-select ng-model="query.contact">
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

			<!-- <div flex>
				<md-button 
					class="md-raised md-primary" 
					aria-label="Search"
					ng-click="submitForm()"
				>
					Search
				</md-button>
			</div> -->
		</form>


	</div>



	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th>Applicant</th>
			<th>Approving Manager</th>
			<th>Destinations</th>
			<th>Created</th>
			<th class="actions">Actions</th>
	</tr>
	</thead>
	<tbody>
	<tr
		ng-repeat="ta in travelapplications">
		<td>
			{{ta.applicant.name}}
		</td>
		<td>
			{{ta.applicant.approving_manager.User.name}}
		</td>

		<td>

  			<span ng-repeat="itinerary_item in ta.itinerary">
					{{itinerary_item.destination.Territory.name}}{{$last ? '' : ', '}}
			</span>

		</td>

		<td>{{ta.created | date}}</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', '{{ta.id}}')); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', '{{ta.id}}')); ?>
		</td>
	</tr>
	</tbody>
	</table>

	<pre>{{travelapplications | json}}</pre>

</div>




<? echo $this->Html->script('/js/travelapplications/app.js') ;?>

<? echo $this->Html->script('/js/travelapplications/services/TravelapplicationsService.js') ;?>
<? echo $this->Html->script('/js/shared/services/CountriesService.js') ;?>

<? echo $this->Html->script('/js/shared/services/Office365UsersService.js') ;?>

<? echo $this->Html->script('/js/travelapplications/index.js') ;?>