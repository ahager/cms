<?php namespace Pongo\Cms\Controllers;

class LoginController extends BaseController {
	
	/**
	 * Class constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->beforeFilter('pongo.guest');
	}

	/**
	 * Login form
	 * 
	 * @return void
	 */
	public function index()
	{
		return \Render::view('sections.login.login');
	}

	/**
	 * Login a user
	 * 
	 * @return void
	 */
	public function login()
	{
		$credentials = array(
			'username' 	=> \Input::get('username'),
			'password' 	=> \Input::get('password'),
			'is_valid'	=> 1
		);

		if (\Auth::attempt($credentials)) {

			if(\Access::allowedCms(\Auth::user()->role->level)) {

				$this->setConstants();

				\Alert::info(t('alert.info.welcome', array('user' => \Input::get('username'))))->flash();

				return \Redirect::route('dashboard');

			} else {

				\Auth::logout();

				\Alert::error(t('alert.error.unauthorized'))->flash();

				return \Redirect::route('login.index');
			}

		} else {

			\Alert::error(t('alert.error.login'))->flash();

			return \Redirect::route('login.index');
		}
	}

	/**
	 * Set constants values on login
	 *
	 * @return void
	 */
	protected function setConstants()
	{
		Session::put('USERID', \Auth::user()->id);
		Session::put('USERNAME', \Auth::user()->username);
		Session::put('EMAIL', \Auth::user()->email);
		Session::put('ROLEID', \Auth::user()->role->id);
		Session::put('ROLENAME', \Auth::user()->role->name);
		Session::put('LEVEL', \Auth::user()->role->level);
		Session::put('LANG', \Auth::user()->lang);
		Session::put('CMSLANG', \Auth::user()->lang);
		Session::put('EDITOR', \Auth::user()->editor);
	}

}