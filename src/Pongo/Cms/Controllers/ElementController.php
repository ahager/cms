<?php namespace Pongo\Cms\Controllers;

use Pongo\Cms\Support\Repositories\ElementRepositoryInterface as Element;
use Pongo\Cms\Support\Repositories\PageRepositoryInterface as Page;
use Pongo\Cms\Support\Repositories\RoleRepositoryInterface as Role;

use Config, Pongo, Theme, Tool, Render, View;

class ElementController extends BaseController {

	public function __construct(Element $element, Page $page, Role $role)
	{
		parent::__construct();

		$this->beforeFilter('pongo.auth');

		$this->element = $element;
		$this->page = $page;
		$this->role = $role;
	}

	public function deletedElement()
	{
		return Render::view('sections.element.deleted');
	}

	/**
	 * Show element settings page
	 * 
	 * @param  int $pid   page id
	 * @param  int $eid   element id
	 * @return string     view page
	 */
	public function settingsElement($pid, $eid)
	{
		
		// Share page id with all views
		View::share('pageid', $pid);

		$page = $this->page->getPage($pid);
		$element = $this->element->getElement($eid);

		$view = Render::view('sections.element.settings');
		$view['section'] 		= 'settings';
		$view['pid'] 			= $pid;
		$view['eid'] 			= $eid;
		$view['name']			= $element->name;
		$view['label']			= $element->label;
		$view['zones']			= Theme::zones($page->layout);
		$view['zone_selected'] 	= $element->zone;		
		$view['is_valid'] 		= $element->is_valid;

		$view['template_selected'] 	= $page->template;
		$view['header_selected'] 	= $page->header;
		$view['layout_selected'] 	= $page->layout;
		$view['footer_selected'] 	= $page->footer;

		return $view;
	}

}