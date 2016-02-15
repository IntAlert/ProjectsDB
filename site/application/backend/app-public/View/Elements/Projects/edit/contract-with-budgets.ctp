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

<a class="btn btn-contract-add" href="#" style="float:right">
	Add Information and documents
</a>
<h2>
	Donors, Contracts and Budgets
	<?php echo $this->Tooltip->element('This section requires you to complete data for each donor contract you have with the project'); ?>
</h2>





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
						Overall origin donor
						<?php echo $this->Tooltip->element('Where the funding originates from. For example, in Nigeria Alert is a consortium sub-partner to the British Council for a Security & Reconciliation project funded by DFID. In this case, DFID is the origin donor and the "sub-donor" to Alert is British Council.'); ?>
					</td>

					<td>
						Donor Framework
						<?php echo $this->Tooltip->element('Frameworks are pre-selection mechanisms used by donors to restrict the pool of applicants/suppliers. Examples include the UK Conflict, Stability & Security Fund (CSSF) framework or the DFID Fragile & Conflict-Affected States (FCAS) framework. USAID also uses frameworks but calls them Indefinite Quantity Contracts (IQC).'); ?>
					</td>

					<td>
						Sub-donor
						<?php echo $this->Tooltip->element('Who Alert signs a contract with - may be another NGO or a commercial contractor - who holds the overall project contract with the origin donor'); ?>
					</td>
					
				</tr>
			</thead>

			<tbody>
				<tr>

					<td>
						<?php echo $this->Form->input('Contract.'.$contract['id'].'.donor_id', array(

							'id' => false,
							'value' => $contract['donor_id'],
							'type' => 'select',
							'label' => false,
							'empty' => '---- Please Select ----',
							'options' => $donors,
							'class' => 'contract-donor-id',

						)); ?>
					</td>

					<td>

						<?php echo $this->Form->input('Contract.'.$contract['id'].'.framework_id', array(
							'label' => false,
							'type' => 'select',
							'empty' => '---- No Donor Framework ----',
							'value' => $contract['framework_id'],
							'options' => $frameworks,
							'class' => 'contract-donor-framework'
						)); ?>

					</td>

					<td>
						<?php echo $this->Form->input('Contract.'.$contract['id'].'.subdonor_name', array(

							'id' => false,
							'value' => $contract['subdonor_name'],
							'type' => 'text',
							'label' => false,
							'class' => 'contract-subdonor-name',

						)); ?>
					</td>
				</tr>

				<tr>

					

					<td>
						Contract Category
						<?php echo $this->Tooltip->element('Please enter the type of contract that Alert holds (the overall contract with origin donor may be a different type). For example, in Nigeria, Alert holds a sub-contract with the British Council for a Security & Reconciliation project. British Council holds the overall project contract with DFID which is a service contract.'); ?>
					</td>



					<td>
						Donor currency
						<?php echo $this->Tooltip->element('Please select from the list.  If your currency is not listed, please contact Technology team to amend.'); ?>

					</td>

					<td>
						Total origin donor contract value (Donor Currency) (Donor currency)
						<?php echo $this->Tooltip->element('This should be the total budget for the whole project across all partners – reflecting the full budget of the primary contract holder with the donor, or the sum of all consortium member budgets. For example, in Nigeria, Alert is part of a consortium led by the British Council. British Council has a £33 million GBP contract with DFID for the whole project. Alert is a partner in British Council’s consortium and our sub-contract with British Council for the project is £795,000. In this case the Total origin donor contract value (Donor Currency) is £33,000,000 so that would be entered in this field.'); ?>

					</td>
					
				</tr>
				
				<tr>

					

					<td>

						<?php echo $this->Form->input('Contract.'.$contract['id'].'.contractcategory_id', array(
							'label' => false,
							'type' => 'select',
							'empty' => '---- Please Select ----',
							'value' => $contract['contractcategory_id'],
							'options' => $contractcategories,
							'class' => 'contract-category'
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

					<td>

						<?php echo $this->Form->input('Contract.'.$contract['id'].'.origin_total_value', array(
							'label' => false,
							'type' => 'text',
							'class' => 'contract-origin-total-value',
						)); ?>

					</td>

				</tr>

				<tr>
					<td colspan="3">
						<?php echo $this->Form->input('Contract.'.$contract['id'].'.summary', array(
							'label' => 'Comments',
							'value' => $contract['summary'],
							'class' => 'contract-summary',
							'tooltip' => 'Free text space for any comments, e.g. please note if the contract has been amended.',
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

			

			<small><a target="_blank" href="https://portal.international-alert.org/fis/mer/SitePages/Home.aspx">Alert's working exchange rates are published here</a></small>

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
						Overall origin donor
						<?php echo $this->Tooltip->element('Where the funding originates from. For example, in Nigeria Alert is a consortium sub-partner to the British Council for a Security & Reconciliation project funded by DFID. In this case, DFID is the origin donor and the "sub-donor" to Alert is British Council.'); ?>
					</td>

					<td>
						Donor Framework
						<?php echo $this->Tooltip->element('Frameworks are pre-selection mechanisms used by donors to restrict the pool of applicants/suppliers. Examples include the UK Conflict, Stability & Security Fund (CSSF) framework or the DFID Fragile & Conflict-Affected States (FCAS) framework. USAID also uses frameworks but calls them Indefinite Quantity Contracts (IQC).'); ?>
					</td>

					<td>
						Sub-donor
						<?php echo $this->Tooltip->element('Who Alert signs a contract with - may be another NGO or a commercial contractor - who holds the overall project contract with the origin donor'); ?>
					</td>

					
					
				</tr>

			</thead>

			<tbody>
				<tr>

					<td>
						<?php echo $this->Form->input('Contract.{contract_id}.donor_id', array(
							'id' => false,
							'type' => 'select',
							'label' => false,
							'empty' => '---- Please Select ----',
							'options' => $donors,
							'class' => 'contract-donor-id',
						)); ?>
					</td>

					<td>

						<?php echo $this->Form->input('Contract.{contract_id}.framework_id', array(
							'label' => false,
							'type' => 'select',
							'id' => false,
							'empty' => '---- No Donor Framework ----',
							'options' => $frameworks,
							'class' => 'contract-donor-framework'
						)); ?>

					</td>

					<td>
						<?php echo $this->Form->input('Contract.{contract_id}.subdonor_name', array(
							'id' => false,
							'type' => 'text',
							'label' => false,
							'class' => 'contract-subdonor-name',

						)); ?>
					</td>

				</tr>


				<tr>

					<td>
						Contract Category
						<?php echo $this->Tooltip->element('Please enter the type of contract that Alert holds (the overall contract with origin donor may be a different type). For example, in Nigeria, Alert holds a sub-contract with the British Council for a Security & Reconciliation project. British Council holds the overall project contract with DFID which is a service contract.'); ?>
					</td>

					<td>
						Donor currency
						<?php echo $this->Tooltip->element('Please enter the native currency of the grant'); ?>
					</td>

					<td>
						Total origin donor contract value (Donor Currency)
						<?php echo $this->Tooltip->element('This should be the total budget for the whole project across all partners – reflecting the full budget of the primary contract holder with the donor, or the sum of all consortium member budgets. For example, in Nigeria, Alert is part of a consortium led by the British Council. British Council has a £33 million GBP contract with DFID for the whole project. Alert is a partner in British Council’s consortium and our sub-contract with British Council for the project is £795,000. In this case the Total origin donor contract value is £33,000,000 so that would be entered in this field.'); ?>

					</td>
					
				</tr>
				
				<tr>

					

					<td>

						<?php echo $this->Form->input('Contract.{contract_id}.contractcategory_id', array(
							'label' => false,
							'type' => 'select',
							'id' => false,
							'empty' => '---- Please select ----',
							'options' => $contractcategories,
							'class' => 'contract-category'
						)); ?>

					</td>



					<td>

						<?php echo $this->Form->input('Contract.{contract_id}.currency_id', array(
							'label' => false,
							'type' => 'select',
							'id' => false,
							'empty' => '---- Please Select ----',
							'options' => $currencies,
							'class' => 'contract-donor-currency'
						)); ?>

					</td>

					<td>

						<?php echo $this->Form->input('Contract.{contract_id}.origin_total_value', array(
							'label' => false,
							'type' => 'text',
							'id' => false,
							'class' => 'contract-origin-total-value'
						)); ?>

					</td>

				</tr>

				<tr>
					<td colspan="3">
						<?php echo $this->Form->input('Contract.{contract_id}.summary', array(
							'label' => 'Comments',
							'id' => false,
							'class' => 'contract-summary',
							'tooltip' => 'Free text space for any comments, e.g. please note if the contract has been amended.',
						)); ?>
					</td>
				</tr>

			</tbody>
		</table>
		

		<div class="contractbudgets">
			<h3>
				Annual Budgets
				<?php echo $this->Tooltip->element('Please calculate the estimated expenditure value for each calendar year (this will be used in the MAC pipeline)');
				?>
			</h3>
			
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

			<small><a target="_blank" href="https://portal.international-alert.org/fis/mer/SitePages/Home.aspx">Alert's working exchange rates are published here</a></small>

		</div> <!-- End payments -->

		<a class="btn btn-contract-delete" href="#">
			Delete Contract
		</a>
		
	</div> <!-- End Contract -->

</div> <!-- End Component Contracts -->