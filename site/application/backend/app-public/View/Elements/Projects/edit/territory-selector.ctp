<?php echo $this->Html->css('projects/elements/territory-selector', array('inline' => false)); ?>
<?php echo $this->Html->script('projects/elements/territory-selector', array('inline' => false)); ?>

<?

	// get list of selected territory_ids
	$territory_ids = array();

	foreach($this->request->data['Territory'] as $territory):
		$territory_ids[] = $territory['id'];
	endforeach; //($this->request->data['Territory'] as $territory):

?>

<div class="territory-selector">


	<h3>
		Programme
	</h3>

	<div class="ui-state-default clearfix">
		<?php
			echo $this->Form->input('programme_id', array(
				'legend' => false,
				// 'tooltip' => 'Please select the programme which applies',
				'type' => 'radio',
			));

		?>
	</div>


	<h3>
		Territories, Countries or PIP programme
		<?php $this->Tooltip->element('Please select at least one territories/countries/PIP programmes'); ?>
	</h3>


	
	<!-- Empty Territory Checkbox -->


	<div class="ui-state-default clearfix">
		<div class="input select">
			<?php 

			foreach($territoriesWithProgrammes as $territory):

			// build a list of programme_ids
			$programme_ids = array();
			foreach ($territory['Programme'] as $programme) {
				$programme_ids[] = $programme['id'];
			}
			$programme_ids_csv = implode(',', $programme_ids);


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
					'data-programme-ids-csv' => $programme_ids_csv,
					'div' => 'territory-checkbox',
					'checked'=> $checked_value,
				)); ?>

			<?php endforeach; //($territoriesWithProgrammes as $territory): ?>
		</div>
	</div>

</div>



