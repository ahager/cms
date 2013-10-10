@extends('cms::layouts.base')

@section('element-bar')
	@include('cms::partials.rightbars.elementbar')
@stop

@section('option-bar')
	@include('cms::partials.options.element')
@stop

@section('subbar')
	@include('cms::partials.subbars.element')
@stop

@section('footer-js')
	@parent
	{{Render::asset('scripts/vm/element/settings.js')}}
@stop

@section('content')
	
	<h3>{{t('heading.page.'.$section.'_title')}}</h3>

	<form role="form" id="element-content-form">
		<input type="hidden" name="page_id" value="{{$pid}}">
		<input type="hidden" name="element_id" value="{{$eid}}">


		<div class="form-buttons">
			{{link_to_route('api.element.settings.save', t('form.button.save'), null, array('class' => 'btn btn-success btn-block api'))}}

		</div>
	</form>

@stop



@section('modal')



@stop