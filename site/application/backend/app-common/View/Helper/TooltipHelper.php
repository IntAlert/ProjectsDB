<?php
App::uses('AppHelper', 'View/Helper');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class TooltipHelper extends AppHelper {

	public $helpers = array('Html');

	function element($content) {

		return ' ' . $this->Html->tag('i', '', array(
			'class' => 'fa fa-question-circle tooltip',
			'title' => $content,
		));
		
	}

	function inline_required($content = 'This field is required', $fa_symbol = 'fa-asterisk') {

		$content = '<i class="fa ' . $fa_symbol . '"></i> ' . $content;

		return $this->Html->div('tooltip-inline-required', $content);
		
	}

}
