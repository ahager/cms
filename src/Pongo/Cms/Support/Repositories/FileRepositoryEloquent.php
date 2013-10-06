<?php namespace Pongo\Cms\Support\Repositories;

use Pongo\Cms\Models\File as File;

class FileRepositoryEloquent implements FileRepositoryInterface {

	public function countFilePages($file)
	{
		return $file->pages->count();
	}

	public function createFile($file_arr)
	{
		return File::create($file_arr);
	}

	public function deleteFile($file)
	{
		$file->delete();
	}

	public function getFile($file_id)
	{
		return File::find($file_id);
	}

	public function saveFile($file)
	{
		return $file->save();
	}

}