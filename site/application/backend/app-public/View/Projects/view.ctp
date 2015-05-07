<?php echo $this->Html->css('projects/view', array('inline' => false)); ?>
<?php echo $this->Html->script('projects/view', array('inline' => false)); ?>


<?php

// calculate cofinancing additions
$cofinancing_total = 0;
foreach ($project['CofinancedByProject'] as $cofinancedByProject):
	$cofinancing_total += $cofinancedByProject['value_sourced'];
endforeach; // ($project['CofinancedByProject'] as $cofinancedByProject):

// calculate shortfall
$shortfall = 
	+ $project['Project']['value_required'] 
	- $project['Project']['value_sourced']
	- $cofinancing_total;







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


		<dt><?php echo __('Value (GBP)'); ?></dt>
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

		<dt><?php echo __('Cofinancing (GBP)'); ?></dt>
		<dd>
			<?php echo $this->Number->currency($cofinancing_total, 'GBP'); ?>
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


<h3>Contracts and Payments</h3>

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
						Date
					</th>

					<th>
						Value
					</th>

					<th>
						Received
					</th>
				</tr>
			</thead>

			<tbody>
<?php foreach ($contract['Payment'] as $payment): ?>
				<tr>
					<td>
						<?php echo $this->Time->format(
						  'F jS, Y',
						  $payment['date']
						); ?>
					</td>
					<td>
						<?php echo $this->Number->currency(
							$payment['value_donor_currency'],
							$contract['Currency']['code']
						); ?>

						(<?php echo $this->Number->currency(
							$payment['value_gbp'],
							'GBP'
						); ?>)
						
					</td>
					<td>
						<?php echo $payment['received'] ? 'Yes': 'No'; ?>
					</td>
				</tr>
<?php endforeach; // ($project['Contract'] as $contract): ?>
			</tbody>
		</table>


	</div>
<?php endforeach; // ($project['Contract'] as $contract): ?>

</div>

<?php endif; // ( empty($project['Contract']) ): ?>


<div class="co-financing block">

	<h3>Co-financing projects</h3>


	<table>
		<thead>
			<tr>
				<th>Project name</th>
				<th>Value Sourced</th>
				<td></td>
			</tr>
		</thead>
	

		<tbody>
	<?php foreach ($project['CofinancedByProject'] as $cofinancedByProject): ?>
		
		<tr>
			<td>
				<?php echo h($cofinancedByProject['title']); ?>
			</td>
			<td>
				<?php echo $this->Number->currency($cofinancedByProject['value_sourced'], 'GBP'); ?>
			</td>
			<td>
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $cofinancedByProject['id'])); ?>
			</td>
		</tr>


	<?php endforeach; // ($project['CofinancedByProject'] as $project): ?>
		</tbody>
	</table>
</div>

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
