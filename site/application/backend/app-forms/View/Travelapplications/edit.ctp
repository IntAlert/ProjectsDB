<div class="travelapplications form">
<?php echo $this->Form->create('Travelapplication'); ?>
	<fieldset>
		<legend><?php echo __('Edit Travelapplication'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('role_text');
		echo $this->Form->input('summary');
		echo $this->Form->input('convenant_agreed');
		echo $this->Form->input('policy_understood');
		echo $this->Form->input('evacuation_understood');
		echo $this->Form->input('conduct_understood');
		echo $this->Form->input('countrymanager_notified');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Travelapplication.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Travelapplication.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Travelapplications'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Itineraries'), array('controller' => 'itineraries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Itinerary'), array('controller' => 'itineraries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Travelrisksbyusers'), array('controller' => 'travelrisksbyusers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Travelrisksbyuser'), array('controller' => 'travelrisksbyusers', 'action' => 'add')); ?> </li>
	</ul>
</div>
