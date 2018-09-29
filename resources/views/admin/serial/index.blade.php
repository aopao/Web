@extends('admin.layouts.wrap')
@section('content')
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/serial.serial_numbers_list')</div>
					<div class="layui-card-body">
						<div class="table-action-button" style="margin-bottom: 10px;">
							<button class="layui-btn layui-btn-normal" data-type="SerialNumberAdd">
								<i class="layui-icon">&#xe61f;</i>@lang('admin/serial.serial_numbers_add')
							</button>
						</div>
						<table class="layui-hide" id="SerialNumberList" lay-filter="SerialNumberList"></table>
						<script type="text/html" id="isSeniorTpl">
							@{{#  if(d.is_senior == 0){ }}
							<span class="layui-badge layui-bg-blue">初级序列号</span>
							@{{#  } else { }}
							<span class="layui-badge layui-bg-green">高级序列号</span>
							@{{#  } }}
						</script>
						<script type="text/html" id="isInvalidTpl">
							@{{#  if(d.is_invalid == 0){ }}
							<span class="layui-badge layui-bg-blue">有效</span>
							@{{#  } else { }}
							<span class="layui-badge layui-bg-red">无效</span>
							@{{#  } }}
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection()
@section('js')
	<script>
        let SerialNumberListUrl = '{{ route('admin.serial.page') }}';
        layui.config({
            base: '/theme/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['index', 'table'], function () {
            let $ = layui.$
                , admin = layui.admin
                , table = layui.table;

            table.render({
                elem: '#SerialNumberList'
                , url: SerialNumberListUrl
                , cellMinWidth: 80
                , page: true
                , even: true
                , limit: '{{ config("admin.per_page") }}'
                , cols: [[
                    {type: 'checkbox', fixed: 'left'}
                    , {field: 'id', title: 'ID', width: 80, sort: true, fixed: 'left'}
                    , {field: 'number', align: "center", title: '@lang('admin/serial.number')'}
                    , {field: 'is_senior', align: "center", title: '@lang('admin/serial.is_senior')', templet: '#isSeniorTpl'}
                    , {field: 'is_invalid', align: "center", title: '@lang('admin/serial.is_invalid')', templet: '#isInvalidTpl'}
                    , {field: 'created_at', align: "center", title: '@lang('comment/table.created_at')'}
                ]]
            });

            active = {
                SerialNumberAdd: function () {
                    layer.open({
                        type: 2
                        , content: '{{ route('admin.serial.create') }}'
                        , shadeClose: true
                        , area: admin.screen() < 2 ? ['100%', '80%'] : ['50%', '350px']
                        , maxmin: true
                    });
                }
            };

            $('.table-action-button .layui-btn').on('click', function () {
                let type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });

        });
	</script>
@endsection()
