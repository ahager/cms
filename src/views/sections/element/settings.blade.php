@extends('cms::layouts.base')

@section('element-bar')
	@include('cms::partials.rightbars.layoutbar')
@stop

@section('option-bar')
	@include('cms::partials.options.element')
@stop

@section('subbar')
	@include('cms::partials.subbars.layout')
@stop

@section('footer-js')
	@parent
	{{Render::asset('scripts/vm/element/settings.js')}}
@stop

@section('content')
	
	<h3>{{t('heading.page.'.$section.'_title')}}</h3>

	<form role="form" id="element-settings-form">
		<input type="hidden" name="page_id" value="{{$pid}}">
		<input type="hidden" name="element_id" value="{{$eid}}">

		<div class="form-group" rel="label">
			<label for="label" class="control-label">{{t('label.element.settings.label')}}</label>
			<input type="text" name="label" class="form-control" id="label" value="{{$label}}" data-bind="value: itemName, valueUpdate: 'afterkeydown'">
		</div>
		<div class="form-group" rel="name">
			<label for="name" class="control-label">{{t('label.element.settings.name')}}</label>
			<div class="input-group">
  				<span class="input-group-addon">#</span>
				<input type="text" name="name" class="form-control" id="name" value="{{$name}}" data-bind="value: elementName">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default button" data-bind="click: createId">{{t('label.element.settings.create_id')}}</button>
				</span>
			</div>
		</div>
		<div class="form-group">
			<label for="zone" class="control-label">{{t('label.element.settings.zone')}}</label>
			<select name="zone" class="form-control" id="zone">
				@foreach($zones as $zone => $name)
				<option value="{{$zone}}"{{selected($zone, $zone_selected)}}>{{st('settings.layout.' . $zone, $name)}}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<div class="checkbox">
				<label class="control-label">
					<input type="checkbox" name="is_valid" value="1"{{checked($is_valid, 1)}} data-bind="checked: elementState">
					<span class="label" data-bind="css: elementStatus">
						<span data-bind="text: elementStatusLabel"></span>
					</span>
				</label>
			</div>
		</div>
		<div class="form-buttons">
			{{link_to_route('api.element.settings.save', t('form.button.save'), null, array('class' => 'btn btn-success btn-block api'))}}
			<a href="#clone-modal" class="btn btn-primary btn-block confirm">{{t('form.button.clone')}}</a>
			<a href="#delete-modal" class="btn btn-danger btn-block pull-right confirm">{{t('form.button.delete')}}</a>
		</div>
	</form>

@stop



@section('modal')

	<div class="modal-box" id="delete-modal">
		<button type="button" class="close close-modal">&times;</button>
		<h3>{{t('modal.title.remove_element')}}</h3>
		<form action="{{route('api.element.settings.delete')}}" method="POST">
			<input type="hidden" name="page_id" value="{{$pid}}">
			<input type="hidden" name="element_id" value="{{$eid}}">
			<div class="form-buttons">
				<button type="submit" class="btn btn-danger">{{t('form.button.ok')}}</button>
				<button type="button" class="btn btn-default button close-modal">{{t('form.button.cancel')}}</button>
			</div>
		</form>

	</div>

@stop