<?php echo $this->Html->script('travelapplications/add', array('inline' => false)); ?>
<?php echo $this->Html->css('travelapplications/add', array('inline' => false)); ?>

<div class="travelapplications form">
<?php echo $this->Form->create('Travelapplication'); ?>
	<fieldset>
		<legend><?php echo __('Submit Travel Application'); ?></legend>
	<?php
		echo $this->Form->input('user_id', array(
			'type' => 'hidden',
			'value' => $this->session->read('Auth.User.id')
		));
		echo $this->Form->input('role_text', array(
			'type' => 'text',
			'label' => 'Your role at Alert'
		));
		echo $this->Form->input('summary', array(
			'label' => 'Please summarise the purpose of the trip'
		));



?>

<h2>Itinerary and Security Levels</h2>
<table>
	<thead>
		<tr>
			<th>Destination</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Security Level</th>
			<th>Risks</th>
		</tr>
	</thead>

	<tbody>

<?php for ($i=0; $i < 10; $i++): ?>
	
		<tr>
			<td class="input">
				<input type="text" name="data[Travelapplicationitinerary][destination][]" class="itinerary-dest">
			</td>
			<td class="input">
				<input type="text" name="data[Travelapplicationitinerary][start_date][]" class="datepicker itinerary-start-date">
			</td>

			<td class="input">
				<input type="text" name="data[Travelapplicationitinerary][end_date][]" class="datepicker itinerary-end-date">
			</td>



			<td class="input">
				<select 
					name="data[Travelapplicationitinerary][security_level][]"
					class="itinerary-risk-level"
					>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>
			</td>



			<td class="input">
				<input type="text" name="data[Travelapplicationitinerary][risks][]" class="itinerary-risks">
			</td>

		</tr>
<?php endfor; // ($i=0; $i < 10; $i++): ?>

	</tbody>
</table>



<?php
		echo $this->Form->input('convenant_agreed', array(
			'required' => true,
			'label' => 'I have read, understood & signed <a href="#" target="_blank">Alert\'s Security Covenant</a>'
		));
		echo $this->Form->input('policy_understood', array(
			'label' => 'I have read & understood <a href="#" target="_blank">Alert\'s Security Policy, Procedures, and Staff & Field Workers Tasks & Responsibilities</a>'
		));
		echo $this->Form->input('evacuation_understood', array(
			'label' => 'I have read & understood <a href="#" target="_blank">Country Security & Evacuation Plans</a>'
		));
		echo $this->Form->input('conduct_understood', array(
			'label' => 'I have read & understood <a href="#" target="_blank">Country Security Guidelines & Rules of Conduct</a>'
		));

		echo $this->Form->input('countrymanager_notified', array(
			'label' => "I have notified the Country Manager(s) of my arrival, departure and purpose of visit"
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>