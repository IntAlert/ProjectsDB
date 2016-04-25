<?php echo $this->Form->input('summary', array(
		// 'placeholder' => "e.g. help text",
		'tooltip' => 'Up to 300 word summary of what your project hopes to achieve and how this will be delivered',
	)); ?>


<?php echo $this->Form->input('beneficiaries', array(
		// 'placeholder' => "e.g. help text",
		'tooltip' => 'Include all relevant information such as of type of beneficiary, total number of beneficiaries to be reached in the project and an estimate of gender disaggregation',
	)); ?>


<?php echo $this->Form->input('location', array(
		'label' => 'Location(s)',
		// 'placeholder' => "e.g. help text",
		'tooltip' => 'Include regional and/or country name(s) plus any further geographic info such as province or district names',
	)); ?>



<?php echo $this->Form->input('goals', array(
		// 'placeholder' => "e.g. help text",
		'tooltip' => 'Include project goal from logframe (or equivalent)',
	)); ?>

<?php echo $this->Form->input('objectives', array(
		// 'placeholder' => "e.g. help text",
		'tooltip' => 'Include project objectives from logframe (or equivalent)',
	)); ?>


<?php echo $this->Form->input('partners', array(
		// 'placeholder' => "e.g. help text",
		'tooltip' => 'Add details of names of partners including value of sub-grant',
	)); ?>