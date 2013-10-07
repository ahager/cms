<div class="option-bar">

	<div class="option-body">
		
		<header>
			
			<h2>{{t('heading.option.bar_title')}}</h2>

		</header>

		<ul class="options list-unstyled">
			<li{{active('settings', $section)}}>
				<a href="{{route('element.settings', array('pid' => $pid, 'eid' => $eid))}}">{{t('heading.page.settings_title')}}</a>
			</li>
			<li{{active('content', $section)}}>
				<a href="{{route('element.content', array('pid' => $pid, 'eid' => $eid))}}">{{t('heading.element.content_title')}}</a>
			</li>
			<li{{active('files', $section)}}>
				<a href="{{route('element.files', array('pid' => $pid, 'eid' => $eid))}}">{{t('heading.page.files_title')}}</a>
			</li>
		</ul>

	</div>

</div>