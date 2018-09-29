@extends('admin.layouts.wrap')
@section('content')
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/agent.agent_edit')</div>
					<div class="layui-card-body" pad15="2">
						<form action="{{ route('admin.agent.change',['id'=>$info['id']])  }}" method="post" class="layui-form layui-form-pane">
							<div class="layui-form-item">
								<label class="layui-form-label">@lang('admin/agent.mobile')</label>
								<div class="layui-input-block">
									<input autocomplete="off" class="layui-input" lay-verify="required|phone" name="mobile" value="{{ $info['mobile'] }}" placeholder="@lang('admin/agent.mobile')" type="text"/>
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
			@if(Session::has('data.message'))

			@if(Session::get('data.status_code') == 200)
            layer.msg('{{Session::get("data.message")}}', {offset: '100px', icon: 1, time: 2000});
            setTimeout(function () {
                parent.window.location.reload();
                parent.layer.close(index);
            }, 500);
			@else
            layer.msg('{{Session::get("data.message")}}', {offset: '100px', icon: 5, time: 1000});
			@endif
			@endif
        });
	</script>
@endsection()
