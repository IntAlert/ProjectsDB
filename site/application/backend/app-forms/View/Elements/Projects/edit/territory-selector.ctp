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

	<?php echo $this->Tooltip->inline_required(); ?>

	<div class="department ui-state-default clearfix">
		<?php
			echo $this->Form->input('department_id', array(
				'legend' => false,
				'tooltip' => 'The programme or department within Alert who will sign or has signed the contract',
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

			// allow none to be selected
			$departmentsWithNone = 
				array_replace($departments, array(0 => 'No secondary department'));


			echo $this->Form->input('secondary_department_id', array(
				'options' => $departmentsWithNone,
				'legend' => false,
				'tooltip' => 'If the proposal or project involves more than one Alert programme - for example if Africa Programme is leading a proposal for a project in Uganda that focuses on conflict-sensitivity in the oil sector, and PIP Economic Development for Peace (EDP) team is involved in the project proposal and implementation, then you would select "PIP" as secondary programme here.',
				'type' => 'radio',
			));

		?>
	</div>

</div>



