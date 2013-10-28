<?php namespace Pongo\Cms\Support\Validators\User;

use Pongo\Cms\Support\Validators\BaseValidator;

class SettingsValidator extends BaseValidator {

	/**
	 * Validation rules and messages
	 */
	public function __construct($user_id) {
		
		parent::__construct();
		
		static::$rules = array(
			'name'		=> 'required|alpha_dash|max:20|unique:users,username,' . $user_id,
			'email'		=> 'required|email'
		);

		static::$messages = array(
			'alpha_dash' 	=> t('validation.errors.alpha_dash'),
			'email'			=> t('validation.errors.email'),
			'max'			=> t('validation.errors.max_username'),
			'required' 		=> t('validation.errors.required'),			
			'unique'		=> t('validation.errors.unique'),
		);
	}
	
}