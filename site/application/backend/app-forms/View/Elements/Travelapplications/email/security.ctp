
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

<h2>Checklist</h2>
	
<table width="100%">
	<tbody>
		<tr width="50%">
			<th>
				I have read, understood & signed Alert's Security Covenant
			</th>
			<td>
				<?php echo $travelapplicationObj->convenant_agreed ? 'YES' : 'NO'; ?>
			</td>
		</tr>

		<tr width="50%">
			<th>
				I have read &amp; understood Alert's Security Policy, Procedures, and Staff &amp; Field Workers Tasks &amp; Responsibilities</a>
			</th>
			<td>
				<?php echo $travelapplicationObj->policy_understood ? 'YES' : 'NO'; ?>
			</td>
		</tr>

		<tr width="50%">
			<th>
				I have read &amp; understood Country Security &amp; Evacuation Plans
			</th>
			<td>
				<?php echo $travelapplicationObj->evacuation_understood ? 'YES' : 'NO'; ?>
			</td>
		</tr>
		
	</tbody>
</table>