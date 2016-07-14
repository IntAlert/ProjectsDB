<?php

	echo $this->Form->input('mode', array(
		'type' => 'radio',
		'options' => array(
			'has-office' => 'Yes, the country does have an Alert office', 
			'no-office' => 'No, the country does not have an Alert office'
		),
		'legend' => 'Does your destination country have an Alert office?',
		'ng-model' => 'mode'
	));

?>