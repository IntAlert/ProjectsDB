<h1 class="md-display-2">Itinerary</h1>



<div class="itinerary-item" ng-repeat="(i, itinerary_item) in formData.itinerary">

	<h3>Itinerary Item #{{i+1}}</h3>

	 <md-button 
		ng-click="removeItineraryItem(i)"
		ng-show="formData.itinerary.length > 1"
		class="md-raised">
		Remove
	</md-button>
	
	<table>

		<tbody>
			<tr>
				<th>Start</th>
				<td colspan="3">
					<md-datepicker 
						ng-model="itinerary_item.start" 
						md-placeholder="Enter date"
					></md-datepicker>

				</td>
			</tr>

			<tr>
				<th>Finish</th>
				<td colspan="3">
					<md-datepicker 
						ng-model="itinerary_item.finish" 
						md-placeholder="Enter date"
					></md-datepicker>
				</td>
			</tr>

			<tr>
				<th>Origin</th>
				<td colspan="3">
					<?php
						echo $this->Form->input('homecontact_freq', array(
							'label' => false
						));
					?>
				</td>
			</tr>
			<tr>

				<th>Destination</th>
				<td colspan="3">
					<?php
						echo $this->Form->input('homecontact_freq', array(
							'label' => false
						));
					?>
				</td>

			</tr>
		

			
			<tr>

				<th>Transport Details</th>
				<td>
					
					<?php
						echo $this->Form->input('homecontact_freq', array(
							'label' => 'Detail',
							'type' => 'textarea'
						));
					?>
					<p>eg. flight details, airport pick up, road travel</p>
				</td>
				<td>
					<?php
						echo $this->Form->input('homecontact_freq', array(
							'label' => 'Email Address(es)',
							'type' => 'textarea'
						));
					?>
				</td>
				<td>
					<?php
						echo $this->Form->input('homecontact_freq', array(
							'label' => 'Phone numbers',
							'type' => 'textarea'
						));
					?>
				</td>

			</tr>
			<tr>

				<th>Accommodation</th>
				<td>
					<?php
						echo $this->Form->input('homecontact_freq', array(
							'label' => 'Detail',
							'type' => 'textarea'
						));
					?>
				</td>
				<td>
					<?php
						echo $this->Form->input('homecontact_freq', array(
							'label' => 'Email Address(es)',
							'type' => 'textarea'
						));
					?>
				</td>
				<td>
					<?php
						echo $this->Form->input('homecontact_freq', array(
							'label' => 'Phone numbers',
							'type' => 'textarea'
						));
					?>
				</td>

			</tr>

		</tbody>
	</table>
</div> <!-- <div class="itinerary-item"> -->

<md-button 
		ng-click="addItineraryItem()"
		class="md-raised">
		Add Itinerary Item
</md-button>
