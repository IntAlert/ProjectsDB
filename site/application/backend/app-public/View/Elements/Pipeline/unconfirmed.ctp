

<table class="table">

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
				Submission Date
			</th>

			<th>
				Duration
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



			<th>
				Has 1+ contract(s)
			</th>

			<th>
				Complete annual budgets
			</th>

			<th>
				Has territories
			</th>

		</tr>

	</thead>

	<tbody>


<?php foreach ($unconfirmedProjects as $project): 

$projectChecker = new ProjectChecker($project);

?>
	

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
				<?php echo h($project['likelihood_short_name']); ?>
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
				  'M&\nb\s\p;y', // non breaking space
				  $project['proposal_date']
				); ?>
			</td>

			<td>
				<?php echo $project['duration_months']; ?>m
			</td>

			<td>
				<?php echo $this->MacNumber->currency($project['value_required']); ?>
			</td>

			<td>
				<?php 
					if($project['matched_funding_percentage'] === false) {
						echo 'n/a';
					} else {
						echo $this->MacNumber->toPercentage($project['matched_funding_percentage']);
					}

				?>
				
			</td>

			<td>
				<?php echo $this->MacNumber->currency($project['contract_primary']['contract_budget_this_year_gbp']); ?>
			</td>

			<td>
				<?php echo $this->MacNumber->currency($project['contract_primary']['contract_budget_next_year_gbp']); ?>
			</td>


			<td>
				
				<?php 

					if ($projectChecker->hasAtLeastOneContract()) {
						echo '<i class="fa fa-check"></i>';
					} else {
						echo '<i class="fa fa-times-circle"></i>';
					}

				?>

			</td>

			<td>
					<?php 

					if ($projectChecker->hasValidAnnualBudgets()) {
						echo '<i class="fa fa-check"></i>';
					} else {
						echo '<i class="fa fa-times-circle"></i>';
					}

					?>
			</td>

			<td>
				
				<?php 

					if ($projectChecker->hasValidTerritories()) {
						echo '<i class="fa fa-check"></i>';
					} else {
						echo '<i class="fa fa-times-circle"></i>';
					}

				?>

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
						echo h($project['likelihood_short_name']);
					?>
				</td>

				<td>
					<?php 
						if (isset($contract_secondary['Donor']['name'])) {
							echo h($contract_secondary['Donor']['name']);
						} else {
							echo 'none';
						}
					?>
				</td>

				<td>
					<?php echo $this->Time->format(
					  'M&\nb\s\p;y', // non breaking space
					  $project['proposal_date']
					); ?>
				</td>

				<td>
					<!--<?php echo $project['duration_months']; ?>m-->
				</td>

				<td>
					n/a
				</td>

				<td>
					n/a
				</td>

				<td>
					<?php echo $this->MacNumber->currency($contract_secondary['contract_budget_this_year_gbp']); ?>
				</td>

				<td>
					<?php echo $this->MacNumber->currency($contract_secondary['contract_budget_next_year_gbp']); ?>
				</td>

			</tr>

		<?php endforeach; // ($countries as $country): ?>

<?php endforeach; // ($countries as $country): ?>


	</tbody>


	<tfoot>
		<tr>
			<th colspan="8">
				Unconfirmed
			</th>
			<td>
				<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetThisYear(array('highly-likely', 'medium', 'low'))); ?>
			</td>
			<td>
				<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetNextYear(array('highly-likely', 'medium', 'low'))); ?>
			</td>
		</tr>
		<tr>
			<th colspan="8">
				Highly Likely
			</th>
			<td>
				<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetThisYear(array('highly-likely'))); ?>
			</td>
			<td>
				<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetNextYear(array('highly-likely'))); ?>
			</td>
		</tr>

		<tr>
			<th colspan="8" rowspan="2">
				Total Confirmed + Highly Likely against Budget
			</th>
			<td>
				<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetThisYear(array('confirmed', 'highly-likely'))); ?>
			</td>
			<td>
				<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetNextYear(array('confirmed', 'highly-likely'))); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $this->MacNumber->toPercentage($pipeline->getPercentageBudgetThisYear(array('confirmed', 'highly-likely'))); ?>
			</td>
			<td>
				<?php echo $this->MacNumber->toPercentage($pipeline->getPercentageBudgetNextYear(array('confirmed', 'highly-likely'))); ?>
			</td>
		</tr>
	</tfoot>



</table>


<?php // debug($unconfirmedProjects);