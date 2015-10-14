<?php

// Load FB 
require_once('../../app-common/Config/bootstrap-common.php');


CakePlugin::load('CakePHPExcel', 
    array(
        'routes' => true
    )
);