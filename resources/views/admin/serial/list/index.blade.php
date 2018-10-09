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
							<div class="layui-form" style="display:inline">
								<div class="layui-inline">
									<div class="layui-input-inline">
										<input type="text" name="number" id="number" value="" placeholder="@lang('admin/serial.input_serial_numbers')" autocomplete="off" class="layui-input">
									</div>
								</div>
								<div class="layui-inline">
									<div class="layui-input-inline">
										<select name="is_senior" id="isSenior" lay-filter="is_senior" lay-search="">
											<option value="">@lang('admin/serial.is_senior')</option>
											<option value="0">@lang('admin/serial.primary')</option>
											<option value="1">@lang('admin/serial.senior')</option>
										</select>
									</div>
								</div>
								<div class="layui-inline">
									<div class="layui-input-inline">
										<select name="is_invalid" id="isInvalid" lay-filter="is_invalid" lay-search="">
											<option value="">@lang('admin/serial.is_invalid')</option>
											<option value="0">@lang('admin/serial.invalid')</option>
											<option value="1">@lang('admin/serial.not_invalid')</option>
										</select>
									</div>
								</div>
								<button class="layui-btn layui-btn-normal layuiadmin-btn-list" id="search" data-type="Search">
									<i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
								</button>
							</div>
						</div>

						<table class="layui-hide" id="SerialNumberList" lay-filter="SerialNumberList"></table>
						<script type="text/html" id="isSeniorTpl">
							@{{#  if(d.is_senior == 0){ }}
							<span class="layui-badge layui-bg-blue">@lang('admin/serial.primary')</span>
							@{{#  } else { }}
							<span class="layui-badge layui-bg-green">@lang('admin/serial.senior')</span>
							@{{#  } }}
						</script>
						<script type="text/html" id="isInvalidTpl">
							@{{#  if(d.is_invalid == 0){ }}
							<span class="layui-badge layui-bg-blue">@lang('admin/serial.invalid')</span>
							@{{#  } else { }}
							<span class="layui-badge layui-bg-red">@lang('admin/serial.not_invalid')</span>
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
                , form = layui.form
                , table = layui.table;

            function render() {
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
            }

            render()

            //表单监听
            form.on('select(is_senior)', function (data) {
                SerialNumberListUrl = '{{ route('admin.serial.page') }}';
                let number = $('#number').val()
                let is_invalid = $('#isInvalid').val()
                SerialNumberListUrl = SerialNumberListUrl + '?number=' + number + '&is_senior=' + data.value + '&is_invalid=' + is_invalid;
                render();
            });

            //表单监听
            form.on('select(is_invalid)', function (data) {
                SerialNumberListUrl = '{{ route('admin.serial.page') }}';
                let number = $('#number').val()
                let is_senior = $('#isSenior').val()
                SerialNumberListUrl = SerialNumberListUrl + '?number=' + number + '&is_invalid=' + data.value + '&is_senior=' + is_senior;
                render();
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
                , Search: function () {
                    SerialNumberListUrl = '{{ route('admin.serial.page') }}';
                    let number = $('#number').val()
                    let is_senior = $('#isSenior').val()
                    SerialNumberListUrl = SerialNumberListUrl + '?number=' + number + '&is_senior=' + is_senior;
                    render()
                }
            };

            $('.table-action-button .layui-btn').on('click', function () {
                let type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });

        });
	</script>
@endsection()
