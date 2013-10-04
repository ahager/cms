<div class="option-bar">
				
	<div class="option-body">
		
		<header>
			
			<h2>{{t('heading.option.bar_title')}}</h2>

		</header>
		
		<ul class="options list-unstyled">
			<li{{active('settings', $section)}}>
				<a href="{{route('page.settings', array('id' => $id))}}">{{t('heading.page.settings_title')}}</a>
			</li>
			<li{{active('layout', $section)}}>
				<a href="{{route('page.layout', array('id' => $id))}}">{{t('heading.page.layout_title')}}</a>
			</li>
			<li{{active('seo', $section)}}>
				<a href="{{route('page.seo', array('id' => $id))}}">{{t('heading.page.seo_title')}}</a>
			</li>
			<li{{active('files', $section)}}>
				<a href="{{route('page.files', array('id' => $id))}}">{{t('heading.page.files_title')}}</a>
			</li>
			<li{{active('link', $section)}}>
				<a href="{{route('page.link', array('id' => $id))}}">{{t('heading.page.linked_title')}}</a>
			</li>
		</ul>

	</div>

</div>