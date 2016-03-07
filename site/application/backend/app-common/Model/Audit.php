<?php

App::uses('AuthComponent', 'Controller/Component');
App::uses('AppModel', 'Model');

class Audit extends AppModel
{

  public $displayField = "email";

  
  public $belongsTo = array(
    'Project' => array(
      'className' => 'Project',
      'foreignKey' => 'entity_id',
      'conditions' => array('Audit.model = "Project"'),
    ),

    'User' => array(
      'className' => 'User',
      'foreignKey' => 'source_id',
    ),
  );

  public $hasMany = array(
      'AuditDelta' => array(
        'className' => 'AuditDelta',
        'foreignKey' => 'audit_id',
      )
    );

  function record($event, $model_name, $entity_id, $data = null) {

  	$user_id = AuthComponent::user('id');
    $description = NULL;
    $json_object = json_encode( $data );

  	$data = array(
      'Audit' => array(
        'event'     => $event,
        'model'     => $model_name,
        'entity_id' => $entity_id,
        'json_object' => $json_object,
        'source_id' => $user_id,
        'description' => $description,
      )
    );

	  $this->create($data);

    return $this->save();

  }

  function findCompanyActivity($limit = 10) {

    return $this->find('all', array(
      'conditions' => array(
        'Audit.model' => "Project",
        'Audit.event' => array("CREATE", "EDIT"),
        'Project.deleted' => false,
      ),
      'contain' => array('User', 'Project'),
      'order' => array('Audit.created DESC'),
      'limit' => $limit,
    ));
  }

  function findProjectActivity($project_id) {

    return $this->find('all', array(
      'conditions' => array(
        'Audit.model' => "Project",
        'Audit.entity_id' => $project_id,
        'Audit.event' => array("CREATE", "EDIT", "READ"),
        'Project.deleted' => false,
      ),
      'contain' => array('User', 'Project'),
      'order' => array('Audit.created DESC'),
    ));
  }

  public function getLeagueTable() {
        $results = $this->find('all', array(
            'fields' => array(
                'User.*', 
                'COUNT(Audit.id)',
                'Audit.source_id',
            ),
            'conditions' => array(
              'Audit.source_id <>' => null,
              'Audit.source_id <>' => 0,
            ),
            'group' => array('Audit.source_id'),
            'order' => 'COUNT(Audit.id) DESC',
            'contain' => 'User.Office365user',
                        )
        );

        // $table = [];
        // foreach($results as $result) {
        //   $table[] = array(
        //     'total' => $result[0]['COUNT(`Audit`.`id`)'],
        //     'Office365User' => $result['User']['Office365User'],
        //   );
        // }

        return $results;
    }

}
?>
