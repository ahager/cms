<?php namespace Pongo\Cms\Support\Repositories;

interface PageRepositoryInterface {

	public function countPageElements($page);

	public function countPageFiles($page);

	public function createPage($page_arr);

	public function deletePage($page);

	public function deletePageElements($element);

	public function detachPageFiles($page, $file_id);

	public function getPage($page_id);

	public function getPageBySlug($slug);

	public function getPageElements($page_id);

	public function getPageFiles($page_id);

	public function getPageList($parent_id, $lang);

	public function getLangHomePage();

	public function getSubPages($page_id);

	public function resetHomePage();

	public function savePage($page);

	public function savePageFile($page, $file);

	public function savePageElement($page, $element, $order);
	
}