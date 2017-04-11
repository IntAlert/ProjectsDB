<pre>
	{{formData.applicant}}
</pre>

<h2>Applicant</h2>
<table>
	<tr>
		<th>
			Your name
		</th>
		
		<td>
			{{formData.applicant.user.displayName}}
		</td>
	</tr>

	<tr>
		<th>
			Role Category
		</th>
		
		<td>
			{{formData.applicant.role_category}}
			{{formData.applicant.role_category == 'Other' ?  '('+formData.applicant.role_category_other+')': ''}}
		</td>
	</tr>

	<tr>
		<th>
			Your role at Alert
		</th>
		
		<td>
			{{formData.applicant.role_text}}
		</td>
	</tr>

</table>