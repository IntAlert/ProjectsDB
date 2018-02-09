<h2>Contacts</h2>



<h3>Point of Contact information in your home office</h3>
<table width="100%">
	<tr width="50%">
		<th>
			Name
		</th>
		
		<td>
			<?php echo $travelapplicationObj->contact_home->user->displayName; ?>
		</td>
	</tr>

	<tr width="50%">
		<th>
			Email Address(es)
		</th>
		
		<td>
			<?php echo $travelapplicationObj->contact_home->email; ?>
		</td>
	</tr>

	<tr width="50%">
		<th>
			Telephone Number(s)
		</th>
		
		<td>
			<?php echo $travelapplicationObj->contact_home->tel_land; ?>
		</td>
	</tr>

	<tr width="50%">
		<th>
			Mobile telephone number(s)
		</th>
		
		<td>
			<?php echo $travelapplicationObj->contact_home->tel_mobile; ?>
		</td>
	</tr>

	<tr width="50%">
		<th>
			Skype for Bussiness
		</th>
		
		<td>
			<?php echo $travelapplicationObj->contact_home->tel_skype; ?>
		</td>
	</tr>

	<tr width="50%">
		<th>
			Agreed Frequency of Contact
		</th>
		
		<td>
			<?php echo $travelapplicationObj->contact_home->freqency_of_contact; ?>
		</td>
	</tr>
</table>

<?php if ($travelapplicationObj->mode == 'no-office'): ?>
<div>
	<h3>Point of Contact information in-country</h3>
	<table width="100%">
		<tr width="50%">
			<th>
				Name
			</th>
			
			<td>
				<?php echo $travelapplicationObj->contact_incountry->user->displayName; ?>
			</td>
		</tr>

		<tr width="50%">
			<th>
				Email Address(es)
			</th>
			
			<td>
				<?php echo $travelapplicationObj->contact_incountry->email; ?>
			</td>
		</tr>

		<tr width="50%">
			<th>
				Telephone Number
			</th>
			
			<td>
				<?php echo $travelapplicationObj->contact_incountry->tel_land; ?>
			</td>
		</tr>

		<tr width="50%">
			<th>
				Mobile telephone number(s)
			</th>
			
			<td>
				<?php echo $travelapplicationObj->contact_incountry->tel_mobile; ?>
			</td>
		</tr>

		<tr width="50%">
			<th>
				Skype for Bussiness
			</th>
			
			<td>
				<?php echo $travelapplicationObj->contact_incountry->tel_skype; ?>
			</td>
		</tr>

		<tr width="50%">
			<th>
				Agreed Frequency of Contact
			</th>
			
			<td>
				<?php echo $travelapplicationObj->contact_incountry->freqency_of_contact; ?>
			</td>
		</tr>
	</table>
</div>


<div>

	<h3>Other Contacts</h3>
	<table width="100%">
		<tr width="50%">
			<th>
				Alert Partners, Embassies, Local emergency numbers, Local medical facilities
			</th>
			
			<td>
				<?php echo $travelapplicationObj->contact_other; ?>
			</td>
		</tr>

	</table>

</div>  


<?php endif; // if ($travelapplicationObj->mode == 'no-office'): ?>