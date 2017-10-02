<?php echo $this->Html->css('projects/elements/department-selector', array('inline' => false)); ?>
<?php echo $this->Html->script('projects/elements/department-selector', array('inline' => false)); ?>



<div class="department-selector">

	<h3>
		Departments
	</h3>

	<?php echo $this->Tooltip->inline_required(); ?>

	<div class="department ui-state-default clearfix">
		<?php
			echo $this->Form->input('department_id', array(
				'legend' => false,
				'tooltip' => 'The programme or department within Alert who will sign or has signed the contract',
				'type' => 'radio',
			));

		?>
	</div>

	<h3>
		Secondary Programme
	</h3>

	<div class="secondary-department ui-state-default clearfix">
		<?php

			// allow none to be selected
			$departmentsWithNone = 
				array_replace($departments, array(0 => 'No secondary department'));


			echo $this->Form->input('secondary_department_id', array(
				'options' => $departmentsWithNone,
				'legend' => false,
				'tooltip' => 'If the proposal or project involves more than one Alert programme - for example if Africa Programme is leading a proposal for a project in Uganda that focuses on conflict-sensitivity in the oil sector, and PIP Economic Development for Peace (EDP) team is involved in the project proposal and implementation, then you would select "PIP" as secondary programme here.',
				'type' => 'radio',
			));

		?>
	</div>

</div>
