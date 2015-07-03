<?php


App::uses('FormHelper', 'View/Helper');
class CustomFormHelper extends FormHelper {
   
	// asmt
	public $helpers = array('Html', 'Tooltip');


	public function _inputLabel($fieldName, $label, $options) {
		$labelAttributes = $this->domId(array(), 'for');
		$idKey = null;
		if ($options['type'] === 'date' || $options['type'] === 'datetime') {
			$firstInput = 'M';
			if (array_key_exists('dateFormat', $options) &&
				($options['dateFormat'] === null || $options['dateFormat'] === 'NONE')
			) {
				$firstInput = 'H';
			} elseif (!empty($options['dateFormat'])) {
				$firstInput = substr($options['dateFormat'], 0, 1);
			}
			switch ($firstInput) {
				case 'D':
					$idKey = 'day';
					$labelAttributes['for'] .= 'Day';
					break;
				case 'Y':
					$idKey = 'year';
					$labelAttributes['for'] .= 'Year';
					break;
				case 'M':
					$idKey = 'month';
					$labelAttributes['for'] .= 'Month';
					break;
				case 'H':
					$idKey = 'hour';
					$labelAttributes['for'] .= 'Hour';
			}
		}
		if ($options['type'] === 'time') {
			$labelAttributes['for'] .= 'Hour';
			$idKey = 'hour';
		}
		if (isset($idKey) && isset($options['id']) && isset($options['id'][$idKey])) {
			$labelAttributes['for'] = $options['id'][$idKey];
		}

		if (is_array($label)) {
			$labelText = null;
			if (isset($label['text'])) {
				$labelText = $label['text'];
				unset($label['text']);
			}
			$labelAttributes = array_merge($labelAttributes, $label);
		} else {
			$labelText = $label;
		}

		if (isset($options['id']) && is_string($options['id'])) {
			$labelAttributes = array_merge($labelAttributes, array('for' => $options['id']));
		}

		// asmt3 
		if(isset($options['tooltip']) && is_string($options['tooltip'])) {
			$labelAttributes['tooltip'] = $options['tooltip'];
		}
		
		return $this->label($fieldName, $labelText, $labelAttributes);
	}


	public function label($fieldName = null, $text = null, $options = array()) {
		if ($fieldName === null) {
			$fieldName = implode('.', $this->entity());
		}

		if ($text === null) {
			if (strpos($fieldName, '.') !== false) {
				$fieldElements = explode('.', $fieldName);
				$text = array_pop($fieldElements);
			} else {
				$text = $fieldName;
			}
			if (substr($text, -3) === '_id') {
				$text = substr($text, 0, -3);
			}
			$text = __(Inflector::humanize(Inflector::underscore($text)));
		}

		if (is_string($options)) {
			$options = array('class' => $options);
		}

		if (isset($options['for'])) {
			$labelFor = $options['for'];
			unset($options['for']);
		} else {
			$labelFor = $this->domId($fieldName);
		}

		// asmt3
		if(isset($options['tooltip']) && is_string($options['tooltip'])) {
			$text .= $this->Tooltip->element($options['tooltip']);
		}

		return $this->Html->useTag('label', $labelFor, $options, $text);
	}


	public function radio($fieldName, $options = array(), $attributes = array()) {
		$attributes['options'] = $options;
		$attributes = $this->_initInputField($fieldName, $attributes);
		unset($attributes['options']);

		$showEmpty = $this->_extractOption('empty', $attributes);
		if ($showEmpty) {
			$showEmpty = ($showEmpty === true) ? __d('cake', 'empty') : $showEmpty;
			$options = array('' => $showEmpty) + $options;
		}
		unset($attributes['empty']);

		$legend = false;
		if (isset($attributes['legend'])) {
			$legend = $attributes['legend'];
			unset($attributes['legend']);
		} elseif (count($options) > 1) {
			$legend = __(Inflector::humanize($this->field()));
		}

		if($legend && isset($attributes['tooltip']) && is_string($attributes['tooltip'])) {
			$legend .= $this->Tooltip->element($attributes['tooltip']);
		}

		$label = true;
		if (isset($attributes['label'])) {
			$label = $attributes['label'];
			unset($attributes['label']);
		}

		$separator = null;
		if (isset($attributes['separator'])) {
			$separator = $attributes['separator'];
			unset($attributes['separator']);
		}

		$between = null;
		if (isset($attributes['between'])) {
			$between = $attributes['between'];
			unset($attributes['between']);
		}

		$value = null;
		if (isset($attributes['value'])) {
			$value = $attributes['value'];
		} else {
			$value = $this->value($fieldName);
		}

		$disabled = array();
		if (isset($attributes['disabled'])) {
			$disabled = $attributes['disabled'];
		}

		$out = array();

		$hiddenField = isset($attributes['hiddenField']) ? $attributes['hiddenField'] : true;
		unset($attributes['hiddenField']);

		if (isset($value) && is_bool($value)) {
			$value = $value ? 1 : 0;
		}

		$this->_domIdSuffixes = array();
		foreach ($options as $optValue => $optTitle) {
			$optionsHere = array('value' => $optValue, 'disabled' => false);

			if (isset($value) && strval($optValue) === strval($value)) {
				$optionsHere['checked'] = 'checked';
			}
			$isNumeric = is_numeric($optValue);
			if ($disabled && (!is_array($disabled) || in_array((string)$optValue, $disabled, !$isNumeric))) {
				$optionsHere['disabled'] = true;
			}
			$tagName = $attributes['id'] . $this->domIdSuffix($optValue);

			if ($label) {
				$labelOpts = is_array($label) ? $label : array();
				$labelOpts += array('for' => $tagName);
				$optTitle = $this->label($tagName, $optTitle, $labelOpts);
			}

			if (is_array($between)) {
				$optTitle .= array_shift($between);
			}
			$allOptions = array_merge($attributes, $optionsHere);
			$out[] = $this->Html->useTag('radio', $attributes['name'], $tagName,
				array_diff_key($allOptions, array('name' => null, 'type' => null, 'id' => null)),
				$optTitle
			);
		}
		$hidden = null;

		if ($hiddenField) {
			if (!isset($value) || $value === '') {
				$hidden = $this->hidden($fieldName, array(
					'form' => isset($attributes['form']) ? $attributes['form'] : null,
					'id' => $attributes['id'] . '_',
					'value' => '',
					'name' => $attributes['name']
				));
			}
		}
		$out = $hidden . implode($separator, $out);

		if (is_array($between)) {
			$between = '';
		}
		if ($legend) {
			$out = $this->Html->useTag('fieldset', '', $this->Html->useTag('legend', $legend) . $between . $out);
		}
		return $out;
	}




}