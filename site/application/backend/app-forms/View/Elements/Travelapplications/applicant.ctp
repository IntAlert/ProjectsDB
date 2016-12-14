<?php
		echo $this->Form->input('user_id', array(
			'type' => 'hidden',
			'ng-model' => 'formData.applicant.id',
		));
		echo $this->Form->input('name', array(
			'type' => 'text',
			'label' => 'Your name *',
			'disabled' => true,
			'ng-model' => 'formData.applicant.name'
		));


		?>

<p>Category *</p>
<md-radio-group ng-model="formData.applicant.role_category">

  <md-radio-button value="Alert staff">Alert staff</md-radio-button>
  <md-radio-button value="Consultant">Consultant</md-radio-button>
  <md-radio-button value="Other">Other</md-radio-button>
  
</md-radio-group>


<div ng-show=" formData.applicant.role_category == 'Other' ">
	<md-input-container md-no-float class="md-block">
		<label>Other role*</label>
		<input 
			ng-required=" formData.applicant.role_category == 'Other' "
			ng-model=" formData.applicant.role_category_other " 
			>
	</md-input-container>
</div>


	<md-input-container md-no-float class="md-block">
		<label>Your role at Alert *</label>
		<input 
			required
			ng-model=" formData.applicant.role_text " 
			>
	</md-input-container>


<div layout="row" layout-align="end center">
	<md-button 
	ng-show="applicantForm.$valid"
	ng-click=" changeActiveTab(2) "
	class="md-raised">
	Next
	</md-button>
</div>