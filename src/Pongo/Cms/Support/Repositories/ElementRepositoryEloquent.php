<?php namespace Pongo\Cms\Support\Repositories;

use Pongo\Cms\Models\Element as Element;

class ElementRepositoryEloquent implements ElementRepositoryInterface {

	public function attachIfNotElementPage($element, $page_id, $order)
	{
		if( ! $element->pages->contains($page_id))
			return $element->pages()->attach($page_id, array('order_id' => $order));
	}

	public function countElementPages($element)
	{
		return $element->pages->count();
	}

	public function countElements($element, $element_id)
	{
		return $element->pivot->where('element_id', $element_id)->count();
	}

	public function createElement($element_arr)
	{
		return Element::create($element_arr);
	}

	public function deleteElement($element)
	{
		return $element->delete();
	}

	public function duplicateElement($element)
	{

	}

	public function getElement($element_id)
	{
		return Element::find($element_id);
	}

	public function getElementCheck($field, $value)
	{
		return Element::where('lang', LANG)
				   	  ->where($field, $value)
				   	  ->first();
	}

	public function saveElement($element)
	{
		return $element->save();
	}
	
	public function updateElementOrder($element, $order)
	{
		return $element->pivot->update(array('order_id' => $order));
	}

}