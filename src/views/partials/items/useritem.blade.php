@foreach($items as $user)
	<li class="dd-item" data-id="{{$user->id}}">
		
		<a href="{{route('user.settings', array('user_id' => $user->id))}}"{{active($user->id, $user_id)}}>
			<i class="icon-chevron-left"></i>
		</a>

		<div class="dd-handle">

			<span>{{$user->username}}</span>

			<label>
				<input type="checkbox" value="{{$user->id}}" {{Tool::isChecked($user->is_valid, 1)}} class="is_valid">
			</label>

		</div>

	</li>
@endforeach