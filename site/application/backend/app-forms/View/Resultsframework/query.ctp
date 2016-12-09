<script>
	// for use when ouputing stateless access to API end points
	var api_key = "<?php echo $_SERVER['API_KEY']; ?>";
</script>


<?php $this->set('title', 'Query Monitoring Data'); ?>

<?php echo $this->Html->css('resultsframework/query', array('inline' => false)); ?>

<div class="resultsframework form" ng-app="resultsframework">
	
	<form ng-controller="ResultsframeworkQueryController">

	<fieldset>

		<div class="header clearfix">
		
			<legend><?php echo __('Query Monitoring Data'); ?></legend>

		</div>

		<div ng-cloak>
		  <md-content>
		    <md-tabs 
		    	md-dynamic-height
		    	md-border-bottom
		    	md-selected="selectedTabIndex"
		    	id="tabs"
		    >

		    <!-- TRAINING -->
		      <md-tab label="TRAINING">
		        <md-content 
		        	class="md-padding">

		        	<?php echo $this->element('Resultsframework/query/trainings'); ?>

		        </md-content>
		      </md-tab>

		    <!-- ACCOMPANIMENT -->
		      <md-tab label="ACCOMPANIMENT">
		        <md-content 
		        	class="md-padding">

		        <?php // echo $this->element('Resultsframework/query/accompaniments'); ?>

		        </md-content>
		      </md-tab>


		      <md-tab label="DIALOGUE">
		        <md-content 
		        	class="md-padding">

		        <?php // echo $this->element('Resultsframework/query/dialogues'); ?>
		        </md-content>
		      </md-tab>




		    <!-- RESEARCH -->
		      <md-tab label="RESEARCH">
		        <md-content 
		        	class="md-padding">

		      	<?php // echo $this->element('Resultsframework/query/researches'); ?>

		        </md-content>
		      </md-tab>


		    <!-- ADVOCACY AND OUTREACH -->
		      <md-tab label="ADVOCACY AND OUTREACH">
		        <md-content 
		        class="md-padding">

		        	<?php // echo $this->element('Resultsframework/query/advocacies'); ?>

		        </md-content>
		      </md-tab>



		      <!-- OTHER ACTIVITIES -->
		      <md-tab label="OTHER ACTIVITIES">
		        <md-content 
		        	class="md-padding">

		        <?php // echo $this->element('Resultsframework/query/other_activities'); ?>
		        </md-content>
		      </md-tab>

		    <!-- RESULTS -->
		      <md-tab label="results">
		        <md-content 
			        class="md-padding">

			        <?php // echo $this->element('Resultsframework/query/results'); ?>

		        </md-content>
		      </md-tab>

		    </md-tabs>
		  </md-content>
		</div>


	</fieldset>

</form>
</div>



<?php echo $this->Html->script('resultsframework/app'); ?>
<?php echo $this->Html->script('shared/services/NonInteractiveDialogService'); ?>
<?php echo $this->Html->script('shared/directives/StrategicPathwaySelector'); ?>
<?php echo $this->Html->script('shared/directives/dateStringSelector'); ?>

<?php echo $this->Html->script('shared/directives/NumberStringInput'); ?>

<?php echo $this->Html->script('resultsframework/services/DedupeService'); ?>
<?php echo $this->Html->script('resultsframework/services/ResultsFrameworkService'); ?>
<?php echo $this->Html->script('resultsframework/services/FormOptionsService'); ?>


<?php echo $this->Html->script('resultsframework/services/TrainingsService'); ?>
<?php echo $this->Html->script('resultsframework/services/ResearchesService'); ?>
<?php echo $this->Html->script('resultsframework/services/MeetingsService'); ?>
<?php echo $this->Html->script('resultsframework/services/ProcessesService'); ?>
<?php echo $this->Html->script('resultsframework/services/ResultsService'); ?>
<?php echo $this->Html->script('resultsframework/services/AdvocaciesService'); ?>
<?php echo $this->Html->script('resultsframework/services/AccompanimentsService'); ?>
<?php echo $this->Html->script('resultsframework/services/OtherActivitiesService'); ?>


<?php echo $this->Html->script('resultsframework/controllers/ResultsframeworkQueryController'); ?>
<?php // echo $this->Html->script('resultsframework/controllers/query/geography'); ?>
<?php // echo $this->Html->script('resultsframework/controllers/query/themes'); ?>
<?php // echo $this->Html->script('resultsframework/controllers/query/researches'); ?>
<?php // echo $this->Html->script('resultsframework/controllers/query/results'); ?>
<?php echo $this->Html->script('resultsframework/controllers/query/TrainingsQueryController'); ?>
<?php // echo $this->Html->script('resultsframework/controllers/query/meetings'); ?>
<?php // echo $this->Html->script('resultsframework/controllers/query/processes'); ?>
<?php // echo $this->Html->script('resultsframework/controllers/query/accompaniments'); ?>
<?php // echo $this->Html->script('resultsframework/controllers/query/advocacies'); ?>

<?php // echo $this->Html->script('resultsframework/controllers/query/other_activities'); ?>



<style type="text/css">/*pre {display: none}*/</style>