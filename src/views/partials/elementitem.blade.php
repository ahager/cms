@foreach($items as $element)
	<li class="dl-item" data-id="{{$element->id}}">

		<div class="dl-handle">
			
			{{Tool::unChecked($element->is_valid)}}
			<span>{{$element->name}}</span>

		</div>

		<a href="{{route('element.settings', array('page_id' => $page_id, 'element_id' => $element->id))}}"{{active($element->id, $element_id)}}>
			<i class="icon-chevron-left"></i>
		</a>

	</li>
@endforeach