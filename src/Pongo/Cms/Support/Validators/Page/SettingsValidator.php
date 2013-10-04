<?php namespace Pongo\Cms\Support\Validators\Page;

use Pongo\Cms\Support\Validators\BaseValidator;

class SettingsValidator extends BaseValidator {

	/**
	 * Validation rules
	 * 
	 * @var array
	 */
	public static $rules = array(
		'name' 			=> 'required',
		'slug_last'  	=> 'required|alpha_dash',
	);

	/**
	 * Validation messages
	 */
	public function __construct() {
		
		parent::__construct();
		
		static::$messages = array(
			'required' => t('validation.messages.required')
		);
	}
	
}