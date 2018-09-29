@extends('admin.layouts.wrap')
@section('content')
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">{{ $info['nickname'] }} [ {{ $info['mobile'] }} ] - @lang('admin/agent.assign_agent_province')</div>
					<div class="layui-card-body" pad15="2">
						<form action="{{ route('admin.agent.assign',['id'=>$info['id']])  }}" method="post" class="layui-form layui-form-pane">
							<div class="layui-form-item">
								@inject('provinces','App\Services\ProvinceService')
								{!! $provinces->getAllProvincesCheckbox($assign_provinces) !!}
							</div>
							<div class="layui-form-item" style="text-align: center">
								{{ csrf_field() }}
								{{method_field('PUT')}}
								<input type="hidden" name="agent_id" value="{{ $info['id'] }}">
								<button class="layui-btn layui-btn-normal" lay-submit=""><i class="layui-icon">&#xe609;</i> @lang('comment/form.button_assign')</button>
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
            layer.msg('{{Session::get("message")}}', {offset: '100px', icon: 1, time: 2000});
            setTimeout(function () {
                parent.window.location.reload();
                parent.layer.close(index);
            }, 500);
			@endif
        });
	</script>
@endsection()
