<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {


    public $hasOne = 'Office365user';

	public $virtualFields = array(
	    // 'name' => 'CONCAT(User.first_name, " ", User.last_name)'
	    'name' => "CONCAT(first_name, ' ', last_name)",
        'name_formal' => "CONCAT(last_name, ', ', first_name)",
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $validate = array(
        // 'username' => array(
        //     'required' => array(
        //         'rule' => array('notEmpty'),
        //         'message' => 'A username is required'
        //     )
        // ),
        // 'password' => array(
        //     'required' => array(
        //         'rule' => array('notEmpty'),
        //         'message' => 'A password is required'
        //     )
        // ),
        // 'role' => array(
        //     'valid' => array(
        //         'rule' => array('inList', array('admin', 'employee')),
        //         'message' => 'Please enter a valid role',
        //         'allowEmpty' => false
        //     )
        // )
    );

    public function findEmployeesList() {
    	return $this->find('list', array(
    		'fields' => array('id', 'name_formal'),
    		'conditions' => array('role' => 'employee')
    	));
    }


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
