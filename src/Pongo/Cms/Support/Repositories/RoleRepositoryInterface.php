<?php namespace Pongo\Cms\Support\Repositories;

interface RoleRepositoryInterface {

	public function createRole($role_arr);

	public function deleteRole($role);

	public function deleteRoleUsers($role);

	public function getRole($role_id);

	public function getRoles();

	public function getRolesByLevel();

	public function orderBy($field, $order);

	public function saveRole($role);
	
}