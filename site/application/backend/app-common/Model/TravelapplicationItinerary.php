<?php
App::uses('AppModel', 'Model');
/**
 * Travelapplication Model
 *
 * @property User $User
 * @property Itinerary $Itinerary
 * @property Travelrisksbyuser $Travelrisksbyuser
 */
class TravelapplicationItinerary extends AppModel {

	public $useTable = 'travelapplications_itineraries';

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Travelapplication',
		'Destination' => array(
        	'foreignKey' => 'destination_territory_id',
            'className' => 'Territory',
        ),

        'Origin' => array(
        	'foreignKey' => 'origin_territory_id',
            'className' => 'Territory',
        ),
	);
}
