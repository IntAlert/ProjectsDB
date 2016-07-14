<h1 class="md-display-2">Security Risk Assessment</h1>

<?php
	echo $this->Form->input('homecontact_freq', array(
		'label' => 'What are the main safety and security risks in the locations which you will visit?',
		'ng-model' => 'formData.risks.overview'
	));
?>

<?php
	echo $this->Form->input('homecontact_freq', array(
		'label' => 'How will you protect yourself against these risks?',
		'ng-model' => 'formData.risks.protection'
	));
?>


<?php
	echo $this->Form->input('homecontact_freq', array(
		'label' => 'What emergency?',
		'ng-model' => 'formData.risks.emergency_plan'
	));
?>

<?php
	echo $this->Form->input('homecontact_freq', array(
		'label' => 'Sources of security information used',
		'ng-model' => 'formData.risks.sources'
	));
?>