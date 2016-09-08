<?php // echo $this->Html->script('travelapplications/add', array('inline' => false)); ?>


<!--[if IE 10]><!-->< script>if (/@cc_on!@/false) {document.documentElement.className+=' ie10';}<!--<![endif]-->


<style type="text/css">
.ie10 span[flex] { display: block; }
.ie10 md-dialog { padding: 0px 20px;}
.ie10 .ie10FixDivWithSidenav {
display: inline-block;
width: calc(100% - 280px);
}
</style>



<?php echo $this->Html->css('travelapplications/add', array('inline' => false)); ?>

<div class="travelapplications form" ng-app="travelapplication">
	
	<?php echo $this->Form->create('Travelapplication', array(
		'name' => 'Travelapplication',
		'ng-controller' => "TravelapplicationEditController"
	)); ?>

	<fieldset>
		<legend><?php echo __('New Travel Application'); ?></legend>

		<div ng-cloak>
		  <md-content>
		    <md-tabs md-dynamic-height md-border-bottom md-selected="selectedTabIndex" id="tabs">



			<!-- General -->
		      <md-tab label="general">
		        <md-content class="md-padding" ng-form="generalForm">


		          <?php echo $this->element('Travelapplications/general'); ?>


		        </md-content>
		      </md-tab>



		      <!-- Applicant -->
		      <md-tab label="applicant" ng-disabled="disableTabsByValid && generalForm.$invalid">
		        <md-content class="md-padding" ng-form="applicantForm">

		          <?php echo $this->element('Travelapplications/applicant'); ?>

		        </md-content>
		      </md-tab>

		      <!-- Contacts -->
		      <md-tab label="contacts" ng-disabled="disableTabsByValid && applicantForm.$invalid">
		        <md-content class="md-padding" ng-form="contactsForm">
					
				

				<?php echo $this->element('Travelapplications/contacts'); ?>


		        </md-content>
		      </md-tab>

		      <!-- Itinerary -->
		      <md-tab label="itinerary" ng-disabled="disableTabsByValid && contactsForm.$invalid">
		        <md-content class="md-padding" ng-form="itineraryForm">
		          <?php echo $this->element('Travelapplications/itinerary'); ?>

		        </md-content>
		      </md-tab>

		      <!-- Meetings -->
		      <md-tab label="meetings" ng-disabled="disableTabsByValid && itineraryForm.$invalid">

		        <md-content class="md-padding" ng-form="meetingsForm">
		          <?php echo $this->element('Travelapplications/meetings'); ?>
		        </md-content>

		      </md-tab>

		      <!-- Security -->




<!-- If the no office, we need at least one meeting -->
		      <md-tab label="security" ng-disabled="disableTabsByValid && (!(meetingsForm.$valid && (formData.mode == 'has-office' || formData.schedule.length)) || itineraryForm.$invalid)">
		        
		        <md-content class="md-padding" ng-form="securityForm">
		          <?php echo $this->element('Travelapplications/security'); ?>
		        </md-content>

		      </md-tab>

		      <!-- Checklist -->
		      <md-tab 
		      	label="checklist" 
		      	ng-disabled="disableTabsByValid && securityForm.$invalid">
		        <md-content class="md-padding" ng-form="checklistForm">
		          <?php echo $this->element('Travelapplications/checklist'); ?>

		        </md-content>
		      </md-tab>

		      <!-- Confirm -->
		      <md-tab label="confirm" ng-disabled="disableTabsByValid && checklistForm.$invalid">
		        <md-content class="md-padding">
		          <?php echo $this->element('Travelapplications/confirm'); ?>
		        </md-content>


		      </md-tab>
		    </md-tabs>
		  </md-content>
		</div>


	</fieldset>
</form>
</div>

<?php echo $this->Html->script('travelapplications/app'); ?>
<?php echo $this->Html->script('travelapplications/TravelapplicationEditController'); ?>

<?php echo $this->Html->script('shared/services/Office365UsersService'); ?>

<?php echo $this->Html->script('shared/services/NonInteractiveDialogService'); ?>

<?php echo $this->Html->script('shared/services/CountriesService'); ?>

<?php echo $this->Html->script('travelapplications/services/TravelapplicationsService'); ?>

