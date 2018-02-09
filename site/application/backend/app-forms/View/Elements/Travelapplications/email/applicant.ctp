<h2>Applicant</h2>
<table width="100%">
	<tr width="50%">
		<th>
			Your name
		</th>
		
		<td>
			<?php echo $travelapplicationObj->applicant->user->displayName;?>
		</td>
	</tr>

	<tr width="50%">
		<th>
			Role Category
		</th>
		
		<td>
			<?php echo $travelapplicationObj->applicant->role_category;?>
			<?php echo $travelapplicationObj->applicant->role_category == 'Other' ?  '('+$travelapplicationObj->formData->applicant->role_category_other+')': '';?>
		</td>
	</tr>

</table>