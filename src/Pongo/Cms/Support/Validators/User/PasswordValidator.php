<?php namespace Pongo\Cms\Support\Validators\User;

use Pongo\Cms\Support\Validators\BaseValidator;

class PasswordValidator extends BaseValidator {

	/**
	 * Validation rules and messages
	 */
	public function __construct($user_id) {
		
		parent::__construct();
		
		static::$rules = array(
			'password'		=> 'required|min:8|confirmed'
		);

		static::$messages = array(
			'required' 		=> t('validation.errors.required'),
			'min'			=> t('validation.errors.min_password'),
			'confirmed' 	=> t('validation.errors.confirmed'),
		);
	}
	
}