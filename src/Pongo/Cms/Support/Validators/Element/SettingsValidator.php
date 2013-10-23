<?php namespace Pongo\Cms\Support\Validators\Element;

use Pongo\Cms\Support\Validators\BaseValidator;

class SettingsValidator extends BaseValidator {

	/**
	 * Validation rules and messages
	 */
	public function __construct($element_id) {
		
		parent::__construct();
		
		static::$rules = array(
			'name'		=> 'required|uniqueName:element,' . $element_id,
			'attrib' 	=> 'required|alpha_dash|uniqueName:element,' . $element_id,
		);

		static::$messages = array(
			'required' 		=> t('validation.errors.required'),
			'alpha_dash' 	=> t('validation.errors.alpha_dash'),
			'unique_name'	=> t('validation.errors.unique_name'),
		);
	}
	
}