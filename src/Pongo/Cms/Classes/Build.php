<?php namespace Pongo\Cms\Classes;

use ExpressiveDate;

use Pongo\Cms\Support\Validators\GenericValidator as GenericValidator;

class Build {

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
		$item_view = \Render::view('partials.forms.dates.date');
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
		$item_view = \Render::view('partials.forms.dates.datetime');
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
	 * Build an input fields list to put inside a form
	 * 
	 * @param  array $input_form
	 * @param  string $label_ns
	 * @return blade view
	 */
	public function formFields($input_form, $label_ns)
	{
		$form_view = '';

		foreach ($input_form as $name => $option) {
			$field_view = \Render::view('partials.forms.fielditem');

			$field_view['name'] 	= $name;
			$field_view['form'] 	= $option['form'];
			$field_view['label'] 	= array_key_exists('label', $option) ? $option['label'] : $label_ns . '.' . $name;
			$field_view['validate'] = array_key_exists('validate', $option) ? $option['validate'] : null;

			$form_view .= $field_view . "\n";
		}

		return $form_view;
	}

	/**
	 * Build an input field
	 * 
	 * @return [type] [description]
	 */
	public function inputField($form, $name, $attributes = array(), $value = null)
	{
		if(method_exists(app('form'), $form)) {

			return \Form::$form($name, $value, $attributes);

		} else {

			return $this->customField($form, $name, $attributes, $value);
		}
	}

	/**
	 * Write validdations rules hidden field
	 * 
	 * @param  string $name
	 * @param  string $validation_rules
	 * @return string
	 */
	public function validateField($name, $validation_rules = null)
	{
		if(!is_null($validation_rules)) {

			return \Form::hidden("valid[$name]", $validation_rules) . "\n";
		}
	}

	/**
	 * Validate an auto-build form
	 * 
	 * @return array variables 
	 */
	public function validForm()
	{
		$input = \Input::all();

		if(is_array($input['valid'])) {

			$v = new GenericValidator($input['valid']);

			if(! $v->passes()) return json_encode($v->formatErrors());
		}

		return $input;
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