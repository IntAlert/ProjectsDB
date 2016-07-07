<?php

$funding = $this->request->data['Funding'];


?>
<h2>Funding</h2>

<table>
	<thead>
		<tr>
			<th>
				<!-- Month -->
			</th>
<?php foreach($funding as $funding_year): ?>
			<th>
<?php echo $funding_year['year']; ?>
			</th>
<?php endforeach; // ($funding as $funding_year): ?>
		</tr>
	</thead>


	<tbody>

	<!-- Total -->

	<tr>
		<th>
			Total
		</th>
		<?php foreach($funding as $funding_year): ?>
			<td>
				<?php 
				echo $this->Form->input('Funding.' . $funding_year['id'] . '.total', array(
						'label' => false,
						'value' => $funding_year['total']
					)); 
				?>
			</td>
		<?php endforeach; // ($funding as $funding_year): ?>
	</tr>

	<!-- Months -->
	
	<?php for ($m=1; $m <= 12; $m++): ?>
	<tr>
		<th>
			<?php echo DateTime::createFromFormat('!m', $m)->format('M'); ?>
		</th>
		<?php foreach($funding as $funding_year): ?>
			<td>
				<?php 
				echo $this->Form->input('Funding.' . $funding_year['id'] . '.month_' . $m, array(
						'label' => false,
						'value' => $funding_year['month_' . $m]
					)); 
				?>
			</td>
		<?php endforeach; // ($funding as $funding_year): ?>
	</tr>

	
	<?php endfor; // ($m=1; $m <= 12; $m++): ?>

	</tbody>


</table>