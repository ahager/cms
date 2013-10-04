<?php

/**
 * Instantiate CustomValidator class
 */
Validator::resolver(function($translator, $data, $rules, $messages)
{
	return new Pongo\Cms\Support\Validators\PongoValidator($translator, $data, $rules, $messages);
});