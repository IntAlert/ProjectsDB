<div 
	class="travelapplications index"
	ng-app="travelapplicationList"
	ng-controller="TravelapplicationListController">

	<div layout="row">
		<!-- Country -->
		<div flex="20">

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


		<!-- Applicant -->
		<div flex="20">
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
		<div flex="20">
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

		<div flex="20">
			<md-checkbox 
				ng-change="getTravelapplications()"
				aria-label="Disabled checkbox" 
				ng-model="query.allDates">
            All dates?
          </md-checkbox>
		</div>

		<!-- Date -->
		<div flex="20">
				<md-datepicker 
					ng-model="query.date" 
					ng-show=" !query.allDates "
					md-placeholder="Enter date"
					md-open-on-focus>
				</md-datepicker>
		</div>

		 

		<div flex="20">
			<md-button 
				class="md-raised md-primary" 
				aria-label="Search"
				ng-click="getTravelapplications()"
			>
				Search
			</md-button>
		</div>
	</div>

	<div layout="row">

		<div flex>
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
						{{ta.applicant.approving_manager.displayName}}
					</td>

					<td>

			  			<span ng-repeat="itinerary_item in ta.itinerary">
								{{itinerary_item.destination.Territory.name}}{{$last ? '' : ', '}}
						</span>

					</td>

					<td>{{ta.created | date}}</td>
					
					<td class="actions">
						<a 
							ng-click="previewTravelapplication($event, ta)"
							class="md-button">
							View
						</a>
					</td>
				</tr>
				</tbody>
				</table>

				<!-- <pre>{{travelapplications | json}}</pre> -->

			</div>

		</div>



	 <div style="visibility: hidden">
    <div class="md-dialog-container" id="myDialog">
      <md-dialog layout-padding>
        

        <md-toolbar>
			      <div class="md-toolbar-tools">
			        <h2>
			        	Travel Application for {{formData.applicant.name}}
			        </h2>
			      </div>
			    </md-toolbar>
        

					        
			     <md-dialog-content>
			      <div class="md-dialog-content">

									<?php echo $this->element('Travelapplications/confirm/general'); ?>

									<?php echo $this->element('Travelapplications/confirm/applicant'); ?>

									<?php echo $this->element('Travelapplications/confirm/contacts'); ?>

									<?php echo $this->element('Travelapplications/confirm/itinerary'); ?>

									<?php echo $this->element('Travelapplications/confirm/meetings'); ?>

									<?php echo $this->element('Travelapplications/confirm/security'); ?>

									<?php echo $this->element('Travelapplications/confirm/checklist'); ?>
								</div>
							</md-dialog-content>


							<md-dialog-actions layout="row">
			      
			      <md-button 
				      target="_blank"
				      class="md-raised"
			      	ng-href="/forms/travelapplications/edit/{{formData.id}}">
			       Edit
			      </md-button>
			      
			      <span flex></span>

			    </md-dialog-actions>


      </md-dialog>
    </div>
  </div>

	</div>

</div>






<? echo $this->Html->script('/js/travelapplications/app-list.js') ;?>



<? echo $this->Html->script('/js/travelapplications/services/TravelapplicationsService.js') ;?>
<? echo $this->Html->script('/js/shared/services/CountriesService.js') ;?>

<? echo $this->Html->script('/js/shared/services/Office365UsersService.js') ;?>

<? echo $this->Html->script('/js/travelapplications/list.js') ;?>
