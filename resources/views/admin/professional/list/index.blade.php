@extends('admin.layouts.wrap')
@section('content')
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/professional.professional_list')</div>
					<div class="layui-card-body">
						<div class="table-action-button" style="margin-bottom: 10px;">
							<button class="layui-btn layui-btn-normal" data-type="professionalCategoryAdd">
								<i class="layui-icon">&#xe61f;</i>@lang('admin/professional.professional_add')
							</button>
							<button class="layui-btn layui-btn-danger" data-type="BatchDel">
								<i class="layui-icon">&#xe640;</i>@lang('comment/form.batch_del')
							</button>
							<form class="layui-form" style="display:inline">
								<div class="layui-inline">
									<div class="layui-input-inline">
										@inject('professional','App\Services\ProfessionalCategoryService')
										<select name="parent_id" lay-filter="parent_id" lay-search="">
											<option value="">@lang('admin/professional.professional_select_parent_id')</option>
											{!! $professional->getAllProfessionalCategoryOptions() !!}
										</select>
									</div>
								</div>
							</form>
						</div>
						<table class="layui-hide" id="professionalList" lay-filter="professionalList"></table>
						<script type="text/html" id="professionalListOperate">
							<button class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit">@lang('comment/form.edit')</button>
							<button class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">@lang('comment/form.del')</button>
						</script>
						<script type="text/html" id="professionalLevel">
							@{{#  if(d.professional_level === 0){ }}
							<span class="layui-badge layui-bg-blue">@lang('admin/professional.professional_specialist')</span>
							@{{#  } else { }}
							<span class="layui-badge layui-bg-orange">@lang('admin/professional.professional_bachelor')</span>
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
        let professionalIndexUrl = '{{ route('admin.professional.index') }}';
        let professionalListUrl = '{{ route('admin.professional.page') }}';
        let professionalBatchDeleteUrl = '{{ route('admin.professional.delete') }}';

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
                    elem: '#professionalList'
                    , url: professionalListUrl
                    , cellMinWidth: 80
                    , even: true
                    , page: true
                    , limit: '{{ config("admin.per_page") }}'
                    , cols: [[
                        {type: 'checkbox', fixed: 'left'}
                        , {field: 'id', title: 'ID', width: 80, sort: true, fixed: 'left'}
                        , {field: 'professional_name', title: '@lang('admin/professional.professional_name')'}
                        , {field: 'professional_code', align: "center", title: '@lang('admin/professional.professional_code')'}
                        , {field: 'awarded_degree', align: "center", title: '@lang('admin/professional.awarded_degree')', templet: '<div>@{{ d.professional_detail.awarded_degree }}</div>'}
                        , {field: 'professional_level', align: "center", title: '@lang('admin/professional.professional_level')', templet: '#professionalLevel'}
                        , {field: 'created_at', align: "center", width: 200, title: '@lang('comment/table.created_at')', sort: true}
                        , {align: 'center', width: 200, title: '@lang('comment/table.action')', fixed: 'right', toolbar: '#professionalListOperate'}
                    ]]
                });
            }

            //表单监听
            form.on('select(parent_id)', function (data) {
                professionalListUrl = '{{ route('admin.professional.page') }}';
                professionalListUrl = professionalListUrl + '?top_parent_id=' + data.value;
                render();
            });
            render()

            active = {
                professionalCategoryAdd: function () {
                    layer.open({
                        type: 2
                        , content: '{{ route('admin.professional.create') }}'
                        , shadeClose: true
                        , area: admin.screen() < 2 ? ['100%', '80%'] : ['50%', '500px']
                        , maxmin: true
                    });
                }
                , BatchDel: function () { //获取选中数据
                    let checkStatus = table.checkStatus('professionalList')
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
                            url: professionalBatchDeleteUrl,
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
            table.on('tool(professionalList)', function (obj) {
                let layEvent = obj.event;
                let data = obj.data;
                if (layEvent === 'edit') {
                    layer.open({
                        type: 2
                        , content: professionalIndexUrl + '/' + data.id + '/edit'
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
                            url: professionalIndexUrl + '/' + data.id,
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
                }
            });
        });
	</script>
@endsection()
