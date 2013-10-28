<?php namespace Pongo\Cms\Support\Repositories;

use Pongo\Cms\Models\User as User;

class UserRepositoryEloquent implements UserRepositoryInterface {

	public function createUser($user_arr)
	{
		return User::create($user_arr);
	}

	public function deleteUser($user)
	{
		return $user->delete();
	}

	public function getUser($user_id)
	{
		return User::find($user_id);
	}

	public function getUserLevel($user)
	{
		return $user->role->level;
	}

	public function getUsers()
	{
		return User::all();
	}

	public function saveUser($user)
	{
		return $user->save();
	}

}