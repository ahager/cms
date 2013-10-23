<?php namespace Pongo\Cms\Support\Repositories;

interface UserRepositoryInterface {

	public function all();

	public function find($user_id);

	public function create($user_arr);
	
}