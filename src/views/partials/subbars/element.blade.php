<div class="row">
	<div class="subbar">

		<div class="box">

			<h2>
				<span data-bind="text: pageName">{{$name}}</span>
			</h2>

		</div>

		<button type="button" class="subbar-toggle options-toggle">
			<i class="icon-cogs"></i>
		</button>

		<button type="button" class="subbar-toggle right-toggle element-toggle">			
			@if($n_elements > 0)
			<span class="label label-primary">{{$n_elements}}</span>
			@endif
			<i class="icon-sort-by-attributes"></i>
		</button>

	</div>
</div>