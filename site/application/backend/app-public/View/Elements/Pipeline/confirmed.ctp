<?
$confirmedProjects = $pipeline->getFlattenedProjects(array('confirmed'));
?>

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
				Fund code
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


<?php foreach ($confirmedProjects as $project): ?>
	

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
					if (isset($project['contract_primary']['donor_name'])) {
						echo h($project['contract_primary']['donor_name']);
					} else {
						echo 'none';
					}
				?>
			</td>

			<td>
				<?php 

				echo $this->Time->format(
				  'M&\nb\s\p;y', // non breaking space
				  $project['start_date']
				); 

				echo '-';
				
				echo $this->Time->format(
				  'M&\nb\s\p;y', // non breaking space
				  $project['finish_date']
				); 

				?>
			</td>

			<td>
				<?php echo $this->MacNumber->currency($project['value_required']); ?>
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
				<?php echo $this->MacNumber->currency($project['contract_primary']['contract_budget_this_year_gbp']); ?>
			</td>

			<td>
				<?php echo $this->MacNumber->currency($project['contract_primary']['contract_budget_next_year_gbp']); ?>
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
						if ($project['fund_code']) {
							echo h($project['fund_code']);
						} else {
							echo 'none';
						}
					?>
				</td>

				<td>
					<?php 
						if (isset($contract_secondary['donor_name'])) {
							echo h($contract_secondary['donor_name']);
						} else {
							echo 'none';
						}
					?>
				</td>

				<td>
					<?php 

					echo $this->Time->format(
					  'M y',
					  $project['start_date']
					); 
					echo '-';
					echo $this->Time->format(
					  'M y',
					  $project['finish_date']
					); 

					?>
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
			<th colspan="7" rowspan="2">
				Total confirmed against Budget
			</th>
			<td>
				<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetThisYear(array('confirmed'))); ?>
			</td>
			<td>
				<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetNextYear(array('confirmed'))); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $this->Number->toPercentage($pipeline->getPercentageBudgetThisYear(array('confirmed'))); ?>
			</td>
			<td>
				<?php echo $this->Number->toPercentage($pipeline->getPercentageBudgetNextYear(array('confirmed'))); ?>
			</td>
		</tr>
	</tfoot>



</table>
<?php // debug($confirmedProjects);