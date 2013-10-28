<?php namespace Pongo\Cms\Controllers\Api;

use Pongo\Cms\Support\Repositories\UserRepositoryInterface as User;

use Pongo\Cms\Support\Validators\User\SettingsValidator as SettingsValidator;
use Pongo\Cms\Support\Validators\User\PasswordValidator as PasswordValidator;
use Pongo\Cms\Support\Validators\User\DetailsValidator as DetailsValidator;

use Access, Alert, Hash, Input, Pongo, Redirect, Session;

class UserController extends ApiController {

	/**
	 * Class constructor
	 * 
	 * @param User    $user
	 */
	public function __construct(User $user)
	{
		parent::__construct();

		$this->user = $user;
	}

	/**
	 * Create a new User
	 * 
	 * @return json object
	 */
	public function createUser()
	{
		if(Input::has('create')) {

			$user_account = Pongo::settings('user_account');

			$user_arr = array(
				'role_id'	=> $user_account['id'],
				'username' 	=> $user_account['username'],
				'email'		=> $user_account['email'],
				'password'	=> Hash::make($user_account['password']),
				'lang'		=> CMSLANG,
				'editor'	=> 0,
				'is_valid' 	=> 0
			);

			$new_user = $this->user->createUser($user_arr);

			$response = array(
				'status' 	=> 'success',
				'msg'		=> t('alert.success.user_created'),
				'id'		=> $new_user->id,
				'name'		=> $new_user->username,
				'url'		=> route('user.settings', array('user_id' => $new_user->id)),
				'cls'		=> 'new'
			);

		} else {

			$response = array(
				'status' 	=> 'error',
				'msg'		=> t('alert.error.user_created')
			);

		}

		return json_encode($response);
	}


	/**
	 * Delete a user
	 * 
	 * @return void
	 */
	public function userSettingsDelete()
	{
		if(Input::has('user_id')) {

			$user_id = Input::get('user_id');

			$user = $this->user->getUser($user_id);

			$user_level = $this->user->getUserLevel($user);

			// Check if deleting last admin user
			if($user->id == 1 and $user_level == Access::roleMaxLevel()) {

				Alert::error(t('alert.error.user_admin'))->flash();

				return Redirect::back();

			} else {

				// You can delete
				if(LEVEL >= $user_level) {
					
					$this->user->deleteUser($user);

					Alert::success(t('alert.success.user_deleted'))->flash();

					return Redirect::route('user.settings');

				} else {

					Alert::error(t('alert.error.user_deleted'))->flash();

					return Redirect::back();
				}				
			}

		} else {

			Alert::error(t('alert.error.user_deleted'))->flash();

			return Redirect::back();
		}

	}

	/**
	 * Attach user to role
	 * 
	 * @return json object
	 */
	public function userSettingsLink()
	{
		if(Input::has('user_id') and Input::has('role_id')) {

			$user_id 	= Input::get('user_id');
			$role_id 	= Input::get('role_id');

			if(Pongo::settings('admin_account.id') == $user_id) {

				$response = array(
					'status' 	=> 'error',
					'msg'		=> t('alert.error.user_admin_role')
				);

			} else {

				$user = $this->user->getUser($user_id);

				$user->role_id = $role_id;

				$this->user->saveUser($user);

				$response = array(
					'status' 	=> 'success'
				);
			}			

		} else {

			$response = array(
				'status' 	=> 'error'
			);
		}

		return json_encode($response);
	}

	/**
	 * Save user settings
	 * 
	 * @return json object
	 */
	public function userSettingsSave()
	{
		if(Input::has('user_id')) {

			$input = Input::all();

			$v = new SettingsValidator($input['user_id']);

			if($v->passes()) {

				extract($input);

				$user = $this->user->getUser($user_id);

				// Author can edit the page
				if(is_array($unauth = Access::grantEdit('access.users')))
					return json_encode($unauth);
				
				$user->username = $name;
				$user->email 	= $email;
				$user->lang 	= $lang;
				$user->editor 	= $editor;

				if($user_id == USERID) Session::put('USERNAME', $name);

				$this->user->saveUser($user);

				$response = array(
					'status' 	=> 'success',
					'msg'		=> t('alert.success.save'),
					'user'	=> array(

						'id' 		=> $user_id,
						'name'		=> $name
						
					)
				);

			} else {

				return json_encode($v->formatErrors());

			}

		} else {

			$response = array(
				'status' 	=> 'error',
				'msg'		=> t('alert.error.save')
			);

		}

		return json_encode($response);
	}

	/**
	 * Save valid status
	 * 
	 * @return json object
	 */
	public function userSettingsValid()
	{
		if(Input::has('item_id') and Input::has('action')) {

			$user_id 	= Input::get('item_id');
			$valid 		= Input::get('action');

			$user = $this->user->getUser($user_id);

			$user->is_valid = $valid;

			$this->user->saveUser($user);

			$response = array(
				'status' 	=> 'success'
			);

		} else {

			$response = array(
				'status' 	=> 'error'
			);
		}

		return json_encode($response);
	}

	/**
	 * Save user password
	 * 
	 * @return json object
	 */
	public function userPasswordSave()
	{
		if(Input::has('user_id')) {

			$input = Input::all();

			$v = new PasswordValidator($input['user_id']);

			if($v->passes()) {

				extract($input);

				$user = $this->user->getUser($user_id);

				// Author can edit the page
				if(is_array($unauth = Access::grantEdit('access.users')))
					return json_encode($unauth);
				
				$user->password = Hash::make($password);

				$this->user->saveUser($user);

				$response = array(
					'status' 	=> 'success',
					'msg'		=> t('alert.success.save'),
					'element'	=> array(

						'id' 		=> $user_id,
						'name'		=> $name
						
					)
				);

			} else {

				return json_encode($v->formatErrors());

			}

		} else {

			$response = array(
				'status' 	=> 'error',
				'msg'		=> t('alert.error.save')
			);

		}

		return json_encode($response);
	}

}