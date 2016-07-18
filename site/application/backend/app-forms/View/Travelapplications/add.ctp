<?php // echo $this->Html->script('travelapplications/add', array('inline' => false)); ?>

<?php echo $this->Html->css('travelapplications/add', array('inline' => false)); ?>

<div class="travelapplications form" ng-app="travelapplication">
	
	<?php echo $this->Form->create('Travelapplication', array(
		'name' => 'Travelapplication',
		'ng-controller' => "TravelapplicationController"
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

					<md-button 
						ng-show="generalForm.$valid"
						ng-click=" changeActiveTab(1) "
						class="md-raised">
						Next
					</md-button>

		        </md-content>
		      </md-tab>



		      <!-- Applicant -->
		      <md-tab label="applicant" ng-disabled="disableTabsByValid && generalForm.$invalid">
		        <md-content class="md-padding" ng-form="applicantForm">

		          <?php echo $this->element('Travelapplications/applicant'); ?>

		          <md-button 
						ng-show="applicantForm.$valid"
						ng-click=" changeActiveTab(2) "
						class="md-raised">
						Next
					</md-button>

		        </md-content>
		      </md-tab>

		      <!-- Contacts -->
		      <md-tab label="contacts" ng-disabled="disableTabsByValid && applicantForm.$invalid">
		        <md-content class="md-padding" ng-form="contactsForm">
					
				<?php echo $this->element('Travelapplications/contact_home'); ?>

				<?php echo $this->element('Travelapplications/contact_incountry'); ?>

				<?php echo $this->element('Travelapplications/contact_other'); ?>

					<md-button 
						ng-show="contactsForm.$valid"
						ng-click=" changeActiveTab(3) "
						class="md-raised">
						Next
					</md-button>

		        </md-content>
		      </md-tab>

		      <!-- Itinerary -->
		      <md-tab label="itinerary" ng-disabled="disableTabsByValid && contactsForm.$invalid">
		        <md-content class="md-padding" ng-form="itineraryForm">
		          <?php echo $this->element('Travelapplications/itinerary'); ?>

					<md-button 
						ng-show="itineraryForm.$valid"
						ng-click=" changeActiveTab(4) "
						class="md-raised">
						Next
					</md-button>

		        </md-content>
		      </md-tab>

		      <!-- Meetings -->
		      <md-tab label="meetings" ng-disabled="disableTabsByValid && itineraryForm.$invalid">

		        <md-content class="md-padding" ng-form="meetingsForm">
		          <?php echo $this->element('Travelapplications/meetings'); ?>
		        </md-content>

		        <md-button 
						ng-show="meetingsForm.$valid"
						ng-click=" changeActiveTab(5) "
						class="md-raised">
						Next
				</md-button>

		      </md-tab>

		      <!-- Security -->
		      <md-tab label="security" ng-disabled="disableTabsByValid && meetingsForm.$invalid">
		        
		        <md-content class="md-padding" ng-form="securityForm">
		          <?php echo $this->element('Travelapplications/security'); ?>
		        </md-content>

		        <md-button 
					ng-show="securityForm.$valid"
					ng-click=" changeActiveTab(6) "
					class="md-raised">
					Next
				</md-button>

		      </md-tab>

		      <!-- Checklist -->
		      <md-tab 
		      	label="checklist" 
		      	ng-disabled="disableTabsByValid && securityForm.$invalid">
		        <md-content class="md-padding" ng-form="checklistForm">
		          <?php echo $this->element('Travelapplications/checklist'); ?>

					<md-button 
						ng-show="checklistForm.$valid"
						ng-click=" changeActiveTab(7) "
						class="md-raised">
						Next
					</md-button>

		        </md-content>
		      </md-tab>

		      <!-- Confirm -->
		      <md-tab label="confirm" ng-disabled="disableTabsByValid && checklistForm.$invalid">
		        <md-content class="md-padding">
		          <?php echo $this->element('Travelapplications/confirm'); ?>
		        </md-content>


				<md-button 
					ng-show="checklistForm.$valid"
					ng-click=" submitTravelApplication() "
					class="md-raised">
					Submit Travel Application
				</md-button>

		      </md-tab>
		    </md-tabs>
		  </md-content>
		</div>


	</fieldset>
</form>
</div>

<?php echo $this->Html->script('travelapplications/main', array('inline' => false)); ?>