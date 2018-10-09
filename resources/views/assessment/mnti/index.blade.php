<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Index</title>
</head>
<body>
<form action="" method="post">
	@foreach ($data as $value)
		<input type="text" name="answer_{{ $value['id'] }}" id="" value="{{ $value['answer'] }}">
	@endforeach
	{{ csrf_field() }}
	<input type="submit" value="提交">
</form>
</body>
</html>