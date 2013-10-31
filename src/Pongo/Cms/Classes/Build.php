<?php namespace Pongo\Cms\Classes;

use ExpressiveDate, Form, Render;

class Build {

	/**
	 * Render constructor
	 */
	public function __construct()
	{

	}

	/**
	 * Manage custom fields
	 * 
	 * @param  string $form
	 * @param  string $name
	 * @param  array  $attributes
	 * @param  string $value
	 * @return string
	 */
	public function customField($form, $name, $attributes = array(), $value = null)
	{
		switch ($form) {
			case 'date':
				return $this->dateField($name, $attributes);
				break;

			case 'datetime':
				return $this->dateTimeField($name, $attributes);
				break;
			
			default:
				return 'No method ' . $form;
				break;
		}
	}

	/**
	 * Create date form control
	 * 
	 * @param  string  $name        
	 * @param  array   $attributes
	 * @param  integer $year_past
	 * @param  integer $year_future
	 * @return string
	 */
	public function dateField($name, $attributes = array(), $year_past = 99, $year_future = 1)
	{
		$item_view = Render::view('partials.dates.date');
		$item_view['name']			= $name;
		$item_view['date']			= new ExpressiveDate;
		$item_view['day_name']		= 'day';
		$item_view['month_name']	= 'month';
		$item_view['year_name']		= 'year';
		$item_view['year_past']		= $year_past;
		$item_view['year_future'] 	= $year_future;

		return $item_view;
	}

	/**
	 * Create date time form control
	 * 
	 * @param  string  $name        
	 * @param  array   $attributes
	 * @param  integer $year_past
	 * @param  integer $year_future
	 * @return string
	 */
	public function dateTimeField($name, $attributes = array(), $year_past = 99, $year_future = 1)
	{
		$item_view = Render::view('partials.dates.datetime');
		$item_view['name']			= $name;
		$item_view['date']			= new ExpressiveDate;
		$item_view['day_name']		= 'day';
		$item_view['month_name']	= 'month';
		$item_view['year_name']		= 'year';
		$item_view['hh_name']		= 'hh';
		$item_view['mm_name']		= 'mm';
		$item_view['year_past']		= $year_past;
		$item_view['year_future'] 	= $year_future;

		return $item_view;
	}

	/**
	 * Build an input field
	 * 
	 * @return [type] [description]
	 */
	public function inputField($form, $name, $attributes = array(), $value = null)
	{
		if(method_exists(app('form'), $form)) {

			return Form::$form($name, $value, $attributes);

		} else {

			return $this->customField($form, $name, $attributes, $value);
		}
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