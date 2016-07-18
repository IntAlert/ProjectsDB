<h2>General</h2>
<table>
	<tr>
		<th>
			Does your destination country have an Alert office?
		</th>
		
		<td>
			{{formData.mode == 'has-office' ? 'YES' : 'NO'}}
		</td>
	</tr>

	<tr>
		<th>
			Reason for your trip
		</th>
		
		<td>
			{{formData.applicant.reason}}
		</td>
	</tr>


	<tr>
		<th>
			Approving Manager
		</th>
		
		<td>
			{{formData.applicant.approving_manager.User.name_formal}}
		</td>
	</tr>
</table>