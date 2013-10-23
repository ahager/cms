{{-- */ if(!isset($role_id)) $role_id = 0; /* --}}

<div class="right-bar">

	<div class="right-body">
				
		<header>

			<h2>{{t('heading.role.bar_title')}}</h2>

			<button id="create-role" class="btn btn-primary loading">
				<i class="icon-plus-sign"></i> {{t('form.button.role')}}
			</button>

		</header>

		<div class="dl">

			<ol class="dl-list">

				{{Render::roleList($role_id)}}

			</ol>

		</div>	

	</div>

</div>