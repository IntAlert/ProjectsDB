<?php echo $this->Html->script('projects/elements/contract-with-payments');

// for convenience
$project = $this->request->data;

?>

<div class="component-contracts">
<h2>Contracts and Payments</h2>


<a class="btn btn-contract-add" href="#">
	Add Contract
</a>


<div class="contracts">
<?php if (isset($project['Contract'])): ?>
<?php foreach ($project['Contract'] as $contract): ?>


	<div 
		class="contract"
		data-contract-id="<?php echo $contract['id']; ?>"
	>


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
						<?php echo $this->Form->input('Contract.'.$contract['id'].'.donor_id', array(
							'label' => false,
							'empty' => '---- Please Select ----',
							'value' => $contract['donor_id'],
							'options' => $donors,
						)); ?>
					</td>

					<td>

						<?php echo $this->Form->input('Contract.'.$contract['id'].'.currency_id', array(
							'label' => false,
							'type' => 'select',
							'empty' => '---- Please Select ----',
							'value' => $contract['currency_id'],
							'options' => $currencies,
						)); ?>

					</td>
				</tr>
			</tbody>
		</table>
		

		<div class="payments">
			<h3>Payment schedule</h3>

			<table>
				<thead>
					<tr>

						<th>
							Payment Date
						</th>

						<th>
							Value (Donor currency)
						</th>

						<th>
							Value (GBP)
						</th>

						<th>
							Received
						</th>

						<th>
							
						</th>


					</tr>
				</thead>

				<tbody>


	<?php foreach ($contract['Payment'] as $payment):

	// debug($payment); 
	?>
					<tr class="payment">
						<td>
							<?php echo $this->Form->date('Contract.'.$contract['id'].'.Payment.'.$payment['id'].'.date', array(
								'value' => $payment['date']
							)); ?>
						</td>

						<td>
							<?php echo $this->Form->input('Contract.'.$contract['id'].'.Payment.'.$payment['id'].'.value_donor_currency', array(
								'value' => $payment['value_donor_currency'],
								'label' => false,
							)); ?>
						</td>

						<td>
							<?php echo $this->Form->input('Contract.'.$contract['id'].'.Payment.'.$payment['id'].'.value_gbp', array(
								'value' => $payment['value_gbp'],
								'label' => false,
							)); ?>
						</td>

						<td>
							<?php echo $this->Form->input('Contract.'.$contract['id'].'.Payment.'.$payment['id'].'.received', array(
								'checked' => !! $payment['received'],
								'label' => false,
								'type' => 'checkbox',
							)); ?>
						</td>

						<td>
<?php echo $this->Form->input('Contract.'.$contract['id'].'.Payment.'.$payment['id'].'.id', array(
	'type' => 'hidden', 
	'value' => $payment['id']
)); ?>

<?php echo $this->Form->input('Contract.'.$contract['id'].'.Payment.'.$payment['id'].'.deleted', array(
	'type' => 'hidden', 
	'value' => $payment['deleted'],
	'class' => 'deleted',
)); ?>

							<a class="btn btn-payment-delete" href="#">
								Delete
							</a>
						</td>
					</tr>
	<?php endforeach; // ($contract['Payment'] as $payment): ?>


					


				</tbody>
			</table>

			<a class="btn btn-payment-add" href="#">
				Add new payment
			</a>

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
							'label' => false,
							'empty' => '---- Please Select ----',
							'options' => $donors,
						)); ?>
					</td>

					<td>

						<?php echo $this->Form->input('Contract.{contract_id}.currency_id', array(
							'label' => false,
							'type' => 'select',
							'empty' => '---- Please Select ----',
							'options' => $currencies,
						)); ?>

					</td>
				</tr>
			</tbody>
		</table>
		

		<div class="payments">
			<h3>Payment schedule</h3>
			
			<table>
				<thead>
					<tr>

						<th>
							Payment Date
						</th>

						<th>
							Value (Donor currency)
						</th>

						<th>
							Value (GBP)
						</th>

						<th>
							Received
						</th>

						<th>
							
						</th>


					</tr>
				</thead>

				<tbody>


					<tr class="payment">
						<td>
							<?php echo $this->Form->date('Contract.{contract_id}.Payment.{payment_id}.date'); ?>
						</td>

						<td>
							<?php echo $this->Form->input('Contract.{contract_id}.Payment.{payment_id}.value_donor_currency', array('label' => false)); ?>
						</td>

						<td>
							<?php echo $this->Form->input('Contract.{contract_id}.Payment.{payment_id}.value_gbp', array('label' => false)); ?>
						</td>

						<td>
							<?php echo $this->Form->input('Contract.{contract_id}.Payment.{payment_id}.received', array(
								'label' => false,
								'type' => 'checkbox',
							)); ?>
						</td>
						<td>
							<a class="btn btn-payment-delete" href="#">
								Delete
							</a>
						</td>
					</tr>

				</tbody>
			</table>

			<a class="btn btn-payment-add" href="#">
				Add new payment
			</a>
			
		

		</div> <!-- End payments -->

		<a class="btn btn-contract-delete" href="#">
			Delete Contract
		</a>
		
	</div> <!-- End Contract -->

</div> <!-- End Component Contracts -->