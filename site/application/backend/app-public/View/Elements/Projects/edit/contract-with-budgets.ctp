<?php 
echo $this->Html->script('projects/elements/contract-with-budgets', array('inline' => false));
echo $this->Html->css('projects/elements/contract-with-budgets', array('inline' => false));

// for convenience
$project = $this->request->data;





// append earliest and latest contractbudget year
if(!empty($project['Contract'])):
foreach($project['Contract'] as &$contract):

	$earliestYear = $latestYear = null;

	foreach ($contract['Contractbudget'] as $contractbudget) {
		if (is_null($earliestYear) || $contractbudget['year'] < $earliestYear) {
			$earliestYear = $contractbudget['year'];
		}

		if (is_null($latestYear) || $contractbudget['year'] > $latestYear) {
			$latestYear = $contractbudget['year'];
		}
	}

	$contract['contractbudget_earliest_year'] = $earliestYear;
	$contract['contractbudget_latest_year'] = $latestYear;

endforeach; //($projects['Contract'] as $contract):
unset($contract);
endif; //(count($project['Contract'])):

// debug($project);

?>

<div class="component-contracts">
<h2>Contracts and Contract Budgets</h2>


<a class="btn btn-contract-add" href="#">
	Add Contract
</a>


<div class="contracts">
<?php if (isset($project['Contract'])): ?>
<?php foreach ($project['Contract'] as $contract): 

// debug($contract);
?>


	<div 
		class="contract"
		data-contract-id="<?php echo $contract['id']; ?>"
		data-contractbudget-earliest-year="<?php echo $contract['contractbudget_earliest_year']; ?>"
		data-contractbudget-latest-year="<?php echo $contract['contractbudget_latest_year']; ?>"
	>


		<table class="table">
			<thead>
				<tr>

					<td>
						Donor
					</td>

					<td>
						Donor currency
					</td>
					
				</tr>
			</thead>

			<tbody>
				<tr>

					<td>
						<?php echo $this->Form->input('Contract.'.$contract['id'].'.donor_id', array(
							'id' => false,
							'label' => false,
							'empty' => '---- Please Select ----',
							'value' => $contract['donor_id'],
							'options' => $donors,
							'class' => 'contract-donor-id',
						)); ?>
					</td>

					<td>

						<?php echo $this->Form->input('Contract.'.$contract['id'].'.currency_id', array(
							'label' => false,
							'type' => 'select',
							'empty' => '---- Please Select ----',
							'value' => $contract['currency_id'],
							'options' => $currencies,
							'class' => 'contract-donor-currency',
						)); ?>

					</td>
				</tr>

				<tr>
					<td colspan="2">
						<?php echo $this->Form->input('Contract.'.$contract['id'].'.summary', array(
							'label' => 'Comments',
							'value' => $contract['summary'],
							'class' => 'contract-summary',
						)); ?>
					</td>
				</tr>




			</tbody>
		</table>
		

		<div class="contractbudgets">
			<h3>Annual Budgets</h3>

			<table class="table">
				<thead>
					<tr>

						<th>
							Year
						</th>

						<th>
							Value (Donor currency)
						</th>

						<th>
							Value (GBP)
						</th>

						<th>
							<!-- controls -->
							<a class="btn btn-contractbudget-add-before" href="#">
								Add year
							</a>
						</th>


					</tr>
				</thead>

				<tbody>


	<?php foreach ($contract['Contractbudget'] as $contractbudget):

	
	?>
					<tr class="contractbudget">
						<td>
							<span class="year">
								<?php echo $contractbudget['year']; ?>
							</span>
							<?php echo $this->Form->input('Contract.'.$contract['id'].'.Contractbudget.'.$contractbudget['id'].'.year', array(
								'type' => 'hidden',
								'label' => false,
								'class' => 'year',
								'value' => $contractbudget['year'],
							)); ?>
						</td>

						<td>
							<?php echo $this->Form->input('Contract.'.$contract['id'].'.Contractbudget.'.$contractbudget['id'].'.value_donor_currency', array(
								'value' => $contractbudget['value_donor_currency'],
								'label' => false,
								'class' => 'value_donor_currency',
							)); ?>
						</td>

						<td>
							<?php echo $this->Form->input('Contract.'.$contract['id'].'.Contractbudget.'.$contractbudget['id'].'.value_gbp', array(
								'value' => $contractbudget['value_gbp'],
								'label' => false,
								'class' => 'value_gbp',
							)); ?>
						</td>

						<td>

<?php echo $this->Form->input('Contract.'.$contract['id'].'.Contractbudget.'.$contractbudget['id'].'.id', array(
	'type' => 'hidden', 
	'value' => $contractbudget['id']
)); ?>

							<a class="btn btn-contractbudget-delete" href="#">
								Delete
							</a>
						</td>
					</tr>
	<?php endforeach; // ($contract['Payment'] as $payment): ?>


					


				</tbody>

				<tfoot>
					<tr>
					<td>
						Total
					</td>
					<td class="total_value_donor_currency">
						
					</td>
					<td class="total_value_gbp">
						
					</td>
					<td>
						<a class="btn btn-contractbudget-add-after" href="#">
							Add year
						</a>
					</td>
				</tr>
				</tfoot>
			</table>

			

			

		</div> <!-- End payments -->

<?php echo $this->Form->input('Contract.'.$contract['id'].'.id', array(
	'type' => 'hidden', 
	'value' => $contract['id'])); 
?>

<?php echo $this->Form->input('Contract.'.$contract['id'].'.deleted', array(
	'type' => 'hidden', 
	'value' => $contract['deleted'],
	'class' => 'deleted',
)); ?>

	<a class="btn btn-contract-delete" href="#">
		Delete Contract
	</a>


	</div> <!-- End Contract -->



<?php endforeach; // ($project['Contract'] as $contract): ?>
<?php endif; // (isset($project['Contract'])): ?>


</div>



<!-- Template -->

<div class="contract template">


		<table>
			<thead>
				<tr>

					<td>
						Donor
					</td>

					<td>
						Donor currency
					</td>
					
				</tr>
			</thead>

			<tbody>
				<tr>

					<td>
						<?php echo $this->Form->input('Contract.{contract_id}.donor_id', array(
							'id' => false,
							'label' => false,
							'id' => false,
							'empty' => '---- Please Select ----',
							'options' => $donors,
							'class' => 'contract-donor-id',
						)); ?>
					</td>

					<td>

						<?php echo $this->Form->input('Contract.{contract_id}.currency_id', array(
							'label' => false,
							'type' => 'select',
							'id' => false,
							'empty' => '---- Please Select ----',
							'options' => $currencies,
							'class' => 'contract-donor-currency',
						)); ?>

					</td>
				</tr>

				<tr>
					<td colspan="2">
						<?php echo $this->Form->input('Contract.{contract_id}.summary', array(
							'label' => 'Comments',
							'id' => false,
							'class' => 'contract-summary',
						)); ?>
					</td>
				</tr>

			</tbody>
		</table>
		

		<div class="contractbudgets">
			<h3>Annual Budgets</h3>
			
			<table>
				<thead>
					<tr>

						<th>
							Year
						</th>

						<th>
							Value (Donor currency)
						</th>

						<th>
							Value (GBP)
						</th>

						<th>
							<!-- controls -->
							<a class="btn btn-contractbudget-add-before" href="#">
								Add year
							</a>
						</th>


					</tr>
				</thead>

				<tbody>


					<tr class="contractbudget">
						<td>
							
							<span class="year">
								
							</span>

							<?php echo $this->Form->input('Contract.{contract_id}.Contractbudget.{contractbudget_id}.year', array(
								'type' => 'hidden',
								'id' => false,
								'label' => false,
								'class' => 'year',
							)); ?>
						</td>

						<td>
							<?php echo $this->Form->input('Contract.{contract_id}.Contractbudget.{contractbudget_id}.value_donor_currency', array(
									'id' => false,
									'label' => false,
									'class' => 'value_donor_currency',
							)); ?>
						</td>

						<td>
							<?php echo $this->Form->input('Contract.{contract_id}.Contractbudget.{contractbudget_id}.value_gbp', array(
									'id' => false,
									'label' => false,
									'class' => 'value_gbp',
							)); ?>
						</td>
						<td>
							<a class="btn btn-contractbudget-delete" href="#">
								Delete
							</a>
						</td>
					</tr>

				</tbody>

				<tfoot>
					<tr>
					<td>
						Total
					</td>
					<td class="total_value_donor_currency">
						
					</td>
					<td class="total_value_gbp">
						
					</td>
					<td>
						<a class="btn btn-contractbudget-add-after" href="#">
							Add year
						</a>
					</td>
				</tr>
				</tfoot>

			</table>

			
			
		

		</div> <!-- End payments -->

		<a class="btn btn-contract-delete" href="#">
			Delete Contract
		</a>
		
	</div> <!-- End Contract -->

</div> <!-- End Component Contracts -->