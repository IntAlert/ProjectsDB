<script>

	// selected year used by departments/pipeline-export-form.js
	var selectedYear = <?php echo (int)$selectedYear; ?>;
</script>

<?php echo $this->Html->css('departments/pipeline', array('inline' => false)); ?>
<?php echo $this->Html->script('departments/pipeline-export-form', array('inline' => false)); ?>


<div class="pipeline-export-form">
<?php echo $this->element('/Departments/pipeline-export-form-this-year'); ?>
</div>

<div class="pipeline-export-form">
<?php echo $this->element('/Departments/pipeline-export-form-next-year'); ?>
</div>


<?php foreach($departmentsDetailAnnual as $department_id => $departmentDetailAnnual): ?>

<div class="pipeline-export-by-department">

<?php echo $this->element('Departments/pipeline-by-department', $departmentDetailAnnual); ?>

</div>

<?php endforeach; //($departments as $department): ?>

