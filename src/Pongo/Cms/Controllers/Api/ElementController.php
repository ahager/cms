<?php namespace Pongo\Cms\Controllers\Api;

use Pongo\Cms\Support\Repositories\PageRepositoryInterface as Page;
use Pongo\Cms\Support\Repositories\ElementRepositoryInterface as Element;

use Pongo\Cms\Support\Validators\Element\SettingsValidator as SettingsValidator;

use Alert, Input, Pongo, Redirect;

class ElementController extends ApiController {

	/**
	 * Default order
	 * 
	 * @var int
	 */
	private $default_order;

	/**
	 * Class constructor
	 * @param Page    $page 
	 * @param Element $element
	 */
	public function __construct(Page $page, Element $element)
	{
		parent::__construct();

		$this->page = $page;
		$this->element = $element;

		$this->default_order = Pongo::system('default_order');
	}

	public function createElement()
	{
		if(Input::has('lang') and Input::has('pid')) {

			$pid = Input::get('pid');

			$lang = Input::get('lang');

			$label = t('template.element.new', array(), $lang);

			$element_arr = array(
				'lang' => $lang,
				'name' => snake_case($label),
				'label' => $label,
				'text' => '',
				'zone' => 'ZONE1',
				'author_id' => USERID,
				'is_valid' => 0
			);

			$element = $this->element->createElement($element_arr);

			$page = $this->page->getPage($pid);

			$new_element = $this->page->savePageElement($page, $element, $this->default_order);

			$response = array(
				'status' 	=> 'success',
				'msg'		=> t('alert.success.element_created'),
				'id'		=> $new_element->id,
				'label'		=> $new_element->label,
				'url'		=> route('element.settings', array('pid' => $pid, 'eid' => $new_element->id)),
				'cls'		=> 'new',
				'counter'	=> 'up'
			);

		} else {

			$response = array(
				'status' 	=> 'error',
				'msg'		=> t('alert.error.element_created')
			);

		}

		return json_encode($response);
	}

	/**
	 * Detach an element from a page
	 * Delete element if no other page refers to it
	 * 
	 * @return void
	 */
	public function elementSettingsDelete()
	{
		if(Input::has('page_id') and Input::has('element_id')) {

			$pid = Input::get('page_id');
			$eid = Input::get('element_id');

			$page = $this->page->getPage($pid);

			$this->page->detachPageElements($page, $eid);

			$element = $this->element->getElement($eid);

			$count_elements = $this->element->countElementPages($element);

			Alert::success(t('alert.success.element_deleted'))->flash();

			if($count_elements == 0) {

				$this->element->deleteElement($element);

				return Redirect::route('element.deleted');
			}			

			return Redirect::route('page.settings', array('id' => $pid));

		} else {

			Alert::error(t('alert.error.delete_item'))->flash();

			return Redirect::route('element.settings', array('pid' => $pid, 'eid' => $eid));
		}

	}

	/**
	 * Save element settings
	 * 
	 * @return json object
	 */
	public function elementSettingsSave()
	{
		if(Input::has('element_id') and Input::has('page_id')) {

			$input = Input::all();

			$v = new SettingsValidator($input['element_id']);

			if($v->passes()) {

				extract($input);

				$page = $this->page->getPage($page_id);

				// Author can edit the page
				if(is_array($unauth = Pongo::grantEdit($page->role_level)))
					return json_encode($unauth);

				$element = $this->element->getElement($element_id);

				$valid = isset($is_valid) ? 1 : 0;

				$element->name 		= $name;
				$element->label 	= $label;
				$element->zone 		= $zone;
				$element->is_valid 	= $valid;

				$this->element->saveElement($element);

				$response = array(
					'status' 	=> 'success',
					'msg'		=> t('alert.success.save'),
					'element'	=> array(

						'id'		=> $element_id,
						'label'		=> $label,
						'checked'	=> $valid

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
	 * Reorder page elements
	 * 
	 * @return string json encoded object
	 */
	public function orderElements()
	{
		if(Input::has('elements') and Input::has('pid')) {

			$mod_elements = json_decode(Input::get('elements'), true);

			$pid = Input::get('pid');

			$elements = $this->page->getPageElements($pid);

			// Reorder order id

			foreach ($mod_elements as $key => $el) {

				foreach ($elements as $element) {

					if($element->id == $el['id']) 
						$this->element->updateElementOrder($element, $key + 1);
				}				
			}

			$response = array(
				'status' 	=> 'success',
				'msg'		=> t('alert.success.element_order')
			);

		} else {

			$response = array(
				'status' 	=> 'error',
				'msg'		=> t('alert.error.element_order')
			);

		}		

		return json_encode($response);
	}

}