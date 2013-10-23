<?php namespace Pongo\Cms\Support\Repositories;

use User;

class UserRepositoryEloquent implements UserRepositoryInterface {

	public function all()
	{
		return User::all();
	}

	public function find($user_id)
	{
		return User::find($user_id);
	}

	public function create($user_arr)
	{
		return User::create($input);
	}

}