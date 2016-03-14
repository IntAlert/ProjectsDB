<?php
	// create pipelines
	$pipelineThisYear = new MACPipeline($selectedYear, $departmentBudgetsThisYear, $contractbudgetsThisYear);

	// get dates for convenience
	$now = new DateTime();
?>

<!-- This year / Master Form -->

<div class="pipeline-container">
	<h2>
		Pipeline

		<?php echo $selectedYear; ?>
	</h2>




	<table class="table pipeline this-year">

		<thead>
			<tr>
				<th colspan="9" class="this-year">
					<?php echo $pipelineThisYear->getYear(); ?> STATUS 
					as at <?php echo $this->Time->nice($now); ?>
				</th>
				<th colspan="3" class="last-year">
					
					Comparison Date
					
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
					Comparison Figures as at <br>
					<input type="hidden" class="datepicker comparisson-date" name="comparisson-date-this-year">
					<a class="datepicker-nice" href="#">No date set</a>
					 for current year projections
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


	<!-- Last Year -->
				<td class="last-year">
					<!-- Budget -->
					<input 
						type="number"
						class="garlic-persist department-budget" 
						name="department-budget-this-year[<?php echo $department_id;?>]"
						data-department-id="<?php echo $department_id;?>"
					>
					
					<!-- hidden, unless printed -->
					<span 
						class="department-budget" 
						data-department-id="<?php echo $department_id;?>"
					></span>
				</td>
				<td class="last-year">
					<!-- Value CF+HL -->
					<input 
						type="number"
						class="garlic-persist department-cfhl" 
						name="department-cfhl-this-year[<?php echo $department_id;?>]"
						data-department-id="<?php echo $department_id;?>"
					>

					<!-- hidden, unless printed -->
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
