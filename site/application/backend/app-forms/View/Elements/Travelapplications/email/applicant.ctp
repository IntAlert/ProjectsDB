<h2>Applicant</h2>
<table>
	<tr>
		<th>
			Your name
		</th>
		
		<td>
			<?php echo $travelapplicationObj->applicant->name;?>
		</td>
	</tr>

	<tr>
		<th>
			Role Category
		</th>
		
		<td>
			<?php echo $travelapplicationObj->applicant->role_category;?>
			<?php echo $travelapplicationObj->applicant->role_category == 'Other' ?  '('+$travelapplicationObj->formData->applicant->role_category_other+')': '';?>
		</td>
	</tr>

	<tr>
		<th>
			Your role at Alert
		</th>
		
		<td>
			<?php echo $travelapplicationObj->applicant->role_text;?>
		</td>
	</tr>

</table>