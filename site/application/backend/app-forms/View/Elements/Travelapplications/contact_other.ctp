<div class="other-contacts" ng-show=" formData.mode == 'no-office' ">

	<h3>Other Useful Contacts</h3>

	<p>Please supply other useful contacts eg. Alert partners, Embassies, Local emergency numbers, Local medical facilities</p>

	<?php
		echo $this->Form->input('homecontact_freq', array(
			'ng-required' => "formData.mode == 'no-office'",
			'label' => 'Alert Partners *',
			'type' => 'textarea',
			'ng-model' => 'formData.contact_other.alert'
		));
	?>

	<?php
		echo $this->Form->input('homecontact_freq', array(
			'ng-required' => "formData.mode == 'no-office'",
			'label' => 'Embassies *',
			'type' => 'textarea',
			'ng-model' => 'formData.contact_other.embassies'
		));
	?>

	<?php
		echo $this->Form->input('homecontact_freq', array(
			'ng-required' => "formData.mode == 'no-office'",
			'label' => 'Local emergency numbers *',
			'type' => 'textarea',
			'ng-model' => 'formData.contact_other.emergency'
		));
	?>

	<?php
		echo $this->Form->input('homecontact_freq', array(
			'ng-required' => "formData.mode == 'no-office'",
			'label' => 'Local medical facilities *',
			'type' => 'textarea',
			'ng-model' => 'formData.contact_other.medical'
		));
	?>
</div> <!-- (ng-show=" formData.mode == 'no-office') -->