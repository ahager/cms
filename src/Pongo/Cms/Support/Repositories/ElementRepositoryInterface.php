<?php namespace Pongo\Cms\Support\Repositories;

interface ElementRepositoryInterface {

	public function countElementPages($element);

	public function countElements($element, $element_id);

	public function createElement($element_arr);

	public function deleteElement($element);

	public function getElement($element_id);

	public function getElementCheck($field, $value);

	public function saveElement($element);

	public function updateElementOrder($element, $order);
	
}