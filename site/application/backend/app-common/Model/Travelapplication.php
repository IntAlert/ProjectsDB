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

}
