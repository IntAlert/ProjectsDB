<table>


	<tr>

		<th>
			Project
		</th>

		<th>
			Has Annual Budgets for all dates
		</th>

		<th>
			Likelihood
		</th>

		<th>
			Status
		</th>


		<th>
			Programme
		</th>

		<th>
			Beneficiaries
		</th>

		<th>
			Location
		</th>

		<th>
			Goals
		</th>

		<th>
			Objectives
		</th>

		<th>
			Summary
		</th>
		<th>
			Fund Code
		</th>

		<th>
			Shortfall
		</th>

		<th>
			Contracts
		</th>

		<th>
			Contract Budgets
		</th>

		<th>
			Has Themes
		</th>

		<th>
			Has Territories
		</th>

		<th>
			Has Dates
		</th>


	</tr>



	<?php foreach ($projects as $project): 


		$projectChecker = new ProjectChecker($project);


	?>

	<tr>
		
		<th>
			<!-- Title -->
			<?php echo $this->Html->link($project['Project']['title'], array('controller' => 'projects', 'action' => 'view', $project['Project']['id'])); ?>
		</th>

		<th>
			<!-- Has Annual Budgets for all dates -->
			<?php if($projectChecker->hasValidAnnualBudgets()) {
				echo $this->element('Projects/health/valid');
			} else {
				echo $this->element('Projects/health/invalid');
			} ?>


		</th>


		<th>
			<!-- Likelihood -->
		</th>

		<th>
			<!-- Status -->
		</th>


		<th>
			<!-- Programme -->
		</th>

		<th>
			<!-- Beneficiaries -->
		</th>

		<th>
			<!-- Location -->
		</th>

		<th>
			<!-- Goals -->
		</th>

		<th>
			<!-- Objectives -->
		</th>

		<th>
			<!-- Summary -->
		</th>
		<th>
			<!-- Fund Code -->
		</th>

		<th>
			<!-- Shortfall -->
		</th>

		<th>
			<!-- Contracts -->
		</th>

		<th>
			<!-- Contract Budgets -->
		</th>

		<th>
			<!-- Has Themes -->
		</th>

		<th>
			<!-- Has Territories -->
		</th>

		<th>
			<!-- Has Dates -->
		</th>

	</tr>

<?php endforeach; // ($projects as $project): ?>



</table>