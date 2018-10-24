<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>@lang('assessment/comment.web_name')</title>
	<link href="{{ asset("theme/layui/css/assessment.css") }}" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="bg">
	<div class="wel">@lang('assessment/comment.slog_name')</div>
	<form method="post" action="{{ route('assessment.senior.collect') }}" autocomplete="off">
		<div class="user">
			<div id="yonghu" style="">@lang('assessment/senior.professional')</div>
			<input id="textfield" maxlength="25" name="textfield" readonly="true" size="25" type="text" value="@lang('assessment/senior.slog_name')"/>
		</div>
		<div class="password">
			<div id="yonghu">@lang('assessment/comment.serial_number')</div>
			<input name="number" type="text" value="{{old('number')}}"/>
		</div>
		<div class="fg">
			<div style="font-size: 11px;margin-top: 11px;">
				<span id="checkCodeHint" style="font-size: 11px;color: red">
					@if ($errors->any())
						{{ $errors->first('number') }}
					@endif
				</span>
			</div>
		</div>
		{{ csrf_field() }}
		<input class="btn" type="submit" value="进 入 测 试"/>
	</form>
</div>
</body>
</html>
