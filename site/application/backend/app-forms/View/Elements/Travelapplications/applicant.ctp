
<h1 class="md-display-2">Applicant Details</h1>

<?php
		echo $this->Form->input('user_id', array(
			'type' => 'hidden',
			'ng-model' => 'formData.applicant.id',
		));
		echo $this->Form->input('name', array(
			'type' => 'text',
			'label' => 'Your name',
			'disabled' => true,
			'ng-model' => 'formData.applicant.name'
		));

		echo $this->Form->input('role_category', array(
			'type' => 'radio',
			'options' => array(
				'Alert staff' => 'Alert staff', 
				'Consultant' => 'Consultant', 
				'Other'=> 'Other'
			),
			'label' => 'Category',
			'ng-model' => 'formData.applicant.role_category'
		));

		echo $this->Form->input('role_category_other', array(
			'type' => 'text',
			'label' => 'Other Role',
			'ng-model' => 'formData.applicant.role_category_other',
			'div' => array(
				'ng-show' => "formData.applicant.role_category == 'Other'"
			)
			
		));

		echo $this->Form->input('role_text', array(
			'type' => 'text',
			'label' => 'Your role at Alert',
			'ng-model' => 'formData.applicant.role_text'
		));



?>