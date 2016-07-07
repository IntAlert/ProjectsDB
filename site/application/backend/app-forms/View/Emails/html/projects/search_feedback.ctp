<h2>
	Search Feedback
</h2>

<dl>
	<dt>User</dt>
	<dd><?php echo $user_fullname; ?></dd>

	<dt>Expected Search Result</dt>
	<dd>
		<p>
		<?php echo $feedback['Project']['expected_search_result']; ?>
		</p>
	</dd>

	
	<dt>Search Criteria</dt>
	<dd><?php echo $feedback['Project']['criteria_url']; ?></dd>
</dl>
