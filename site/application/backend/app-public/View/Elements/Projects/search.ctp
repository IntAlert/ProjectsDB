<?php echo $this->Html->script('projects/search', array('inline' => false)); ?>


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

			echo $this->Form->input('programme_id', array(
				'empty' => '--- Select Programme ---',
				'options' => $programmes,
				'value' => $this->request->query('programme_id'),
			));

			
			echo $this->Form->input('owner_user_id', array(
				'label' => 'Owner',
				'empty' => '--- Select Owner ---',
				'options' => $employees,
				'value' => $this->request->query('owner_user_id'),
			));
			
			
			echo $this->Form->input('country_id', array(
				'empty' => '--- Select Country ---',
				'options' => $countries,
				'value' => $this->request->query('country_id'),
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


		<a class="reset" href="#">Reset Form</a>

		
	<?php echo $this->Form->end(__('Submit')); ?>

	
	</div>