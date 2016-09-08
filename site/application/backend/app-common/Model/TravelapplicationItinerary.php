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


    function getIdsByDestinationAndDate($destination_territory_id, $date) {

        $conditions = [];
        if ($destination_territory_id != -1) {
            $conditions[] = array('destination_territory_id' => $destination_territory_id);
        }

        if ($date != -1) {
            $conditions[] = array(
                'start <=' => $date,
                'finish >=' => $date,
            );
        }

        // debug($conditions);

        $fields = array('travelapplication_id', 'travelapplication_id');
        $ids = $this->find('list', compact('fields', 'conditions'));

        // debug($ids);

        // $dbo = $this->getDatasource();
        //   $logs = $dbo->getLog();
        //   $lastLog = end($logs['log']);
        //   debug($lastLog['query']);

        return array_unique($ids);

    }
}
