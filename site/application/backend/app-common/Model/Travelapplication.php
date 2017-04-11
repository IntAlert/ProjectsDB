<?php
App::uses('AppModel', 'Model');
/**
 * Travelapplication Model
 *
 * @property User $User
 * @property Itinerary $Itinerary
 * @property Travelrisksbyuser $Travelrisksbyuser
 */
class Travelapplication extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'summary';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Applicant' => array(
			'className' => 'User',
			'foreignKey' => 'applicant_user_id'
		),

		'ApprovingManager' => array(
			'className' => 'User',
			'foreignKey' => 'manager_user_id'
		),

		'HomeContact' => array(
			'className' => 'User',
			'foreignKey' => 'contact_home_user_id'
		),

		'CountryContact' => array(
			'className' => 'User',
			'foreignKey' => 'contact_incountry_user_id'
		),

		
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'TravelapplicationItinerary' => array(
			'className' => 'TravelapplicationItinerary',
			'foreignKey' => 'travelapplication_id'
		)
	);



	function saveWithItinerary($applicant_o365_object_id, $user_id, $data, $travelapplication_id) {

		// debug($data);
		$travelapplication = array(
			'mode' => $data["mode"],
			'applicant_user_id' => $user_id,
			'applicant_o365_object_id' => $applicant_o365_object_id,
			'manager_o365_object_id' => $data["applicant"]["approving_manager"]["objectId"],
			'contact_home_o365_object_id' => isset($data["contact_home"]["user"]) ? $data["contact_home"]["user"]["objectId"]: null,
			'contact_incountry_o365_object_id' => isset($data["contact_incountry"]["user"]) ? $data["contact_incountry"]["user"]["objectId"] : null,
			'application_json' => json_encode($data),
		);

		if ($travelapplication_id) {
			// edit application
			$this->id = $travelapplication_id;
		} else {
			// create application
			$this->create();
		}
		
		if ( $this->save($travelapplication) ) {

			if ( $travelapplication_id ) {
				// delete any itineraries if this is an edit
				$this->TravelapplicationItinerary->deleteAll([
					'travelapplication_id' => $this->id
				]);
			}

			// save the itineraries
			foreach($data['itinerary'] as $itinerary) {
				$itinerary = array(
					'travelapplication_id' => $this->id,
					'start' => $itinerary['start'],
					'finish' => $itinerary['finish'],
					'origin_territory_id' => $itinerary['origin']['Territory']['id'],
					'destination_territory_id' => $itinerary['destination']['Territory']['id'],
				);

				$this->TravelapplicationItinerary->create();
				$this->TravelapplicationItinerary->save($itinerary);
			}
		}

		return $this->id;
	}

	function getMine($user_id) {

		// just return recent applications
		return $this->find('all', array(
			'contain' => false,
			'conditions' => array(
				'applicant_user_id' => $user_id
			),
			'order' => array(
				'Travelapplication.created' => 'DESC'
			),
		));

	}

	function getManaged($manager_o365_object_id, $query = null) {

		$query = array(
			'contact_o365_object_id' => $manager_o365_object_id,
			'destination_territory_id' => -1,
			'date' => $query['date'],
			'applicant_o365_object_id' => $query['applicant_o365_object_id'],
		);

		return $this->search($query);

	}

	function search($query = null) {

		// debug($query);
		// $query = array(
		// 	'destination_territory_id' => -1,
		// 	'date' => '2016-07-27',
		// 	'contact_o365_object_id' => 'f1a3aea2-0302-4982-b373-74ac88195268',
		// 	'applicant_o365_object_id' => 4,
		// );

		$conditions = [];

		// debug($query);

		// search by destination and destination
		// get travelapplication_ids of itineraries that have a matching destination
		if ( !($query['destination_territory_id'] == -1 && $query['date'] == -1) ) {
			$travelapplication_ids = $this
				->TravelapplicationItinerary
				->getIdsByDestinationAndDate($query['destination_territory_id'], $query['date']);


			// // just return empty if there are no matching travelapplications
			// if ( empty($travelapplication_ids)) return [];

			$conditions[] = array(
				'id' => $travelapplication_ids
			);
		}

		// search by contact
		if ($query['contact_o365_object_id'] != -1) {
			$conditions[] = array(
				'OR' => array(
					'manager_o365_object_id' => $query['contact_o365_object_id'],
					'contact_home_o365_object_id' => $query['contact_o365_object_id'],
					'contact_incountry_o365_object_id' => $query['contact_o365_object_id'],
					'contact_hq_o365_object_id' => $query['contact_o365_object_id'],
				)
			);
		}

		// search by applicant
		if ($query['applicant_o365_object_id'] != -1) {
			$conditions[] = array(
				'applicant_o365_object_id' => $query['applicant_o365_object_id']
			);
		}

		// debug($conditions);

		return $this->find('all', array(
			'contain' => false,
			'conditions' => $conditions,
			'order' => array(
				'Travelapplication.created' => 'DESC'
			),
		));


	}

}
