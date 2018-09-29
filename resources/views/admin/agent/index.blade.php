@extends('admin.layouts.wrap')
@section('content')
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/agent.agent_list')</div>
					<div class="layui-card-body">
						<div class="table-action-button" style="margin-bottom: 10px;">
							<button class="layui-btn layui-btn-normal" data-type="AgentAdd">
								<i class="layui-icon">&#xe61f;</i>@lang('admin/agent.agent_add')
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
								<button class="layui-btn layuiadmin-btn-list" id="search" data-type="Search">
									<i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
								</button>
							</div>
						</div>
						<table class="layui-hide" id="AgentList" lay-filter="AgentList"></table>
						<script type="text/html" id="AgentListOperate">
							<button class="layui-btn layui-btn-normal layui-btn-xs" lay-event="show">@lang('comment/form.show')</button>
							<button class="layui-btn layui-btn-warm layui-btn-xs" lay-event="edit">@lang('comment/form.edit')</button>
							<button class="layui-btn layui-btn-normal layui-btn-xs" lay-event="assign">@lang('admin/agent.assign_agent_province')</button>
							<button class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">@lang('comment/form.del')</button>
							<button class="layui-btn layui-btn-blue layui-btn-xs" lay-event="change">@lang('admin/agent.agent_change_mobile')</button>
						</script>
						<script type="text/html" id="statusTpl">
							@{{#  if(d.status == 1){ }}
							<span class="layui-badge layui-bg-blue">正常</span>
							@{{#  } else { }}
							<span class="layui-badge layui-bg-red">禁封</span>
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
        let AgentIndexUrl = '{{ route('admin.agent.index') }}';
        let AgentListUrl = '{{ route('admin.agent.page') }}';
        let AgentBatchDeleteUrl = '{{ route('admin.agent.delete') }}';

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
                    elem: '#AgentList'
                    , url: AgentListUrl
                    , cellMinWidth: 80
                    , even: true
                    , page: true
                    , limit: '{{ config("admin.per_page") }}'
                    , cols: [[
                        {type: 'checkbox', fixed: 'left'}
                        , {field: 'id', title: 'ID', width: 80, sort: true, fixed: 'left'}
                        , {field: 'mobile', align: "center", title: '@lang('admin/agent.mobile')'}
                        , {field: 'nickname', align: "center", title: '@lang('admin/agent.nickname')'}
                        , {field: 'student_num', align: "center", title: '@lang('admin/agent.student_num')', templet: '<div>后期添加</div>'}
                        , {field: 'status', align: "center", title: '@lang('admin/agent.status')', templet: '#statusTpl'}
                        , {field: 'created_at', align: "center",  title: '@lang('comment/table.created_at')', sort: true}
                        , {align: 'center',width: '25%', title: '@lang('comment/table.action')', fixed: 'right', toolbar: '#AgentListOperate'}
                    ]]
                });
            }

            render()


            active = {
                AgentAdd: function () {
                    layer.open({
                        type: 2
                        , content: '{{ route('admin.agent.create') }}'
                        , shadeClose: true
                        , area: admin.screen() < 2 ? ['100%', '80%'] : ['50%', '500px']
                        , maxmin: true
                    });
                }
                , BatchDel: function () { //获取选中数据
                    let checkStatus = table.checkStatus('AgentList')
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
                            url: AgentBatchDeleteUrl,
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
                    AgentListUrl = '{{ route('admin.agent.page') }}';
                    let mobile = $('#mobile').val()
                    AgentListUrl = AgentListUrl + '?mobile=' + mobile;
                    render()
                }
            };

            $('.table-action-button .layui-btn').on('click', function () {
                let type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });

            //监听工具条
            table.on('tool(AgentList)', function (obj) {
                let layEvent = obj.event;
                let data = obj.data;
                if (layEvent === 'edit') {
                    layer.open({
                        type: 2
                        , content: AgentIndexUrl + '/' + data.id + '/edit'
                        , shadeClose: true
                        , area: admin.screen() < 2 ? ['100%', '80%'] : ['50%', '500px']
                        , maxmin: true
                    });
                } else if (layEvent === 'assign') {
                    layer.open({
                        type: 2
                        , content: AgentIndexUrl + '/' + data.id + '/assign'
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
                            url: AgentIndexUrl + '/' + data.id,
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
                        , content: AgentIndexUrl + '/' + data.id + '/change'
                        , shadeClose: true
                        , area: admin.screen() < 2 ? ['100%', '80%'] : ['50%', '250px']
                        , maxmin: true
                    });
                }

            });
        });
	</script>
@endsection()
