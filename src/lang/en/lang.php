<?php

return array(

	'alert' => array(

		'info' => array(
			
			'logout'		=> 'You have been logged out',
			'page_lang'		=> 'Editing content in :lang',
			'welcome'		=> 'Welcome back, :user',

		),

		'error' => array(

			'clone_element'			=> 'Unable to clone element',
			'clone_page'			=> 'Unable to clone page',
			'create_item'			=> 'Unable to create this item',
			'delete_item'			=> 'Unable to delete this item',
			'element_created'		=> 'Unable to create element',
			'element_order'			=> 'Unable to save order',
			'input_validator'		=> 'Check form fields',
			'login' 				=> 'Access denied, please retry',
			'not_granted'			=> 'Editing not allowed',
			'page_cant_delete'		=> 'Unable to delete this page',
			'page_created'			=> 'Unable to create page',
			'page_has_elements'		=> 'This page still contains elements',
			'page_has_subpages'		=> 'This page still contains subpages',
			'page_lang'				=> 'Unable to change language',
			'page_order'			=> 'Unable to save page order',
			'save'					=> 'Unable to save',			
			'session_exp'			=> 'Session expired, please login',
			'unauthorized'			=> 'Unauthorized access, please login',
			'upload_completed'		=> 'Unable to upload files',
			
		),

		'success' => array(

			'element_cloned'	=> 'Element successfully cloned',
			'element_created'	=> 'New element created',
			'element_deleted'	=> 'The element has been deleted',
			'element_order'		=> 'New element order saved',
			'file_created'		=> 'File entry successfully saved',
			'item_remove'		=> 'This item has been removed',
			'page_cloned'		=> 'Page successfully cloned',
			'page_created'		=> 'New page created',
			'page_deleted'		=> 'The page has been deleted',
			'page_order'		=> 'New page order saved',
			'save'				=> 'Successfully saved',
			'upload_completed'	=> 'Files successfully uploaded',
			'upload_comp_err'	=> 'Files uploaded with some errors',

		),

	),

	'form' => array(

		'button' => array(

			'cancel'		=> 'Cancel',
			'choose'		=> 'Select files',
			'clone'			=> 'Clone',
			'create'		=> 'Create',
			'element' 		=> 'Element',
			'delete'		=> 'Delete',
			'ok'			=> 'Ok',
			'page' 			=> 'Page',
			'save'			=> 'Save',
			'upload'		=> 'Start upload',
			'upload_files'	=> 'Upload files',

		),

		'infos' => array(

			'create_file' => 'Please rename this file to ":rename" and upload it to ":upload" using a FTP connection'

		),

		'select' => array(

			'admin' 	=> 'Admin',
			'blogs'		=> 'Blog posts',
			'editor' 	=> 'Editor',
			'guest' 	=> 'Guest',
			'manager' 	=> 'Manager',
			'pages'		=> 'Other pages',
			'products'	=> 'Products',
			'user' 		=> 'User',

		),

	),

	'heading' => array(

		'element' => array(

			'bar_title' 	=> 'Page elements',
			'content_title' => 'Content',

		),

		'file' => array(

			'bar_title' => 'Page files',

		),

		'layout' => array(

			'bar_title' => 'Content layout',

		),

		'marker' => array(

			'bar_title' => 'Markers',

		),

		'option' => array(

			'bar_title' => 'Options',

		),

		'page' => array(

			'bar_title' 			=> 'Page manager',
			'layout_title' 			=> 'Layout',
			'seo_title'		 		=> 'Seo',
			'files_title' 			=> 'Upload Files',
			'files_create_title' 	=> 'Create Files',
			'linked_title' 			=> 'Linked pages',
			'settings_title' 		=> 'Settings',

		),

	),

	'label' => array(

		'page' => array(

			'settings' => array(

				'browse_by' 	=> 'Who can visit this?',
				'check_all_ele' => 'All page elements',
				'choose_lang'	=> 'In which language to clone this page?',
				'clone'			=> '[CLONATO]',
				'create_slug' 	=> 'Slug',
				'edit_by' 		=> 'Who can edit this?',
				'force_delete'	=> 'Delete page and detach all elements',
				'may_contain'	=> 'What can contain?',
				'media_all'		=> 'All page files',
				'name' 			=> 'Page name',
				'page_include'	=> 'Include also',
				'set_hp' 		=> 'Home Page',
				'slug' 			=> 'Page slug',
				'slug_preview'	=> 'Slug preview',

			),

			'layout' => array(

				'template'		=> 'Page template',
				'header'		=> 'Page header',
				'layout'		=> 'Page layout',
				'footer'		=> 'Page footer',

			),

			'seo'	=> array(

				'title'	=> 'Titolo della pagina',
				'keyw'	=> 'Keywords della pagina',
				'descr'	=> 'Descrizione della pagina',

			),

			'files'	=> array(

				'custom_upload'	=> 'Create an empty file entry',
				'file_name'		=> 'File name',
				'file_size'		=> 'File size',
				'force_delete'	=> 'Delete this file if not linked to any other page',
				'ftp_upload'	=> 'Upload your new file using a FTP connection',
				'max_item'		=> 'Maximum number of items at a time',
				'max_upload' 	=> 'Maximum upload size',
				'mimes' 		=> 'Allowed file formats',

			),

		),

		'element' => array(

			'settings' => array(

				'attrib'			=> 'Element ID attribute',
				'create_attrib' 	=> 'id',
				'name' 				=> 'Element name',
				'page_target'		=> 'Attach the cloned element to page',
				'self_element' 		=> 'Un-link',
				'zone' 				=> 'Where to insert this element?',

			),

		),

	),
	
	'marker' => array(

		'_api' => array(

			'file_name' => 'file name',
			'height'	=> 'height',
			'mandatory' => 'mandatory',
			'none'		=> 'no options',
			'optional'	=> 'optional',
			'width'		=> 'width',

		),

		'back' => array(

			'description' => 'Create a link to the previous page',

		),

		'image'	=> array(

			'description' => 'Render an image by its name',

		),

	),

	'modal' => array(

		'title' => array(

			'clone_element'		=> 'Clone this element?',
			'clone_page'		=> 'Clone this page?',
			'delete_page' 		=> 'Delete this page?',
			'detach_file' 		=> 'Detach file from this page?',
			'detach_element' 	=> 'Detach element from page?',

		),

	),

	'template' => array(

		'element' => array(

			'new'			=> 'New element',

		),

		'page' => array(

			'new'			=> 'New page',

		),

	),

	'validation' => array(

		'errors' => array(

			'alpha_dash'	=> 'This field may only contain letters, numbers, and dashes',
			'ext_mimes'		=> 'This file extension is not allowed',
			'integer'		=> 'This value must be an integer',
			'is_slug'		=> 'Click the button to generate a correct slug',
			'file_size'		=> 'The file size exceeds maximum allowed',
			'not_image'		=> 'This tool is not for images',
			'required' 		=> 'This field is required',
			'unique_file' 	=> 'This file name is already present',
			'unique_name' 	=> 'This name is already present in this language',
			'unique_slug' 	=> 'This slug is already present in this language',

		),

	),

);