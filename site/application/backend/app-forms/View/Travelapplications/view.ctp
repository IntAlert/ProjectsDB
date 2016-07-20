<div class="travelapplications" ng-app="travelapplication" ng-cloak>
		

	<div 
		ng-controller="TravelapplicationViewController"
		ng-cloak
		ng-show="formData"
	>

	<?php echo $this->element('Travelapplications/confirm/general'); ?>

	<?php echo $this->element('Travelapplications/confirm/applicant'); ?>

	<?php echo $this->element('Travelapplications/confirm/contacts'); ?>

	<?php echo $this->element('Travelapplications/confirm/itinerary'); ?>

	<?php echo $this->element('Travelapplications/confirm/meetings'); ?>

	<?php echo $this->element('Travelapplications/confirm/security'); ?>

	<?php echo $this->element('Travelapplications/confirm/checklist'); ?>

	</div>

</div>


<?php echo $this->Html->script('travelapplications/view', array('inline' => false)); ?>