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
		
		<a href="{{route('page.settings', array('page_id' => $item->id))}}"{{active($item->id, $page_id)}}>
			
			<i class="icon-chevron-right"></i>

		</a>

		@if($item->id > 0)

			{{Render::pageList($item->id, $item->lang, $page_id, $partial)}}

		@endif

	</li>

	@if($parent_id > 0)
	</ol>
	@endif

@endforeach