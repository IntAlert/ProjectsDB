<?php echo $this->Html->css('departments/pipeline', array('inline' => false)); ?>

<?php

	// create pipelines
	$pipelineThisYear = new MACPipeline($selectedYear, $departmentBudgetsThisYear, $budgetsThisYear);
	$pipelineLastYear = new MACPipeline($selectedYear - 1, $departmentBudgetsLastYear, $budgetsLastYear);

	// get dates for convenience
	$now = new DateTime();
	$thisTimeLastYear = clone $now;
	$thisTimeLastYear->modify('-1 Year');

?>



<!-- Budget Warning -->
<?php if (count($departmentBudgetsThisYear) < count($departmentsList)): ?>
<div class="notice">
	Warning: Department budgets are not set for <?php echo $selectedYear; ?>.
	<a href="/pdb/departmentbudgets/edit/<?php echo $selectedYear; ?>">Click here to update budgets for this year</a>.
</div>
<?php endif; // (count($departmentBudgetsThisYear) == 0): ?>

<?php if (count($departmentBudgetsLastYear) < count($departmentsList)): ?>
<div class="notice">
	Warning: Department budgets are not set for <?php echo $selectedYear - 1; ?>.
	<a href="/pdb/departmentbudgets/edit/<?php echo $selectedYear - 1; ?>">Click here to update budgets for this year</a>.
</div>
<?php endif; // (count($departmentBudgetsThisYear) == 0): ?>



<?php echo $this->element('Departments/pipeline-nav'); ?>


<div class="pipeline-container">
	<h2>
		Summary

		<?php echo $selectedYear; ?>
	</h2>




	<table class="table pipeline">

		<thead>
			<tr>
				<th colspan="9" class="this-year">
					<?php echo $pipelineThisYear->getYear(); ?> STATUS 
					as at <?php echo $this->Time->nice($now); ?>
				</th>
				<th colspan="3" class="last-year">
					<?php echo $pipelineLastYear->getYear(); ?> Progress to Target
				</th>
			</tr>


			<tr>
				<th colspan="2">
					<?php echo $pipelineThisYear->getYear(); ?> Budget Targets
				</th>
				<th colspan="4">
					Progress Status to Target Against Budget
					(confirmed and highly likely)
				</th>
				<th colspan="3">
					Pipeline (all unconfirmed)
				</th>
				<th colspan="3">
					Comparisson Figures as at <br>
					<?php echo $this->Time->nice($thisTimeLastYear); ?>
				</th>
			</tr>

			<tr>
				<th>
					Department
				</th>
				<th>
					Budget
				</th>

				<th colspan="2">
					Confirmed
				</th>

				<th colspan="2">
					Confirmed &amp; Highly Likely
				</th>
				<th>
					Total Unconfirmed
				</th>
				<th>
					Highly Likely
				</th>
				<th>
					Low to Medium
				</th>
				<th>
					Budget
				</th>
				<th>
					Value CF&amp;HL
				</th>
				<th>
					CF/HL
				</th>
			</tr>
		</thead>

		<tbody>

			<tr>
				<th>
					Total
				</th>
				<td>
					<!-- Budget -->
					<?php echo $this->Number->currency($pipelineThisYear->getBudget('all'), 'GBP'); ?>

				</td>


				<td class="confirmed-highly-likely">
					<!-- Confirmed -->
					<?php echo $this->Number->currency($pipelineThisYear->getTotal("all", "confirmed"), 'GBP'); ?>
				</td>
				<td class="confirmed-highly-likely">
					<!-- Confirmed percentage -->
					<?php echo $this->Number->toPercentage($pipelineThisYear->getPercentage("all", "confirmed")); ?>
				</td>


				<td class="confirmed-highly-likely">
					<!-- Confirmed + HL -->
					<?php echo $this->Number->currency($pipelineThisYear->getTotal("all", array('confirmed', 'highly-likely')), 'GBP'); ?>
				</td>
				<td class="confirmed-highly-likely">
					<!-- Confirmed + HL percentage -->
					<?php echo $this->Number->toPercentage($pipelineThisYear->getPercentage("all", array('confirmed', 'highly-likely'))); ?>
				</td>

				<td class="pipeline">
					<!-- Total Unconfirmed -->
					<?php echo $this->Number->currency($pipelineThisYear->getTotal("all", array("highly-likely", 'medium', 'low')), 'GBP'); ?>
				</td>
				<td class="pipeline">
					<!-- HL -->
					<?php echo $this->Number->currency($pipelineThisYear->getTotal("all", "highly-likely"), 'GBP'); ?>
				</td>
				<td class="pipeline">
					<!-- Low to Medium -->
					<?php echo $this->Number->currency($pipelineThisYear->getTotal("all", array('low', 'medium')), 'GBP'); ?>
				</td>


	<!-- Last Year -->
				<td class="last-year">
					<!-- Budget -->
					<?php echo $this->Number->currency($pipelineLastYear->getBudget("all"), 'GBP'); ?>
				</td>
				<td class="last-year">
					<!-- Value CF+HL -->
					<?php echo $this->Number->currency($pipelineLastYear->getTotal("all", array('confirmed', 'highly-likely')), 'GBP'); ?>
				</td>
				<td class="last-year">
					<!-- Confirmed + HL percentage -->
					<?php echo $this->Number->toPercentage($pipelineLastYear->getPercentage("all", array('confirmed', 'highly-likely'))); ?>
				</td>
			</tr>

	<?php foreach ($departmentsList as $department_id => $department_name): ?>


			<tr>
				<th>
					<?php echo $department_name; ?>
				</th>
				<td>
					<!-- Budget -->
					<?php echo $this->Number->currency($pipelineThisYear->getBudget($department_id), 'GBP'); ?>

				</td>


				<td class="confirmed-highly-likely">
					<!-- Confirmed -->
					<?php echo $this->Number->currency($pipelineThisYear->getTotal($department_id, "confirmed"), 'GBP'); ?>
				</td>
				<td class="confirmed-highly-likely">
					<!-- Confirmed percentage -->
					<?php echo $this->Number->toPercentage($pipelineThisYear->getPercentage($department_id, "confirmed")); ?>
				</td>


				<td class="confirmed-highly-likely">
					<!-- Confirmed + HL -->
					<?php echo $this->Number->currency($pipelineThisYear->getTotal($department_id, array('confirmed', 'highly-likely')), 'GBP'); ?>
				</td>
				<td class="confirmed-highly-likely">
					<!-- Confirmed + HL percentage -->
					<?php echo $this->Number->toPercentage($pipelineThisYear->getPercentage($department_id, array('confirmed', 'highly-likely'))); ?>
				</td>

				<td class="pipeline">
					<!-- Total Unconfirmed -->
					<?php echo $this->Number->currency($pipelineThisYear->getTotal($department_id, array("highly-likely", 'medium', 'low')), 'GBP'); ?>
				</td>
				<td class="pipeline">
					<!-- HL -->
					<?php echo $this->Number->currency($pipelineThisYear->getTotal($department_id, "highly-likely"), 'GBP'); ?>
				</td>
				<td class="pipeline">
					<!-- Low to Medium -->
					<?php echo $this->Number->currency($pipelineThisYear->getTotal($department_id, array('low', 'medium')), 'GBP'); ?>
				</td>


	<!-- Last Year -->
				<td class="last-year">
					<!-- Budget -->
					<?php echo $this->Number->currency($pipelineLastYear->getBudget($department_id), 'GBP'); ?>
				</td>
				<td class="last-year">
					<!-- Value CF+HL -->
					<?php echo $this->Number->currency($pipelineLastYear->getTotal($department_id, array('confirmed', 'highly-likely')), 'GBP'); ?>
				</td>
				<td class="last-year">
					<!-- Confirmed + HL percentage -->
					<?php echo $this->Number->toPercentage($pipelineLastYear->getPercentage($department_id, array('confirmed', 'highly-likely'))); ?>
				</td>
			</tr>

	<?php endforeach; // ($departments as $department): ?>

		</tbody>

	</table>
</div>

