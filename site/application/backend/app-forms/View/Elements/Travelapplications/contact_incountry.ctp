
<div ng-show=" formData.mode == 'no-office' ">
	<h3>Point of Contact information in-country</h3>
		

	<table>
		<tr>
			<th>
				Member of staff *
			</th>
			<td>
				<select 
					ng-required=" formData.mode == 'no-office' "
					ng-model="formData.contact_incountry.user" 
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
						'ng-required' => "formData.mode == 'no-office'",
						'label' => false,
						'ng-model' => 'formData.contact_incountry.email'
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
						'ng-required' => "formData.mode == 'no-office'",
						'label' => false,
						'ng-model' => 'formData.contact_incountry.tel_land'
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
						'ng-required' => "formData.mode == 'no-office'",
						'label' => false,
						'ng-model' => 'formData.contact_incountry.tel_mobile'
					));
				?>
			</td>
		</tr>

		<tr>
			<th>
				Skype *
			</th>
			<td>
				<?php
					echo $this->Form->input('homecontact_tel_skype', array(
						'ng-required' => "formData.mode == 'no-office'",
						'label' => false,
						'ng-model' => 'formData.contact_incountry.tel_skype'
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
						'ng-required' => "formData.mode == 'no-office'",
						'label' => false,
						'ng-model' => 'formData.contact_incountry.freqency_of_contact'
					));
				?>
			</td>
		</tr>
	</table>
</div> <!-- ng-show=" formData.mode == 'no-office' " -->