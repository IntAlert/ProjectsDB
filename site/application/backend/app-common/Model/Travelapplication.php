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



	function saveWithItinerary($data, $travelapplication_id = null) {

		// debug($data);
		$travelapplication = array(
			'mode' => $data["mode"],
			'applicant_user_id' => $data["applicant"]["id"],
			'manager_user_id' => $data["applicant"]["approving_manager"]["User"]["id"],
			'contact_home_user_id' => isset($data["contact_home"]["user"]) ? $data["contact_home"]["user"]["User"]["id"]: null,
			'contact_incountry_user_id' => isset($data["contact_incountry"]["user"]) ? $data["contact_incountry"]["user"]["User"]["id"] : null,
			'application_json' => json_encode($data),
		);

		
		if (is_null($travelapplication_id)) {
			// create application
			$this->create();
		} else {
			// edit application
			$this->id = $travelapplication_id;
		}
		
		if ($this->save($travelapplication)) {

			if (is_null($travelapplication_id)) {
				$travelapplication_id = $this->id;
			} else {
				// delete any itineraries if this is an edit
				$this->Travelapplication->TravelapplicationItinerary->deleteAll([
					'travelapplication_id' => $travelapplication_id
				]);
			}

			// save the itineraries
			foreach($data['itinerary'] as $itinerary) {
				$itinerary = array(
					'travelapplication_id' => $travelapplication_id,
					'start' => $itinerary['start'],
					'finish' => $itinerary['finish'],
					'origin_territory_id' => $itinerary['origin']['Territory']['id'],
					'destination_territory_id' => $itinerary['destination']['Territory']['id'],
				);

				$this->TravelapplicationItinerary->create();
				$this->TravelapplicationItinerary->save($itinerary);
			}
		}

		return $travelapplication_id;
	}

}
