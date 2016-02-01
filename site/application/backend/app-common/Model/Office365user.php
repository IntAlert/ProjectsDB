<?php
App::uses('AppModel', 'Model');
/**
 * Office365user Model
 *
 * @property User $User
 */
class Office365user extends AppModel {

	public $primaryKey = 'user_id';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		)
	);




	function getOrCreate($o365_user_response, $role_ids = array()) {
		
		// extract useful data
		$o365_object_id = $o365_user_response->objectId;
		$name = $o365_user_response->displayName;
		$email = $o365_user_response->userPrincipalName;
		$displayName = $o365_user_response->displayName;
		$givenName = $o365_user_response->givenName;
		$surname = $o365_user_response->surname;
		

		// look for user
		$user = $this->findUserByObjectId($o365_object_id);

		
		// return the user if it exists
		if ($user) return $user;

		// if not exist,
		// create native user
		$this->User->create(array(
			'first_name' => $givenName,
			'last_name' => $surname,
			'display_name' => $displayName,
		));
		$result = $this->User->save();
		$user_id = $this->User->id;

		// add roles if any supplied
		if(is_array($role_ids)) {
			foreach ($role_ids as $role_id) {
				$relationship = compact('user_id', 'role_id');

				$this->User->RolesUser->create();
				$this->User->RolesUser->save($relationship);
			}	
		}
		

		// create o365 user
		$this->create(compact(
			'o365_object_id',
			'user_id',
			'email'
		));
		$this->save();

		// return user record
		return $this->findUserByObjectId($o365_object_id);


	}

	function updateGraphTokens($user_id, $tokens) {
		
		$this->id = $user_id;

		$data = array(
			'graph_access_token' => $tokens['access_token'],
			'graph_refresh_token' => $tokens['refresh_token'],
		);

		return $this->save($data);

	}

	function updateSharepointTokens($user_id, $tokens) {
		
		$this->id = $user_id;

		$data = array(
			'sharepoint_access_token' => $tokens['access_token'],
			'sharepoint_refresh_token' => $tokens['refresh_token'],
			// 'sharepoint_token_expires' => $tokens['access_token_expires']
		);

		return $this->save($data);

	}

	function getAlreadyKnownListByObjectId($office365Users) {

		$objectIds = array();

		foreach ($office365Users as $o365user) {
			$objectIds[] = $o365user->objectId;
		}

		// which of these already exist?
		$knownObjectIds = $this->find('list', array(
			'conditions' => array(
				'o365_object_id' => $objectIds,
			),
			'fields' => array('o365_object_id', 'email')
		));

		return $knownObjectIds;

	}


	private function findUserByObjectId($o365_object_id) {
		return $this->find('first', array(
			'contain' => array('User'),
			'conditions' => array(
				'o365_object_id' => $o365_object_id
			)
		));
	}

}

