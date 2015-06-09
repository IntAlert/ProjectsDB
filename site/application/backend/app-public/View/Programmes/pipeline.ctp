<?

$pipeline = new MACPipelineByProgramme($selectedYear, $projects, $programmeBudgetThisYear, $programmeBudgetNextYear);

$unconfirmedProjects = $pipeline->getFlattenedProjects(array('highly-likely', 'medium', 'low'));
$confirmedProjects = $pipeline->getFlattenedProjects(array('confirmed'));



?>

<?php echo $this->element('Programmes/pipeline-nav'); ?>

<div class="pipeline-container">
	<h2>
		<?php echo $programme['Programme']['name']; ?>

		<?php echo $selectedYear; ?>
	</h2>



	<!-- Summary -->
	<section>

		<table class="table">
			<tr>
				<td>
					<h3>Summary</h3>
				</td>
				<th>
					<?php echo $selectedYear; ?>
				</th>
				<th>
					<?php echo $selectedYear + 1; ?>
				</th>
			</tr>

			<!-- Budget -->
			<tr>
				<th>
					Budget
				</th>
				<td>
					<?php echo $this->Number->currency($programmeBudgetThisYear, 'GBP'); ?>
				</td>
				<td>
					<?php echo $this->Number->currency($programmeBudgetNextYear, 'GBP'); ?>
				</td>
			</tr>

			<!-- Confirmed -->
			<tr>
				<th>
					Confirmed
				</th>
				<td>
					<?php echo $this->Number->currency($pipeline->getTotalBudgetThisYear(array('confirmed')), 'GBP'); ?>
					(<?php echo $this->Number->toPercentage($pipeline->getPercentageBudgetThisYear(array('confirmed'))); ?>)
				</td>
				<td>
					<?php echo $this->Number->currency($pipeline->getTotalBudgetNextYear(array('confirmed')), 'GBP'); ?>
					(<?php echo $this->Number->toPercentage($pipeline->getPercentageBudgetNextYear(array('confirmed'))); ?>)
				</td>
			</tr>

			<!-- Highly Likely -->
			<tr>
				<th>
					Highly Likely
				</th>
				<td>
					<?php echo $this->Number->currency($pipeline->getTotalBudgetThisYear(array('highly-likely')), 'GBP'); ?>
					(<?php echo $this->Number->toPercentage($pipeline->getPercentageBudgetThisYear(array('highly-likely'))); ?>)
				</td>
				<td>
					<?php echo $this->Number->currency($pipeline->getTotalBudgetNextYear(array('highly-likely')), 'GBP'); ?>
					(<?php echo $this->Number->toPercentage($pipeline->getPercentageBudgetNextYear(array('highly-likely'))); ?>)
				</td>
			</tr>

			<!-- Confirmed + Highly Likely -->
			<tr>
				<th>
					Confirmed + Highly Likely
				</th>
				<td>
					<?php echo $this->Number->currency($pipeline->getTotalBudgetThisYear(array('confirmed', 'highly-likely')), 'GBP'); ?>
					(<?php echo $this->Number->toPercentage($pipeline->getPercentageBudgetThisYear(array('confirmed', 'highly-likely'))); ?>)
				</td>
				<td>
					<?php echo $this->Number->currency($pipeline->getTotalBudgetNextYear(array('confirmed', 'highly-likely')), 'GBP'); ?>
					(<?php echo $this->Number->toPercentage($pipeline->getPercentageBudgetNextYear(array('confirmed', 'highly-likely'))); ?>)
				</td>
			</tr>

			<!-- Unconfirmed -->
			<tr>
				<th>
					Unconfirmed
				</th>
				<td>
					<?php echo $this->Number->currency($pipeline->getTotalBudgetThisYear(array('highly-likely', 'medium', 'low')), 'GBP'); ?>
				</td>
				<td>
					<?php echo $this->Number->currency($pipeline->getTotalBudgetNextYear(array('highly-likely', 'medium', 'low')), 'GBP'); ?>
				</td>
			</tr>
		</table>
	</section>


	<!-- Confirmed Funding -->
	<section>
		<h3>Confirmed Funding</h3>
		<? if (count($confirmedProjects)): ?>
			<?php echo $this->element('Programmes/pipeline-by-programme-confirmed', compact('pipeline', 'confirmedProjects')); ?>	
		<? else: // (count($confirmedProjects)): ?>
			<p>None</p>
		<? endif; // (count($confirmedProjects)): ?>
		
	</section>

	<!-- Total Confirmed + Highly Likely Funding -->

	<section>
		<h3>Unconfirmed Funding</h3>
		<? if (count($unconfirmedProjects)): ?>
			<?php echo $this->element('Programmes/pipeline-by-programme-unconfirmed', compact('pipeline', 'unconfirmedProjects')); ?>
		<? else: // (count($confirmedProjects)): ?>
			<p>None</p>
		<? endif; // (count($confirmedProjects)): ?>
		

	</section>
</div>
