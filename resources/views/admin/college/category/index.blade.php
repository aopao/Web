@extends('admin.layouts.wrap')
@section('content')
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/college.college_category_list')</div>
					<div class="layui-card-body">
						<div class="table-action-button" style="margin-bottom: 10px;">
							<button class="layui-btn layui-btn-normal" data-type="collegeCategoryAdd">
								<i class="layui-icon">&#xe61f;</i>@lang('admin/college.college_category_add')
							</button>
						</div>
						<table class="layui-hide" id="CollegeCategoryList" lay-filter="CollegeCategoryList"></table>
						<script type="text/html" id="categorListOperate">
							<button class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit">@lang('comment/form.edit')</button>
							<button class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">@lang('comment/form.del')</button>
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection()
@section('js')
	<script>
        let CollegeCategoryIndexUrl = '{{ route('admin.college.category.index') }}';
        let CollegeCategoryListUrl = '{{ route('admin.college.category.page') }}';
        layui.config({
            base: '/theme/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['index', 'table'], function () {
            let $ = layui.$
                , admin = layui.admin
                , table = layui.table;

            table.render({
                elem: '#CollegeCategoryList'
                , url: CollegeCategoryListUrl
                , cellMinWidth: 80
                , even: true
                , page: true
                , limit: '{{ config("admin.per_page") }}'
                , cols: [[
                    {field: 'id', title: 'ID', width: 80, sort: true, fixed: true}
                    , {field: 'category_name', title: '@lang('admin/college.category_name')'}
                    , {field: 'created_at', align: "center", width: 200, title: '@lang('comment/table.created_at')', sort: true}
                    , {align: 'center', width: 200, title: '@lang('comment/table.action')', fixed: 'right', toolbar: '#categorListOperate'}
                ]]
            });

            active = {
                collegeCategoryAdd: function () {
                    layer.open({
                        type: 2
                        , content: '{{ route('admin.college.category.create') }}'
                        , shadeClose: true
                        , area: admin.screen() < 2 ? ['100%', '80%'] : ['50%', '500px']
                        , maxmin: true
                    });
                },
            };

            $('.table-action-button .layui-btn').on('click', function () {
                let type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });

            //监听工具条
            table.on('tool(CollegeCategoryList)', function (obj) {
                let layEvent = obj.event;
                let data = obj.data;
                if (layEvent === 'edit') {
                    layer.open({
                        type: 2
                        , content: CollegeCategoryIndexUrl + '/' + data.id + '/edit'
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
                            url: CollegeCategoryIndexUrl + '/' + data.id,
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
