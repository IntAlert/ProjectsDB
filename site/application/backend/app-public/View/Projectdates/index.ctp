<?php echo $this->Html->css('projectdates/search.css', array('inline' => false)); ?>
<?php echo $this->Html->script('projectdates/search.js', array('inline' => false)); ?>

<div class="left">


<?php echo $this->Form->create('Projectdate', array(
	'type' => 'get',
	'action' => '',
)); ?>

	<!-- Start Date All -->
	<div class="date-all">
		<?php echo $this->Form->input('start_date_limit', array(
			'value' => 1,
			'checked' => $start_date_limit,
			'label' => "Limit Start Date",
			'type' => 'checkbox',
		)); ?>
	</div>

	<!-- Start Date -->
	<div class="date">
		<?php echo $this->Form->input('start_date', array(
			'value' => $start_date,
			'label' => false,
			'type' => 'text',
		)); ?>
	</div>

	<!-- Start Date All -->
	<div class="date-all">
		<?php echo $this->Form->input('finish_date_limit', array(
			'value' => 1, 
			'checked' => $finish_date_limit,
			'label' => "Limit Finish Date",
			'type' => 'checkbox',
		)); ?>
	</div>


	<!-- Finish Date -->
	<div class="date">
		<?php echo $this->Form->input('finish_date', array(
			'value' => $finish_date,
			'label' => false,
			'type' => 'text',
		)); ?>
	</div>

	<?php

		echo $this->Form->input('completed', array(
			'label' => 'Complete?',
			'options' => array(
				'-1' => 'All',
				'0' => 'Incomplete',
				'1' => 'Complete',
			),
			'value' => $completed,
		));
	?>


	<input type="submit" value="Search">


	</form>
</div>


<div class="results">
	<h2>
		Project dates
	</h2>

	<table>
		<tr>
			<th>Key Date Type</th>
			<th>Key Date</th>
			<th>Key Date Title</th>
			<th>Project Name</th>
			<th>Budget Holder</th>
			<th>Budget Holder Email</th>
			<th>Complete</th>
		</tr>


		<?php foreach ($projectdates as $projectdate): ?>
	
		<tr>
			<td>
				<?php echo $projectdate['Projectdate']['type']; ?>
			</td>
			<td>
				<?php echo $projectdate['Projectdate']['date']; ?>
			</td>
			<td>
				<?php echo $projectdate['Projectdate']['title']; ?>
			</td>
			<td>
				<?php echo $projectdate['Project']['title']; ?>
			</td>
			<td>
			<?php echo $projectdate['Project']['OwnerUser']['first_name'] . ' ' . $projectdate['Project']['OwnerUser']['last_name']; ?>
			</td>
			<td>
			<?php echo $projectdate['Project']['OwnerUser']['Office365user']['email']; ?>
			</td>
			<td>
				<?php echo $projectdate['Projectdate']['completed'] ? 'YES' : 'NO'; ?>
			</td>
		</tr>


		<?php endforeach; // ($projectdates as $projectdate): ?>
	</table>

	<a href="<?php echo $csv_download_link_projectdates; ?>">Download CSV</a>
</div>