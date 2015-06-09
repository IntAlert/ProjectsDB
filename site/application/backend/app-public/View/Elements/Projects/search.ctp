<?php echo $this->Html->script('projects/elements/search', array('inline' => false)); ?>
<?php echo $this->Html->css('projects/elements/search', array('inline' => false)); ?>


<div class="project-search">

<?php echo $this->Form->create('Project', array('type' => 'get')); ?>




		<fieldset>
			<legend><?php echo __('Search'); ?></legend>
		<?php

			echo $this->Form->input('q', array(
				'label' => 'Search',
				'value' => $this->request->query('q'),
			));

			echo $this->Form->input('status_id', array(
				'empty' => '--- Select Status ---',
				'options' => $statuses,
				'value' => $this->request->query('status_id'),
			));

			echo $this->Form->input('status_id', array(
				'empty' => '--- Select Likelihood ---',
				'options' => $likelihoods,
				'value' => $this->request->query('likelihood_id'),
			));

			echo $this->Form->input('programme_id', array(
				'empty' => '--- Select Programme ---',
				'options' => $programmes,
				'value' => $this->request->query('programme_id'),
			));

			
			echo $this->Form->input('owner_user_id', array(
				'label' => 'Budget Holder',
				'empty' => '--- Select Budget Holder ---',
				'options' => $employees,
				'value' => $this->request->query('owner_user_id'),
			));
			
			
			echo $this->Form->input('territory_id', array(
				'empty' => '--- Select Territory ---',
				'options' => $territories,
				'value' => $this->request->query('territory_id'),
			));

			echo $this->Form->input('theme_id', array(
				'empty' => '--- Select Theme ---',
				'options' => $themes,
				'value' => $this->request->query('theme_id'),
			));

		?>
		<table>
			<tr>
				<td>
					<?php echo $this->Form->input('value_from', array(
						'value' => $this->request->query('value_from'),
					)); ?>
				</td>
				<td>
					<?php echo $this->Form->input('value_to', array(
						'value' => $this->request->query('value_to'),
					)); ?>
				</td>
			</tr>
		</table>

		</fieldset>


		

	<div class="submit">
		<ul>
			
			<li><input type="submit" value="Search Projects"></li>
			<li><a class="reset btn" href="#">Reset Form</a></li>
			
		</ul>
	</div>


	
	</div>