<?php $this->set('title', 'Projects - Search'); ?>
<?php echo $this->Html->css('projects/index'); ?>


<div class="projects">

	<div class="projects-container">


	<?php echo $this->element('Projects/search2'); ?>
	

<?php if ( $action == 'search' && !count($projects) ): ?>
	<p>
		No results
	</p>

<?php elseif ( $action == 'search' ): ?>


<div class="search-results">

	<div class="project-sort">
	Sort by: 
		<?php echo $this->Paginator->sort('title'); ?>, 
		<?php echo $this->Paginator->sort('value'); ?>,
		<?php echo $this->Paginator->sort('start_date'); ?>
	</div>


	<ol>


		<?php foreach ($projects as $project): ?>
		<li>
			<h3>
				<?php echo $this->Html->link(h($project['Project']['title']), array('action' => 'view', $project['Project']['id'])); ?>
			</h3>

			<p>
				<?php echo $this->Text->truncate($project['Project']['summary'], 200); ?>
			</p>

			<p>

				<?php 
				// create array of country names
				echo $project['Department']['name']?>/<?php

				$territory_names = [];
				foreach($project['Territory'] as $territory) {
					array_push($territory_names, $territory['name']);
				}
				
				if (count($territory_names)) echo implode(', ', $territory_names);
				else echo "None"


				?>
			</p>


			<p>
				Donors:
				<?php

				$donor_names = [];
				foreach($project['Contract'] as $contract) {
					if (isset($contract['Donor']['name'])) {
						array_push($donor_names, $contract['Donor']['name']);
					}
				}
				$donor_names = array_unique($donor_names);
				
				if (count($donor_names)) {
					echo implode(', ', $donor_names);
				} else {
					echo "None";
				}
				?>
			</p>
			
			<p>
				Value: <?php echo $this->Number->currency($project['Project']['value_required'], 'GBP'); ?>
				Status: <?php echo h($project['Status']['name']); ?>
			</p>
		</li>
		<?php endforeach; // ($projects as $project): ?>
	</ol>




	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>

</div>

<?php endif; // (count($projects)): ?>


	</div>

</div>
