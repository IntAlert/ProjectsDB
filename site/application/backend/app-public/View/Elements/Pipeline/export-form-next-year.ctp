<?php
	// create pipelines
	$pipelineNextYear = new MACPipeline($nextYear, $departmentBudgetsNextYear, $contractbudgetsNextYear);

	// get dates for convenience
	$now = new DateTime();
?>
<!-- Next Year / Slave form -->
<div class="pipeline-container">
	<h2>
		Pipeline

		<?php echo $nextYear; ?>
	</h2>




	<table class="table pipeline next-year">

		<thead>
			<tr>
				<th colspan="9" class="this-year">
					<?php echo $pipelineNextYear->getYear(); ?> STATUS 
					as at <?php echo $this->Time->nice($now); ?>
				</th>
				<th colspan="3" class="last-year">
					
					Comparison Date
					
				</th>
			</tr>


			<tr>
				<th colspan="2">
					<?php echo $pipelineNextYear->getYear(); ?> Budget Targets
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
					<span class="comparisson-date">Date not set</span>
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
					<?php echo $this->MacNumber->currency($pipelineNextYear->getBudget('all'), 'GBP'); ?>

				</td>


				<td class="confirmed-highly-likely">
					<!-- Confirmed -->
					<?php echo $this->MacNumber->currency($pipelineNextYear->getTotal("all", "confirmed"), 'GBP'); ?>
				</td>
				<td class="confirmed-highly-likely">
					<!-- Confirmed percentage -->
					<?php echo $this->Number->toPercentage($pipelineNextYear->getPercentage("all", "confirmed")); ?>
				</td>


				<td class="confirmed-highly-likely">
					<!-- Confirmed + HL -->
					<?php echo $this->MacNumber->currency($pipelineNextYear->getTotal("all", array('confirmed', 'highly-likely')), 'GBP'); ?>
				</td>
				<td class="confirmed-highly-likely">
					<!-- Confirmed + HL percentage -->
					<?php echo $this->Number->toPercentage($pipelineNextYear->getPercentage("all", array('confirmed', 'highly-likely'))); ?>
				</td>

				<td class="pipeline">
					<!-- Total Unconfirmed -->
					<?php echo $this->MacNumber->currency($pipelineNextYear->getTotal("all", array("highly-likely", 'medium', 'low')), 'GBP'); ?>
				</td>
				<td class="pipeline">
					<!-- HL -->
					<?php echo $this->MacNumber->currency($pipelineNextYear->getTotal("all", "highly-likely"), 'GBP'); ?>
				</td>
				<td class="pipeline">
					<!-- Low to Medium -->
					<?php echo $this->MacNumber->currency($pipelineNextYear->getTotal("all", array('low', 'medium')), 'GBP'); ?>
				</td>


	<!-- Last Year -->
				<td class="last-year">
					<!-- Budget -->
					&pound;<span class="department-budget-total"></span>
				</td>
				<td class="last-year">
					<!-- Value CF+HL -->
					&pound;<span class="department-cfhl-total"></span>
				</td>
				<td class="last-year">
					<!-- Confirmed + HL percentage -->
					<span class="department-cfhl-total-percentage"></span>%
				</td>
			</tr>

	<?php foreach ($departmentsList as $department_id => $department_name): ?>


			<tr>
				<th>
					<?php echo $department_name; ?>
				</th>
				<td>
					<!-- Budget -->
					<?php echo $this->MacNumber->currency($pipelineNextYear->getBudget($department_id), 'GBP'); ?>

				</td>


				<td class="confirmed-highly-likely">
					<!-- Confirmed -->
					<?php echo $this->MacNumber->currency($pipelineNextYear->getTotal($department_id, "confirmed"), 'GBP'); ?>
				</td>
				<td class="confirmed-highly-likely">
					<!-- Confirmed percentage -->
					<?php echo $this->Number->toPercentage($pipelineNextYear->getPercentage($department_id, "confirmed")); ?>
				</td>


				<td class="confirmed-highly-likely">
					<!-- Confirmed + HL -->
					<?php echo $this->MacNumber->currency($pipelineNextYear->getTotal($department_id, array('confirmed', 'highly-likely')), 'GBP'); ?>
				</td>
				<td class="confirmed-highly-likely">
					<!-- Confirmed + HL percentage -->
					<?php echo $this->Number->toPercentage($pipelineNextYear->getPercentage($department_id, array('confirmed', 'highly-likely'))); ?>
				</td>

				<td class="pipeline">
					<!-- Total Unconfirmed -->
					<?php echo $this->MacNumber->currency($pipelineNextYear->getTotal($department_id, array("highly-likely", 'medium', 'low')), 'GBP'); ?>
				</td>
				<td class="pipeline">
					<!-- HL -->
					<?php echo $this->MacNumber->currency($pipelineNextYear->getTotal($department_id, "highly-likely"), 'GBP'); ?>
				</td>
				<td class="pipeline">
					<!-- Low to Medium -->
					<?php echo $this->MacNumber->currency($pipelineNextYear->getTotal($department_id, array('low', 'medium')), 'GBP'); ?>
				</td>


	<!-- Last Year -->
				<td class="last-year">
					<!-- Budget -->
					<span 
						class="department-budget" 
						data-department-id="<?php echo $department_id;?>"
					></span>
				</td>
				<td class="last-year">
					<!-- Value CF+HL -->
					<span 
						class="department-cfhl" 
						data-department-id="<?php echo $department_id;?>"
					></span>
				</td>
				<td class="last-year">
					<!-- Confirmed + HL percentage -->
					<span 
						class="department-cfhl-percentage"
						data-department-id="<?php echo $department_id;?>"
					></span>%
				</td>
			</tr>

	<?php endforeach; // ($departments as $department): ?>

		</tbody>

	</table>
</div>