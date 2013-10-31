<?php namespace Pongo\Cms\Support\Repositories;

use Pongo\Cms\Models\Role as Role;

class RoleRepositoryEloquent implements RoleRepositoryInterface {

	public function createRole($role_arr)
	{
		return Role::create($role_arr);
	}

	public function deleteRole($role)
	{
		return $role->delete();
	}

	public function deleteRoleUsers($role)
	{
		return $role->users()->delete();
	}

	public function getRole($role_id)
	{
		return Role::find($role_id);
	}

	public function getRoles()
	{
		return Role::where('level', '>', 0)
				   ->orderBy('level', 'desc')
				   ->orderBy('id', 'asc')
				   ->get();
	}

	public function getRolesByLevel()
	{
		return Role::where('level', '>', 0)
				   ->where('level', '<=', LEVEL)
				   ->orderBy('level', 'desc')
				   ->orderBy('id', 'asc')
				   ->get();
	}

	public function orderBy($field, $order)
	{
		return Role::orderBy($field, $order)->get();
	}

	public function saveRole($role)
	{
		return $role->save();
	}

}