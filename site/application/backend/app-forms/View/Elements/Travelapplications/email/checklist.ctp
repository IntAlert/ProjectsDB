<h2>Checklist</h2>
	
<table>
	<tbody>
		<tr>
			<th>
				I have read, understood & signed Alert's Security Covenant
			</th>
			<td>
				<?php echo $travelapplicationObj->convenant_agreed ? 'YES' : 'NO'; ?>
			</td>
		</tr>

		<tr>
			<th>
				I have read &amp; understood Alert's Security Policy, Procedures, and Staff &amp; Field Workers Tasks &amp; Responsibilities</a>
			</th>
			<td>
				<?php echo $travelapplicationObj->policy_understood ? 'YES' : 'NO'; ?>
			</td>
		</tr>

		<tr>
			<th>
				I have read &amp; understood Country Security &amp; Evacuation Plans
			</th>
			<td>
				<?php echo $travelapplicationObj->evacuation_understood ? 'YES' : 'NO'; ?>
			</td>
		</tr>

		<tr ng-show=" formData.mode=='has-office' ">
			<th>
				I have read &amp; understood Country Security Guidelines &amp; Rules of Conduct
			</th>
			<td>
				<?php echo $travelapplicationObj->conduct_understood ? 'YES' : 'NO'; ?>
			</td>
		</tr>

		<tr ng-show=" formData.mode=='has-office' ">
			<th>
				I have notified the Country Manager(s) of my arrival, departure and purpose of visit
			</th>
			<td>
				<?php echo $travelapplicationObj->countrymanager_notified ? 'YES' : 'NO'; ?>
			</td>
		</tr>
	</tbody>
</table>