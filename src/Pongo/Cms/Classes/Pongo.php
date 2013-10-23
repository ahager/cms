<?php namespace Pongo\Cms\Classes;

use Pongo\Cms\Support\Repositories\PageRepositoryInterface as Page;

use Alert, Config, View;

class Pongo {

	/**
	 * Pongo constructor
	 */
	public function __construct(Page $page)
	{
		$this->page = $page;
	}

	/**
	 * Create array of admin roles
	 * 
	 * @param  array  	$roles   	Roles array of object
	 * @param  boolean 	$reverse 	Reverse result array
	 * @return array           		Admin roles array
	 */
	public function adminRoles($roles, $reverse = false)
	{
		$min_access = $this->system('min_access');
		$role_access = $this->system('roles.'.$min_access);

		$admin_roles = array();

		foreach ($roles as $role) {
			if($role->level >= $role_access) {
				$admin_roles[$role->name] = $role->level;	
			}			
		}

		return $reverse ? array_reverse($admin_roles) : $admin_roles;
	}
	
	/**
	 * Check current user is a editor+ user
	 * 
	 * @param  integer $level
	 * @return bool
	 */
	public function allowedCms($level = null)
	{
		if(is_null($level)) $level = LEVEL;

		$min_access = $this->system('min_access');

		$min_level = $this->system('roles.' . $min_access);

		return ($level >= $min_level) ? true : false;
	}

	/**
	 * Get actual url segments
	 * -> full, first, last, prev
	 * 
	 * @return array
	 */
	public function getUrl()
	{
		$full_url = $_SERVER['REQUEST_URI'];

		$segments = explode('/', $full_url);

		array_shift($segments);

		$n_segments = count($segments);

		$url_arr = array();

		// full
		$url_arr['full'] = $full_url;

		// first
		$url_arr['first'] = '/' . $segments[0];

		// last
		$url_arr['last'] = '/' . $segments[$n_segments - 1];

		// prev
		$url_arr['prev'] = str_replace($url_arr['last'], '', $full_url);

		return $url_arr;
	}

	/**
	 * Check page role_level against user level
	 * 
	 * @param  int $role_level page role_level
	 * @return void
	 */
	public function grantEdit($role_level)
	{
		if(!is_int($role_level)) {

			$role = $this->system('sections.' . $role_level . '.min_access');

			$role_level = $this->system('roles.' . $role);
		}


		$blocked =  ($role_level > LEVEL) ? true : false;

		if($blocked) {

			$response = array(
				'status' 	=> 'error',
				'msg'		=> t('alert.error.not_granted')
			);

			return $response;
		} 
	}

	/**
	 * Check if a role name is a system role
	 * 
	 * @param  string  $role_name
	 * @return boolean
	 */
	public function isSystemRole($role_name)
	{
		return (array_key_exists($role_name, $this->system('roles'))) ? true : false;
	}

	/**
	 * Get markers from config markers
	 * 
	 * @return array
	 */
	public function markers()
	{
		return Config::get('cms::markers');
	}

	/**
	 * Turn off PHP memory limit
	 * 
	 * @return void
	 */
	public function memoryLimitOff()
	{
		ini_set('memory_limit', '-1');
	}
	
	/**
	 * Create a back recursive site structure of pages
	 * 
	 * @param  int     $id        page id
	 * @param  string  $field     db column to target
	 * @param  string  $separator optional separator
	 * @param  boolean $url       create a url string
	 * @param  boolean $link      make each chunk linkable to its url
	 * @param  string  $context   site or cms context
	 * @return string
	 */
	public function pageTree($id, $field = 'slug', $separator = '', $url = false, $link = false, $context = 'cms')
	{
		if($url) {
			$field = 'slug';
			$separator = '/';
		}

		$str = $this->recursivePageTree($id, $field, $separator, $url, $link, $context);

		$result =  ($url and !$link) ? url($str) : $str;

		return $result;

	}

	/**
	 * Recursive process of pageTree method
	 * 
	 * @param  int     $id        page id
	 * @param  string  $field     db column to target
	 * @param  string  $separator optional separator
	 * @param  boolean $url       create a url string
	 * @param  boolean $link      make each chunk linkable to its url
	 * @param  string  $context   site or cms context
	 * @return string
	 */
	protected function recursivePageTree($id, $field, $separator, $url, $link, $context)
	{
		$page = $this->page->getPage($id);

		if($field == 'slug') {
			
			$separator = '';

			$slug_arr = explode('/', $page->$field);

			$page_field = '/' . end($slug_arr);

		} else {

			$page_field = $page->$field;
		}

		if($context == 'cms') {

			$slug = link_to_cms('page/edit/' . $page->id, $page_field);

		} else {

			$slug = link_to($page->slug, $page_field);
		}

		if($page->parent_id == 0) {

			$str = ($link and !$url) ? $slug : $page_field;

		} else {

			if($link and !$url) {

				$str = $this->recursivePageTree($page->parent_id, $field, $separator, $url, $link, $context) . $separator . $slug;
			} else {

				$str = $this->recursivePageTree($page->parent_id, $field, $separator, $url, $link, $context) . $separator . $page_field;
			}
		}

		return $str;				  
	}

	/**
	 * Get config settings values
	 * 
	 * @param  string $key
	 * @return string
	 */
	public function settings($key)
	{
		return Config::get('cms::settings.' . $key);
	}

	/**
	 * Get config system values
	 * 
	 * @param  string $key
	 * @return string
	 */
	public function system($key)
	{
		return Config::get('cms::system.' . $key);
	}

	/**
	 * Show alert wrapper
	 * 
	 * @return string Alert message
	 */
	public function showAlert()
	{
		$format = $this->system('alert_tpl');

		foreach (Alert::all($format) as $alert) {
			return $alert;
		}
	}

	/**
	 * Share a var value with views
	 * 
	 * @param  string $var
	 * @param  mixed  $value
	 * @return void
	 */
	public function viewShare($var, $value)
	{
		return View::share($var, $value);
	}

	/**
	 * Get Class name back
	 * 
	 * @return string Name of the class
	 */
	public function className()
	{
		return get_class($this);
	}
	
}