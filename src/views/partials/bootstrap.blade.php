/**
 *	PongoCMS v2
 *
 *	Pongo Namespace definition
 *
 *	Javascript Library Bootstrap
 *	ver 0.0.1
 *
 *	Fabio Fumis - pongoweb.it
 */

var Pongo = {};

Pongo.base = '{{route('cms.index')}}';
Pongo.mimes = '{{str_replace(' ', '', Config::get('cms::settings.mimes'))}}';
Pongo.max_upload_size = '{{Config::get('cms::settings.max_upload_size') * 1024000}}';
Pongo.max_upload_items = '{{Config::get('cms::settings.max_upload_items')}}';