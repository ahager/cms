<?php namespace Pongo\Cms\Controllers\Api;

use Pongo\Cms\Support\Repositories\PageRepositoryInterface as Page;
use Pongo\Cms\Support\Repositories\FileRepositoryInterface as File;

use Pongo\Cms\Support\Validators\FileCreateValidator as FileCreateValidator;
use Pongo\Cms\Support\Validators\FileUploadValidator as FileUploadValidator;

use Config, Image, Input, Media;

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

	public function pageFilesCreate()
	{
		$input = Input::all();

		$pid = $input['page_id'];

		if(isset($input['file_name']) and isset($input['file_size'])) {

			$file_name = $input['file_name'];
			$file_size = $input['file_size'];
			$size_type = $input['size_type'];

			// Validate file name
			$v = new FileCreateValidator();

			if($v->passes()) {

				$folder_name = Media::getFolderName($file_name);

				$format_name = Media::formatFileName($file_name);

				$file_ext = Media::fileExtension($file_name);

				$file_size = Media::convertFileSize($file_size, $size_type);

				$http_path = Media::getFolderPublic($this->upload_path . $folder_name . $format_name);

				$file_arr = array(
					'name' 		=> $format_name,
					'original'	=> $file_name,
					'ext'		=> $file_ext,
					'size'		=> $file_size,
					'w'			=> 0,
					'h'			=> 0,
					'path'		=> $http_path,
					'is_image'	=> 0,
					'is_valid'	=> 1
				);

				// Write into db
				$new_file = $this->file->createFile($file_arr);

				$page = $this->page->getPage($pid);

				$file_page = $this->page->savePageFile($page, $new_file);

				$response = array(
					'status' 	=> 'success',
					'msg'		=> t('alert.success.file_created'),
					'counter' 	=> 'up',
					'infos'		=> array(

						'file_name' => t('form.infos.create_file', array(

							'rename' => $format_name,
							'upload' => $http_path

						)),

					),

					'item'		=> array(

						'file_id' 		=> $new_file->id,
						'file_name' 	=> Media::formatFileName($file_arr['name'], false),
						'thumb' 		=> Image::showThumb($new_file->path),
						'ext' 			=> $file_arr['ext'],
						'size'			=> Media::formatFileSize($file_arr['size']),
						'edit_url'		=> route('file.edit', array('id' => $new_file->id)),
						'delete_url'	=> route('api.page.files.delete', array('id' => $new_file->id))

					),

				);

			} else {

				return json_encode($v->formatErrors());
			}

		} else {

			$response = array(
				'status' 	=> 'error',
				'msg'		=> t('alert.error.create_item')
			);

		}

		return json_encode($response);
	}

	/**
	 * Detach/delete file from a page
	 * 
	 * @return json object
	 */
	public function pageFilesDelete($id)
	{

		$input = Input::all();

		$fid = $id;
		$pid = $input['page_id'];

		$force_delete = (Input::has('force_delete')) ? true : false;

		if(isset($pid)) {

			$page = $this->page->getPage($pid);

			$this->page->detachPageFiles($page, $fid);

			$file = $this->file->getFile($fid);

			$count_pages = $this->file->countFilePages($file);

			if($count_pages == 0 and $force_delete) {

				Media::deleteFile($file->name);

				$this->file->deleteFile($file);
			}

			$response = array(
				'status' 	=> 'success',
				'msg'		=> t('alert.success.item_remove'),
				'remove'	=> $fid
			);

		} else {

			$response = array(
				'status' 	=> 'error',
				'msg'		=> t('alert.error.delete_item')
			);

		}

		return json_encode($response);
	}

	/**
	 * Upload files in Pages
	 * 
	 * @return json obj
	 */
	public function pageFilesUpload()
	{
		$input = Input::all();

		$pid = $input['page_id'];

		$response = array();

		if(!empty($input['files']) and is_array($input['files'])) {

			$files = $input['files'];

			$has_errors = false;

			foreach ($files as $key => $file) {

				// Validate each file
				$v = new FileUploadValidator($file);

				if($v->passes()) {

					// Proceed with upload...					
					$file_arr = $this->saveFileAndGetArray($file, true);

					// Write into db
					$new_file = $this->file->createFile($file_arr);

					$page = $this->page->getPage($pid);

					$file_page = $this->page->savePageFile($page, $new_file);

					$response[$key]['status'] = 'success';
					$response[$key]['icon'] = 'icon-ok success';

					// Fill json data for each list element
					$response[$key]['item']['file_id'] = $new_file->id;
					$response[$key]['item']['file_name'] = Media::formatFileName($file_arr['name'], false);
					$response[$key]['item']['thumb'] = Image::showThumb($new_file->path);
					$response[$key]['item']['ext'] = $file_arr['ext'];
					$response[$key]['item']['size'] = Media::formatFileSize($file_arr['size']);
					$response[$key]['item']['edit_url'] = route('file.edit', array('id' => $new_file->id));
					$response[$key]['item']['delete_url'] = route('api.page.files.delete', array('id' => $new_file->id));


				} else {

					$response[$key] = $v->uploadErrors();

					$has_errors = true;

				}

			}

			$response['status'] = 'success';
			$response['msg'] = $has_errors ? t('alert.success.upload_comp_err') : t('alert.success.upload_completed');

		} else {

			$response = array(
				'status' 	=> 'error',
				'msg'		=> t('alert.error.upload_completed')
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
		$folder_name = Media::getFolderName($file_name);
		// upload path
		$upload_path = public_path($this->upload_path . $folder_name);

		// Format file name
		$format_name = Media::formatFileName($file_name);
		
		// Save to disk
		$file->move($upload_path, $format_name);

		// file path
		$file_path = $upload_path . $format_name;

		// http path
		$http_path = '/' . $this->upload_path . $folder_name . $format_name;
		
		if(Media::isImage($format_name)) {
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
			'name' 		=> $format_name,
			'original'	=> $file_name,
			'ext'		=> $file_ext,
			'size'		=> $file_size,
			'w'			=> $image_w,
			'h'			=> $image_h,
			'path'		=> $http_path,
			'is_image'	=> $is_image,
			'is_valid'	=> 1
		);
	}

}