<p>
	Please consult the FCO travel advice for each destination country:
	<ul>
		<li 
			ng-repeat="(i, itinerary_item) in formData.itinerary"
			ng-show="itinerary_item.destination.Territory.name"
			>
			FCO Travel Advice:
			<a href="https://www.gov.uk/search?q={{itinerary_item.destination.Territory.name}}+Travel+Advice" target="_blank">
				{{itinerary_item.destination.Territory.name}}
			</a>
		</li>
	</ul>
	

</p>


<?php
	echo $this->Form->input('countrymanager_notified', array(
		'type' => 'checkbox',
		'ng-required' => " formData.mode=='has-office' ",
		'label' => "I have notified the Country Manager(s) of my arrival, departure and purpose of visit *",
		'ng-model' => 'formData.countrymanager_notified',
		'div' => array(
			'ng-show' => " formData.mode=='has-office' "
		)
	));


	echo $this->Form->input('homecontact_freq', array(
		'ng-required' => " formData.mode=='no-office' ",
		'label' => 'What are the main safety and security risks in the locations which you will visit? *',
		'type' => 'textarea',
		'ng-model' => 'formData.risks.overview',
		'div' => array(
			'ng-show' => " formData.mode=='no-office' "
		)
	));

	echo $this->Form->input('homecontact_freq', array(
		'ng-required' => " formData.mode=='no-office' ",
		'label' => 'How will you protect yourself against these risks? *',
		'type' => 'textarea',
		'ng-model' => 'formData.risks.protection',
		'div' => array(
			'ng-show' => " formData.mode=='no-office' "
		)
	));

	echo $this->Form->input('homecontact_freq', array(
		'ng-required' => " formData.mode=='no-office' ",
		'label' => 'Sources of security information used *',
		'type' => 'textarea',
		'ng-model' => 'formData.risks.sources',
		'div' => array(
			'ng-show' => " formData.mode=='no-office' "
		)
	));
?>

<div layout="row" layout-align="end center">
	<md-button 
		ng-show="securityForm.$valid"
		ng-click=" changeActiveTab(6) "
		class="md-raised">
		Next
	</md-button>
</div>