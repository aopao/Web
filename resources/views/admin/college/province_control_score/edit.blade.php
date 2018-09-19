@extends('admin.layouts.wrap')
@section('content')
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/college.province_control_score_edit')</div>
					<div class="layui-card-body" pad15="2">
						<form action="{{ route('admin.province.score.update',['id'=>$info['id']])  }}" method="post" class="layui-form layui-form-pane">
							<div class="layui-form-item" pane>
								<label class="layui-form-label">@lang('admin/college.subject')</label>
								<div class="layui-input-block">
									@inject('radio','App\Services\RadioService')
									<input type="radio" name="subject" {{ $radio->isChecked(0,$info['subject']) }} value="0" title="@lang('admin/college.subject_art')">
									<input type="radio" name="subject" {{ $radio->isChecked(1,$info['subject']) }}  value="1" title="@lang('admin/college.subject_math')">
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">@lang('admin/college.province_id')</label>
								<div class="layui-input-block">
									@inject('provinces','App\Services\ProvinceService')
									<select name="province_id" lay-filter="province" lay-search="">
										<option value="">@lang('admin/college.select_province')</option>
										{!! $provinces->getAllProvincesOptions($info['province_id']) !!}
									</select>
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">@lang('admin/college.year')</label>
								<div class="layui-input-block">
									@inject('years','App\Services\YearService')
									<select name="year" lay-filter="province" lay-search="">
										<option value="">@lang('admin/college.select_years')</option>
										{!! $years->getAllYearsOptions($info['year']) !!}
									</select>
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">@lang('admin/college.batch')</label>
								<div class="layui-input-block">
									<input autocomplete="off" class="layui-input" lay-verify="required" name="batch" value="{{ $info['batch'] }}" placeholder="@lang('admin/college.batch')" type="text"/>
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">@lang('admin/college.score')</label>
								<div class="layui-input-block">
									<input autocomplete="off" class="layui-input" lay-verify="required|number" name="score" value="{{ $info['score'] }}" placeholder="@lang('admin/college.score')" type="text"/>
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
