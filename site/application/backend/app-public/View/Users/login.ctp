<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?php echo __('Please enter your username and password'); ?>
        </legend>
        <?php echo $this->Form->input('username', array('class' => 'form-control', 'div' => array('class' => 'form-group'),));
        echo $this->Form->input('password', array('class' => 'form-control', 'div' => array('class' => 'form-group'),));
    ?>
    </fieldset>
<?php echo $this->Form->end(array(
	'label' => 'Login',
	'div' => array('class' => 'form-group'),
	'class' => 'btn btn-default'
)); ?>
</div>