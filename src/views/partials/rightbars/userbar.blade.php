{{-- */ if(!isset($user_id)) $user_id = 0; /* --}}
{{-- */ if(!isset($role_id)) $role_id = 0; /* --}}

<div class="right-bar">

	<div class="right-body">
		
		<ul class="multi-panel">

			<li>

				<header>

					<h2>{{t('heading.user.bar_title')}}</h2>

					<button id="create-user" class="btn btn-primary loading">
						<i class="icon-plus-sign"></i> {{t('form.button.user')}}
					</button>

				</header>

				<div class="linked-pages user-list">

					<form action="{{route('api.user.settings.valid')}}">

						<ol class="dd-list valid">

							{{Access::userList($user_id)}}

						</ol>

					</form>

				</div>

			</li>

			<li>
				
				<header>

					<h2>{{t('heading.role.bar_title_single')}}</h2>

				</header>

				<div class="linked-pages">
					
					<form action="{{route('api.user.settings.link')}}" data-id="{{$user_id}}">

						<ol class="dd-list role-list">

							{{Access::roleList($role_id, 'userrole')}}

						</ol>

					</form>

				</div>

			</li>

		</ul>

	</div>

	<footer>
			
		<ul class="toolbar">
			<li class="active"><a href="#"><i class="icon-user"></i></a></li>
			<li><a href="#"><i class="icon-group"></i></a></li>
		</ul>

	</footer>

</div>