@extends('admin.layouts.wrap')
@section('content')
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/student.student_edit')</div>
					<div class="layui-card-body" pad15="2">
						<form action="{{ route('admin.student.update',['id'=>$info['id']])  }}" method="post" class="layui-form layui-form-pane">
							<div class="layui-form-item">
								<label class="layui-form-label">@lang('admin/student.mobile')</label>
								<div class="layui-input-block">
									<input autocomplete="off" class="layui-input" lay-verify="required|phone" disabled="disabled" name="" value="{{ $info['mobile'] }}" placeholder="@lang('admin/student.mobile')" type="text"/>
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">@lang('admin/student.password')</label>
								<div class="layui-input-block">
									<input autocomplete="off" class="layui-input" name="password" value="" placeholder="@lang('admin/student.change_password')" type="text"/>
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">@lang('admin/student.nickname')</label>
								<div class="layui-input-block">
									<input autocomplete="off" class="layui-input" name="nickname" value="{{ $info['nickname'] }}" placeholder="@lang('admin/student.nickname')" type="text"/>
								</div>
							</div>
							<div class="layui-form-item" style="text-align: center">
								{{ csrf_field() }}
								{{method_field('PUT')}}
								<button class="layui-btn layui-btn-normal" lay-submit=""><i class="layui-icon">&#xe609;</i> @lang('comment/form.button_edit')</button>
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
