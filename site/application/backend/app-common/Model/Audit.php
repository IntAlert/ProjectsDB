<?php

App::uses('AuthComponent', 'Controller/Component');
App::uses('AppModel', 'Model');

class Audit extends AppModel
{

  public $displayField = "email";

  
  public $belongsTo = array(
    // 'User' => array(
    //   'className' => 'User',
    //   'foreignKey' => 'source_id',
    // ),
    // 'Journey' => array(
    //   'className' => 'Journey',
    //   'foreignKey' => 'entity_id',
    //   'conditions' => array("Audit.model" => "Journey"),
    // ),
    // 'Company' => array(
    //   'className' => 'Company',
    //   'foreignKey' => 'entity_id',
    //   'conditions' => array("Audit.model" => "Company"),
    // ),
    // 'Vehicle' => array(
    //   'className' => 'Vehicle',
    //   'foreignKey' => 'entity_id',
    //   'conditions' => array("Audit.model" => "Vehicle"),
    // ),
    // 'Tag' => array(
    //   'className' => 'Tag',
    //   'foreignKey' => 'entity_id',
    //   'conditions' => array("Audit.model" => "Tag"),
    // ),
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

}
?>
