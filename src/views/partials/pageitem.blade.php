@foreach($items as $key => $item)

	@if($parent_id > 0)
	<ol class="dd-list">
	@endif

	<li class="dd-item" data-id="{{$item->id}}">
		
		<div class="dd-handle">

			{{Tool::isHome($item->is_home)}}
			
			{{Tool::unChecked($item->is_valid)}}

			<span>{{$item->name}}</span>

		</div>
		
		<a href="{{route('page.settings', array('pid' => $item->id))}}"{{active($item->id, $pid)}}>
			
			<i class="icon-chevron-right"></i>

		</a>

		@if($item->id > 0)

			{{Render::pageList($item->id, $item->lang, $pid)}}

		@endif

	</li>

	@if($parent_id > 0)
	</ol>
	@endif

@endforeach