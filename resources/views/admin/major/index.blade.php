@extends('admin.layouts.wrap')
@section('content')
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/major.major_list')</div>
					<div class="layui-card-body">
						<div class="table-action-button" style="margin-bottom: 10px;">
							<button class="layui-btn layui-btn-normal" data-type="majorAdd">
								<i class="layui-icon">&#xe61f;</i>@lang('admin/major.major_add')
							</button>
							<button class="layui-btn layui-btn-danger" data-type="BatchDel">
								<i class="layui-icon">&#xe640;</i>@lang('comment/form.batch_del')
							</button>
							<form class="layui-form" style="display:inline">
								<div class="layui-inline">
									<div class="layui-input-inline">
										{{--@inject('major','App\Services\ProfessionalCategoryService')--}}
										{{--<select name="parent_id" lay-filter="parent_id" lay-search="">--}}
											{{--<option value="">@lang('admin/major.major_select_parent_id')</option>--}}
											{{--{!! $major->getAllProfessionalCategoryOptions() !!}--}}
										{{--</select>--}}
									</div>
								</div>
							</form>
						</div>
						<table class="layui-hide" id="majorList" lay-filter="majorList"></table>
						<script type="text/html" id="majorListOperate">
							<button class="layui-btn layui-btn-primary layui-btn-xs" lay-event="view">@lang('comment/form.view')</button>
							<button class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit">@lang('comment/form.edit')</button>
							<button class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">@lang('comment/form.del')</button>
						</script>
						<script type="text/html" id="majorLevel">
							@{{#  if(d.major_diplomas === 0){ }}
							<span class="layui-badge layui-bg-blue">@lang('admin/major.major_specialist')</span>
							@{{#  } else { }}
							<span class="layui-badge layui-bg-orange">@lang('admin/major.major_bachelor')</span>
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
        let majorIndexUrl = '{{ route('admin.major.index') }}';
        let majorListUrl = '{{ route('admin.major.page') }}';
        let majorBatchDeleteUrl = '{{ route('admin.major.delete') }}';

        layui.config({
            base: '/theme/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['index', 'table'], function () {
            let $ = layui.$
                , admin = layui.admin
                , table = layui.table
                , form = layui.form;

            function render() {
                table.render({
                    elem: '#majorList'
                    , url: majorListUrl
                    , cellMinWidth: 80
                    , even: true
                    , page: true
                    , limit: '{{ config("admin.per_page") }}'
                    , cols: [[
                        {type: 'checkbox', fixed: 'left'}
                        , {field: 'id', title: 'ID', width: 80, sort: true, fixed: 'left'}
                        , {field: 'major_name', title: '@lang('admin/major.major_name')'}
                        , {field: 'major_code', align: "center", title: '@lang('admin/major.major_code')'}
                        , {field: 'awarded_degree', align: "center", title: '@lang('admin/major.awarded_degree')', templet: '<div>@{{ d.major_detail.awarded_degree }}</div>'}
                        , {field: 'major_diplomas', align: "center", title: '@lang('admin/major.major_diplomas')', templet: '#majorLevel'}
                        , {field: 'created_at', align: "center", width: 200, title: '@lang('comment/table.created_at')', sort: true}
                        , {align: 'center', width: 200, title: '@lang('comment/table.action')', fixed: 'right', toolbar: '#majorListOperate'}
                    ]]
                });
            }

            //表单监听
            form.on('select(parent_id)', function (data) {
                majorListUrl = '{{ route('admin.major.page') }}';
                majorListUrl = majorListUrl + '?top_parent_id=' + data.value;
                render();
            });
            render()

            active = {
                majorAdd: function () {
                    layer.open({
                        type: 2
                        , content: '{{ route('admin.major.create') }}'
                        , shadeClose: true
                        , area: admin.screen() < 2 ? ['100%', '80%'] : ['50%', '500px']
                        , maxmin: true
                    });
                }
                , BatchDel: function () { //获取选中数据
                    let checkStatus = table.checkStatus('majorList')
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
                            url: majorBatchDeleteUrl,
                            type: "DELETE",
                            data: {"ids": ids},
                            dataType: "json",
                            success: function (data) {
                                if (data.status_code === 200) {
                                    layer.msg("删除成功", {icon: 6});
                                    window.location.reload()
                                }
                            }
                        });
                    });
                }
            };

            $('.table-action-button .layui-btn').on('click', function () {
                let type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });

            //监听工具条
            table.on('tool(majorList)', function (obj) {
                let layEvent = obj.event;
                let data = obj.data;
                if (layEvent === 'edit') {
                    layer.open({
                        type: 2
                        , content: majorIndexUrl + '/' + data.id + '/edit'
                        , shadeClose: true
                        , area: admin.screen() < 2 ? ['100%', '80%'] : ['50%', '500px']
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
                            url: majorIndexUrl + '/' + data.id,
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
                } else if (layEvent === 'view') {
                    location.href = majorIndexUrl + '/' + data.id
                }
            });
        });
	</script>
@endsection()
