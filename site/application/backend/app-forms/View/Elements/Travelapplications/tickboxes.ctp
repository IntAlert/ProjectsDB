<h1 class="md-display-2">Checklist</h1>


<?php
	echo $this->Form->input('convenant_agreed', array(
		'required' => true,
		'label' => 'I have read, understood & signed <a href="#" target="_blank">Alert\'s Security Covenant</a>',
		'ng-model' => 'formData.convenant_agreed',

	));
	echo $this->Form->input('policy_understood', array(
		'label' => 'I have read & understood <a href="#" target="_blank">Alert\'s Security Policy, Procedures, and Staff & Field Workers Tasks & Responsibilities</a>',
		'ng-model' => 'formData.policy_understood',
	));
	echo $this->Form->input('evacuation_understood', array(
		'label' => 'I have read & understood <a href="#" target="_blank">Country Security & Evacuation Plans</a>',
		'ng-model' => 'formData.evacuation_understood',
	));
	echo $this->Form->input('conduct_understood', array(
		'label' => 'I have read & understood <a href="#" target="_blank">Country Security Guidelines & Rules of Conduct</a>',
		'ng-model' => 'formData.conduct_understood',
		'div' => array(
			'ng-show' => " mode=='has-office' "
		),
		
	));

	echo $this->Form->input('countrymanager_notified', array(
		'label' => "I have notified the Country Manager(s) of my arrival, departure and purpose of visit",
		'ng-model' => 'formData.countrymanager_notified',
		'div' => array(
			'ng-show' => " mode=='has-office' "
		)
	));
?>

