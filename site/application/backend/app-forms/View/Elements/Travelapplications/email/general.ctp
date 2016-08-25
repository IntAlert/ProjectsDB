<h2>General</h2>
<table>
	<tr>
		<th>
			Does your destination country have an Alert office?
		</th>
		
		<td>
			<?php echo $travelapplicationObj->mode == 'has-office' ? 'YES' : 'NO'; ?>
			
		</td>
	</tr>

	<tr>
		<th>
			Reason for your trip
		</th>
		
		<td>
			<?php echo $travelapplicationObj->applicant->reason; ?>
		</td>
	</tr>


	<tr>
		<th>
			Approving Manager
		</th>
		
		<td>
			<?php echo $travelapplicationObj->applicant->approving_manager->displayName; ?>
		</td>
	</tr>
</table>