
<h2>Security Risk Assessment</h2>


<?php if ($travelapplicationObj->mode == 'no-office'): ?>

	<h3>What are the main safety and security risks in the locations which you will visit?</h3>
	<pre><?php echo $travelapplicationObj->risks->overview; ?></pre>

	<h3>How will you protect yourself against these risks?</h3>
	<pre><?php echo $travelapplicationObj->risks->protection; ?></pre>

	<h3>Sources of security information used</h3>
	<pre><?php echo $travelapplicationObj->risks->sources; ?></pre>

<?php else: //($travelapplicationObj->mode == 'no-office'): ?>

	<h3>
	I have notified the Country Manager(s) of my arrival, departure and purpose of visit
	</h3>
	<p>
		<?php echo $travelapplicationObj->countrymanager_notified ? 'YES' : 'NO'; ?>
	</p>

<?php endif; //($travelapplicationObj->mode == 'no-office'): ?>