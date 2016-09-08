<div class="itinerary-item" ng-repeat="(i, itinerary_item) in formData.itinerary">

	
	<div layout="row" layout-align="space-between center">
		<h3>Leg #{{i+1}}</h3>
		<md-button 
			ng-click="removeItineraryItem(i)"
			ng-show="formData.itinerary.length > 1"
			class="md-warn">
			Remove Leg
		</md-button>
	</div>

	 
	
	<table>

		<tbody>
			<tr>
				<th>Start *</th>
				<td colspan="3">
					<md-datepicker
						required
						ng-model="itinerary_item.start" 
						md-placeholder="Enter date"
					></md-datepicker>

				</td>
			</tr>

			<tr>
				<th>Finish *</th>
				<td colspan="3">
					<md-datepicker 
						required
						ng-model="itinerary_item.finish" 
						md-placeholder="Enter date"
					></md-datepicker>
				</td>
			</tr>

			<tr>
				<th>Origin</th>
				<td colspan="3">

					<select
						ng-model="itinerary_item.origin" 
						ng-options="country.Territory.name for country in countries.all">
					</select>

				</td>
			</tr>
			<tr>

				<th>Destination *</th>
				<td colspan="3">

					<select 
						required
						ng-model="itinerary_item.destination" 
						ng-options="country.Territory.name for country in countries.all">
					</select>

				</td>

			</tr>
		

			
			<tr>

				<th>Transport Details</th>
				<td>
					
					<?php
						echo $this->Form->input('transport_detail', array(
							'required' => true,
							'label' => 'Detail *',
							'type' => 'textarea',
							'ng-model' => 'itinerary_item.transport.detail'
						));
					?>
					<p>eg. flight details, airport pick up, road travel</p>
				</td>
				<td>
					<?php
						echo $this->Form->input('transport_email', array(
							'label' => 'Email Address(es)',
							'type' => 'textarea',
							'ng-model' => 'itinerary_item.transport.email'
						));
					?>
				</td>
				<td>
					<?php
						echo $this->Form->input('transport_phone', array(
							'label' => 'Phone numbers',
							'type' => 'textarea',
							'ng-model' => 'itinerary_item.transport.phone'
						));
					?>
				</td>

			</tr>
			<tr>

				<th>Accommodation</th>
				<td>
					<?php
						echo $this->Form->input('accommodation_detail', array(
							'required' => true,
							'label' => 'Detail *',
							'type' => 'textarea',
							'ng-model' => 'itinerary_item.accommodation.detail'
						));
					?>
				</td>
				<td>
					<?php
						echo $this->Form->input('accommodation_email', array(
							'required' => true,
							'label' => 'Email Address(es) *',
							'type' => 'textarea',
							'ng-model' => 'itinerary_item.accommodation.email'
						));
					?>
				</td>
				<td>
					<?php
						echo $this->Form->input('accommodation_phone', array(
							'required' => true,
							'label' => 'Phone numbers *',
							'type' => 'textarea',
							'ng-model' => 'itinerary_item.accommodation.phone'
						));
					?>
				</td>

			</tr>

		</tbody>
	</table>
</div> <!-- <div class="itinerary-item"> -->




<div layout="row" layout-align="end center">

	<md-button 
		ng-click="addItineraryItem()"
		class="md-raised">
		Add Itinerary Item
	</md-button>

	  <md-button 
		ng-show="itineraryForm.$valid"
		ng-click=" changeActiveTab(4) "
		class="md-raised">
		Next
	</md-button>
</div>