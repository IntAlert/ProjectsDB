<?php // echo $this->Html->script('travelapplications/add', array('inline' => false)); ?>

<?php echo $this->Html->css('resultsframework/add', array('inline' => false)); ?>

<div class="resultsframework form" ng-app="resultsframework">
	
	<form ng-controller="ResultsframeworkController">

		<md-button 
			class="md-raised" 
			ng-click="save()">
			Save Whole Record
		</md-button>
	
	<fieldset>
		<legend><?php echo __('Results for Project LOREM IPSUM'); ?></legend>

		<div ng-cloak>
		  <md-content>
		    <md-tabs md-dynamic-height md-border-bottom md-selected="selectedTabIndex" id="tabs">



			<!-- GEOGRAPHY -->
		      <md-tab label="GEOGRAPHY">
		        <md-content 
		        class="md-padding" 
		        ng-controller="GeographyController"
		        ng-form="geographyForm">

		        <?php echo $this->element('Resultsframework/geography'); ?>

		        </md-content>
		      </md-tab>

		    <!-- THEMES -->
		      <md-tab label="PATHWAYS/THEMES">
		        <md-content 
		        	class="md-padding" 
		        	ng-controller="ThemesController"
		        	ng-form="themesForm">

		        <?php echo $this->element('Resultsframework/themes'); ?>

		        </md-content>
		      </md-tab>

		    <!-- TRAINING -->
		      <md-tab label="TRAINING">
		        <md-content 
		        	class="md-padding" 
		        	ng-controller="TrainingsController"
		        	ng-form="trainingForm">

		        	<?php echo $this->element('Resultsframework/trainings'); ?>

		        </md-content>
		      </md-tab>

		    <!-- ACCOMPANIMENT -->
		      <md-tab label="ACCOMPANIMENT">
		        <md-content 
		        	class="md-padding" 
		        	ng-controller="AccompanimentsController"
		        	ng-form="accompanimentForm">

		        <?php echo $this->element('Resultsframework/accompaniments'); ?>

		        </md-content>
		      </md-tab>

		    <!-- DIALOGUE -->
		      <md-tab label="DIALOGUE">
		        <md-content 
		        	class="md-padding" 
		        	ng-controller="DialoguesController"
		        	ng-form="dialogueForm">

		        <?php echo $this->element('Resultsframework/dialogues'); ?>
		        </md-content>
		      </md-tab>

		    <!-- RESEARCH -->
		      <md-tab label="RESEARCH">
		        <md-content 
		        	class="md-padding" 
		        	ng-controller="ResearchesController"
		        	ng-form="researchForm">

		      	<?php echo $this->element('Resultsframework/researches'); ?>

		        </md-content>
		      </md-tab>


		    <!-- ADVOCACY AND OUTREACH -->
		      <md-tab label="ADVOCACY AND OUTREACH">
		        <md-content 
		        class="md-padding" 
	        	ng-controller="AdvocaciesController"
		        ng-form="advocacyForm">

		        	<?php echo $this->element('Resultsframework/advocacies'); ?>

		        </md-content>
		      </md-tab>


		    <!-- RESULTS -->
		      <md-tab label="results">
		        <md-content 
			        ng-controller="ResultsController"
			        class="md-padding" 
			        ng-form="resultsForm">

			        <?php echo $this->element('Resultsframework/results'); ?>

		        </md-content>
		      </md-tab>

		    </md-tabs>
		  </md-content>
		</div>


	</fieldset>

</form>
</div>



<?php echo $this->Html->script('resultsframework/app'); ?>
<?php echo $this->Html->script('resultsframework/services/DedupeService'); ?>
<?php echo $this->Html->script('resultsframework/services/ResultsFrameworkService'); ?>
<?php echo $this->Html->script('resultsframework/geography'); ?>
<?php echo $this->Html->script('resultsframework/themes'); ?>
<?php echo $this->Html->script('resultsframework/researches'); ?>
<?php echo $this->Html->script('resultsframework/results'); ?>
<?php echo $this->Html->script('resultsframework/trainings'); ?>
<?php echo $this->Html->script('resultsframework/dialogues'); ?>
<?php echo $this->Html->script('resultsframework/accompaniments'); ?>
<?php echo $this->Html->script('resultsframework/advocacies'); ?>


<style type="text/css">/*pre {display: none}*/</style>