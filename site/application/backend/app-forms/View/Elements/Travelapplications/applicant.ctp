
<h1 class="md-display-2">Applicant Details</h1>
<?php
		echo $this->Form->input('user_id', array(
			'type' => 'hidden',
			'value' => $this->session->read('Auth.User.id')
		));
		echo $this->Form->input('name', array(
			'type' => 'text',
			'label' => 'Your name',
			'value' => $this->session->read('Auth.User.name'),
			'disabled' => true,
			'ng-model' => 'formData.applicant.name'
		));

		echo $this->Form->input('role_category', array(
			'type' => 'radio',
			'options' => array('Alert staff', 'Consultant', 'Other'),
			'label' => 'Category',
			'ng-model' => 'formData.applicant.role_category'
		));

		echo $this->Form->input('role_category_other', array(
			'type' => 'text',
			'label' => 'Other',
			'ng-model' => 'formData.applicant.role_category_other'
		));

		echo $this->Form->input('role_text', array(
			'type' => 'text',
			'label' => 'Your role at Alert',
			'ng-model' => 'formData.applicant.role_text'
		));

		echo $this->Form->input('reason', array(
			'label' => 'Reason for your trip',
			'type' => 'textarea',
			'ng-model' => 'formData.applicant.reason'
		));

		echo $this->Form->input('approving_manager', array(
			'type' => 'select',
			'options' => $users,
			'label' => 'Name of manager who has approved trip',
			'ng-model' => 'formData.applicant.approving_manager'
		));



?>