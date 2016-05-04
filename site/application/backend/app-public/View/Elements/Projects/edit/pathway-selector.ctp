<?php echo $this->Html->css('projects/elements/pathway-selector', array('inline' => false)); ?>

<!-- Pathways -->
<div class="pathway-selector clearfix">

	<h3>Strategic Pathway(s)</h3>

	<?php echo $this->Tooltip->inline_required(); ?>
	
	<div class="ui-state-default">
	<?php 
		echo $this->Form->input('Pathway', array(
			'label' => false,
			'multiple' => 'checkbox'
		));
	?>
	</div>

</div>

<script>
	$(function(){
		$(".pathway-selector .input.select").buttonset()
	})
</script>