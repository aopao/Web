@extends('admin.layouts.wrap')
@section('content')
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/serial.serial_numbers_record_list')</div>
					<div class="layui-card-body">
						<div class="table-action-button" style="margin-bottom: 10px;">
							<div class="layui-form" style="display:inline">
								<div class="layui-inline">
									<div class="layui-input-inline">
										<input type="text" name="number" id="number" value="" placeholder="@lang('admin/serial.input_serial_numbers')" autocomplete="off" class="layui-input">
									</div>
								</div>
								<div class="layui-inline">
									<div class="layui-input-inline">
										<input type="text" name="mobile" id="mobile" value="" placeholder="@lang('admin/serial.input_serial_mobile')" autocomplete="off" class="layui-input">
									</div>
								</div>
								<div class="layui-inline">
									<div class="layui-input-inline">
										<select name="assessment_type" id="assessmentType" lay-filter="assessment_type" lay-search="">
											<option value="">@lang('admin/serial.is_senior')</option>
											<option value="mbti_primary">@lang('admin/serial.mbti_primary')</option>
											<option value="mbti_senior">@lang('admin/serial.mbti_senior')</option>
										</select>
									</div>
								</div>
								<button class="layui-btn layui-btn-normal layuiadmin-btn-list" id="search" data-type="Search">
									<i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
								</button>
							</div>
						</div>

						<table class="layui-hide" id="SerialNumberRecordList" lay-filter="SerialNumberRecordList"></table>
						<script type="text/html" id="SerialNumberRecordListOperate">
							<button class="layui-btn layui-btn-normal layui-btn-xs" lay-event="view">@lang('comment/form.view')</button>
						</script>
						<script type="text/html" id="assessmentTypeTpl">
							@{{#  if(d.assessment_type == "mbti_primary"){ }}
							<span class="layui-badge layui-bg-blue">@lang('admin/serial.mbti_primary')</span>
							@{{#  } else { }}
							<span class="layui-badge layui-bg-green">@lang('admin/serial.mbti_senior')</span>
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
        let SerialNumberRecordIndexUrl = '{{ route('admin.serial.record.index') }}';
        let SerialNumberRecordListUrl = '{{ route('admin.serial.record.page') }}';
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
                    elem: '#SerialNumberRecordList'
                    , url: SerialNumberRecordListUrl
                    , cellMinWidth: 80
                    , page: true
                    , even: true
                    , limit: '{{ config("admin.per_page") }}'
                    , cols: [[
                        {type: 'checkbox', fixed: 'left'}
                        , {field: 'id', title: 'ID', width: 80, sort: true, fixed: 'left'}
                        , {field: 'serial_number', align: "center", title: '@lang('admin/serial.number')'}
                        , {field: 'mobile', align: "center", title: '@lang('admin/serial.mobile')'}
                        , {field: 'username', align: "center", title: '@lang('admin/serial.username')'}
                        , {field: 'assessment_type', width: "10%", align: "center", title: '@lang('admin/serial.assessment_type')', templet: '#assessmentTypeTpl'}
                        , {field: 'created_at', align: "center", title: '@lang('admin/serial.created_at')'}
                        , {align: 'center', width: 100, title: '@lang('comment/table.action')', fixed: 'right', toolbar: '#SerialNumberRecordListOperate'}
                    ]]
                });
            }

            render()

            //表单监听
            form.on('select(assessment_type)', function (data) {
                SerialNumberRecordListUrl = '{{ route('admin.serial.record.page') }}';
                let number = $('#number').val()
                let mobile = $('#mobile').val()
                SerialNumberRecordListUrl = SerialNumberRecordListUrl + '?number=' + number + '&mobile=' + mobile + '&assessment_type=' + data.value;
                render();
            });

            active = {
                Search: function () {
                    SerialNumberRecordListUrl = '{{ route('admin.serial.record.page') }}';
                    let number = $('#number').val()
                    let mobile = $('#mobile').val()
                    let assessment_type = $('#assessmentType').val()
                    SerialNumberRecordListUrl = SerialNumberRecordListUrl + '?number=' + number + '&mobile=' + mobile + '&assessment_type=' + assessment_type;
                    render()
                }
            };

            $('.table-action-button .layui-btn').on('click', function () {
                let type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });

            //监听工具条
            table.on('tool(SerialNumberRecordList)', function (obj) {
                let layEvent = obj.event;
                let data = obj.data;
                if (layEvent === 'view') {
                    layer.open({
                        type: 2
                        , content: SerialNumberRecordIndexUrl + '/' + data.id
                        , shadeClose: true
                        , area: admin.screen() < 2 ? ['100%', '80%'] : ['90%', '350px']
                        , maxmin: true
                    });
                }
            });
        });
	</script>
@endsection()
