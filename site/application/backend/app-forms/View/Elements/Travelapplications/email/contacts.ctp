<h2>Contacts</h2>

<h3>Point of Contact information in your home office</h3>
<table>
	<tr>
		<th>
			Name
		</th>
		
		<td>
			<?php echo $travelapplicationObj->contact_home->user->User->name_formal; ?>
		</td>
	</tr>

	<tr>
		<th>
			Email Address(es)
		</th>
		
		<td>
			<?php echo $travelapplicationObj->contact_home->email; ?>
		</td>
	</tr>

	<tr>
		<th>
			Mobile telephone number(s)
		</th>
		
		<td>
			<?php echo $travelapplicationObj->contact_home->tel_mobile; ?>
		</td>
	</tr>

	<tr>
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
	<table>
		<tr>
			<th>
				Name
			</th>
			
			<td>
				<?php echo $travelapplicationObj->contact_incountry->user->User->name_formal; ?>
			</td>
		</tr>

		<tr>
			<th>
				Email Address(es)
			</th>
			
			<td>
				<?php echo $travelapplicationObj->contact_incountry->email; ?>
			</td>
		</tr>

		<tr>
			<th>
				Mobile telephone number(s)
			</th>
			
			<td>
				<?php echo $travelapplicationObj->contact_incountry->tel_mobile; ?>
			</td>
		</tr>

		<tr>
			<th>
				Skype
			</th>
			
			<td>
				<?php echo $travelapplicationObj->contact_incountry->skype; ?>
			</td>
		</tr>

		<tr>
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
	<table>
		<tr>
			<th>
				Alert Partners
			</th>
			
			<td>
				<?php echo $travelapplicationObj->contact_other->alert; ?>
			</td>
		</tr>

		<tr>
			<th>
				Embassies
			</th>
			
			<td>
				<?php echo $travelapplicationObj->contact_other->embassies; ?>
			</td>
		</tr>

		<tr>
			<th>
				Local emergency numbers
			</th>
			
			<td>
				<?php echo $travelapplicationObj->contact_other->emergency; ?>
			</td>
		</tr>

		<tr>
			<th>
				Local medical facilities
			</th>
			
			<td>
				<?php echo $travelapplicationObj->contact_other->medical; ?>
			</td>
		</tr>
	</table>

</div>  


<?php endif; // if ($travelapplicationObj->mode == 'no-office'): ?>