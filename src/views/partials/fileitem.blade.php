@foreach($items as $file)
	<li class="dl-item" data-id="{{$file->id}}">

		<div class="dl-handle">
			
			<a href="{{route('file.edit', array('fid' => $file->id))}}">
				{{Image::showThumb($file->path)}}</a>
			<span>{{Media::formatFileName($file->name, false)}}</span>
			<div>
				<span class="ext">{{$file->ext}}</span>
				<span class="size">{{Media::formatFileSize($file->size)}}</span>
			</div>

		</div>

		<a href="{{route('file.edit', array('fid' => $file->id))}}" class="edit">
			<i class="icon-chevron-left"></i>
		</a>

		<a href="{{route('api.page.files.delete', array('fid' => $file->id))}}" class="remove confirm">
			<i class="icon-remove"></i>
		</a>

	</li>
@endforeach