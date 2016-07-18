<h1 class="md-display-2">Meetings</h1>

<table>
	<thead>
		<tr>
			<th>
				Date
			</th>

			<th>
				Time
			</th>

			<th>
				Organisation and contact
			</th>

			<th>
				Full Address
			</th>

			<th>
				Email
			</th>

			<th>
				Confirmed
			</th>

			<td></td>
		</tr>
			
	</thead>

	<tbody 
		ng-repeat="(i, schedule_item) in formData.schedule"
	>


		<tr>
			<td>
				<!-- Date -->

				<md-datepicker 
					required
					ng-model="schedule_item.date" 
					md-placeholder="Enter date"
				></md-datepicker>

			</td>

			<td>
				<!-- Time -->
				<?php
					echo $this->Form->input('homecontact_freq', array(
						'required' => true,
						'label' => false,
						'type' => 'text',
						'ng-model' => 'schedule_item.time'
					));
				?>
			</td>

			<td>
				<!-- Organisation and contact -->
				<?php
					echo $this->Form->input('homecontact_freq', array(
						'required' => true,
						'label' => false,
						'type' => 'textarea',
						'ng-model' => 'schedule_item.org_contact'
					));
				?>
			</td>

			<td>
				<!-- Full Address -->
				<?php
					echo $this->Form->input('homecontact_freq', array(
						'required' => true,
						'label' => false,
						'type' => 'textarea',
						'ng-model' => 'schedule_item.address'
					));
				?>
			</td>

			<td>
				<!-- Email -->
				<?php
					echo $this->Form->input('homecontact_freq', array(
						'required' => true,
						'label' => false,
						'type' => 'text',
						'ng-model' => 'schedule_item.email'
					));
				?>
			</td>

			<td>
				<!-- Confirmed -->
				<?php
					echo $this->Form->input('homecontact_freq', array(
						'label' => false,
						'type' => 'checkbox',
						'ng-model' => 'schedule_item.confirmed'
					));
				?>
			</td>

			<td>
				<md-button 
						ng-show="formData.schedule.length > 1"
						ng-click="removeScheduleItem(i)"
						class="md-raised">
						Remove
				</md-button>
				
			</td>
		</tr>

		
	</tbody>
</table>


<md-button 
	ng-click="addScheduleItem()"
	class="md-raised">
	Add Schedule Item
</md-button>