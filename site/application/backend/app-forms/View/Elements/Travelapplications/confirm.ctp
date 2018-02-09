<h1 class="md-display-2">Confirm Trip</h1>


<?php echo $this->element('Travelapplications/confirm/general'); ?>

<?php echo $this->element('Travelapplications/confirm/applicant'); ?>

<?php echo $this->element('Travelapplications/confirm/contacts'); ?>

<?php echo $this->element('Travelapplications/confirm/itinerary'); ?>

<?php echo $this->element('Travelapplications/confirm/meetings'); ?>

<?php echo $this->element('Travelapplications/confirm/security'); ?>


<div layout="row" layout-align="end center">

	<md-button 
		ng-show="securityForm.$valid"
		ng-click=" submitTravelApplication() "
		class="md-raised">
		Submit Trip
	</md-button>
</div>


