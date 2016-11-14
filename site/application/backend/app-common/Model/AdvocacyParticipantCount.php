<?php
App::uses('AppModel', 'Model');
/**
 * Meeting Model
 *
 * @property ParticipantType $ParticipantType
 * @property Theme $Theme
 */
class AdvocacyParticipantCount extends AppModel {

	var $useTable = 'advocacies_participant_types';

	function deleteCounts($advocacy_id) {
		return $this->deleteAll(compact('advocacy_id'));
	}
}