

<p>Please verify the following emergency information is up to date.</p>

<table>

<!-- Proof of life -->

	<tr>
		<th>
			Proof of Life Question
		</th>
		<td>
			<?php
				echo $this->Form->input('pol_question', array(
					'required' => true,
					'label' => false,
					'ng-model' => 'formData.contact_home.email',
				));
			?>
		</td>
	</tr>

	<tr>
		<th>
			Proof of Life Answer
		</th>
		<td>
			<?php
				echo $this->Form->input('pol_answer', array(
					'required' => true,
					'label' => false,
					'ng-model' => 'formData.contact_home.email',
				));
			?>
		</td>
	</tr>

</table>

<!-- Emergency Contacts -->

<p>Confirm the above is correct to continue with your travel application</p>



<div layout="row" layout-align="end center">
  
	<md-button 
		ng-show="emergencyForm.$valid"
		ng-click=" continueApplication() "
		class="md-raised">
		Continue Travel Application
	</md-button>
</div>