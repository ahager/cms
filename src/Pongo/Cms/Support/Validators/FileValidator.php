<?php namespace Pongo\Cms\Support\Validators;

use Pongo\Cms\Support\Validators\BaseValidator;

class FileValidator extends BaseValidator {

	/**
	 * Validation rules
	 * 
	 * @var array static
	 */
	public static $rules = array(
		"file_name" 	=> "unique_file",
		"file_size"		=> "file_size",
		"file_mimes"	=> "file_mimes"
	);

	/**
	 * Auto set mimes and max upload size
	 */
	public function __construct($input)
	{
		$this->input = $this->makeFileArray($input);

		static::$messages = array(
			'unique_file' 	=> t('validation.errors.unique_file'),
			'file_size' 	=> t('validation.errors.file_size'),
			'file_mimes' 	=> t('validation.errors.file_mimes'),
		);
	}

	/**
	 * Transform file Obj in file Array for validation
	 * 
	 * @param  object $input
	 * @return array
	 */
	protected function makeFileArray($input)
	{
		$file_name = $input->getClientOriginalName();

		$file_arr = array();

		$file_arr['file_name'] = \Tool::formatFile($file_name);
		$file_arr['file_size'] = $input->getSize();
		$file_arr['file_mimes'] = \Tool::fileExtension($file_name);

		return $file_arr;
	}
	
}