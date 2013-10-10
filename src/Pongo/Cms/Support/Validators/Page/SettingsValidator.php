<?php namespace Pongo\Cms\Support\Validators\Page;

use Pongo\Cms\Support\Validators\BaseValidator;

class SettingsValidator extends BaseValidator {	

	/**
	 * Validation rules and messages
	 */
	public function __construct($page_id)
	{		
		parent::__construct();
		
		static::$rules = array(
			'name' 			=> 'required|uniqueName:page,' . $page_id,
			'slug_last'  	=> 'required|is_slug',
			'slug_full'		=> 'unique_slug:' . $page_id
		);

		static::$messages = array(
			'required' 		=> t('validation.errors.required'),
			'is_slug' 		=> t('validation.errors.is_slug'),
			'unique_name'	=> t('validation.errors.unique_name'),
			'unique_slug'	=> t('validation.errors.unique_slug'),
		);
	}
	
}