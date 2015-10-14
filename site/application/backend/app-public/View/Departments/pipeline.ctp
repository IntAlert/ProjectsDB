<?php echo $this->Html->css('departments/pipeline', array('inline' => false)); ?>



<?php echo $this->element('Departments/pipeline-nav'); ?>

<!-- <nav class="subnav clearfix">
	<ul>
		<li><?php echo $this->Html->link(__('Add Project'), array('controller' => 'projects', 'action' => 'add')); ?> </li>
		
	</ul>
</nav> -->


<?php echo $this->element('Departments/pipeline-by-department'); ?>

