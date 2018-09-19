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
								<td>@lang('admin/college.curent_province')</td>
								<td>
									{{ $province_data['info']['province_name'] }}
								</td>
							</tr>
							<tr>
								<td>@lang('admin/college.trend')</td>
								<td>
									TODO
								</td>
							</tr>
							<tr>
								<td>@lang('admin/college.year_interval')</td>
								<td>
									@lang('admin/college.year_interval_start')
									{{ $province_data['year_interval'] }}
									@lang('admin/college.year_interval_end')
								</td>
							</tr>
							<tr>
								<td>@lang('admin/college.data_action')</td>
								<td style="padding-bottom: 0;">
									<div class="layui-btn-container">
										<a href="{{ route('admin.province.score.index') }}" class="layui-btn layui-btn-normal">@lang('admin/college.go_back')</a>
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
					<div class="layui-card-header">@lang('admin/college.extend_data')</div>
					<div class="layui-card-body">
						<div class="layui-carousel layadmin-carousel layadmin-backlog">
							<div>
								<ul class="layui-row layui-col-space10">
									<li class="layui-col-xs6">
										<a class="layadmin-backlog-body">
											<h3>@lang('admin/college.province_college_sum')</h3>
											<p><cite> {{$province_data['province_college_sum']}} </cite></p>
										</a>
									</li>
									<li class="layui-col-xs6">
										<a lay-href="app/forum/list.html" class="layadmin-backlog-body">
											<h3>待定</h3>
											<p><cite>12</cite></p>
										</a>
									</li>
									<li class="layui-col-xs6">
										<a lay-href="template/goodslist.html" class="layadmin-backlog-body">
											<h3>待定</h3>
											<p><cite>99</cite></p>
										</a>
									</li>
									<li class="layui-col-xs6">
										<a href="javascript:;" onclick="layer.tips('不跳转', this, {tips: 3});" class="layadmin-backlog-body">
											<h3>待定</h3>
											<p><cite>20</cite></p>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/college.province_control_score_bar_math')</div>
					<div class="layui-card-body">
						<div id="BarMath"></div>
					</div>
				</div>
			</div>
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/college.province_control_score_bar_art')</div>
					<div class="layui-card-body">
						<div id="BarArt"></div>
					</div>
				</div>
			</div>
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/college.province_control_score_line_math')</div>
					<div class="layui-card-body">
						<div id="LineMath"></div>
					</div>
				</div>
			</div>
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/college.province_control_score_line_art')</div>
					<div class="layui-card-body">
						<div id="LineArt"></div>
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
        let math =
				{!! $math !!}
        var art = {!! $art !!}

        // 显示文本
        var Shape = G2.Shape;
        Shape.registerShape('interval', 'textInterval', {
            drawShape: function drawShape(cfg, group) {
                var points = this.parsePoints(cfg.points); // 将0-1空间的坐标转换为画布坐标
                var value = cfg.origin._origin.score;
                group.addShape('text', {
                    attrs: {
                        text: value,
                        textAlign: 'center',
                        x: points[1].x + cfg.size / 2,
                        y: points[1].y,
                        fontFamily: 'PingFang SC',
                        fontSize: 12,
                        fill: '#BBB'
                    }
                });
                var polygon = group.addShape('polygon', {
                    attrs: {
                        points: points.map(function (point) {
                            return [point.x, point.y];
                        }),
                        fill: cfg.color
                    }
                });
                return polygon;
            }
        });

        //理科省控线柱状图
        const chart_bar_math = new G2.Chart({
            container: 'BarMath',
            forceFit: true,
            height: 450,
            data: math,
            padding: [20, 20, 100, 50]
        });
        chart_bar_math.scale('score', {
            type: 'linear',
            min: 0,
            max: 800
        });
        chart_bar_math.axis('year', {
            label: {
                formatter: val => {
                    return val + '年';
                }
            }
        });
        chart_bar_math.interval().shape('textInterval').position('year*score').color('batch').adjust([{
            type: 'dodge',
            marginRatio: 1 / 32
        }]).size(10);
        chart_bar_math.render();

        //文科省控线柱状图
        const chart_bar_art = new G2.Chart({
            container: 'BarArt',
            data: art,
            forceFit: true,
            height: 450,
            padding: [20, 20, 100, 50]
        });
        chart_bar_art.scale('score', {
            type: 'linear',
            min: 0,
            max: 800
        });
        chart_bar_art.axis('year', {
            label: {
                formatter: val => {
                    return val + '年';
                }
            }
        });
        chart_bar_art.interval().shape('textInterval').position('year*score')
            .color('batch').adjust([{
            type: 'dodge',
            marginRatio: 1 / 32
        }]).size(10);
        chart_bar_art.render();

        //理科省控线柱状图
        const chart_line_math = new G2.Chart({
            container: 'LineMath',
            data: math,
            forceFit: true,
            height: 450,
            padding: [20, 20, 100, 50]
        });
        chart_line_math.scale('score', {
            type: 'linear',
            min: 0,
            max: 800
        });
        chart_line_math.axis('year', {
            label: {
                formatter: val => {
                    return val + '年';
                }
            }
        });
        chart_line_math.line().position('year*score').color('batch');
        chart_line_math.point().position('year*score').color('batch').size(4).shape('circle').style({
            stroke: '#fff',
            lineWidth: 1
        });
        chart_line_math.render();

        //文科省控线柱状图
        const chart_line_art = new G2.Chart({
            container: 'LineArt',
            data: art,
            forceFit: true,
            height: 450,
            padding: [20, 20, 100, 50]
        });
        chart_line_art.scale('score', {
            type: 'linear',
            min: 0,
            max: 800
        });
        chart_line_art.axis('year', {
            label: {
                formatter: val => {
                    return val + '年';
                }
            }
        });
        chart_line_art.tooltip({
            crosshairs: {
                type: 'line'
            }
        });

        chart_line_art.line().position('year*score').color('batch');
        chart_line_art.point().position('year*score').color('batch').size(4).shape('circle').style({
            stroke: '#fff',
            lineWidth: 1
        });
        chart_line_art.render();
	</script>
	<script>
        layui.config({
            base: '/theme/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['index', 'console']);
	</script>
@endsection()
