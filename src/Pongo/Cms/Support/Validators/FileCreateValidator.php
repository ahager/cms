<?php namespace Pongo\Cms\Support\Validators;

use Pongo\Cms\Support\Validators\BaseValidator;

class FileCreateValidator extends BaseValidator {

	/**
	 * Validation rules
	 * 
	 * @var array static
	 */
	public static $rules = array(
		"file_size"  => "required|integer",
		"file_name"  => "required|not_image|file_mimes|unique_file"
	);

	/**
	 * Auto set mimes and max upload size
	 */
	public function __construct()
	{
		parent::__construct();

		static::$messages = array(
			'file_mimes' 	=> t('validation.errors.ext_mimes'),
			'integer' 		=> t('validation.errors.integer'),
			'not_image' 	=> t('validation.errors.not_image'),
			'required' 		=> t('validation.errors.required'),
			'unique_file' 	=> t('validation.errors.unique_file'),
		);
	}
	
}