@extends('admin.layouts.wrap')
@section('content')
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('comment/region.city_add')</div>
					<div class="layui-card-body" pad15="2">
						<form action="{{ route('admin.city.store') }}" method="post" class="layui-form layui-form-pane">
							<div class="layui-form-item">
								<label class="layui-form-label">@lang('admin/college.province_id')</label>
								<div class="layui-input-block">
									@inject('provinces','App\Services\ProvinceService')
									<select name="province_id" lay-filter="province" lay-search="">
										<option value="">@lang('admin/college.select_province')</option>
										{!! $provinces->getAllProvincesOptions() !!}
									</select>
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">@lang('comment/region.city_name')</label>
								<div class="layui-input-block">
									<input autocomplete="off" class="layui-input" lay-verify="required" name="city_name" value="" placeholder="@lang('comment/region.city_name')" type="text"/>
								</div>
							</div>
							<div class="layui-form-item" style="text-align: center">
								{{ csrf_field() }}
								<button class="layui-btn layui-btn-normal" lay-submit=""><i class="layui-icon">&#xe609;</i> @lang('comment/form.button_add')</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection()
@section('js')
	<script>
        layui.config({
            base: '/theme/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['index', 'form'], function () {
            let index = parent.layer.getFrameIndex(window.name); //获取窗口索引
			@if(Session::has('message'))
            layer.msg('{{Session::get("message")}}', {offset: '100px', icon: 1, time: 1000});
            setTimeout(function () {
                parent.window.location.reload();
                parent.layer.close(index);
            }, 500);
			@endif
        });
	</script>
@endsection()
