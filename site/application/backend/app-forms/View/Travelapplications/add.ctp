<?php // echo $this->Html->script('travelapplications/add', array('inline' => false)); ?>

<?php echo $this->Html->css('travelapplications/add', array('inline' => false)); ?>

<div class="travelapplications form" ng-app="travelapplication">

	<?php echo $this->Form->create('Travelapplication', array(
		'ng-controller' => "TravelapplicationController"
	)); ?>

	<fieldset>
		<legend><?php echo __('New Travel Application'); ?></legend>



		<div ng-cloak>
		  <md-content>
		    <md-tabs md-dynamic-height md-border-bottom>
		      <md-tab label="general">
		        <md-content class="md-padding">

		          <?php echo $this->element('Travelapplications/mode'); ?>

		          <?php echo $this->element('Travelapplications/applicant'); ?>

		        </md-content>
		      </md-tab>
		      <md-tab label="contacts">
		        <md-content class="md-padding">
					<?php echo $this->element('Travelapplications/contact_home'); ?>

					<?php echo $this->element('Travelapplications/contact_incountry'); ?>

					<?php echo $this->element('Travelapplications/contact_other'); ?>

		        </md-content>
		      </md-tab>
		      <md-tab label="itinerary">
		        <md-content class="md-padding">
		          <?php echo $this->element('Travelapplications/itinerary'); ?>
		        </md-content>
		      </md-tab>

		      <md-tab label="meetings">
		        <md-content class="md-padding">
		          <?php echo $this->element('Travelapplications/schedule'); ?>
		        </md-content>
		      </md-tab>

		      <md-tab label="checklist">
		        <md-content class="md-padding">
		          <?php echo $this->element('Travelapplications/tickboxes'); ?>
		        </md-content>
		      </md-tab>

		      <md-tab label="confirm">
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

<?php echo $this->Html->script('travelapplications/main', array('inline' => false)); ?>