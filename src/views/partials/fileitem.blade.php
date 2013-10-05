@foreach($items as $file)
	<li class="dl-item" data-id="{{$file->id}}">

		<div class="dl-handle">
			
			{{$file->name}}

			{{HTML::image($file->path)}}

		</div>

		<a href="{{--route('file.edit', array('id' => $file->id))--}}">
			<i class="icon-chevron-left"></i>
		</a>

	</li>
@endforeach