{{-- */ if(!isset($element_id)) $element_id = 0; /* --}}

<div class="right-bar">

	<div class="right-body multi">
		
		<ul class="multi-panel">

			<li>

				<header>

					<h2>{{t('heading.file.bar_title')}}</h2>

					<div id="fileuploader">{{t('form.button.upload_files')}}</div>

				</header>

				<div class="dn">

					<ol class="dn-list list">

						{{Render::fileList($page_id, 'action')}}

					</ol>

				</div>

			</li>

			<li>

				<header>

					<h2>{{t('heading.marker.bar_title')}}</h2>

				</header>

				<div class="dn">

					<ol class="dn-list list">

						{{Render::markerList()}}

					</ol>

				</div>

			</li>

			<li>

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

			</li>

		</ul>

	</div>

	<footer>
			
		<ul class="toolbar">
			<li class="active"><a href="#"><i class="icon-picture"></i></a></li>
			<li><a href="#"><i class="icon-rocket"></i></a></li>
			<li><a href="#"><i class="icon-sort-by-attributes"></i></a></li>
			
			
		</ul>

	</footer>

</div>