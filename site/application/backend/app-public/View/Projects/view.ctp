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






?>
<script>
var data = <?php echo json_encode($project); ?>;
</script>

<div class="projects view">
<h2>Project - <?php echo h($project['Project']['title']); ?></h2>
	<dl>
		<dt><?php echo __('Budget Holder'); ?></dt>
		<dd>
			<?php echo h($project['OwnerUser']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Programme'); ?></dt>
		<dd>
			<?php echo h($project['Programme']['name']); ?>
		</dd>

		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($project['Status']['name']); ?>
		</dd>

		<dt><?php echo __('Likelihood'); ?></dt>
		<dd>
			<?php echo h($project['Likelihood']['name']); ?>
		</dd>

		<dt><?php echo __('Territory/ies'); ?></dt>
		<dd>
			<?php 

			if (count($territory_names)) echo implode(', ', $territory_names);
			else echo "None"

			?>
		</dd>

		<dt><?php echo __('Theme(s)'); ?></dt>
		<dd>
			<?php 

			if (count($theme_names)) echo implode(', ', $theme_names);
			else echo "None"

			?>
		</dd>
		
		
		
		<dt><?php echo __('Timespan'); ?></dt>
		<dd>
			<?php echo $this->Time->format(
			  'F jS, Y',
			  $project['Project']['start_date']
			); ?>
			-
			<?php echo $this->Time->format(
			  'F jS, Y',
			  $project['Project']['finish_date']
			); ?>
		</dd>


		<dt><?php echo __(' Total value (GBP)'); ?></dt>
		<dd>
			<?php echo $this->Number->currency($project['Project']['value_required'], 'GBP'); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Raised (GBP)'); ?></dt>
		<dd>
			<?php echo $this->Number->currency(
			$project['Project']['value_sourced']
			, 'GBP'); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Shortfall (GBP)'); ?></dt>
		<dd>
			<?php echo $this->Number->currency($shortfall, 'GBP'); ?>
			&nbsp;
		</dd>
		
	</dl>


<?php if (trim($project['Project']['summary'])): ?>
<div class="summary block">
	<h3>Summary</h3>

	<p>
		<?php echo h($project['Project']['summary']); ?>
	</p>
</div>
<?php endif; // (trim($project['Project']['summary'])): ?>


<h3>Contracts and Annual Budgets</h3>

<div class="contracts block">

<?php if ( empty($project['Contract']) ): ?>
	
	<p>None</p>

<?php else: // ( empty($project['Contract']) ): ?>


<?php foreach ($project['Contract'] as $contract): ?>
	<div class="contract">
		<h4><?php echo $contract['Donor']['name']; ?></h4>

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
<?php foreach ($contract['Contractbudget'] as $contractbudget): ?>
				<tr>
					<td>
						<?php echo $contractbudget['year']; ?>
					</td>
					<td>
						<?php echo $this->Number->currency(
							$contractbudget['value_donor_currency'],
							$contract['Currency']['code']
						); ?>
					</td>
					<td>

						(<?php echo $this->Number->currency(
							$contractbudget['value_gbp'],
							'GBP'
						); ?>)
						
					</td>
				</tr>
<?php endforeach; // ($project['Contract'] as $contract): ?>
			</tbody>
		</table>


	</div>
<?php endforeach; // ($project['Contract'] as $contract): ?>

</div>

<?php endif; // ( empty($project['Contract']) ): ?>


<div class="projectnotes block">
	<h3>Project Comments</h3>
	
		
	

	<ul>
		<? foreach ($project['Projectnote'] as $projectnote):?>
		<li>
			<p>
				<?php echo h($projectnote['content']); ?>
				by
				<strong>
					<?php echo h($projectnote['User']['first_name']); ?>
				</strong> 
			</p>
			<?php if ($projectnote['user_id'] === AuthComponent::user('id')): ?>

			<a 
				data-projectnote-id="<?php echo $projectnote['id']; ?>"
				class="delete"
			>Delete</a>

			<?php endif; // ($projectnote['user_id'] === AuthComponent::user('id')): ?>
		</li>
		<? endforeach; // ($project['Projectnote'] as $projectnotes): ?>

	</ul>

	

	<form method="post">
		<textarea></textarea>
		<input type="submit" value="Add comment">
	</form>
</div>

<!-- 

<br><br><br>
	<h3>Project Activity</h3>
 -->

</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Project'), array('action' => 'edit', $project['Project']['id'])); ?> </li>
		
	</ul>
</div>
