<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {


    public $hasOne = 'Office365user';
    public $hasAndBelongsToMany = 'Role';

	public $virtualFields = array(
	    // 'name' => 'CONCAT(User.first_name, " ", User.last_name)'
	    'name' => "CONCAT(first_name, ' ', last_name)",
        'name_formal' => "CONCAT(last_name, ', ', first_name)",
	);

    public function findBudgetHoldersList() {

        // get all user ids that are budget holders
        $role = $this->Role->find('first', array(
            'contain' => 'User',
            'conditions' => array(
                'Role.id' => 2, // budget holder
            )
        ));

        $user_ids = [];
        foreach ($role['User'] as $user) {
            $user_ids[] = $user['id'];
        }

        return $this->find('list', array(
            'fields' => array('id', 'name_formal'),
            'order' => array('last_name, first_name'),
            'conditions' => array(
                'User.id' => $user_ids
            )
        ));
    }

    public function findAllUsersList() {

        return $this->find('list', array(
            'fields' => array('id', 'name_formal'),
            'order' => array('last_name, first_name')
        ));
    }

    public function findAllUsersOrdered() {

        return $this->find('all', array(
            'order' => array('last_name, first_name')
        ));
    }


	public function createEmptyUser() {

		// create an empty user
		$this->create();
		$this->save();
		return $this->id;
	}

	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $passwordHasher = new BlowfishPasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash(
	            $this->data[$this->alias]['password']
	        );
	    }
	    return true;
	}

    public function softDelete($id) {
        $this->id = $id;
        $this->saveField('deleted', true);
        return true; // assume it worked
    }

    public function addRole($user_id, $role_short_name_or_id) {

        // if name, get role
        $role = $this->Role->find('first', array(
            'conditions' => array(
                'OR' => array(
                    'Role.id' => $role_short_name_or_id,
                    'Role.short_name' => $role_short_name_or_id,
        ))));

        if (!$role) throw new Exception("Role not found: " . $role_short_name_or_id, 1);
        $role_id = $role['Role']['id'];    
        
        

        // role assoc already exists?
        $role_assocs = $this->RolesUser->find('list', array(
            'conditions' => compact('user_id'),
            'fields' => array('role_id', 'role_id'),
        ));

        // already associated?
        if ( !isset($role_assocs[$role_id]) ) {
            // create assoc
            $this->RolesUser->create();
            $this->RolesUser->save(compact('role_id', 'user_id'));
        }

    }

    public function addRoles($user_id, $role_short_name_or_ids) {
        foreach ($role_short_name_or_ids as $role_short_name_or_id) {
            $this->addRole($user_id, $role_short_name_or_id);
        }
    }

    

}