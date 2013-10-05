<?php namespace Pongo\Cms\Classes;

use Config;

class Tool {

	/**
	 * Create array of admin roles
	 * 
	 * @param  array  	$roles   	Roles array of object
	 * @param  boolean 	$reverse 	Reverse result array
	 * @return array           		Admin roles array
	 */
	public function adminRoles($roles, $reverse = false)
	{
		$min_access = Config::get('cms::system.min_access');
		$role_access = Config::get('cms::system.roles.'.$min_access);

		$admin_roles = array();

		foreach ($roles as $role) {
			if($role->level >= $role_access) {
				$admin_roles[$role->name] = $role->level;	
			}			
		}

		return $reverse ? array_reverse($admin_roles) : $admin_roles;
	}

	/**
	 * Get file extension
	 * 
	 * @param  string $file
	 * @return string
	 */
	public function fileExtension($filename)
	{
		$temp = explode('.', $filename);
		return end($temp);
	}

	/**
	 * Format a file name
	 * 
	 * @param  string $file
	 * @return string
	 */
	public function formatFile($filename)
	{
		$temp = explode('.', $filename);
		$extension = end($temp);
		$temp_name = $temp[0];

		return \Str::slug($temp_name, '_') . '.' . $extension;
	}

	/**
	 * Format a thumb file name
	 *
	 * $thumb must be one of the site::theme.thumb keys
	 * 
	 * @param  string $file
	 * @param  string $thumb
	 * @return string
	 */
	public function formatFileThumb($filename, $thumb = 'cms')
	{
		$temp = explode('.', $filename);
		$extension = end($temp);
		$temp_name = $temp[0];

		return \Str::slug($temp_name, '_') . '_' . $thumb . '.' . $extension;
	}

	/**
	 * Format a number to Kb or Mb size
	 * 
	 * @param  int $size
	 * @param  string $type
	 * @return int
	 */
	public function formatFileSize($size, $type = 'kb')
	{
		switch ($type) {
			case 'kb':
				return $size * 1024;
				break;
			case 'mb':
				return $size * 1024000;
				break;
			default:
				return $size * 1024;
				break;
		}
	}

	/**
	 * Get folder name where to copy uploaded file
	 * 
	 * @param  string $filename
	 * @return string
	 */
	public function getFolderName($filename)
	{
		if($this->isImage($filename)) {

			return 'img/';

		} else {

			return $this->fileExtension($filename) . '/';
		}
	}

	/**
	 * Get public folder http path
	 * 
	 * @param $path
	 * @return string
	 */
	public function getFolderPublic($path = '')
	{
		$path_arr = explode('/', public_path());

		return '/' . end($path_arr).($path ? '/'.$path : $path);;
	}

	/**
	 * Print out class=active if true
	 * 
	 * @param  string $var 
	 * @param  string $fix 
	 * @return bool
	 */
	public function isActive($var, $fix)
	{
		return ($var == $fix) ? ' class="active"' : '';
	}

	/**
	 * Print out checked=checked if true
	 * 
	 * @param  string $var 
	 * @param  string $fix 
	 * @return bool
	 */
	public function isChecked($var, $fix)
	{
		return ($var == $fix) ? ' checked="checked"' : '';
	}

	/**
	 * Check if file is not an Image
	 * 
	 * @param  string  $filename
	 * @return boolean
	 */
	public function isFile($filename)
	{
		return ($this->isImage($filename)) ? false : true;
	}

	/**
	 * Check if file is a Image
	 * 
	 * @param  string  $filename
	 * @return boolean
	 */
	public function isImage($filename)
	{
		$images = array('bmp', 'gif', 'jpg', 'jpeg', 'png');

		$ext = $this->fileExtension($filename);

		return (in_array($ext, $images)) ? true : false;
	}

	/**
	 * Print out selected=selected if true
	 * 
	 * @param  string $var 
	 * @param  string $fix 
	 * @return bool
	 */
	public function isSelected($var, $fix)
	{
		return ($var == $fix) ? ' selected="selected"' : '';
	}

	/**
	 * Print icon homepage
	 * 
	 * @param  string $is_valid
	 * @return string
	 */
	public function isHome($is_home)
	{
		return ($is_home) ? '<i class="icon-home" style="display: visible"></i>' : '<i class="icon-home" style="display: none"></i>';
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
	 * Print icon checked/unchecked
	 * 
	 * @param  string $is_valid
	 * @return string
	 */
	public function unChecked($is_valid)
	{
		return ($is_valid) ? '<i class="icon-check check"></i>' : '<i class="icon-unchecked check"></i>';
	}

	/**
	 * Reduce slug chunks
	 * 
	 * @param  string  $url  
	 * @param  integer $back Chunks to subtract
	 * @return string        Partial slug
	 */
	public function slugBack($url, $back = 0)
	{
		if($back > 0) {

			$segments = explode('/', $url);

			if(is_array($segments)) {

				$n_segments = count($segments) - $back;

				$tmp_url = '';

				for ($i=1; $i < $n_segments; $i++) {

					$tmp_url .= '/' . $segments[$i];
				}

				return $tmp_url;
			}

		}

		return $url;
	}
	
	/**
	 * Slice a slug in chunks
	 * 
	 * @param  string  $url
	 * @param  integer $back
	 * @return mixed	back = 1 string || back > 1 array
	 */
	public function slugSlice($url, $back = 0)
	{
		if($back > 0) {

			$segments = array_reverse(explode('/', $url));

			array_pop($segments);

			if(is_array($segments)) {

				if($back == 1) {

					return $segments[0];
				}

				return $segments;
			}

		}

		return $url;
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