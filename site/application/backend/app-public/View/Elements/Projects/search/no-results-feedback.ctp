

<?php if ( !count($projects) ): ?>

<!-- Feedback form -->

<div class="no-results-feedback">
	<div class="inner">
	
	<h3>Expecting to find results for your search criteria?</h3>
	<p>Let us know what you were expecting and we'll do what we can to improve the search engine.</p>

	<?php 

	echo $this->Form->create('Project', array(
		'type' => 'post',
		'action' => 'searchFeedback'
		)
	);

	echo $this->Form->input('expected_search_result', array(
		'label' => 'What were you expecting to find?',
		'type' => 'textarea',
	));

	echo $this->Form->input('criteria_url', array(
		'value' => Router::reverse($this->params, true), // full URL
		'type' => 'hidden',
	));

	echo $this->Form->end(__('Submit feedback to Tech team')); 

	?>

	</div>
</div>

<?php endif; // (count($projects)): ?>

