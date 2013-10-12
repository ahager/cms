{{-- */ if(!isset($page_id)) $page_id = 0; /* --}}

<div class="page-bar">

	<div class="page-body">

		<header>

			<h2>{{t('heading.page.bar_title')}}</h2>

			<div class="page-controls">
				<i class="icon-plus-sign-alt" data-action="expand-all"></i>
				<i class="icon-minus-sign-alt" data-action="collapse-all"></i>
			</div>

			<select id="change-lang" class="form-control">
				@foreach(Pongo::settings('languages') as $lang_key => $lang)
					<option value="{{$lang_key}}"{{selected($lang_key, LANG)}}>{{$lang['lang']}}</option>
				@endforeach
			</select>

			<button id="create-page" class="btn btn-primary loading">
				<i class="icon-plus-sign"></i> {{t('form.button.page')}}
			</button>
			
		</header>
		
		@foreach(Pongo::settings('languages') as $lang_key => $lang)
		<div class="dd" rel="{{$lang_key}}">	
			
			<ol class="dd-list">

				{{Render::pageList(0, $lang_key, $page_id)}}

			</ol>

		</div>
		@endforeach

	</div>

</div>