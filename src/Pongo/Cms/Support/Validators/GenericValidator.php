<?php namespace Pongo\Cms\Support\Validators;

use Pongo\Cms\Support\Validators\BaseValidator;

class GenericValidator extends BaseValidator {

	/**
	 * Validation rules and messages
	 */
	public function __construct($rules) {
		
		parent::__construct();

		static::$rules = $this->buildRules($rules);
		
		static::$messages = $this->buildMessages($rules);

		/*static::$rules = array(
			'name'		=> 'required|alpha_dash|max:20|unique:users,username,' . $user_id,
			'email'		=> 'required|email'
		);*/

		/*static::$messages = array(
			'alpha_dash' 	=> t('validation.errors.alpha_dash'),
			'email'			=> t('validation.errors.email'),
			'max'			=> t('validation.errors.max_username'),
			'required' 		=> t('validation.errors.required'),			
			'unique'		=> t('validation.errors.unique'),
		);*/
	}

	/**
	 * Build rule array
	 * 
	 * @param  array $rules
	 * @return array
	 */
	protected function buildRules($rules)
	{
		$rules_arr = array();

		foreach($rules as $name => $rule) {

			$rules_arr[$name] = $rule;
		}

		return $rules_arr;
	}

	/**
	 * Build error messages array
	 * 
	 * @return array
	 */
	protected function buildMessages($rules)
	{
		$rule_msg = array();

		foreach($rules as $rule) {

			$rules_arr = explode('|', $rule);

			foreach ($rules_arr as $rule_name) {
				
				$name = str_replace(strstr($rule_name, ':'), '', $rule_name);

				$rule_msg[$name] = t('validation.errors.' . $name);
			}
		}

		return $rule_msg;
	}
	
}