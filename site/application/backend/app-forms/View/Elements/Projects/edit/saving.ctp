
<div id="dialog-project-save">
  <p><br><i class="fa fa-spinner fa-spin"></i><br><br>Your project is being saved. Please don't navigate away from this page.</p>
</div>


<?php

// placed at end of doc as some scripts added by elements alter inputs
// at init
echo $this->Html->script('projects/edit.saving', array('inline' => false));
