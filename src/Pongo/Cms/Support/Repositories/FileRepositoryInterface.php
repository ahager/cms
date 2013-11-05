<?php namespace Pongo\Cms\Support\Repositories;

interface FileRepositoryInterface {

	public function countFilePages($file);

	public function createFile($file_arr);

	public function deleteFile($file);

	public function getFile($file_id);

	public function getFiles();

	public function saveFile($file);
	
}