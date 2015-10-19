<?php echo $this->Html->css('pipeline/pipeline', array('inline' => false)); ?>



<?php echo $this->element('Pipeline/nav'); ?>

<!-- <nav class="subnav clearfix">
	<ul>
		<li><?php echo $this->Html->link(__('Add Project'), array('controller' => 'projects', 'action' => 'add')); ?> </li>
		
	</ul>
</nav> -->


<?php echo $this->element('Pipeline/by-department'); ?>

