<h2>Programme Budgets <?php echo $year;  ?></h2>
<?php echo $this->Form->create('Programmebudget'); ?>




<table class="table">
	<thead>
		<th>Programme</th>
		<td>Target Budget</td>
	</thead>
<?php foreach ($programmes as $programme_id => $programme_name): ?>
	

<tr>
	<th>
		<?php echo $programme_name; ?>
	</th>

	<td>
		
		<?php echo $this->Form->input('Programmebudget.'.$programme_id.'.value_gbp', array(
			'label' => false,
			'type' => 'number',
			'value' => 
				isset($programmeBudgetsThisYear[$programme_id]) 
					? $programmeBudgetsThisYear[$programme_id] : 0,
		));?>
	</td>
</tr>



<?php endforeach; // ($programmes as $programme): ?>
</table>


<?php echo $this->Form->end(__('Save ' . $year . ' Programme Budgets')); ?>