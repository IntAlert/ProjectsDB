<?php echo $this->Html->script('projects/contract.js'); ?>

<h2>Contracts and Payments</h2>

<div class="contracts">

<div class="contract">


	
	<table>
		<thead>
			<tr>

				<td>
					Contract name
				</td>

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

					<?php echo $this->Form->input('contract_name', array(
						'type' => 'text',
						'label' => false,
					)); ?>

				</td>
				<td>
					<?php echo $this->Form->input('donor_id', array(
						'label' => false,
						'options' => array(
							'TEST DONOR NAME #1',
							'TEST DONOR NAME #2',
							'TEST DONOR NAME #3',
						)
					)); ?>
				</td>

				<td>

					<?php echo $this->Form->input('donor_currency', array(
						'label' => false,
						'type' => 'select',
						'options' => array('---- Please Select ----','Euro', 'GBP')
					)); ?>

				</td>
			</tr>
		</tbody>
	</table>
	

	

	

	

	<?php /*echo $this->Form->input('payment_mode', array(
		'type' => 'select',
		'label' => "Payment Schedule",
		'options' => array(
			'---- please select ----',
			'Single',
			'Custom schedule',
		)
	)); */ ?>

	

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


				</tr>
			</thead>

			<tbody>


				<tr class="template">
					<td>
						<?php echo $this->Form->date('donation_date'); ?>
					</td>

					<td>
						<?php echo $this->Form->input('value_donor', array('label' => false)); ?>
					</td>

					<td>
						<?php echo $this->Form->input('value_gbp', array('label' => false)); ?>
					</td>
					<td>
						<button>Delete</button>
					</td>
				</tr>



<?php for ($i=0; $i < 4; $i++):?>
				<tr>
					<td>
						<?php echo $this->Form->date('donation_date'); ?>
					</td>

					<td>
						<?php echo $this->Form->input('value_donor', array('label' => false)); ?>
					</td>

					<td>
						<?php echo $this->Form->input('value_gbp', array('label' => false)); ?>
					</td>
					<td>
						<button>Delete</button>
					</td>
				</tr>
<?php endfor; // ($i=0; $i < 4; $i++):?>


				


			</tbody>
		</table>

		<button>
			Add new payment
		</button>
		
	</div>


</div>

<button>Add Contract</button>

</div>