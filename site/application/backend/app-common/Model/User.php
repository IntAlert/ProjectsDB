<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {


	var $displayField = 'username';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'voter')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );


	public function createEmptyUser() {

		// create an empty user
		$this->create();
		$this->save();
		return $this->id;
	}

	// public function markAsMigrated($user_id) {
	// 	$this->id = $user_id;
	// 	return $this->saveField('migrated', true);
	// }

	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $passwordHasher = new BlowfishPasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash(
	            $this->data[$this->alias]['password']
	        );
	    }
	    return true;
	}

}
