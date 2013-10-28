<?php namespace Pongo\Cms\Support\Validators;

use Pongo\Cms\Support\Repositories\PageRepositoryInterface as Page;
use Pongo\Cms\Support\Repositories\ElementRepositoryInterface as Element;

use Illuminate\Validation\Validator as LaravelValidator;

use Access, Config, Media, Pongo, Str;

class PongoValidator extends LaravelValidator {

	/**
	 * Page repository
	 * 
	 * @var object instance
	 */
	private $page;

	/**
	 * Element repository
	 * 
	 * @var object instance
	 */
	private $element;

	/**
	 * Class constructor
	 * @param Page    $page 
	 * @param Element $element
	 */
	public function __construct($translator, $data, $rules, $messages, Page $page, Element $element)
	{
		$this->translator = $translator;
		$this->data = $data;
		$this->rules = $this->explodeRules($rules);
		$this->customMessages = $messages;

		$this->page = $page;
		$this->element = $element;
	}

	public function validateFileSize($attribute, $value, $parameters)
	{
		$max_size = Pongo::settings('max_upload_size') * 1024000;

		return ($value < $max_size) ? true : false;
	}

	public function validateExtMimes($attribute, $value, $parameters)
	{
		$ext = $value;

		$mimes = str_replace(' ', '', Pongo::settings('mimes'));

		$mimes_arr = explode(',', $mimes);

		return (in_array($ext, $mimes_arr)) ? true : false;
	}

	public function validateFileMimes($attribute, $value, $parameters)
	{
		$ext = Media::fileExtension($value);

		$mimes = str_replace(' ', '', Pongo::settings('mimes'));

		$mimes_arr = explode(',', $mimes);

		return (in_array($ext, $mimes_arr)) ? true : false;
	}

	public function validateIsSlug($attribute, $value, $parameters)
	{
		return $value == Str::slug($value);
	}

	public function validateNotImage($attribute, $value, $parameters)
	{
		return Media::isFile($value);
	}

	public function validateSystemRole($attribute, $value, $parameters)
	{		
		$role_id = $parameters[0];

		return !Access::isSystemRole($role_id);
	}

	public function validateUniqueFile($attribute, $value, $parameters)
	{
		$file_name = Media::formatFileName($value);

		$upload_path = Pongo::settings('upload_path');

		$folder_name = Media::getFolderName($file_name);

		$file_path = public_path($upload_path . $folder_name . $file_name);
		
		return (file_exists($file_path)) ? false : true;
	}

	public function validateUniqueName($attribute, $value, $parameters)
	{
		$check 	= $parameters[0];		
		$id 	= $parameters[1];
		$field 	= strtolower($attribute);
		$value 	= strtolower($value);

		switch ($check) {
			case 'page':
				$item = $this->page->getPageCheck($field, $value);
				break;
			case 'element':
				$item = $this->element->getElementCheck($field, $value);
				break;
			default:
				return false;
				break;
		}

		return (!is_empty($item) and $id != $item->id) ? false : true;
	}

	public function validateUniqueSlug($attribute, $value, $parameters)
	{
		$page_id = $parameters[0];

		$page = $this->page->getPagePath($value);

		return (!is_empty($page) and $page_id != $page->id) ? false : true;
	}

}