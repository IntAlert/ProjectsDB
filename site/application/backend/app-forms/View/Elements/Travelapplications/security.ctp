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




<div class="security">
	<?php


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


</div>

<div class="checklist">


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

		?>
	<?php
		echo $this->Form->input('convenant_agreed', array(
			'type' => 'checkbox',
			'required' => true,
			'label' => 'I have read, understood & signed <a href="http://src.intalert.org/wp-content/uploads/2017/11/SECURITY-COVENANT.pdf" target="_blank">Alert\'s Security Covenant</a> *',
			'ng-model' => 'formData.convenant_agreed',

		));
		echo $this->Form->input('policy_understood', array(
			'type' => 'checkbox',
			'required' => true,
			'label' => 'I have read & understood <a href="http://src.intalert.org/country-updates/" target="_blank">Alert\'s Security Policy, Procedures, and Staff & Field Workers Tasks & Responsibilities</a> *',
			'ng-model' => 'formData.policy_understood',
		));
		echo $this->Form->input('evacuation_understood', array(
			'type' => 'checkbox',
			'required' => true,
			'label' => 'I have read & understood <a href="http://src.intalert.org/country-updates/" target="_blank">Country Security & Evacuation Plans</a> *',
			'ng-model' => 'formData.evacuation_understood',
		));

	?>
	
</div>

<div layout="row" layout-align="end center">
	<md-button 
		ng-show="securityForm.$valid"
		ng-click=" changeActiveTab(6) "
		class="md-raised">
		Next
	</md-button>
</div>