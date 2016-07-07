<?php
App::uses('ProgrammesController', 'Controller');

/**
 * ProgrammesController Test Case
 *
 */
class ProgrammesControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.programme',
		'app.programmebudget',
		'app.project',
		'app.status',
		'app.likelihood',
		'app.user',
		'app.projectnote',
		'app.contract',
		'app.donor',
		'app.currency',
		'app.payment',
		'app.contractbudget',
		'app.territory',
		'app.territories_project',
		'app.projects_user',
		'app.theme',
		'app.projects_theme',
		'app.proposal',
		'app.territories_proposal',
		'app.proposals_theme',
		'app.audit',
		'app.audit_delta'
	);

}
