<?php

$shareable_url = Configure::read('BASE_URL') . '/shareables/p/' . $prediction_id;

$persona['Persona']['shareable_url'] = $shareable_url;

echo $this->AjaxResponse->package($persona);