{{-- */ if(!isset($element_id)) $element_id = 0; /* --}}

<div class="right-bar">

	<div class="right-body">

		<header>

			<h2>{{t('heading.element.bar_title')}}</h2>

			<button id="create-element" class="btn btn-primary loading">
				<i class="icon-plus-sign"></i> {{t('form.button.element')}}
			</button>

		</header>

		<div class="dl">

			<ol class="dl-list">

				{{Render::elementList($page_id, $element_id)}}

			</ol>

		</div>

	</div>

</div>