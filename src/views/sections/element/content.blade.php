@extends('cms::layouts.base')

@section('element-bar')
	@include('cms::partials.rightbars.contentbar')
@stop

@section('option-bar')
	@include('cms::partials.options.element')
@stop

@section('subbar')
	@include('cms::partials.subbars.element')
@stop

@section('header-js')
	@parent
	{{Render::asset('styles/magnific-popup.css')}}
@stop

@section('footer-js')
	@parent
	{{Render::asset('scripts/plugins/jquery.uploadfile.js')}}
	{{Render::asset('scripts/plugins/magnific-popup.js')}}
	{{Render::asset('scripts/tinymce/tinymce.min.js')}}
	{{Render::asset('scripts/sections/element.js')}}
	{{Render::asset('scripts/vm/element/content.js')}}
@stop

@section('content')
	
	<h3>{{t('heading.element.'.$section.'_title')}}</h3>

	<form role="form" id="element-content-form">
		<input type="hidden" name="page_id" value="{{$page_id}}">
		<input type="hidden" name="element_id" value="{{$element_id}}">
		<input type="hidden" id="name" value="{{$name}}">
		
		<div class="form-group">
			<textarea name="text" class="form-control" id="text">{{$text}}</textarea>
		</div>

		<div class="form-buttons">
			{{link_to_route('api.element.content.save', t('form.button.save'), null, array('class' => 'btn btn-success btn-block api pull-right'))}}

		</div>
	</form>

@stop



@section('modal')



@stop