@extends('student.layout.layout')
@section('content')
	<div class="userRight col-md-9 col-sm-9">
		<h2>
			<i class="fa fa-fw fa-mortar-board" aria-hidden="true"></i>院校推荐</h2>
		<div class="table-responsive userTable">
			<table class="table table-responsive table-bordered">
				<thead>
				<tr>
					<th>院校名称</th>
					<th>院校代码</th>
					<th>院校性质</th>
					<th>211</th>
					<th>985</th>
					<th>综合排名</th>
				</tr>
				</thead>
				<tbody>
				@if (isset($college_data) && is_array($college_data))
					@foreach ($college_data as $college)
						<tr>
							<td>{{ $college["name"] }}</td>
							<td>{{ $college["code"] }}</td>
							<td>
								@if ($college["is_nation"]==1)
									公办
								@else
									民办
								@endif
							</td>
							<td>@if ($college["is_211"]==1)
									是
								@else
									否
								@endif
							</td>
							<td>
								@if ($college["is_985"]==1)
									是
								@else
									否
								@endif
							</td>
							<td>{{$college["general_rank"]}}</td>
						</tr>
					@endforeach
				@else
					<tr>
						<td colspan="6">
							{{$college_data}}
						</td>
					</tr>
				@endif

				</tbody>
			</table>
		</div>
	</div>
	</div>
	</div>
@endsection()