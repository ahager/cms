@extends('cms::layouts.base')

@section('element-bar')
	@include('cms::partials.rightbars.filebar')
@stop

@section('option-bar')
	@include('cms::partials.options.page')
@stop

@section('subbar')
	@include('cms::partials.subbars.file')
@stop

@section('footer-js')
	@parent
	{{Render::asset('scripts/plugins/jquery.uploadfile.js')}}
	{{Render::asset('scripts/vm/page/files.js')}}
@stop

@section('content')
	
	<h3>{{t('heading.page.'.$section.'_title')}}</h3>

	<ul class="info-list">
		<li>{{t('label.page.files.mimes')}}: {{Config::get('cms::settings.mimes')}}</li>
		<li>{{t('label.page.files.max_item')}}: 20</li>
		<li>{{t('label.page.files.max_upload')}}: {{Config::get('cms::settings.max_upload_size')}} Mb</li>
	</ul>
	
	<div id="fileuploader">{{t('form.button.choose')}}</div>

	<h3>{{t('heading.page.'.$section.'_create_title')}}</h3>

	<ul class="info-list">
		<li>{{t('label.page.files.custom_upload')}}</li>
		<li>{{t('label.page.files.ftp_upload')}}</li>
	</ul>

	<form role="form" id="page-files-form">
		<input type="hidden" name="page_id" value="{{$id}}">
		<div class="form-group size" rel="file_size">
			<label for="file_size" class="control-label">{{t('label.page.files.file_size')}}</label>
			<input type="text" name="file_size" class="form-control" id="file_size">
			<select name="size_type" class="form-control" id="size_type">
				<option value="kb">Kb</option>
				<option value="mb">Mb</option>
			</select>
		</div>
		<div class="form-group" rel="file_name">
			<label for="file_name" class="control-label">{{t('label.page.files.file_name')}}</label>
			<input type="text" name="file_name" class="form-control" id="file_name">
		</div>
		<div class="form-buttons">
			{{link_to_route('api.page.files.create', t('form.button.create'), null, array('class' => 'btn btn-success btn-block api'))}}
		</div>
	</form>

@stop