
<h1 class="md-display-2">General</h1>

<?php
			
		echo $this->Form->input('mode', array(
			'type' => 'radio',
			'options' => array(
				'has-office' => 'Yes, the country does have an Alert office', 
				'no-office' => 'No, the country does not have an Alert office'
			),
			'legend' => 'Does your destination country have an Alert office? *',
			'ng-model' => 'formData.mode'
		));


		echo $this->Form->input('reason', array(
			'required' => true,
			"ng-minlength" => "3",
			'label' => 'Reason for your trip *',
			'type' => 'textarea',
			'ng-model' => 'formData.applicant.reason'
		));


?>

	<div class="input select">
		<label>Name of manager who has approved trip *</label>
		<select 
			required
			ng-model="formData.applicant.approving_manager" 
			ng-options="user.User.name_formal for user in users track by user.User.id">
		</select>
	</div>

	<div layout="row" layout-align="end center">
	  
		<md-button 
			ng-show="generalForm.$valid"
			ng-click=" changeActiveTab(1) "
			class="md-raised">
			Next
		</md-button>
	</div>