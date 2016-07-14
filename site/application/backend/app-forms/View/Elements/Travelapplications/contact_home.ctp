<h1 class="md-display-2">Point of Contact information in your home office</h1>

<table>
	<tr>
		<th>
			Name
		</th>
		<td>
			<?php
				echo $this->Form->input('homecontact_name', array(
					'label' => false,
			'ng-model' => 'formData.contact_home.name'
				));
			?>
		</td>
	</tr>

	<tr>
		<th>
			Email Address(es)
		</th>
		<td>
			<?php
				echo $this->Form->input('homecontact_email', array(
					'label' => false,
			'ng-model' => 'formData.contact_home.email'
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
					'label' => false,
			'ng-model' => 'formData.contact_home.tel_land'
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
					'label' => false,
			'ng-model' => 'formData.contact_home.skype'
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
					'label' => false,
			'ng-model' => 'formData.contact_home.freqency_of_contact'
				));
			?>
		</td>
	</tr>
</table>