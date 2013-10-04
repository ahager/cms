@extends('cms::layouts.base')

@section('element-bar')
	@include('cms::partials.elementbar')
@stop

@section('option-bar')
	@include('cms::partials.options.page')
@stop

@section('subbar')
	@include('cms::partials.subbar')
@stop

@section('footer-js')
	@parent
	{{Render::asset('scripts/plugins/jquery.uploadfile.js')}}
	{{Render::asset('scripts/vm/page/files.js')}}
@stop

@section('content')
	
	<h3>{{t('heading.page.'.$section.'_title')}}</h3>

	<ul class="upload-info">
		<li>{{t('label.page.files.mimes')}}: {{Config::get('cms::settings.mimes')}}</li>
		<li>{{t('label.page.files.max_upload')}}: {{Config::get('cms::settings.max_upload_size')}} Mb</li>
	</ul>
	
	<div id="fileuploader">{{t('form.button.choose')}}</div>

@stop