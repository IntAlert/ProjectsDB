<script>
	// for use when ouputing stateless access to API end points
	var api_key = "<?php echo $_SERVER['API_KEY']; ?>";
	var project_id = <?php echo $project['Project']['id']; ?>;
	
</script>


<?php $this->set('title', ' Monitoring Data for ' . $project['Project']['title']); ?>

<?php echo $this->Html->css('resultsframework/edit.css?v=2', array('inline' => false)); ?>

<div class="resultsframework form" ng-app="resultsframework">
	
	<form ng-controller="ResultsframeworkEditController">

	<fieldset>
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

		        	<?php echo $this->element('Resultsframework/edit/trainings'); ?>

		        </md-content>
		      </md-tab>

		    <!-- ACCOMPANIMENT -->
		      <md-tab label="ACCOMPANIMENT">
		        <md-content 
		        	class="md-padding">

		        <?php echo $this->element('Resultsframework/edit/accompaniments'); ?>

		        </md-content>
		      </md-tab>


		      <md-tab label="DIALOGUE">
		        <md-content 
		        	class="md-padding">

		        <?php echo $this->element('Resultsframework/edit/dialogues'); ?>
		        </md-content>
		      </md-tab>




		    <!-- RESEARCH -->
		      <md-tab label="RESEARCH">
		        <md-content 
		        	class="md-padding">

		      	<?php echo $this->element('Resultsframework/edit/researches'); ?>

		        </md-content>
		      </md-tab>


		    <!-- ADVOCACY AND OUTREACH -->
		      <md-tab label="ADVOCACY AND OUTREACH">
		        <md-content 
		        class="md-padding">

		        	<?php echo $this->element('Resultsframework/edit/advocacies'); ?>

		        </md-content>
		      </md-tab>



		      <!-- OTHER ACTIVITIES -->
		      <md-tab label="OTHER ACTIVITIES">
		        <md-content 
		        	class="md-padding">

		        <?php echo $this->element('Resultsframework/edit/other_activities'); ?>
		        </md-content>
		      </md-tab>

		    <!-- RESULTS -->
		      <md-tab label="results">
		        <md-content 
			        class="md-padding">

			        <?php echo $this->element('Resultsframework/edit/results'); ?>

		        </md-content>
		      </md-tab>

		    <!-- EXPORT -->
		      <md-tab label="export">
		        <md-content 
			        class="md-padding">

			        <?php echo $this->element('Resultsframework/edit/export'); ?>

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

<!-- Services -->
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

<!-- Controllers -->
<?php echo $this->Html->script('resultsframework/controllers/ResultsframeworkEditController'); ?>
<?php echo $this->Html->script('resultsframework/controllers/edit/researches'); ?>
<?php echo $this->Html->script('resultsframework/controllers/edit/results'); ?>
<?php echo $this->Html->script('resultsframework/controllers/edit/trainings'); ?>
<?php echo $this->Html->script('resultsframework/controllers/edit/meetings'); ?>
<?php echo $this->Html->script('resultsframework/controllers/edit/processes'); ?>
<?php echo $this->Html->script('resultsframework/controllers/edit/accompaniments'); ?>
<?php echo $this->Html->script('resultsframework/controllers/edit/advocacies'); ?>
<?php echo $this->Html->script('resultsframework/controllers/edit/other_activities'); ?>
<?php echo $this->Html->script('resultsframework/controllers/edit/export'); ?>
