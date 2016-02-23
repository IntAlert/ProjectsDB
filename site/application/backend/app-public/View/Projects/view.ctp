<?php $this->set('title', 'Projects - ' . $project['Project']['title']); ?>
<?php echo $this->Html->css('projects/view', array('inline' => false)); ?>
<?php echo $this->Html->script('projects/view', array('inline' => false)); ?>


<?php

// calculate shortfall
$shortfall = 
	+ $project['Project']['value_required'] 
	- $project['Project']['value_sourced'];


// create array of country names
$territory_names = [];
foreach($project['Territory'] as $territory) {
	array_push($territory_names, $territory['name']);
}

// create array of theme names
$theme_names = [];
foreach($project['Theme'] as $theme) {
	array_push($theme_names, $theme['name']);
}

// create array of theme names
$pathway_names = [];
foreach($project['Pathway'] as $pathway) {
	array_push($pathway_names, $pathway['name']);
}

// create array of donor names
$donor_names = [];
foreach($project['Contract'] as $contract) {
	array_push($donor_names, $contract['Donor']['name']);
}



?>
<script>
var data = <?php echo json_encode($project); ?>;
</script>


<nav class="subnav clearfix">
	<ul>
		<li><?php echo $this->Html->link(__('Edit Project'), array('action' => 'edit', $project['Project']['id'])); ?> </li>
		

<?php if (isset($sharepoint_root_folder)): ?>
		<li>
			<a 
			target="_blank"
			href="https://intlalert.sharepoint.com/prompt/Documents/Forms/AllItems.aspx?RootFolder=<?php echo urlencode($sharepoint_root_folder); ?>">
				View Project Documents
			</a>
		</li>
<?php endif; // (isset($sharepoint_root_folder)): ?>

	</ul>
</nav>

<div class="projects view">
<h2><?php echo h($project['Project']['title']); ?></h2>


<table class="table">
		<tr>
			<th>
				<?php echo __('Budget Holder'); ?>
			</th>
			<td>
				<?php 
				if (trim($project['OwnerUser']['name'])) {
					echo h($project['OwnerUser']['name']);
				} else {
					echo "No budget holder selected <strong>(Please amend)</strong>";
				} ?>

				
				&nbsp;
			</td>
		</tr>

		<tr>
			<th>
				<?php echo __('Programme'); ?>
			</th>
			<td>
				<?php echo h($project['Department']['name']); ?>
			</td>
		</tr>




<?php if ($project['SecondaryDepartment']['name']): ?>
		<tr>
			<th>
				<?php echo __('Secondary Programme'); ?>
				</th>
			<td>
				<?php echo h($project['SecondaryDepartment']['name']); ?>
			</td>
		</tr>

<?php endif; // ($project['SecondaryDepartment']['name']): ?>



		<tr>
			<th>
				<?php echo __('Status'); ?>
				</th>
			<td>
				<?php echo h($project['Status']['name']); ?>
			</td>
		</tr>


		<tr>
			<th>
				<?php echo __('Likelihood'); ?>
				</th>
			<td>
				<?php echo h($project['Likelihood']['name']); ?>
			</td>
		</tr>


		<tr>
			<th>
				<?php echo __('Territory/ies'); ?>
			</th>
		<td>
			<?php 

			if (count($territory_names)) echo implode(', ', $territory_names);
				else echo "None"

				?>
			</td>
		</tr>


		<tr>
			<th>
				<?php echo __('Strategic Pathway(s)'); ?>
			</th>
		<td>
			<?php 

			if (count($pathway_names)) echo implode(', ', $pathway_names);
				else echo "None"

				?>
			</td>
		</tr>

		<tr>
			<th>
				<?php echo __('Theme(s)'); ?>
			</th>
		<td>
			<?php 

			if (count($theme_names)) echo implode(', ', $theme_names);
				else echo "None"

				?>
			</td>
		</tr>

		<tr>
			<th>
				<?php echo __('Donor(s)'); ?>
			</th>
		<td>
			<?php 

			if (count($donor_names)) echo implode(', ', $donor_names);
				else echo "None"

				?>
			</td>
		</tr>

		
		
		
		<tr>
			<th>
				<?php echo __('Timespan'); ?>
			</th>
		<td>
			<?php echo $this->Time->format(
			  'F jS, Y',
			  $project['Project']['start_date']
			); ?>
			-
			<?php echo $this->Time->format(
				  'F jS, Y',
				  $project['Project']['finish_date']
				); ?>
			</td>
		</tr>



		<tr>
			<th>
				<?php echo __(' Total ALERT contract value (GBP)'); ?>
			</th>
			<td>
				<?php echo $this->Number->currency($project['Project']['value_required'], 'GBP'); ?>
				&nbsp;
			</td>
		</tr>


		<tr>
			<th>
				<?php echo __('Raised (GBP)'); ?>
			</th>
		<td>
			<?php echo $this->Number->currency(
				$project['Project']['value_sourced']
				, 'GBP'); ?>
				&nbsp;
			</td>
		</tr>


		<tr>
			<th>
				<?php echo __('Shortfall (GBP)'); ?>
			</th>
			<td>
				<?php echo $this->Number->currency($shortfall, 'GBP'); ?>
				&nbsp;
			</td>
		</tr>

		
	</table>



<div class="contracts block">


<h3>
	Donors, Contracts and Budgets
</h3>


<?php if ( empty($project['Contract']) ): ?>
	
	<p>None</p>

<?php else: // ( empty($project['Contract']) ): ?>


<?php foreach ($project['Contract'] as $contract): 


$contract_value_total_gbp = 0;
$contract_value_total_donor_currency = 0;



?>
	<div class="contract">
		<h4>
			<?php echo $contract['Donor']['name']; ?>
		</h4>

		<table>
			<thead>
				<tr>
					<th>
						Year
					</th>

					<th>
						Value (GBP)
					</th>

					<th>
						Value (Donor Currency)
					</th>
				</tr>
			</thead>

			<tbody>
<?php foreach ($contract['Contractbudget'] as $contractbudget): 

$contract_value_total_gbp += $contractbudget['value_gbp'];
$contract_value_total_donor_currency += $contractbudget['value_donor_currency'];

?>
				<tr>
					<td>
						<?php echo $contractbudget['year']; ?>
					</td>

					<td>

						<?php echo $this->Number->currency(
							$contractbudget['value_gbp'],
							'GBP'
						); ?>
						
					</td>
					<td>
						<?php echo $this->Number->currency(
							$contractbudget['value_donor_currency'],
							$contract['Currency']['code']
						); ?>
					</td>
				</tr>
<?php endforeach; // ($project['Contract'] as $contract): ?>
			</tbody>

			<tfoot>
				<tr>
					<td>
						Total ALERT contract value
					</td>

					<td>

						<?php echo $this->Number->currency(
							$contract_value_total_gbp,
							'GBP'
						); ?>
						
					</td>
					<td>
						<?php echo $this->Number->currency(
							$contract_value_total_donor_currency,
							$contract['Currency']['code']
						); ?>
					</td>
				</tr>

			<?php if ($contract['origin_total_value']): ?>
				<tr>
					<td>
						Total origin donor contract value
					</td>

					<td>
						<!-- Only show donor currency -->
					</td>
					<td>
						<?php echo $this->Number->currency(
							$contract['origin_total_value'],
							$contract['Currency']['code']
						); ?>
					</td>
				</tr>
			<?php endif;  // ($contract['Contract']['origin_total_value']): ?>

			</tfoot>
		</table>


	</div>
<?php endforeach; // ($project['Contract'] as $contract): ?>

<?php endif; // ( empty($project['Contract']) ): ?>


</div>



<?php 

$textBlocks = array(
	'summary' => 'Summary',
	'beneficiaries' => 'Beneficiaries',
	'location' => 'Locations',
	'goals' => 'Goals',
	'objectives' => 'Objectives',
	'partners' => 'Partners',
);
?>

<?php foreach ($textBlocks as $key => $niceName): ?>

	<?php if (trim($project['Project'][$key])): ?>
	<div class="summary block">
		<h3><?php echo $niceName; ?></h3>

		<pre><?php echo h($project['Project'][$key]); ?></pre>

	</div>
	<?php endif; // (trim($project['Project']['summary'])): ?>


<?php endforeach; // ($textBlocks as $key => $textBlock): ?>



<?php echo $this->element('Projects/view/urls'); ?>


<?php echo $this->element('Projects/view/docs'); ?>

<?php echo $this->element('Projects/view/activity'); ?>

<?php echo $this->element('Projects/view/projectnotes'); ?>


<?php if ($project['Project']['id'] == '30'): ?>
<iframe width="100%" height="500" src="https://intlalert.sharepoint.com/prompt/Documents/Forms/AllItems.aspx?RootFolder=%2Fprompt%2FDocuments%2FPRODUCTION%2Fprojects%2Fproject_id_98%2Fgeneral"></iframe>
<?php endif; // ($project['Project']['id'] == '30'): ?>

<!-- 

<br><br><br>
	<h3>Project Activity</h3>
 -->
</div>

