<?php echo $this->Html->script('projects/elements/search', array('inline' => false)); ?>
<?php echo $this->Html->css('projects/elements/search', array('inline' => false)); ?>



<?php echo $this->Form->create('Project', array(
	'type' => 'get',
	'action' => 'index/page:1', // always revert to page 1 for new searches
));

echo $this->Form->input('action', array(
	'value' => 'search',
	'type' => 'hidden',
));

 ?>

<h2>Proposal/Project Search</h2>

<div class="clearfix">
	<?php echo $this->element('Projects/search/left'); ?>

	<?php echo $this->element('Projects/search/right'); ?>
</div>

</form>

<?php echo $this->element('Projects/search/no-results-feedback'); ?>
