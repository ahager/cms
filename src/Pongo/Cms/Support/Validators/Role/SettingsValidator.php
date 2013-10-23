<?php namespace Pongo\Cms\Support\Validators\Role;

use Pongo\Cms\Support\Validators\BaseValidator;

class SettingsValidator extends BaseValidator {

	/**
	 * Validation rules and messages
	 */
	public function __construct($role_id) {
		
		parent::__construct();
		
		static::$rules = array(
			'name'		=> 'required|systemRole|unique:roles,name,' . $role_id,
		);

		static::$messages = array(
			'required' 		=> t('validation.errors.required'),
			'system_role'	=> t('validation.errors.system_role'),
			'unique'		=> t('validation.errors.unique'),
		);
	}
	
}