<div class="form-group" rel="{{$name}}">
	<label for="{{$name}}" class="control-label">{{t('label.' . $label)}}</label>
	{{Build::inputField($form, $name, array('class' => 'form-control', 'id' => $name))}}
	{{Build::validateField($name, $validate)}}
</div>