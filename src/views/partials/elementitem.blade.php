@foreach($items as $element)
	<li class="dl-item" data-id="{{$element->id}}">

		<div class="dl-handle">
			
			{{Tool::unChecked($element->is_valid)}}
			{{$element->label}}

		</div>

		<a href="{{route('element.settings', array('pid' => $pid, 'eid' => $element->id))}}"{{active($element->id, $eid)}}>
			<i class="icon-chevron-left"></i>
		</a>

	</li>
@endforeach