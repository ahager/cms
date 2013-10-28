<?php namespace Pongo\Cms\Support\Repositories;

interface UserRepositoryInterface {

	public function createUser($user_arr);

	public function deleteUser($user);

	public function getUser($user_id);

	public function getUserLevel($user);

	public function getUsers();

	public function saveUser($user);
	
}