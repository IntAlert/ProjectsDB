<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {


    public $hasOne = 'Office365user';
    public $hasAndBelongsToMany = 'Role';

	// public $virtualFields = array(
	//     // 'name' => 'CONCAT(User.first_name, " ", User.last_name)'
	//     'name' => "CONCAT(first_name, ' ', last_name)",
 //        'name_formal' => "CONCAT(last_name, ', ', first_name)",
	// );

    public function __construct($id = false, $table = null, $ds = null) {

        parent::__construct($id, $table, $ds);

        $this->virtualFields = array(
            'name' => "CONCAT(" . $this->alias . ".first_name, ' ', " . $this->alias . ".last_name)",
            'name_formal' => "CONCAT(" . $this->alias . ".last_name, ', ', " . $this->alias . ".first_name)",
        );

    }

    public function findUserListByRoleName($role_name) {

        // get all user ids that are budget holders
        $role = $this->Role->find('first', array(
            'contain' => 'User',
            'conditions' => array(
                'Role.short_name' => $role_name, // budget holder
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

    public function getO365Id($user_id) {
        $user = $this->find('first', array(
            'conditions' => array('id' => $user_id),
            'contain' => 'Office365user'
        ));

        return $user['Office365user']['o365_object_id'];
    }

    public function findUsersByRoleName($role_name) {

        // get all user ids that are budget holders
        $role = $this->Role->find('first', array(
            'contain' => 'User',
            'conditions' => array(
                'Role.short_name' => $role_name, // budget holder
            )
        ));

        $user_ids = [];
        foreach ($role['User'] as $user) {
            $user_ids[] = $user['id'];
        }

        return $this->find('all', array(
            'conditions' => array(
                'User.id' => $user_ids
            )
        ));
    }


    public function userHasRole($user_id, $role_short_name) {

        // get all user ids that are budget holders
        $role = $this->Role->find('first', array(
            'conditions' => array(
                'Role.short_name' => $role_short_name, // budget holder
            )
        ));

        // If the role does not exist, throw an error
        if ( !$role ) {
            throw new Exception("Role does not exist" . $role_short_name, 1);
            
        }

        return !! $this->RolesUser->find('first', array(
            'conditions' => array(
                'role_id' => $role['Role']['id'],
                'user_id' => $user_id,
            )
        ));

    }

    public function findBudgetHoldersList() {

        return $this->findUserListByRoleName('budget-holder');

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