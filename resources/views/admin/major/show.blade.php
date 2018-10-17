@extends('admin.layouts.wrap')
@section('content')
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md6">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/college.data_info')</div>
					<div class="layui-card-body layui-text">
						<table class="layui-table">
							<colgroup>
								<col width="100">
								<col>
							</colgroup>
							<tbody>
							<tr>
								<td>@lang('admin/professional.professional_name')</td>
								<td>
									{{ $info['professional_name'] }}
								</td>
							</tr>
							<tr>
								<td>@lang('admin/professional.professional_code')</td>
								<td>
									{{ $info['professional_code'] }}
								</td>
							</tr>
							<tr>
								<td>@lang('admin/professional.professional_level')</td>
								<td>
									{{ $info['professional_level']?'本科':'专科' }}
								</td>
							</tr>
							<tr>
								<td>@lang('admin/college.data_action')</td>
								<td style="padding-bottom: 0;">
									<div class="layui-btn-container">
										<a href="{{ route('admin.professional.index') }}" class="layui-btn layui-btn-xs layui-btn-normal">@lang('admin/college.go_back')</a>
									</div>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="layui-col-md6">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/professional.belonf_to_professional_category')</div>
					<div class="layui-card-body layui-text">
						<table class="layui-table">
							<colgroup>
								<col width="100">
								<col>
							</colgroup>
							<tbody>
							<tr>
								<td>@lang('admin/professional.professional_category_top_id')</td>
								<td>
									{{ $info['professional_top_category']['professional_category_name'] }}
								</td>
							</tr>
							<tr>
								<td>@lang('admin/professional.professional_category_parent_id')</td>
								<td>
									{{ $info['professional_parent_category']['professional_category_name'] }}
								</td>
							</tr>
							<tr>
								<td>@lang('admin/professional.professional_level')</td>
								<td>
									{{ $info['professional_level']?'本科':'专科' }}
								</td>
							</tr>
							<tr>
								<td>@lang('admin/professional.hot_clicks')</td>
								<td style="padding-bottom: 0;">
									{{ $info['professional_detail']['clicks'] || 0 }}
								</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/professional.job_direction')</div>
					<div class="layui-card-body">
						{{ (strlen($info['professional_detail']['job_direction'])>=1)?$info['professional_detail']['job_direction']:'暂时未更新数据'}}
					</div>
				</div>
			</div>
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/professional.work_rate')</div>
					<div class="layui-card-body">
						<table class="layui-table">
							<tr>
								<th>2015</th>
								<th>2016</th>
								<th>2017</th>
							</tr>
							<tr>
								@foreach ($info['professional_detail']['work_rate'] as $key=>$value)
									<td>{{ $value }}</td>
								@endforeach
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="layui-col-md6">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/professional.subject_rate')</div>
					<div class="layui-card-body">
						<div id="SubjectRate"></div>
					</div>
				</div>
			</div>
			<div class="layui-col-md6">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/professional.gender_rate')</div>
					<div class="layui-card-body">
						<div id="GenderRate"></div>
					</div>
				</div>
			</div>
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/professional.description')</div>
					<div class="layui-card-body">
						{{ (strlen($info['professional_detail']['description'])>=1)?$info['professional_detail']['description']:'暂时未更新数据'}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection()
@section('js')
	<!-- 引入资源 -->
	<script src="{{ asset("theme/js/g2.min.js") }}"></script>
	<script src="{{ asset("theme/js/data-set.min.js") }}"></script>
	<script>
        layui.config({
            base: '/theme/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['index', 'console']);
	</script>
	<script>
        var data = {!! json_encode($info['professional_detail']['subject_rate']['list']) !!};
        var chart_subject = new G2.Chart({
            container: 'SubjectRate',
            forceFit: true,
            padding: [10, 60, 100, 50]
        });
        chart_subject.source(data, {
            value: {
                formatter: function formatter(val) {
                    val = val + '%';
                    return val;
                }
            }
        });
        chart_subject.coord('theta', {
            radius: 0.75,
            innerRadius: 0.6
        });
        chart_subject.tooltip({
            showTitle: false,
            itemTpl: '<li><span style="background-color:{color};" class="g2-tooltip-marker"></span>{name}: {value}</li>'
        });
        // 辅助文本
        chart_subject.guide().html({
            position: ['50%', '50%'],
            html: '<div style="color:#8c8c8c;font-size: 14px;text-align: center;width: 10em;">性别比例图示',
            alignX: 'middle',
            alignY: 'middle'
        });
        var interval_subject = chart_subject.intervalStack().position('value').color('name').label('value', {
            formatter: function formatter(val, item) {
                return item.point.name + ': ' + val;
            }
        }).tooltip('name*value', function (item, value) {
            value = value + '%';
            return {
                name: item,
                value: value
            };
        }).style({
            lineWidth: 1,
            stroke: '#fff'
        });
        chart_subject.render();
        interval_subject.setSelected(data[0]);

        var data = {!! json_encode($info['professional_detail']['gender_rate']['list']) !!};
        var chart = new G2.Chart({
            container: 'GenderRate',
            forceFit: true,
            padding: [10, 60, 100, 50]
        });
        chart.source(data, {
            value: {
                formatter: function formatter(val) {
                    val = val + '%';
                    return val;
                }
            }
        });
        chart.coord('theta', {
            radius: 0.75,
            innerRadius: 0.6
        });
        chart.tooltip({
            showTitle: false,
            itemTpl: '<li><span style="background-color:{color};" class="g2-tooltip-marker"></span>{name}: {value}</li>'
        });
        // 辅助文本
        chart.guide().html({
            position: ['50%', '50%'],
            html: '<div style="color:#8c8c8c;font-size: 14px;text-align: center;width: 10em;">性别比例图示',
            alignX: 'middle',
            alignY: 'middle'
        });
        var interval = chart.intervalStack().position('value').color('name').label('value', {
            formatter: function formatter(val, item) {
                return item.point.name + ': ' + val;
            }
        }).tooltip('name*value', function (item, value) {
            value = value + '%';
            return {
                name: item,
                value: value
            };
        }).style({
            lineWidth: 1,
            stroke: '#fff'
        });
        chart.render();
        interval.setSelected(data[0]);

	</script>
@endsection()
