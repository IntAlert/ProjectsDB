
<h1 class="md-display-2">General</h1>

<div ng-form name="generalForm">
<?php
			
		echo $this->Form->input('mode', array(
			'type' => 'radio',
			'options' => array(
				'has-office' => 'Yes, the country does have an Alert office', 
				'no-office' => 'No, the country does not have an Alert office'
			),
			'legend' => 'Does your destination country have an Alert office?',
			'ng-model' => 'mode'
		));


		echo $this->Form->input('reason', array(
			'required' => true,
			"ng-minlength" => "3",
			'label' => 'Reason for your trip',
			'type' => 'textarea',
			'ng-model' => 'formData.applicant.reason'
		));


?>

<!-- {{Travelapplication["data[Travelapplication][reason]"].$valid}} -->

	<div class="input select">
		<label>Name of manager who has approved trip</label>
		<select ng-model="formData.applicant.approving_manager" ng-options="user.User.name_formal for user in users">
		</select>
	</div>


{{generalForm["data[Travelapplication][reason]"].$valid}}

</div>




<form name="userForm">
  <md-input-container>
    <label>Last Name</label>
    <input name="lastName" ng-model="lastName" required md-maxlength="10" minlength="4">
    <div ng-messages="userForm.lastName.$error" ng-show="userForm.lastName.$dirty">
      <div ng-message="required">This is required!</div>
      <div ng-message="md-maxlength">That's too long!</div>
      <div ng-message="minlength">That's too short!</div>
    </div>
  </md-input-container>
  <md-input-container>
    <label>Biography</label>
    <textarea name="bio" ng-model="biography" required md-maxlength="150"></textarea>
    <div ng-messages="userForm.bio.$error" ng-show="userForm.bio.$dirty">
      <div ng-message="required">This is required!</div>
      <div ng-message="md-maxlength">That's too long!</div>
    </div>
  </md-input-container>
  <md-input-container>
    <input aria-label="title" ng-model="title">
  </md-input-container>
  <md-input-container>
    <input placeholder="title" ng-model="title">
  </md-input-container>
</form>
 <div ng-messages="Travelapplication['data[Travelapplication][reason]'].$valid" ng-show="Travelapplication['data[Travelapplication][reason]'].$dirty">
	<div ng-message="required">This is required!</div>
	<div ng-message="md-maxlength">That's too long!</div>
	<div ng-message="minlength">That's too short!</div>
</div>


<md-button 
	ng-click="selectedTabIndex = 2"
	class="md-raised">
	Confirm
</md-button>