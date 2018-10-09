@extends('admin.layouts.wrap')
@section('content')
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/student.student_list')</div>
					<div class="layui-card-body">
						<div class="table-action-button" style="margin-bottom: 10px;">
							<button class="layui-btn layui-btn-normal" data-type="StudentAdd">
								<i class="layui-icon">&#xe61f;</i>@lang('admin/student.student_add')
							</button>
							<button class="layui-btn layui-btn-danger" data-type="BatchDel">
								<i class="layui-icon">&#xe640;</i>@lang('comment/form.batch_del')
							</button>
							<div class="layui-form" style="display:inline">
								<div class="layui-inline">
									<div class="layui-input-inline">
										<input type="text" name="mobile" id="mobile" value="" placeholder="@lang('admin/agent.input_mobile')" autocomplete="off" class="layui-input">
									</div>
								</div>
								<button class="layui-btn layui-btn-normal layuiadmin-btn-list" id="search" data-type="Search">
									<i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
								</button>
							</div>
						</div>
						<table class="layui-hide" id="StudentList" lay-filter="StudentList"></table>
						<script type="text/html" id="StudentListOperate">
							<button class="layui-btn layui-btn-normal layui-btn-xs" lay-event="show">@lang('comment/form.show')</button>
							<button class="layui-btn layui-btn-warm layui-btn-xs" lay-event="edit">@lang('comment/form.edit')</button>
							<button class="layui-btn layui-btn-normal layui-btn-xs" lay-event="assign">@lang('admin/student.add_more')</button>
							<button class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">@lang('comment/form.del')</button>
							<button class="layui-btn layui-btn-blue layui-btn-xs" lay-event="change">@lang('admin/student.student_change_mobile')</button>
						</script>
						<script type="text/html" id="statusTpl">
							@{{#  if(d.status == 1){ }}
							<span class="layui-badge layui-bg-blue">正常</span>
							@{{#  } else { }}
							<span class="layui-badge layui-bg-red">禁封</span>
							@{{#  } }}
						</script>
						<script type="text/html" id="AvatarTpl">
							@{{# if (d.avatar){ }}
							<img style="display: inline-block; height: 50px" src="@{{d.avatar}}">
							@{{# }else{ }}
							<img style="display: inline-block; height: 50px"
								 src="/errorimg/error.jpg">
							@{{# } }}
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection()
@section('js')
	<script>
        let StudentIndexUrl = '{{ route('admin.student.index') }}';
        let StudentListUrl = '{{ route('admin.student.page') }}';
        let StudentBatchDeleteUrl = '{{ route('admin.student.delete') }}';

        layui.config({
            base: '/theme/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['index', 'table'], function () {
            let $ = layui.$
                , admin = layui.admin
                , table = layui.table;

            function render() {
                table.render({
                    elem: '#StudentList'
                    , url: StudentListUrl
                    , cellMinWidth: 80
                    , even: true
                    , page: true
                    , limit: '{{ config("admin.per_page") }}'
                    , cols: [[
                        {type: 'checkbox', fixed: 'left'}
                        , {field: 'id', title: 'ID', width: 80, sort: true, fixed: 'left'}
                        , {field: 'mobile', align: "center", title: '@lang('admin/student.mobile')'}
                        , {field: 'nickname', align: "center", title: '@lang('admin/student.nickname')'}
                        , {field: 'status', align: "center", title: '@lang('admin/student.status')', templet: '#statusTpl'}
                        , {field: 'created_at', align: "center",  title: '@lang('comment/table.created_at')', sort: true}
                        , {align: 'center',width: '25%', title: '@lang('comment/table.action')', fixed: 'right', toolbar: '#StudentListOperate'}
                    ]]
                });
            }

            render()


            active = {
                StudentAdd: function () {
                    layer.open({
                        type: 2
                        , content: '{{ route('admin.student.create') }}'
                        , shadeClose: true
                        , area: admin.screen() < 2 ? ['100%', '80%'] : ['50%', '500px']
                        , maxmin: true
                    });
                }
                , BatchDel: function () { //获取选中数据
                    let checkStatus = table.checkStatus('StudentList')
                        , data = checkStatus.data, ids = '';
                    for (let p in data) {//遍历json数组时，这么写p为索引，0,1
                        ids = ids + data[p].id + '|';
                    }
                    if (ids === '') {
                        return layer.msg("请选择要删除的数据!", {icon: 5});
                    }
                    layer.confirm('真的删除么?', function (index) {
                        layer.close(index);
                        //向服务端发送删除指令
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: StudentBatchDeleteUrl,
                            type: "DELETE",
                            data: {"ids": ids},
                            dataType: "json",
                            success: function (data) {
                                if (data.status_code === 200) {
                                    //删除这一行
                                    // obj.del();
                                    //关闭弹框
                                    // layer.close(index);
                                    layer.msg("删除成功", {icon: 6});
                                    window.location.reload()
                                }
                            }
                        });
                    });
                }
                , Search: function () {
                    StudentListUrl = '{{ route('admin.student.page') }}';
                    let mobile = $('#mobile').val()
                    StudentListUrl = StudentListUrl + '?mobile=' + mobile;
                    render()
                }
            };

            $('.table-action-button .layui-btn').on('click', function () {
                let type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });

            //监听工具条
            table.on('tool(StudentList)', function (obj) {
                let layEvent = obj.event;
                let data = obj.data;
                if (layEvent === 'edit') {
                    layer.open({
                        type: 2
                        , content: StudentIndexUrl + '/' + data.id + '/edit'
                        , shadeClose: true
                        , area: admin.screen() < 2 ? ['100%', '80%'] : ['50%', '500px']
                        , maxmin: true
                    });
                } else if (layEvent === 'assign') {
                    layer.open({
                        type: 2
                        , content: StudentIndexUrl + '/' + data.id + '/assign'
                        , shadeClose: true
                        , area: admin.screen() < 2 ? ['100%', '80%'] : ['80%', '500px']
                        , maxmin: true
                    });
                } else if (layEvent === 'del') { //删除
                    layer.confirm('真的删除么?', function (index) {
                        layer.close(index);
                        //向服务端发送删除指令
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: StudentIndexUrl + '/' + data.id,
                            type: "DELETE",
                            data: {"id": data.id},
                            dataType: "json",
                            success: function (data) {
                                if (data.status_code === 200) {
                                    //删除这一行
                                    obj.del();
                                    //关闭弹框
                                    layer.close(index);
                                    layer.msg("删除成功", {icon: 6});
                                }
                            }
                        });
                    });
                } else if (layEvent === 'change') {
                    layer.open({
                        type: 2
                        , content: StudentIndexUrl + '/' + data.id + '/change'
                        , shadeClose: true
                        , area: admin.screen() < 2 ? ['100%', '80%'] : ['50%', '250px']
                        , maxmin: true
                    });
                }

            });
        });
	</script>
@endsection()
