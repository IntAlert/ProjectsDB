

<table>

	<thead>
		<tr>
			<th>
				Territory
			</th>

			<th>
				Project
			</th>

			<th>
				Likelihood
			</th>

			<th>
				Donor
			</th>

			<th>
				Dates
			</th>

			<th>
				Total Value
			</th>

			<th>
				% MF Acheived
			</th>

			<th>
				<?php echo $selectedYear; ?>
			</th>

			<th>
				<?php echo $selectedYear + 1; ?>
			</th>

		</tr>

	</thead>

	<tbody>


<?php foreach ($unconfirmedProjects as $project): ?>
	

		<!-- Primary Contract -->
		<tr>
			<td rowspan="<?php echo 1 + count($project['contracts_secondary']); ?>">
				<?php 
				if (count($project['territory_names']))
					echo $project['territory_names'][0]; 
				else
					echo 'No territory';
				?>
			</td>

			<td>
				<?php echo $this->Html->link($project['title'], array('controller' => 'projects', 'action' => 'view', $project['id'])); ?>
			</td>

			<td>
				<?php 
					if ($project['fund_code']) {
						echo h($project['fund_code']);
					} else {
						echo 'none';
					}
				?>
			</td>

			<td>
				<?php 
					if (isset($project['contract_primary']['Donor'])) {
						echo h($project['contract_primary']['Donor']['name']);
					} else {
						echo 'none';
					}
				?>
			</td>

			<td>
				<?php echo $this->Time->format(
				  "M y",
				  $project['start_date']
				); ?>
				-
				<?php echo $this->Time->format(
				  "M y",
				  $project['finish_date']
				); ?>
			</td>

			<td>
				<?php echo $this->Number->currency($project['value_required'], 'GBP'); ?>
			</td>

			<td>
				<?php 
					if($project['matched_funding_percentage'] === false) {
						echo 'n/a';
					} else {
						echo $this->Number->toPercentage($project['matched_funding_percentage']);
					}

				?>
				
			</td>

			<td>
				<?php echo $this->Number->currency($project['contract_primary']['contract_budget_this_year_gbp'], 'GBP'); ?>
			</td>

			<td>
				<?php echo $this->Number->currency($project['contract_primary']['contract_budget_next_year_gbp'], 'GBP'); ?>
			</td>

		</tr>


		<?php foreach ($project['contracts_secondary'] as $contract_secondary): ?>
			<!-- Secondary Contracts -->
			<tr>
				<!-- <td>
					
				</td> -->

				<td>
					<?php echo $project['title']; ?>
				</td>

				<td>
					<?php 
						echo h($project['likelihood']);
					?>
				</td>

				<td>
					<?php 
						if ($contract_secondary['Donor']['name']) {
							echo h($contract_secondary['Donor']['name']);
						} else {
							echo 'none';
						}
					?>
				</td>

				<td>
					<?php echo $this->Time->format(
					  'F, Y',
					  $project['start_date']
					); ?>
					-
					<?php echo $this->Time->format(
					  'F, Y',
					  $project['finish_date']
					); ?>
				</td>

				<td>
					n/a
				</td>

				<td>
					n/a
				</td>

				<td>
					<?php echo $this->Number->currency($contract_secondary['contract_budget_this_year_gbp'], 'GBP'); ?>
				</td>

				<td>
					<?php echo $this->Number->currency($contract_secondary['contract_budget_next_year_gbp'], 'GBP'); ?>
				</td>

			</tr>

		<?php endforeach; // ($countries as $country): ?>

<?php endforeach; // ($countries as $country): ?>


	</tbody>


	<tfoot>
		<tr>
			<th colspan="7">
				Unconfirmed
			</th>
			<td>
				<?php echo $this->Number->currency($pipeline->getTotalBudgetThisYear(array('highly-likely', 'medium', 'low')), 'GBP'); ?>
			</td>
			<td>
				<?php echo $this->Number->currency($pipeline->getTotalBudgetNextYear(array('highly-likely', 'medium', 'low')), 'GBP'); ?>
			</td>
		</tr>
		<tr>
			<th colspan="7">
				Highly Likely
			</th>
			<td>
				<?php echo $this->Number->currency($pipeline->getTotalBudgetThisYear(array('highly-likely')), 'GBP'); ?>
			</td>
			<td>
				<?php echo $this->Number->currency($pipeline->getTotalBudgetNextYear(array('highly-likely')), 'GBP'); ?>
			</td>
		</tr>

		<tr>
			<th colspan="7" rowspan="2">
				Total Confirmed + Highly Likely against Budget
			</th>
			<td>
				<?php echo $this->Number->currency($pipeline->getTotalBudgetThisYear(array('confirmed', 'highly-likely')), 'GBP'); ?>
			</td>
			<td>
				<?php echo $this->Number->currency($pipeline->getTotalBudgetNextYear(array('confirmed', 'highly-likely')), 'GBP'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $this->Number->toPercentage($pipeline->getPercentageBudgetThisYear(array('confirmed', 'highly-likely'))); ?>
			</td>
			<td>
				<?php echo $this->Number->toPercentage($pipeline->getPercentageBudgetNextYear(array('confirmed', 'highly-likely'))); ?>
			</td>
		</tr>
	</tfoot>



</table>


<?php // debug($unconfirmedProjects);