<?php namespace Pongo\Cms\Support\Validators\User;

use Pongo\Cms\Support\Validators\BaseValidator;

class DetailsValidator extends BaseValidator {

	/**
	 * Validation rules and messages
	 */
	public function __construct($user_id) {
		
		parent::__construct();
		
		/*static::$rules = array(
			'password'		=> 'required|confirmed'
		);

		static::$messages = array(
			'confirmed' 		=> t('validation.errors.confirmed'),
		);*/
	}
	
}