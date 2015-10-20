<script>

	// selected year used by departments/pipeline-export-form.js
	var selectedYear = <?php echo (int)$selectedYear; ?>;
</script>

<?php echo $this->Html->css('pipeline/pipeline', array('inline' => false)); ?>
<?php echo $this->Html->script('pipeline/export-form', array('inline' => false)); ?>


<nav class="subnav">
	<ul>
		<li>
			<?php echo $this->Html->link('Cancel Export', array(
		'controller' => 'pipeline', 'action' => 'summary', $selectedYear)); ?>
		</li>

		<li>
			<?php echo $this->Html->link('Print', '#', array('class' => 'print')); ?>
		</li>

		<li>
			<?php echo $this->Html->link('Export to Excel', array(
		'controller' => 'pipelineExport', 'action' => 'download', '?' => 'selectedYear=' . $selectedYear)); ?>
		</li>

	</ul>
</nav>

<div class="pipeline-export-form">
<?php echo $this->element('Pipeline/export-form-this-year'); ?>
</div>

<div class="pipeline-export-form">
<?php echo $this->element('Pipeline/export-form-next-year'); ?>
</div>


<?php foreach($departmentsDetailAnnual as $department_id => $departmentDetailAnnual): ?>

<div class="pipeline-export-by-department">

<?php echo $this->element('Pipeline/by-department', $departmentDetailAnnual); ?>

</div>

<?php endforeach; //($departments as $department): ?>
