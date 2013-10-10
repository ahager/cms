<?php

// Set controllers path shortcut

$pongoControllers = 'Pongo\Cms\Controllers\\';
$apiControllers = 'Pongo\Cms\Controllers\Api\\';

// Back-end routes

Route::group(Config::get('cms::routes.cms_group_routes'), function() use ($pongoControllers)
{

	// JS BOOTSTRAP
	Route::get('bootstrap.js', array('uses' => $pongoControllers.'BaseController@bootstrap', 'as' => 'js.bootstrap'));

	// LOGIN
	Route::get('/', array('uses' => $pongoControllers.'LoginController@index', 'as' => 'cms.index'));
	Route::get('login', array('uses' => $pongoControllers.'LoginController@index', 'as' => 'login.index'));
	Route::post('login', array('uses' => $pongoControllers.'LoginController@login', 'as' => 'post.login'));
	Route::get('logout', array('uses' => $pongoControllers.'BaseController@logout', 'as' => 'logout'));

	// DASHBOARD
	Route::get('dashboard', array('uses' => $pongoControllers.'DashboardController@showDashboard', 'as' => 'dashboard'));

	// PAGE
	Route::get('page/settings/{pid}', array('uses' => $pongoControllers.'PageController@settingsPage', 'as' => 'page.settings'));
	Route::get('page/layout/{pid}', array('uses' => $pongoControllers.'PageController@layoutPage', 'as' => 'page.layout'));
	Route::get('page/seo/{pid}', array('uses' => $pongoControllers.'PageController@seoPage', 'as' => 'page.seo'));
	Route::get('page/files/{pid}', array('uses' => $pongoControllers.'PageController@filesPage', 'as' => 'page.files'));
	Route::get('page/link/{pid}', array('uses' => $pongoControllers.'PageController@linkPage', 'as' => 'page.link'));
	Route::get('page/deleted', array('uses' => $pongoControllers.'PageController@deletedPage', 'as' => 'page.deleted'));

	// ELEMENT
	Route::get('element/settings/{pid}/{eid}', array('uses' => $pongoControllers.'ElementController@settingsElement', 'as' => 'element.settings'));
	Route::get('element/content/{pid}/{eid}', array('uses' => $pongoControllers.'ElementController@contentElement', 'as' => 'element.content'));
	Route::get('element/files/{pid}/{eid}', array('uses' => $pongoControllers.'ElementController@filesElement', 'as' => 'element.files'));
	Route::get('element/deleted', array('uses' => $pongoControllers.'ElementController@deletedElement', 'as' => 'element.deleted'));

	// FILE
	Route::get('file/edit/{fid}', array('uses' => $pongoControllers.'FileController@editFile', 'as' => 'file.edit'));

});

// API calls

Route::group(Config::get('cms::routes.api_group_routes'), function() use ($apiControllers)
{

	// SAVE
	Route::any('save', array('uses' => $apiControllers.'SaveController@save', 'as' => 'api.save'));
	Route::any('error', array('uses' => $apiControllers.'SaveController@error', 'as' => 'api.error'));
	Route::any('expire', array('uses' => $apiControllers.'SaveController@expire', 'as' => 'api.expire'));

	// PAGE
	Route::any('page/create', array('uses' => $apiControllers.'PageController@createPage', 'as' => 'api.page.create'));
	Route::any('page/lang', array('uses' => $apiControllers.'PageController@changeLang', 'as' => 'api.page.lang'));
	Route::any('page/order', array('uses' => $apiControllers.'PageController@orderPages', 'as' => 'api.page.order'));

		// SETTINGS
		Route::any('page/settings/save', array('uses' => $apiControllers.'PageController@pageSettingsSave', 'as' => 'api.page.settings.save'));
		Route::any('page/settings/clone', array('uses' => $apiControllers.'PageController@pageSettingsClone', 'as' => 'api.page.settings.clone'));
		Route::any('page/settings/delete', array('uses' => $apiControllers.'PageController@pageSettingsDelete', 'as' => 'api.page.settings.delete'));
	
		// LAYOUT
		Route::any('page/layout/save', array('uses' => $apiControllers.'PageController@pageLayoutSave', 'as' => 'api.page.layout.save'));
		Route::any('page/layout/change', array('uses' => $apiControllers.'PageController@pageLayoutChange', 'as' => 'api.page.layout.change'));

		// SEO
		Route::any('page/seo/save', array('uses' => $apiControllers.'PageController@pageSeoSave', 'as' => 'api.page.seo.save'));

		// FILES
		Route::any('page/files/upload', array('uses' => $apiControllers.'UploadController@pageFilesUpload', 'as' => 'api.page.files.upload'));
		Route::any('page/files/create', array('uses' => $apiControllers.'UploadController@pageFilesCreate', 'as' => 'api.page.files.create'));
		Route::any('page/files/delete/{fid}', array('uses' => $apiControllers.'UploadController@pageFilesDelete', 'as' => 'api.page.files.delete'));

	// ELEMENT
	Route::any('element/order', array('uses' => $apiControllers.'ElementController@orderElements', 'as' => 'api.element.order'));
	Route::any('element/create', array('uses' => $apiControllers.'ElementController@createElement', 'as' => 'api.element.create'));

		// SETTINGS
		Route::any('element/settings/save', array('uses' => $apiControllers.'ElementController@elementSettingsSave', 'as' => 'api.element.settings.save'));
		Route::any('element/settings/clone', array('uses' => $apiControllers.'ElementController@elementSettingsClone', 'as' => 'api.element.settings.clone'));
		Route::any('element/settings/delete', array('uses' => $apiControllers.'ElementController@elementSettingsDelete', 'as' => 'api.element.settings.delete'));
	


});


// Front-end routes

Route::group(Config::get('cms::routes.site_group_routes'), function() use ($pongoControllers)
{
	
	Route::any('{all}', array('uses' => $pongoControllers.'SiteController@renderPage', 'as' => 'catchall'))->where('all', '.*');

});

// Handles 404 - Not found

App::missing(function($exception)
{
	return Response::view('cms::errors.404', array('error' => $exception), 404);
});
