@extends('admin.layouts.wrap')
@section('content')
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md6">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/serial.student_info')</div>
					<div class="layui-card-body">
						<table class="layui-table">
							<tbody>
							<tr>
								<td>@lang('admin/student.mobile')</td>
								<td>{{ $info['mobile'] }}</td>
							</tr>
							<tr>
								<td>@lang('admin/serial.username')</td>
								<td>{{ $info['username'] }}</td>
							</tr>
							<tr>
								<td>@lang('admin/serial.created_at')</td>
								<td>{{ $info['created_at'] }}</td>
							</tr>
							<tr>
								<td>@lang('admin/serial.view_report')</td>
								<td>
									<a class="layui-btn layui-btn-normal layui-btn-xs" href="http://www.baidu.com" target="_blank">@lang('admin/serial.view_report')</a>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="layui-col-md6">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/serial.serial_numbers_info')</div>
					<div class="layui-card-body">
						<table class="layui-table">
							<tbody>
							<tr>
								<td>@lang('admin/serial.id')</td>
								<td>{{ $info['serial_number_info']['id'] }}</td>
							</tr>
							<tr>
								<td>@lang('admin/serial.number')</td>
								<td>{{ $info['serial_number'] }}</td>
							</tr>
							<tr>
								<td>@lang('comment/table.created_at')</td>
								<td>{{ $info['serial_number_info']['created_at'] }}</td>
							</tr>
							<tr>
								<td>@lang('admin/serial.is_senior')</td>
								<td>
									@if ($info['serial_number_info']['is_senior']==0)
										@lang('admin/serial.primary')
									@else
										@lang('admin/serial.senior')
									@endif
								</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection()
@section('js')
	<!-- 引入在线资源 -->
	<script>
        layui.config({
            base: '/theme/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['index', 'console']);
	</script>
@endsection()
