@extends('admin.layouts.wrap')
@section('content')
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/college.province_control_score_list')</div>
					<div class="layui-card-body">
						<div class="table-action-button" style="margin-bottom: 10px;">
							<button class="layui-btn layui-btn-normal" data-type="ProvinceControlScoreAdd">
								<i class="layui-icon">&#xe61f;</i>@lang('admin/college.province_control_score_add')
							</button>
							<button class="layui-btn layui-btn-danger" data-type="BatchDel">
								<i class="layui-icon">&#xe640;</i>@lang('comment/form.batch_del')
							</button>
							<form class="layui-form" style="display:inline">
								<div class="layui-inline">
									<div class="layui-input-inline">
										@inject('provinces','App\Services\ProvinceService')
										<select name="modules" lay-filter="province" lay-search="">
											<option value="">@lang('admin/college.select_province')</option>
											{!! $provinces->getAllProvincesOptions() !!}
										</select>
									</div>
								</div>
							</form>
						</div>
						<table class="layui-hide" id="ProvinceControlScoreList" lay-filter="ProvinceControlScoreList"></table>
						<script type="text/html" id="categorListOperate">
							<button class="layui-btn layui-btn-primary layui-btn-xs" lay-event="view">@lang('comment/form.view')</button>
							<button class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit">@lang('comment/form.edit')</button>
							<button class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">@lang('comment/form.del')</button>
						</script>
						<script type="text/html" id="subject">
							@{{#  if(d.subject === 1){ }}
							<span class="layui-badge layui-bg-blue">@lang('admin/college.subject_math')</span>
							@{{#  } else { }}
							<span class="layui-badge layui-bg-orange">@lang('admin/college.subject_art')</span>
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
        let ProvinceControlScoreIndexUrl = '{{ route('admin.province.score.index') }}';
        let ProvinceControlScoreListUrl = '{{ route('admin.province.score.page') }}';
        let ProvinceControlScoreBatchDeleteUrl = '{{ route('admin.province.score.delete') }}';
        layui.config({
            base: '/theme/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['index', 'table', 'form'], function () {
            let $ = layui.$
                , admin = layui.admin
                , form = layui.form
                , table = layui.table;

            function render() {
                table.render({
                    elem: '#ProvinceControlScoreList'
                    , url: ProvinceControlScoreListUrl
                    , cellMinWidth: 80
                    , even: true
                    , page: true
                    , limit: '{{ config("admin.per_page") }}'
                    , cols: [[
                        {type: 'checkbox', fixed: 'left'}
                        , {field: 'id', title: 'ID', width: 80, sort: true, fixed: 'left'}
                        , {field: 'province_id', align: "center", title: '@lang('admin/college.province_id')', templet: '<div>@{{d.province.province_name||" "}}  </div>'}
                        , {field: 'year', align: "center", sort: true, title: '@lang('admin/college.year')'}
                        , {field: 'batch', align: "center", title: '@lang('admin/college.batch')'}
                        , {field: 'score', align: "center", sort: true, title: '@lang('admin/college.score')'}
                        , {field: 'subject', align: "center", sort: true, title: '@lang('admin/college.score')', templet: '#subject'}
                        , {align: 'center', width: 200, title: '@lang('comment/table.action')', fixed: 'right', toolbar: '#categorListOperate'}
                    ]]
                });
            }

            //表单监听
            form.on('select(province)', function (data) {
                ProvinceControlScoreListUrl = '{{ route('admin.province.score.page') }}';
                ProvinceControlScoreListUrl = ProvinceControlScoreListUrl + '?province_id=' + data.value;
                render();
            });

            render();

            active = {
                ProvinceControlScoreAdd: function () {
                    layer.open({
                        type: 2
                        , content: '{{ route('admin.province.score.create') }}'
                        , shadeClose: true
                        , area: admin.screen() < 2 ? ['100%', '80%'] : ['50%', '550px']
                        , maxmin: true
                    });
                }
                , BatchDel: function () { //获取选中数据
                    let checkStatus = table.checkStatus('ProvinceControlScoreList')
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
                            url: ProvinceControlScoreBatchDeleteUrl,
                            type: "DELETE",
                            data: {"ids": ids},
                            dataType: "json",
                            success: function (data) {
                                if (data.status_code === 200) {
                                    layer.msg("删除成功", {icon: 6});
                                    window.location.reload();
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
            table.on('tool(ProvinceControlScoreList)', function (obj) {
                let layEvent = obj.event;
                let data = obj.data;
                if (layEvent === 'edit') {
                    layer.open({
                        type: 2
                        , content: ProvinceControlScoreIndexUrl + '/' + data.id + '/edit'
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
                            url: ProvinceControlScoreIndexUrl + '/' + data.id,
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
                    window.location.href = ProvinceControlScoreIndexUrl + '/' + data.province.id
                }
            });
        });
	</script>
@endsection()
