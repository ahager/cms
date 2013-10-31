<?php namespace Pongo\Cms\Controllers;

use Pongo\Cms\Support\Repositories\FileRepositoryInterface as File;

use Pongo, Render;

class FileController extends BaseController {

	/**
	 * Class constructor
	 */
	public function __construct()
	{

	}

	public function uploadFile()
	{
		$view = Render::view('sections.file.upload');
		$view['section']	= 'files';
		$view['page_id'] 	= $page_id;
		$view['name'] 		= $page->name;

		$view['n_files'] 	= $n_files;
		$view['page_link'] 	= '';

		return $view;
	}

}