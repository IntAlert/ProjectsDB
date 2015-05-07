<?php
	debug($pipelineThisYear);
	$pipelineThisYear = new MACPipeline(2015, $paymentsThisYear);
	$pipelineLastYear = new MACPipeline(2014, $paymentsLastYear);
?>

<table>

	<thead>
		<tr>
			<th colspan="9">
				<?php echo $pipelineThisYear->getYear(); ?> STATUS 
				as at <?php echo $this->Time->niceDate(); ?>
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
				Comparisson Figures as at DATE - year
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
				<?php echo $this->Number->currency($pipelineThisYear->getTotal("all", "unconfirmed"), 'GBP'); ?>
			</td>
			<td>
				<!-- HL -->
				<?php echo $this->Number->currency($pipelineThisYear->getTotal("all", "highly-likely"), 'GBP'); ?>
			</td>
			<td>
				<!-- Low to Medium -->
				<?php echo $this->Number->currency($pipelineThisYear->getTotal("all", "low-medium"), 'GBP'); ?>
			</td>


<!-- Last Year -->
			<td>
				<!-- Budget -->
				<?php echo $this->Number->currency($pipelineLastYear->getTotal("all", "budget"), 'GBP'); ?>
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

<?php for ($programme_id=0; $programme_id < 6; $programme_id++): ?>


		<tr>
			<th>
				Programme
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
				<?php echo $this->Number->currency($pipelineThisYear->getTotal($programme_id, "unconfirmed"), 'GBP'); ?>
			</td>
			<td>
				<!-- HL -->
				<?php echo $this->Number->currency($pipelineThisYear->getTotal($programme_id, "highly-likely"), 'GBP'); ?>
			</td>
			<td>
				<!-- Low to Medium -->
				<?php echo $this->Number->currency($pipelineThisYear->getTotal($programme_id, "low-medium"), 'GBP'); ?>
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

<?php endfor; // ($programme_id=0; $programme_id < 6; $programme_id++): ?>

	</tbody>

</table>