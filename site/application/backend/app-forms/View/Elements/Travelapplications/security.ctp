<h1 class="md-display-2">Security Risk Assessment</h1>

<p>
	Please consult the FCO travel advice for each destination country:
	<ul>
		<li ng-repeat="(i, itinerary_item) in formData.itinerary">
			<a href="https://www.gov.uk/search?q={{itinerary_item.destination}}" target="_blank">
				{{itinerary_item.destination}}
			</a>
		</li>
	</ul>
	

</p>

<?php
	echo $this->Form->input('homecontact_freq', array(
		'label' => 'What are the main safety and security risks in the locations which you will visit?',
		'type' => 'textarea',
		'ng-model' => 'formData.risks.overview'
	));
?>

<?php
	echo $this->Form->input('homecontact_freq', array(
		'label' => 'How will you protect yourself against these risks?',
		'type' => 'textarea',
		'ng-model' => 'formData.risks.protection'
	));
?>

<?php
	echo $this->Form->input('homecontact_freq', array(
		'label' => 'Sources of security information used',
		'type' => 'textarea',
		'ng-model' => 'formData.risks.sources'
	));
?>