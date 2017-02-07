
<?php if ($this->request->query('action')): ?>

<div class="project-search-results">

<?php if (count($projects)): ?>


<?php echo $this->element('Projects/search/export'); ?>


<table>

	<thead>
		<tr>
			<th>
				Territory
			</th>

			<th>
				Status
			</th>

			<th>
				Project
			</th>

<!-- 		<th>
				Fund code
			</th>
 -->
			<th>
				Donor
			</th>

			<th>
				Dates
			</th>

			<th>
				Total Value
			</th>

		</tr>

	</thead>

	<tbody>


<?php foreach ($projects as $project):


$territory_names = [];
foreach($project['Territory'] as $territory) {
	array_push($territory_names, $territory['name']);
}




// determine primary contract
$contract_primary = count($project['Contract']) ? $project['Contract'][0] : false;

// determine secondary contracts
$contracts_secondary = (count($project['Contract']) > 1) ? array_slice($project['Contract'], 1) : array();



 ?>
	

		<!-- Primary Contract -->
		<tr>
			<td rowspan="<?php echo 1 + count($contracts_secondary); ?>">

				<?php 

					if (count($territory_names)) echo implode(', ', $territory_names);
						else echo "None";
				?>
			</td>

			<td>
				<?php echo $project['Status']['name'] ?>
			</td>

			<td>
				<?php echo $this->Html->link($project['Project']['title'], array('controller' => 'projects', 'action' => 'view', $project['Project']['id'])); ?>
			</td>

			<!-- <td>
				<?php 
					if ($project['Project']['fund_code']) {
						echo h($project['Project']['fund_code']);
					} else {
						echo 'none';
					}
				?>
			</td> -->

			<td>
				<?php 
					if ($contract_primary['Donor']) {
						
						echo h($contract_primary['Donor']['name']);

					} else {
						echo 'none';
					}
				?>
			</td>

			<td>
				<?php 

				echo $this->Time->format(
				  'M&\nb\s\p;y', // non breaking space
				  $project['Project']['start_date']
				); 

				echo '-';
				
				echo $this->Time->format(
				  'M&\nb\s\p;y', // non breaking space
				  $project['Project']['finish_date']
				); 

				?>
				(<?php echo $this->CustomTime->differenceInMonths($project['Project']['start_date'], $project['Project']['finish_date']); ?>)
			</td>

			<td>
				<?php echo $this->MacNumber->currency($project['Project']['value_required']); ?>
			</td>

		</tr>


		<?php foreach ($contracts_secondary as $contract_secondary): ?>
			<!-- Secondary Contracts -->
			<tr>
				<!-- <td>
					
				</td> -->

				<td>
					<?php echo $project['Project']['title']; ?>
				</td>

				<!-- <td>
					<?php 
						if ($project['Project']['fund_code']) {
							echo h($project['Project']['fund_code']);
						} else {
							echo 'none';
						}
					?>
				</td> -->

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
					<?php 

					echo $this->Time->format(
					  'M y',
					  $project['Project']['start_date']
					); 
					echo '-';
					echo $this->Time->format(
					  'M y',
					  $project['Project']['finish_date']
					); 

					?>
				</td>

				<td>
					
				</td>

			</tr>

		<?php endforeach; // ($countries as $country): ?>

<?php endforeach; // ($countries as $country): ?>


	</tbody>



</table>
<?php // debug($projects); ?>

<?php echo $this->element('Projects/search/pagination'); ?>


<?php else: // (count($projects)): ?>
	<p class="error">No results for your search criteria.</p>
<?php endif; // (count($projects)): ?>

</div>


<?php endif; // ($this->request->query('action')): ?>