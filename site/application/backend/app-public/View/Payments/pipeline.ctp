<?php
	
	// build year options
	$years = array();
	for ($year=$firstYear; $year <= $thisYear; $year++) {
		$years[$year] = $year;
	}

	// create pipelines
	$pipelineThisYear = new MACPipeline($selectedYear, $programmeBudgetsThisYear, $paymentsThisYear);
	$pipelineLastYear = new MACPipeline($selectedYear - 1, $programmeBudgetsLastYear, $paymentsLastYear);

	$this->Html->script('payments/pipeline', array('inline' => false));

	// get dates for convenience
	$now = new DateTime();
	$thisTimeLastYear = clone $now;
	$thisTimeLastYear->modify('-1 Year');

?>

<form>

<?php echo $this->Form->input('selectedYear', array(
	'type' => 'select',
	'options' => $years,
	'value' => $selectedYear,
)); ?>

</form>

<!-- Budget Warning -->
<?php if (count($programmeBudgetsThisYear) < count($programmesList)): ?>
<div class="notice">
	Warning: Programme budgets are not set for <?php echo $thisYear; ?>.
	<a href="/pdb/programmebudgets/<?php echo $thisYear; ?>">Click here to update budgets for this year</a>.
</div>
<?php endif; // (count($programmeBudgetsThisYear) == 0): ?>

<?php if (count($programmeBudgetsLastYear) < count($programmesList)): ?>
<div class="notice">
	Warning: Programme budgets are not set for <?php echo $thisYear - 1; ?>.
	<a href="/pdb/programmebudgets/<?php echo $thisYear - 1; ?>">Click here to update budgets for this year</a>.
</div>
<?php endif; // (count($programmeBudgetsThisYear) == 0): ?>

<table class="table">

	<thead>
		<tr>
			<th colspan="9">
				<?php echo $pipelineThisYear->getYear(); ?> STATUS 
				as at <?php echo $this->Time->nice($now); ?>
			</th>
			<th colspan="3">
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
				Programme
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


			<td>
				<!-- Confirmed -->
				<?php echo $this->Number->currency($pipelineThisYear->getTotal("all", "confirmed"), 'GBP'); ?>
			</td>
			<td>
				<!-- Confirmed percentage -->
				<?php echo $this->Number->toPercentage($pipelineThisYear->getPercentage("all", "confirmed")); ?>
			</td>


			<td>
				<!-- Confirmed + HL -->
				<?php echo $this->Number->currency($pipelineThisYear->getTotal("all", array('confirmed', 'highly-likely')), 'GBP'); ?>
			</td>
			<td>
				<!-- Confirmed + HL percentage -->
				<?php echo $this->Number->toPercentage($pipelineThisYear->getPercentage("all", array('confirmed', 'highly-likely'))); ?>
			</td>

			<td>
				<!-- Total Unconfirmed -->
				<?php echo $this->Number->currency($pipelineThisYear->getTotal("all", array("highly-likely", 'medium', 'low')), 'GBP'); ?>
			</td>
			<td>
				<!-- HL -->
				<?php echo $this->Number->currency($pipelineThisYear->getTotal("all", "highly-likely"), 'GBP'); ?>
			</td>
			<td>
				<!-- Low to Medium -->
				<?php echo $this->Number->currency($pipelineThisYear->getTotal("all", array('low', 'medium')), 'GBP'); ?>
			</td>


<!-- Last Year -->
			<td>
				<!-- Budget -->
				<?php echo $this->Number->currency($pipelineLastYear->getBudget("all"), 'GBP'); ?>
			</td>
			<td>
				<!-- Value CF+HL -->
				<?php echo $this->Number->currency($pipelineLastYear->getTotal("all", array('confirmed', 'highly-likely')), 'GBP'); ?>
			</td>
			<td>
				<!-- Confirmed + HL percentage -->
				<?php echo $this->Number->toPercentage($pipelineLastYear->getPercentage("all", array('confirmed', 'highly-likely'))); ?>
			</td>
		</tr>

<?php foreach ($programmesList as $programme_id => $programme_name): ?>


		<tr>
			<th>
				<?php echo $programme_name; ?>
			</th>
			<td>
				<!-- Budget -->
				<?php echo $this->Number->currency($pipelineThisYear->getBudget($programme_id), 'GBP'); ?>

			</td>


			<td>
				<!-- Confirmed -->
				<?php echo $this->Number->currency($pipelineThisYear->getTotal($programme_id, "confirmed"), 'GBP'); ?>
			</td>
			<td>
				<!-- Confirmed percentage -->
				<?php echo $this->Number->toPercentage($pipelineThisYear->getPercentage($programme_id, "confirmed")); ?>
			</td>


			<td>
				<!-- Confirmed + HL -->
				<?php echo $this->Number->currency($pipelineThisYear->getTotal($programme_id, array('confirmed', 'highly-likely')), 'GBP'); ?>
			</td>
			<td>
				<!-- Confirmed + HL percentage -->
				<?php echo $this->Number->toPercentage($pipelineThisYear->getPercentage($programme_id, array('confirmed', 'highly-likely'))); ?>
			</td>

			<td>
				<!-- Total Unconfirmed -->
				<?php echo $this->Number->currency($pipelineThisYear->getTotal($programme_id, array("highly-likely", 'medium', 'low')), 'GBP'); ?>
			</td>
			<td>
				<!-- HL -->
				<?php echo $this->Number->currency($pipelineThisYear->getTotal($programme_id, "highly-likely"), 'GBP'); ?>
			</td>
			<td>
				<!-- Low to Medium -->
				<?php echo $this->Number->currency($pipelineThisYear->getTotal($programme_id, array('low', 'medium')), 'GBP'); ?>
			</td>


<!-- Last Year -->
			<td>
				<!-- Budget -->
				<?php echo $this->Number->currency($pipelineLastYear->getBudget($programme_id), 'GBP'); ?>
			</td>
			<td>
				<!-- Value CF+HL -->
				<?php echo $this->Number->currency($pipelineLastYear->getTotal($programme_id, array('confirmed', 'highly-likely')), 'GBP'); ?>
			</td>
			<td>
				<!-- Confirmed + HL percentage -->
				<?php echo $this->Number->toPercentage($pipelineLastYear->getPercentage($programme_id, array('confirmed', 'highly-likely'))); ?>
			</td>
		</tr>

<?php endforeach; // ($programmes as $programme): ?>

	</tbody>

</table>