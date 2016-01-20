<?php echo $this->Html->script('projects/elements/search', array('inline' => false)); ?>
<?php echo $this->Html->css('projects/elements/search', array('inline' => false)); ?>



<?php echo $this->Form->create('Project', array('type' => 'get'));

echo $this->Form->input('action', array(
	'value' => 'search',
	'type' => 'hidden',
));

 ?>

<h2>Project Search</h2>


<?php echo $this->element('Projects/search/left'); ?>

<?php echo $this->element('Projects/search/top'); ?>

<?php echo $this->element('Projects/search/results'); ?>


</form>