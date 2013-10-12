<div class="row">
	<div class="subbar">

		<div class="box">

			<h2><em>{{strtoupper(LANG)}}</em> {{$page_link}} <span data-bind="text: itemName">{{$name}}</span></h2>

		</div>

		<button type="button" class="subbar-toggle options-toggle">
			<i class="icon-cogs"></i>
		</button>

		<button type="button" class="subbar-toggle right-toggle file-toggle">
			@if($n_files > 0)
			<span class="label label-primary counter">{{$n_files}}</span>
			@endif
			<i class="icon-th"></i>
		</button>

	</div>
</div>