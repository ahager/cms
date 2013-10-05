<?php namespace Pongo\Cms\Support\Repositories;

use Pongo\Cms\Models\File as File;

class FileRepositoryEloquent implements FileRepositoryInterface {

	public function createFile($file_arr)
	{
		return File::create($file_arr);
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