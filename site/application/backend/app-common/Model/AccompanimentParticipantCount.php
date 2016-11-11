<?php
App::uses('AppModel', 'Model');
/**
 * Meeting Model
 *
 * @property ParticipantType $ParticipantType
 * @property Theme $Theme
 */
class AccompanimentParticipantCount extends AppModel {

	var $useTable = 'accompaniments_participant_types';

	function deleteCounts($accompaniment_id) {
		return $this->deleteAll(compact('accompaniment_id'));
	}
}