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
	echo $this->Form->input('homecontact_freq', array(
		'required' => true,
		'label' => 'What are the main safety and security risks in the locations which you will visit? *',
		'type' => 'textarea',
		'ng-model' => 'formData.risks.overview'
	));
?>

<?php
	echo $this->Form->input('homecontact_freq', array(
		'required' => true,
		'label' => 'How will you protect yourself against these risks? *',
		'type' => 'textarea',
		'ng-model' => 'formData.risks.protection'
	));
?>

<?php
	echo $this->Form->input('homecontact_freq', array(
		'required' => true,
		'label' => 'Sources of security information used *',
		'type' => 'textarea',
		'ng-model' => 'formData.risks.sources'
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