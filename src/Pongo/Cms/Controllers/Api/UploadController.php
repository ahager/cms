<?php namespace Pongo\Cms\Controllers\Api;

use Pongo\Cms\Support\Repositories\PageRepositoryInterface as Page;
use Pongo\Cms\Support\Repositories\FileRepositoryInterface as File;

use Pongo\Cms\Support\Validators\FileValidator as FileValidator;

use Config, Image, Input, Tool;

class UploadController extends ApiController {

	/**
	 * Upload path
	 * 
	 * @var string
	 */
	private $upload_path;

	/**
	 * Class constructor
	 * 
	 * @param File $file
	 */
	public function __construct(Page $page, File $file)
	{
		parent::__construct();

		$this->page = $page;
		$this->file = $file;
		$this->upload_path = Config::get('cms::settings.upload_path');
	}

	/**
	 * Upload files in Pages
	 * 
	 * @return json obj
	 */
	public function pageFilesUpload()
	{
		$input = Input::all();

		// D($input, true);

		$pid = $input['page_id'];

		$response = array();

		if(!empty($input['files']) and is_array($input['files'])) {

			$files = $input['files'];

			foreach ($files as $key => $file) {

				// Validate each file
				$v = new FileValidator($file);

				if($v->passes()) {

					// Proceed with upload...					
					$file_arr = $this->saveFileAndGetArray($file, true);

					// Write into db
					$new_file = $this->file->createFile($file_arr);

					$page = $this->page->getPage($pid);

					$file_page = $this->page->savePageFile($page, $new_file);

					$response[$key]['status'] = 'success';
					$response[$key]['icon'] = 'icon-ok success';

				} else {

					$response[$key] = $v->uploadErrors();

				}

			}

		} else {

			$response = array(
				'status' 	=> 'error',
				'msg'		=> t('alert.error.page_order')
			);

		}

		return json_encode($response);
	}

	/**
	 * Save file on disk and get file array to save into DB
	 * 
	 * @param  object 	$file
	 * @param  bool 	$create_thumb
	 * @return array
	 */
	protected function saveFileAndGetArray($file, $create_thumb = false)
	{
		// file name
		$file_name 	= $file->getClientOriginalName();
		// file size
		$file_size 	= $file->getSize();
		// file extension
		$file_ext 	= $file->getClientOriginalExtension();
		// dir type
		$folder_name = Tool::getFolderName($file_name);
		// upload path
		$upload_path = public_path($this->upload_path . $folder_name);

		// Format file name
		$format_name = Tool::formatFile($file_name);
		
		// Save to disk
		$file->move($upload_path, $format_name);

		// file path
		$file_path = $upload_path . $format_name;

		// http path
		$http_path = '/' . $this->upload_path . $folder_name . $format_name;
		
		if(Tool::isImage($format_name)) {
			$image 		= Image::get($file_path);
			$image_w 	= $image->getWidth();
			$image_h 	= $image->getHeight();
			$is_image 	= 1;

			// Create thumb?
			if($create_thumb) Image::createThumb($image, $format_name, 'cms');

		} else {
			$image_w 	= 0;
			$image_h 	= 0;
			$is_image 	= 0;
		}					

		return array(
			'name' 	=> $format_name,
			'ext'	=> $file_ext,
			'size'	=> $file_size,
			'w'		=> $image_w,
			'h'		=> $image_h,
			'path'	=> $http_path,
			'is_image'	=> $is_image,
			'is_valid'	=> 1
		);
	}

}