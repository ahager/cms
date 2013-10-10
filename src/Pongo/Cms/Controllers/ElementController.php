<?php namespace Pongo\Cms\Controllers;

use Pongo\Cms\Support\Repositories\ElementRepositoryInterface as Element;
use Pongo\Cms\Support\Repositories\PageRepositoryInterface as Page;
use Pongo\Cms\Support\Repositories\RoleRepositoryInterface as Role;

use HTML, Pongo, Theme, Tool, Render;

class ElementController extends BaseController {

	/**
	 * Class constructor
	 * 
	 * @param Element $element
	 * @param Page    $page
	 * @param Role    $role
	 */
	public function __construct(Element $element, Page $page, Role $role)
	{
		parent::__construct();

		$this->beforeFilter('pongo.auth');

		$this->element = $element;
		$this->page = $page;
		$this->role = $role;
	}

	/**
	 * Show element deleted
	 * 
	 * @return string
	 */
	public function deletedElement()
	{
		return Render::view('sections.element.deleted');
	}

	/**
	 * Show element content page
	 *
	 * @param  int $pid   page id
	 * @param  int $eid   element id
	 * @return string     view page
	 */
	public function contentElement($pid, $eid)
	{
		Pongo::viewShare('pid', $pid);
		Pongo::viewShare('eid', $eid);

		$page = $this->page->getPage($pid);
		$element = $this->element->getElement($eid);

		// Count element per page
		$n_elements = $this->page->countPageElements($page);

		$view = Render::view('sections.element.content');
		$view['section'] 		= 'content';
		$view['pid'] 			= $pid;
		$view['eid'] 			= $eid;
		$view['name']			= $element->name;

		$view['page_link']		= HTML::link(route('page.settings', array('pid' => $page->id)), $page->name);

		$view['n_elements'] 	= $n_elements;

		return $view;
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
		
		Pongo::viewShare('pid', $pid);
		Pongo::viewShare('eid', $eid);

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

		$view['page_link']		= HTML::link(route('page.settings', array('pid' => $page->id)), $page->name);

		$view['template_selected'] 	= $page->template;
		$view['header_selected'] 	= $page->header;
		$view['layout_selected'] 	= $page->layout;
		$view['footer_selected'] 	= $page->footer;

		return $view;
	}

}