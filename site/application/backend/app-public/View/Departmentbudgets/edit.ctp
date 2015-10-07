<h2>Department Budgets <?php echo $year;  ?></h2>
<?php echo $this->Form->create('Departmentbudget'); ?>




<table class="table">
	<thead>
		<th>Department</th>
		<td>Target Budget</td>
	</thead>
<?php foreach ($departments as $department_id => $department_name): ?>
	

<tr>
	<th>
		<?php echo $department_name; ?>
	</th>

	<td>
		
		<?php echo $this->Form->input('Departmentbudget.'.$department_id.'.value_gbp', array(
			'label' => false,
			'type' => 'number',
			'value' => 
				isset($departmentBudgetsThisYear[$department_id]) 
					? $departmentBudgetsThisYear[$department_id] : 0,
		));?>
	</td>
</tr>



<?php endforeach; // ($departments as $department): ?>
</table>


<?php echo $this->Form->end(__('Save ' . $year . ' Department Budgets')); ?>