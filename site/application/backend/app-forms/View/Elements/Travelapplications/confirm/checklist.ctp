<h2>Checklist</h2>
	
<table>
	<tbody>
		<tr>
			<th>
				I have read, understood & signed Alert's Security Covenant
			</th>
			<td>
				{{formData.convenant_agreed ? 'YES' : 'NO'}}
			</td>
		</tr>

		<tr>
			<th>
				I have read &amp; understood Alert's Security Policy, Procedures, and Staff &amp; Field Workers Tasks &amp; Responsibilities</a>
			</th>
			<td>
				{{formData.policy_understood ? 'YES' : 'NO'}}
			</td>
		</tr>

		<tr>
			<th>
				I have read &amp; understood Country Security &amp; Evacuation Plans
			</th>
			<td>
				{{formData.evacuation_understood ? 'YES' : 'NO'}}
			</td>
		</tr>

		<tr ng-show=" formData.mode=='has-office' ">
			<th>
				I have notified the Country Manager(s) of my arrival, departure and purpose of visit
			</th>
			<td>
				{{formData.countrymanager_notified ? 'YES' : 'NO'}}
			</td>
		</tr>
	</tbody>
</table>