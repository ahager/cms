@foreach($items as $key => $role)

	<li class="dd-item" data-id="{{$role->id}}">
		
		<div class="dd-handle">

			{{$role->name}}

			<label>
				<input type="checkbox" value="{{$role->id}}" {{Tool::isChecked($role->id, $role_id)}} class="user_role">
			</label>

		</div>

	</li>

@endforeach