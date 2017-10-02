<?php echo $this->Html->css('projects/elements/territory-selector-2', array('inline' => false)); ?>
<?php echo $this->Html->script('projects/elements/territory-selector-2', array('inline' => false)); ?>

<?

	// get list of selected territory_ids
	$territory_ids = array();
	if(isset($this->request->data['Territory'])):
		foreach($this->request->data['Territory'] as $territory):
			$territory_ids[] = $territory['id'];
		endforeach; //($this->request->data['Territory'] as $territory):
	endif; //(is_array($this->request->data['Territory'])):

?>




<div class="territory-selector-2">

	<h3>
		Territories
	</h3>


	<!-- Territories orginised by continents -->
	<div class="continents">
		<?php foreach($continents as $continent): ?>

			<div class="continent">
			<h4>
				<?php echo $continent['Continent']['name']; ?>
			</h4>

			<?php foreach($continent['Territory'] as $territory): ?>

				<?php 

					$checked_value = 
						array_search($territory['id'], $territory_ids) === false 
							? '' : 'checked';

					echo $this->Form->input('Territory.Territory.', array(
						'type' => 'checkbox',
						'id' => 'TerritoryTerritory'.$territory['id'],
						'data-territory-type' => $territory['type'],
						'value' => $territory['id'],
						'label' => $territory['name'],
						'hiddenField' => false,
						'div' => 'territory-checkbox',
						'checked'=> $checked_value,
					)); 
				?>

			<?php endforeach; //($continent['Territory'] as $territory): ?>

			</div> <!-- class="continent" -->

		<?php endforeach; //($continents as $continent): ?>

	</div>
</div>





