{{-- */ if(!isset($role_id)) $role_id = 0; /* --}}
{{-- */ if(!isset($user_id)) $user_id = 0; /* --}}

<div class="right-bar">

	<div class="right-body">
		
		<ul class="multi-panel">

			<li>
				
				<header>

					<h2>{{t('heading.role.bar_title')}}</h2>

					<button id="create-role" class="btn btn-primary loading">
						<i class="icon-plus-sign"></i> {{t('form.button.role')}}
					</button>

				</header>

				<div class="dl">

					<ol class="dl-list">

						{{Access::roleList($role_id)}}

					</ol>

				</div>

			</li>
			<li>
				
				<header>

					<h2>{{t('heading.user.bar_title')}}</h2>

					<button id="create-user" class="btn btn-primary loading">
						<i class="icon-plus-sign"></i> {{t('form.button.user')}}
					</button>

				</header>

				<div class="linked-pages user-list">

					<form action="{{route('api.user.settings.valid')}}">

						<ol class="dd-list">

							{{Access::userList($user_id)}}

						</ol>

					</form>

				</div>

			</li>

		</ul>	

	</div>

	<footer>
			
		<ul class="toolbar">
			<li class="active"><a href="#"><i class="icon-group"></i></a></li>
			<li><a href="#"><i class="icon-user"></i></a></li>
		</ul>

	</footer>

</div>