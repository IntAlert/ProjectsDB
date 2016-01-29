<?php 
	echo $this->Html->script('office365users/search', array('inline' => false));
	echo $this->Html->css('office365users/search', array('inline' => false));
?>

<h2>Add user</h2>

<div class="instruction-block">
	<p>
		This tool will search for users that are registered with International Alert's Office365 system.
	</p>

	<p>
		Once you find a user, click add next to their name to register the user. The next page will allow you to change their role, if necessary.
	</p>

	<p>
		<strong>NB.</strong> You can only add users that already exist on the Office365 system
	</p>

</div>

<div class="selector">

	<div class="form">
		<?php echo $this->Form->create('User'); ?>
			<fieldset>
				<legend><?php echo __('Find User'); ?></legend>
			<?php
				echo $this->Form->input('q', array(
					'label' => 'Name or Email Address'
				));
			?>
			</fieldset>
		<?php echo $this->Form->end(__('Search Office365')); ?>
	</div>


</div>

<div class="results">

<?php if (isset($office365Users)): ?>


	<ul>

<?php foreach ($office365Users as $office365User): ?>
	
		<li class="clearfix">

			<div class="display-name">
				<?php echo $office365User->displayName; ?>
			</div>

			<div class="action">

				<?php if (isset($knownUsers[$office365User->objectId])): ?>

					Already added

				<?php else: // (isset($knownUsers[$office365User->objectId])): ?>
					
					<?php echo $this->Html->link(__('Add User'), array('action' => 'add', $office365User->objectId)); ?>

				<?php endif; // (isset($knownUsers[$office365User->objectId])): ?>

			</div>

			


		</li>
<?php endforeach; // ($office365Users as $office365User): ?>

	</ul>





<?php endif; // ($office365Users): ?>




</div>



