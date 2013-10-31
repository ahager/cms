{{-- */ $day = $date->getDay(); /* --}}
{{-- */ $month = $date->getMonth(); /* --}}
{{-- */ $year = $date->getYear(); /* --}}

<div class="form-inline">
	{{Form::hidden($name, null, array('id' => 'date'))}}
	<div class="form-group">
		<select name="{{$day_name}}" class="form-control" id="{{$day_name}}" data-bind="value: day">
			@for($i = 1; $i <= 31; $i ++)
			<option value="{{Tool::addZero($i)}}">{{Tool::addZero($i)}}</option>
			@endfor
		</select>
	</div>
	<div class="form-group">
		<select name="{{$month_name}}" class="form-control" id="{{$month_name}}" data-bind="value: month">
			@for($i = 1; $i <= 12; $i ++)
			<option value="{{Tool::addZero($i)}}">{{t('datetime.month.' . $i)}}</option>
			@endfor
		</select>
	</div>
	<div class="form-group">
		<select name="{{$year_name}}" class="form-control" id="{{$year_name}}" data-bind="value: year">
			@for($i = $year; $i > $year-$year_past; $i --)
			<option value="{{$i}}">{{$i}}</option>
			@endfor
		</select>
	</div>
</div>