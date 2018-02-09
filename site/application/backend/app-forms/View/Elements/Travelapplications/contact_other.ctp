<div class="other-contacts" ng-show=" formData.mode == 'no-office' ">

	<h3>Other Useful Contacts</h3>

	<p>Please supply other useful contacts eg. Alert partners, Embassies, Local emergency numbers, Local medical facilities</p>

	<?php
		echo $this->Form->input('contact_other', array(
			'ng-required' => "formData.mode == 'no-office'",
			'label' => 'Alert partners, Embassies, Local emergency numbers, Local medical facilities *',
			'type' => 'textarea',
			'ng-model' => 'formData.contact_other'
		));
	?>

</div> <!-- (ng-show=" formData.mode == 'no-office') -->