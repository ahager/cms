{{-- */ if(!isset($eid)) $eid = 0; /* --}}

<div class="element-bar">

	<div class="element-body">

		<header>

			<h2>{{t('heading.element.bar_title')}}</h2>

			<button id="create-element" class="btn btn-primary loading">
				<i class="icon-plus-sign"></i> {{t('form.button.element')}}
			</button>

		</header>

		<div class="dl">

			<ol class="dl-list">

				{{Render::elementList($pid, $eid)}}

			</ol>

		</div>

	</div>

</div>