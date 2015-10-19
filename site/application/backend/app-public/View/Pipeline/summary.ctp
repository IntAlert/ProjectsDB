<?php echo $this->Html->css('pipeline/pipeline', array('inline' => false)); ?>

<?php

	// create pipelines
	$pipelineThisYear = new MACPipeline($selectedYear, $departmentBudgetsThisYear, $budgetsThisYear);

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


<?php echo $this->element('Pipeline/nav'); ?>


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
			</tr>
		</thead>

		<tbody>

			<tr>
				<th>
					Total
				</th>
				<td>
					<!-- Budget -->
					<?php echo $this->MacNumber->currency($pipelineThisYear->getBudget('all')); ?>

				</td>


				<td class="confirmed-highly-likely">
					<!-- Confirmed -->
					<?php echo $this->MacNumber->currency($pipelineThisYear->getTotal("all", "confirmed")); ?>
				</td>
				<td class="confirmed-highly-likely">
					<!-- Confirmed percentage -->
					<?php echo $this->Number->toPercentage($pipelineThisYear->getPercentage("all", "confirmed")); ?>
				</td>


				<td class="confirmed-highly-likely">
					<!-- Confirmed + HL -->
					<?php echo $this->MacNumber->currency($pipelineThisYear->getTotal("all", array('confirmed', 'highly-likely'))); ?>
				</td>
				<td class="confirmed-highly-likely">
					<!-- Confirmed + HL percentage -->
					<?php echo $this->Number->toPercentage($pipelineThisYear->getPercentage("all", array('confirmed', 'highly-likely'))); ?>
				</td>

				<td class="pipeline">
					<!-- Total Unconfirmed -->
					<?php echo $this->MacNumber->currency($pipelineThisYear->getTotal("all", array("highly-likely", 'medium', 'low'))); ?>
				</td>
				<td class="pipeline">
					<!-- HL -->
					<?php echo $this->MacNumber->currency($pipelineThisYear->getTotal("all", "highly-likely")); ?>
				</td>
				<td class="pipeline">
					<!-- Low to Medium -->
					<?php echo $this->MacNumber->currency($pipelineThisYear->getTotal("all", array('low', 'medium'))); ?>
				</td>

			</tr>

	<?php foreach ($departmentsList as $department_id => $department_name): ?>


			<tr>
				<th>
					<?php echo $department_name; ?>
				</th>
				<td>
					<!-- Budget -->
					<?php echo $this->MacNumber->currency($pipelineThisYear->getBudget($department_id)); ?>

				</td>


				<td class="confirmed-highly-likely">
					<!-- Confirmed -->
					<?php echo $this->MacNumber->currency($pipelineThisYear->getTotal($department_id, "confirmed")); ?>
				</td>
				<td class="confirmed-highly-likely">
					<!-- Confirmed percentage -->
					<?php echo $this->Number->toPercentage($pipelineThisYear->getPercentage($department_id, "confirmed")); ?>
				</td>


				<td class="confirmed-highly-likely">
					<!-- Confirmed + HL -->
					<?php echo $this->MacNumber->currency($pipelineThisYear->getTotal($department_id, array('confirmed', 'highly-likely'))); ?>
				</td>
				<td class="confirmed-highly-likely">
					<!-- Confirmed + HL percentage -->
					<?php echo $this->Number->toPercentage($pipelineThisYear->getPercentage($department_id, array('confirmed', 'highly-likely'))); ?>
				</td>

				<td class="pipeline">
					<!-- Total Unconfirmed -->
					<?php echo $this->MacNumber->currency($pipelineThisYear->getTotal($department_id, array("highly-likely", 'medium', 'low'))); ?>
				</td>
				<td class="pipeline">
					<!-- HL -->
					<?php echo $this->MacNumber->currency($pipelineThisYear->getTotal($department_id, "highly-likely")); ?>
				</td>
				<td class="pipeline">
					<!-- Low to Medium -->
					<?php echo $this->MacNumber->currency($pipelineThisYear->getTotal($department_id, array('low', 'medium'))); ?>
				</td>


	<?php endforeach; // ($departments as $department): ?>

		</tbody>

	</table>
</div>

