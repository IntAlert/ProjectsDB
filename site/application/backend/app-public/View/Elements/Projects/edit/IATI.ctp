<?php echo $this->Html->css('projects/elements/IATI', array('inline' => false)); ?>

<!-- Themes -->
<div class="IATI clearfix">

	<h3>IATI</h3>

	<?php 
		echo $this->Form->input('IATI_identifier', array(
			'label' => "IATI identifier"
		));
	?>

	<?php 
		echo $this->Form->input('IATI_excluded', array(
			'label' => "Exclude from IATI"
		));
	?>

</div>