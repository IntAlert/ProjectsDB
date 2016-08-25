<h2>Contacts</h2>

<h3>Point of Contact information in your home office</h3>
<table>
	<tr>
		<th>
			Name
		</th>
		
		<td>
			{{formData.contact_home.user.displayName}}
		</td>
	</tr>

	<tr>
		<th>
			Email Address(es)
		</th>
		
		<td>
			{{formData.contact_home.email}}
		</td>
	</tr>

	<tr>
		<th>
			Telephone Number(s)
		</th>
		
		<td>
			{{formData.contact_home.tel_land}}
		</td>
	</tr>

	<tr>
		<th>
			Mobile telephone number(s)
		</th>
		
		<td>
			{{formData.contact_home.tel_mobile}}
		</td>
	</tr>

	<tr>
		<th>
			Skype
		</th>
		
		<td>
			{{formData.contact_home.tel_skype}}
		</td>
	</tr>

	<tr>
		<th>
			Agreed Frequency of Contact
		</th>
		
		<td>
			{{formData.contact_home.freqency_of_contact}}
		</td>
	</tr>
</table>

<div ng-show=" formData.mode == 'no-office' ">
	<h3>Point of Contact information in-country</h3>
	<table>
		<tr>
			<th>
				Name
			</th>
			
			<td>
				{{formData.contact_incountry.user.displayName}}
			</td>
		</tr>

		<tr>
			<th>
				Email Address(es)
			</th>
			
			<td>
				{{formData.contact_incountry.email}}
			</td>
		</tr>

		<tr>
			<th>
				Telephone number(s)
			</th>
			
			<td>
				{{formData.contact_incountry.tel_land}}
			</td>
		</tr>

		<tr>
			<th>
				Mobile telephone number(s)
			</th>
			
			<td>
				{{formData.contact_incountry.tel_mobile}}
			</td>
		</tr>

		<tr>
			<th>
				Skype
			</th>
			
			<td>
				{{formData.contact_incountry.tel_skype}}
			</td>
		</tr>

		<tr>
			<th>
				Agreed Frequency of Contact
			</th>
			
			<td>
				{{formData.contact_incountry.freqency_of_contact}}
			</td>
		</tr>
	</table>
</div>  <!-- ng-show=" formData.mode == 'no-office' -->

<div ng-show=" formData.mode == 'no-office' ">

	<h3>Other Contacts</h3>
	<table>
		<tr>
			<th>
				Alert Partners
			</th>
			
			<td>
				{{formData.contact_other.alert}}
			</td>
		</tr>

		<tr>
			<th>
				Embassies
			</th>
			
			<td>
				{{formData.contact_other.embassies}}
			</td>
		</tr>

		<tr>
			<th>
				Local emergency numbers
			</th>
			
			<td>
				{{formData.contact_other.emergency}}
			</td>
		</tr>

		<tr>
			<th>
				Local medical facilities
			</th>
			
			<td>
				{{formData.contact_other.medical}}
			</td>
		</tr>
	</table>

</div>  <!-- ng-show=" formData.mode == 'no-office' -->