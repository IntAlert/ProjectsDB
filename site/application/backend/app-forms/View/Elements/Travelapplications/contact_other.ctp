<h1 class="md-display-2">Other Useful Contacts</h1>

<p>Please supply other useful contacts eg. Alert partners, Embassies, Local emergency numbers, Local medical facilities</p>

<?php
	echo $this->Form->input('homecontact_freq', array(
		'label' => 'Alert Partners',
		'ng-model' => 'formData.contact_other.alert'
	));
?>

<?php
	echo $this->Form->input('homecontact_freq', array(
		'label' => 'Embassies',
		'ng-model' => 'formData.contact_other.embassies'
	));
?>

<?php
	echo $this->Form->input('homecontact_freq', array(
		'label' => 'Local emergency numbers',
		'ng-model' => 'formData.contact_other.emergency'
	));
?>

<?php
	echo $this->Form->input('homecontact_freq', array(
		'label' => 'Local medical facilities',
		'ng-model' => 'formData.contact_other.medical'
	));
?>
