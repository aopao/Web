@extends('admin.layouts.wrap')
@section('content')
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/log.student_login_list')</div>
					<div class="layui-card-body">
						<div class="table-action-button" style="margin-bottom: 10px;">
							<div class="layui-form" style="display:inline">
								<div class="layui-inline">
									<div class="layui-input-inline">
										<input type="text" name="student" id="student" value="" placeholder="@lang('admin/log.input_student_id')" autocomplete="off" class="layui-input">
									</div>
								</div>
								<div class="layui-inline">
									<div class="layui-input-inline">
										<input type="text" name="range-date" class="layui-input" id="range-date" placeholder=" ~ " autocomplete="off">
									</div>
								</div>
								<button class="layui-btn layui-btn-normal layuiadmin-btn-list" id="search" data-type="Search">
									<i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
								</button>
							</div>
						</div>
						<table class="layui-hide" id="StudentLoginLogList" lay-filter="StudentLoginLogList"></table>
						<script type="text/html" id="StudentLoginLogListOperate">
							<button class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit">编辑</button>
							<button class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</button>
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection()
@section('js')
	<script>
        let StudentLoginLogListUrl = '{{ route('log.student.login.page') }}';

        layui.config({
            base: '/theme/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['index', 'table', 'laydate'], function () {
            let $ = layui.$
                , table = layui.table
                , laydate = layui.laydate;

            //日期范围
            laydate.render({
                elem: '#range-date'
                , range: '~'
            });

            function render() {
                table.render({
                    elem: '#StudentLoginLogList'
                    , url: StudentLoginLogListUrl
                    , cellMinWidth: 80
                    , page: true
                    , limit: '{{ config("admin.per_page") }}'
                    , cols: [[
                        {field: 'id', title: 'ID', width: 80, sort: true, fixed: 'left'}
                        , {field: 'ip', align: "center", title: '@lang('admin/log.ip')'}
                        , {field: 'student_mobile', align: "center", title: '@lang('admin/log.admin_id')'}
                        , {field: 'platform', align: "center", title: '@lang('admin/log.platform')'}
                        , {field: 'device', align: "center", title: '@lang('admin/log.device')'}
                        , {field: 'browser', align: "center", title: '@lang('admin/log.browser')'}
                        , {field: 'address', align: "center", title: '@lang('admin/log.address')'}
                        , {field: 'created_at', align: "center", width: 200, title: '@lang('comment/table.created_at')', sort: true}
                    ]]
                });
            }

            render()
            active = {
                Search: function () {
                    StudentLoginLogListUrl = '{{ route('log.student.login.page') }}';
                    let student = $('#student').val()
                    let range_date = $('#range-date').val()
                    StudentLoginLogListUrl = StudentLoginLogListUrl + '?student=' + student + '&range_date=' + range_date;
                    render()
                }
            };

            $('#search').on('click', function () {
                let type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });
        });
	</script>
@endsection()
