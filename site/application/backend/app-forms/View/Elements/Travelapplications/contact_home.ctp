<h3>Point of Contact information in your home office</h3>

<table>
	<tr>
		<th>
			Staff Member *
		</th>
		<td>

			<select 
				required
				ng-model="formData.contact_home.user" 
				ng-options="office365user.displayName for office365user in office365Users.all track by office365user.objectId">
			</select>

		</td>
	</tr>

	<tr>
		<th>
			Email Address(es) *
		</th>
		<td>
			<?php
				echo $this->Form->input('homecontact_email', array(
					'required' => true,
					'label' => false,
					'ng-model' => 'formData.contact_home.email',
				));
			?>
		</td>
	</tr>

	<tr>
		<th>
			Landline telephone number(s) *
		</th>
		<td>
			<?php
				echo $this->Form->input('homecontact_tel_land', array(
					'required' => true,
					'label' => false,
					'ng-model' => 'formData.contact_home.tel_land'
				));
			?>
		</td>
	</tr>

	<tr>
		<th>
			Mobile telephone number(s) *
		</th>
		<td>
			<?php
				echo $this->Form->input('homecontact_tel_mob', array(
					'required' => true,
					'label' => false,
					'ng-model' => 'formData.contact_home.tel_mobile'
				));
			?>
		</td>
	</tr>

	<tr>
		<th>
			Skype
		</th>
		<td>
			<?php
				echo $this->Form->input('homecontact_tel_skype', array(
					'required' => true,
					'label' => false,
					'ng-model' => 'formData.contact_home.tel_skype'
				));
			?>
		</td>
	</tr>

	<tr>
		<th>
			Agreed Frequency of Contact *
		</th>
		<td>
			<?php
				echo $this->Form->input('homecontact_freq', array(
					'required' => true,
					'label' => false,
					'ng-model' => 'formData.contact_home.freqency_of_contact'
				));
			?>
		</td>
	</tr>
</table>