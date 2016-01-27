<?php echo $this->Html->css('projects/elements/territory-selector', array('inline' => false)); ?>
<?php echo $this->Html->script('projects/elements/territory-selector', array('inline' => false)); ?>

<?

	// get list of selected territory_ids
	$territory_ids = array();
	if(isset($this->request->data['Territory'])):
		foreach($this->request->data['Territory'] as $territory):
			$territory_ids[] = $territory['id'];
		endforeach; //($this->request->data['Territory'] as $territory):
	endif; //(is_array($this->request->data['Territory'])):

?>

<div class="territory-selector">


	<h3>
		Programme
	</h3>

	<div class="department ui-state-default clearfix">
		<?php
			echo $this->Form->input('department_id', array(
				'legend' => false,
				'tooltip' => 'Please select the programme which applies',
				'type' => 'radio',
			));

		?>
	</div>


	<h3>
		Territories, Countries or Sub-Programme
		<?php $this->Tooltip->element('Please select at least one territories/countries/PIP programmes'); ?>
	</h3>


	
	<!-- Empty Territory Checkbox -->


	<div class="ui-state-default clearfix">
		<div class="input select">
			<?php 

			foreach($territoriesWithDepartments as $territory):

			// build a list of programme_ids
			$department_ids = array();
			foreach ($territory['Department'] as $department) {
				$department_ids[] = $department['id'];
			}
			$department_ids_csv = implode(',', $department_ids);


			?>

				<?php 

				$checked_value = 
					array_search($territory['Territory']['id'], $territory_ids) === false 
						? '' : 'checked';

				echo $this->Form->input('Territory.Territory.', array(
					'type' => 'checkbox',
					'id' => 'TerritoryTerritory'.$territory['Territory']['id'],
					'value' => $territory['Territory']['id'],
					'label' => $territory['Territory']['name'],
					'hiddenField' => false,
					'data-department-ids-csv' => $department_ids_csv,
					'div' => 'territory-checkbox',
					'checked'=> $checked_value,
				)); ?>

			<?php endforeach; //($territoriesWithProgrammes as $territory): ?>
		</div>
	</div>


	

	<h3>
		Secondary Programme
	</h3>

	<div class="secondary-department ui-state-default clearfix">
		<?php
			echo $this->Form->input('secondary_department_id', array(
				'options' => $departments,
				'legend' => false,
				'tooltip' => 'If this project involves a secondary department/programme, please select a department',
				'type' => 'radio',
			));

		?>
	</div>

</div>



