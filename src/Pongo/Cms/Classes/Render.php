<?php namespace Pongo\Cms\Classes;

use Pongo\Cms\Support\Repositories\PageRepositoryInterface as Page;
use Pongo\Cms\Support\Repositories\RoleRepositoryInterface as Role;

use Asset, HTML, Pongo, Theme, Tool, View;

class Render {
	
	/**
	 * Asset base path
	 * 
	 * @var string
	 */
	private $asset_path = 'packages/pongocms/cms/';

	/**
	 * Asset Development base path
	 * 
	 * @var string
	 */
	private $development_path = 'dev/app/';

	/**
	 * Render constructor
	 */
	public function __construct(Page $page, Role $role)
	{
		$this->page = $page;
		$this->role = $role;
	}

	/**
	 * Asset shortcut
	 * 
	 * @param  string $source Asset path
	 * @param  array  $attributes
	 * @return string         Asset path
	 */
	public function asset($source = null, $attributes = array())
	{		
		if ( ! is_null($source)) {

			$type = (pathinfo($source, PATHINFO_EXTENSION) == 'css') ? 'style' : 'script';

			$path = env('local') ? $this->development_path : $this->asset_path;

			return HTML::$type($path . $source, $attributes);
		} 
	}

	/**
	 * Append asset to wrapper
	 * 
	 * @param  string $container  Container name
	 * @param  string $name       Asset name
	 * @param  string $source     Asset source
	 * @param  string $dependency Asset dependency (comes after)
	 * @return string             Print out the asset
	 */
	public function assetAdd($container = 'default', $name = 'asset', $source = '', $dependency = null)
	{
		$path = env('local')  ? $this->development_path : $this->asset_path;

		return Asset::container($container)->add($name, $path . $source, $dependency);
	}

	/**
	 * Bootstrap virtual asset
	 * 
	 * @param  string $source
	 * @return string
	 */
	public function bootJs($source)
	{
		return HTML::script($source);
	}

	/**
	 * Asset container wrapper for scripts
	 * 
	 * @param  string $name Container name
	 * @return string       Asset string
	 */
	public function scripts($name = 'default')
	{
		return Asset::container($name)->scripts();
	}

	/**
	 * Asset container wrapper for styles
	 * 
	 * @param  string $name Container name
	 * @return string       Asset string
	 */
	public function styles($name = 'default')
	{
		return Asset::container($name)->styles();
	}

	/**
	 * Get class name
	 * 
	 * @return string Name of the class
	 */
	public function className()
	{
		return get_class($this);
	}

	/**
	 * Render element form
	 * 
	 * @param  int $page_id     active page id
	 * @return string           page item view
	 */
	public function elementForm($page_id)
	{
		$items = $this->page->getPageElements($page_id);

		$item_view = $this->view('partials.items.elementform');
		$item_view['items'] 	= $items;
		$item_view['page_id'] 	= $page_id;
		
		return $item_view;
	}

	/**
	 * Create element list by page_id
	 * 
	 * @param  int $page_id    page id
	 * @param  int $element_id    element id
	 * @return string      element item view
	 */
	public function elementList($page_id, $element_id = 0)
	{
		$items = $this->page->getPageElements($page_id);

		$item_view = $this->view('partials.items.elementitem');
		$item_view['items'] 		= $items;
		$item_view['element_id'] 	= $element_id;

		return $item_view;
	}

	/**
	 * Create file list by page_id
	 * 
	 * @param  int     $page_id    page id
	 * @param  string  $action     insert | edit
	 * @return string              file item view
	 */
	public function fileList($page_id, $action = 'edit')
	{
		$items = $this->page->getPageFiles($page_id);

		$item_view = $this->view('partials.items.fileitem');
		$item_view['items']		= $items;
		$item_view['action']	= $action;

		return $item_view;
	}

	/**
	 * Render a cleaned and formatted layout preview
	 * 
	 * @param  string $header
	 * @param  string $layout
	 * @param  string $footer
	 * @return string
	 */
	public function layoutPreview($header, $layout, $footer)
	{
		$layout_view = Theme::view('layouts.' . $layout);

		$layout_zones = Theme::layout($layout);

		foreach ($layout_zones as $zone => $name) {

			$layout_view[$zone] = st('settings.layout.' . $layout . '.' . $zone, $name);
		}

		$layout_view = strip_tags($layout_view, '<div>');

		$attrib_to_remove = array('class', 'id', 'rel');

		foreach ($attrib_to_remove as $attrib) {
			
			$attrib_values = Tool::getAllAttributes($attrib, $layout_view);

			if(!empty($attrib_values)) {

				foreach ($attrib_values as $value) {

					if(substr($value, 0, 4) != 'col-')
						$layout_view = str_replace(' '.$attrib.'="'.$value.'"', '', $layout_view);
				}
			}
		}

		$view = $this->view('partials.previews.layout');
		$view['header'] = st('settings.header.' . $header, Theme::config('header.' . $header));
		$view['layout'] = $layout_view;
		$view['footer'] = st('settings.footer.' . $footer, Theme::config('footer.' . $footer));

		return $view;
	}

	/**
	 * Create marker list
	 * 
	 * @return string
	 */
	public function markerList()
	{
		$items = Pongo::markers();

		$item_view = $this->view('partials.items.markeritem');
		$item_view['items'] = $items;

		return $item_view;
	}

	/**
	 * Render page form
	 * 
	 * @param  int $parent_id 	pages's parent id
	 * @param  string $lang 	available languages
	 * @param  int $page_id     active page id
	 * @return string           page item view
	 */
	public function pageForm($parent_id, $lang, $page_id = 0)
	{
		$items = $this->page->getPageList($parent_id, $lang);

		$item_view = $this->view('partials.items.pageform');
		$item_view['items'] 	= $items;
		$item_view['page_id'] 	= $page_id;
		$item_view['parent_id'] = $parent_id;

		return $item_view;
	}

	/**
	 * Render page list recursively
	 * 
	 * @param  int $parent_id 	pages's parent id
	 * @param  string $lang 	available languages
	 * @param  int $page_id     active page id
	 * @return string           page item view
	 */
	public function pageList($parent_id, $lang, $page_id = 0, $partial = 'pageitem')
	{
		$items = $this->page->getPageList($parent_id, $lang);

		$item_view = $this->view('partials.items.' . $partial);
		$item_view['items'] 	= $items;
		$item_view['page_id'] 	= $page_id;
		$item_view['parent_id'] = $parent_id;
		$item_view['partial'] 	= $partial;

		return $item_view;
	}

	/**
	 * Create role list
	 * 
	 * @param  int $role_id
	 * @return string
	 */
	public function roleList($role_id)
	{
		$items = $this->role->getRoles();

		$item_view = $this->view('partials.items.roleitem');
		$item_view['items'] 	= $items;
		$item_view['role_id'] 	= $role_id;

		return $item_view;
	}

	/**
	 * Render PongoCMS main menu
	 * Based on config/system.php sections array
	 *
	 * @param  array $sections
	 * @return void
	 */
	public function sectionMenu($sections = array())
	{
		$menu_view = $this->view('partials.items.menuitem');
		$menu_view['sections'] 	= (!empty($sections)) ? $sections : Pongo::system('sections');

		return $menu_view;
	}

	/**
	 * View::make a Pongo view
	 * 
	 * @param  string $name View location
	 * @param  array  $data Array of data
	 * @return string       View content
	 */
	public function view($name, array $data = array())
	{		
		// Point to cms views
		$view_name = 'cms::' . $name;

		// Set to 'default' view if view not found
		if ( ! View::exists($view_name)) {

			$view_name_arr = explode('.', $view_name);
			$view_name = str_replace(end($view_name_arr), 'default', $view_name);
		}

		return View::make($view_name, $data);
	}
	
}