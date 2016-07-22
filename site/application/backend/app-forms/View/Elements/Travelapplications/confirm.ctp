<h1 class="md-display-2">Confirm Application</h1>


<?php echo $this->element('Travelapplications/confirm/general'); ?>

<?php echo $this->element('Travelapplications/confirm/applicant'); ?>

<?php echo $this->element('Travelapplications/confirm/contacts'); ?>

<?php echo $this->element('Travelapplications/confirm/itinerary'); ?>

<?php echo $this->element('Travelapplications/confirm/meetings'); ?>

<?php echo $this->element('Travelapplications/confirm/security'); ?>

<?php echo $this->element('Travelapplications/confirm/checklist'); ?>


<div layout="row" layout-align="end center">
	<md-button 
		ng-show="checklistForm.$valid"
		ng-click=" submitTravelApplication() "
		class="md-raised">
		Submit Travel Application
	</md-button>
</div>