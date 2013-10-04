<?php namespace Pongo\Cms\Support\Repositories;

interface FileRepositoryInterface {

	public function createFile($file_arr);

	public function getFile($file_id);

	public function saveFile($file);
	
}