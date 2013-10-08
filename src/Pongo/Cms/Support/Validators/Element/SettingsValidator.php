<?php namespace Pongo\Cms\Support\Validators\Element;

use Pongo\Cms\Support\Validators\BaseValidator;

class SettingsValidator extends BaseValidator {

	/**
	 * Validation rules
	 * 
	 * @var array
	 */
	public static $rules = array(
		'label'			=> 'required',
		'name' 			=> 'required|alpha_dash',
	);

	/**
	 * Validation messages
	 */
	public function __construct() {
		
		parent::__construct();
		
		static::$messages = array(
			'required' => t('validation.errors.required'),
			'alpha_dash' => t('validation.errors.alpha_dash'),
		);
	}
	
}