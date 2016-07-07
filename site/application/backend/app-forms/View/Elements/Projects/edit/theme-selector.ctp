<?php echo $this->Html->css('projects/elements/theme-selector', array('inline' => false)); ?>

<!-- Themes -->
<div class="theme-selector clearfix">

	<h3>Themes</h3>

	<?php echo $this->Tooltip->inline_required(); ?>
	
	<div class="ui-state-default">
	<?php 
		echo $this->Form->input('Theme', array(
			'label' => false,
			'multiple' => 'checkbox'
		));
	?>
	</div>

</div>

<script>
	$(function(){
		$(".theme-selector .input.select").buttonset()
	})
</script>