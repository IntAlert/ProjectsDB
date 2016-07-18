
<div ng-show=" formData.mode == 'no-office' ">
	<h1 class="md-display-2">Point of Contact information in-country</h1>
		

	<table>
		<tr>
			<th>
				Member of staff
			</th>
			<td>
				<select 
					ng-required=" formData.mode == 'no-office' "
					ng-model="formData.contact_incountry.user" 
					ng-options="user.User.name_formal for user in users">
				</select>
			</td>
		</tr>

		<tr>
			<th>
				Email Address(es)
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
				Landline telephone number(s)
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
				Mobile telephone number(s)
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
				Skype
			</th>
			<td>
				<?php
					echo $this->Form->input('homecontact_tel_skype', array(
						'label' => false,
						'ng-model' => 'formData.contact_incountry.skype'
					));
				?>
			</td>
		</tr>

		<tr>
			<th>
				Agreed Frequency of Contact
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