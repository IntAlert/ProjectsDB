<p>All checkboxes must be checked to proceed.</p>

<?php
	echo $this->Form->input('convenant_agreed', array(
		'type' => 'checkbox',
		'required' => true,
		'label' => 'I have read, understood & signed <a href="#" target="_blank">Alert\'s Security Covenant</a> *',
		'ng-model' => 'formData.convenant_agreed',

	));
	echo $this->Form->input('policy_understood', array(
		'type' => 'checkbox',
		'required' => true,
		'label' => 'I have read & understood <a href="#" target="_blank">Alert\'s Security Policy, Procedures, and Staff & Field Workers Tasks & Responsibilities</a> *',
		'ng-model' => 'formData.policy_understood',
	));
	echo $this->Form->input('evacuation_understood', array(
		'type' => 'checkbox',
		'required' => true,
		'label' => 'I have read & understood <a href="#" target="_blank">Country Security & Evacuation Plans</a> *',
		'ng-model' => 'formData.evacuation_understood',
	));

?>


<div layout="row" layout-align="end center">
	<md-button 
		ng-show="checklistForm.$valid"
		ng-click=" changeActiveTab(7) "
		class="md-raised">
		Next
	</md-button>
</div>