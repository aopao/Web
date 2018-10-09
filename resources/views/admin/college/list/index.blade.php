@extends('admin.layouts.wrap')
@section('content')
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">@lang('admin/college.college_list')</div>
					<div class="layui-card-body">
						<div class="table-action-button" style="margin-bottom: 10px;">
							<button class="layui-btn layui-btn-normal" data-type="CollegeAdd">
								<i class="layui-icon">&#xe61f;</i>@lang('admin/college.college_add')
							</button>
							<button class="layui-btn layui-btn-danger" data-type="BatchDel">
								<i class="layui-icon">&#xe640;</i>@lang('comment/form.batch_del')
							</button>
							<div class="layui-form" style="display:inline">
								<div class="layui-inline">
									<div class="layui-input-inline">
										<input type="text" name="college_name" id="college_name" value="" placeholder="@lang('admin/college.input_college_name')" autocomplete="off" class="layui-input">
									</div>
								</div>
								<div class="layui-inline">
									<div class="layui-input-inline">
										@inject('provinces','App\Services\ProvinceService')
										<select name="province_id" id="province_id" lay-filter="province" lay-search="">
											<option value="">@lang('admin/college.select_province')</option>
											{!! $provinces->getAllProvincesOptions() !!}
										</select>
									</div>
								</div>
								<button class="layui-btn layui-btn-normal layuiadmin-btn-list" id="search" data-type="Search">
									<i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
								</button>
							</div>
						</div>
						<table class="layui-hide" id="CollegeList" lay-filter="CollegeList"></table>
						<script type="text/html" id="collegeListOperate">
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
						<script type="text/html" id="college_attribute">
							@{{# if(d.is_985 === 1){ }}
							<span class="layui-badge layui-bg-blue">@lang('admin/college.985')</span>
							@{{#  } }}
							@{{# if(d.is_211 === 1){ }}
							<span class="layui-badge layui-bg-green">@lang('admin/college.211')</span>
							@{{#  } }}
							@{{# if(d.is_nation === 1){ }}
							<span class="layui-badge layui-bg-orange">@lang('admin/college.nation')</span>
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
        let CollegeIndexUrl = '{{ route('admin.college.index') }}';
        let CollegeListUrl = '{{ route('admin.college.page') }}';
        let CollegeBatchDeleteUrl = '{{ route('admin.college.delete') }}';
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
                    elem: '#CollegeList'
                    , url: CollegeListUrl
                    , cellMinWidth: 80
                    , even: true
                    , page: true
                    , limit: '{{ config("admin.per_page") }}'
                    , cols: [[
                        {type: 'checkbox', fixed: 'left'}
                        , {field: 'id', title: 'ID', width: 80, sort: true, fixed: 'left'}
                        , {field: 'college_name', title: '@lang('admin/college.college_name')'}
                        , {field: 'college_level_id', title: '@lang('admin/college.college_level_id')', templet: '<div>@{{d.college_level.level_name ||" "}}  </div>'}
                        , {field: 'college_code', align: "center", title: '@lang('admin/college.college_code')', templet: '<div>@{{d.college_detail.college_code||" "}}  </div>'}
                        , {field: 'province_id', align: "center", title: '@lang('admin/college.province_id')', templet: '<div>@{{d.province.province_name||" "}}  </div>'}
                        , {field: 'college_category_id', align: "center", title: '@lang('admin/college.college_category_id')', templet: '<div>@{{d.college_category.category_name ||" "}}  </div>'}
                        , {field: 'college_attribute', align: "center", sort: true, title: '@lang('admin/college.college_attribute')', templet: '#college_attribute'}
                        , {align: 'center', width: 200, title: '@lang('comment/table.action')', fixed: 'right', toolbar: '#collegeListOperate'}
                    ]]
                });
            }

            //表单监听
            form.on('select(province)', function (data) {
                CollegeListUrl = '{{ route('admin.college.page') }}';
                let college_name = $('#college_name').val()
                CollegeListUrl = CollegeListUrl + '?college_name=' + college_name + '&province_id=' + data.value;
                render();
            });

            render();

            active = {
                CollegeAdd: function () {
                    layer.open({
                        type: 2
                        , content: '{{ route('admin.college.create') }}'
                        , shadeClose: true
                        , area: admin.screen() < 2 ? ['100%', '80%'] : ['50%', '550px']
                        , maxmin: true
                    });
                }
                , BatchDel: function () { //获取选中数据
                    let checkStatus = table.checkStatus('CollegeList')
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
                            url: CollegeBatchDeleteUrl,
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
                , Search: function () {
                    CollegeListUrl = '{{ route('admin.college.page') }}';
                    let college_name = $('#college_name').val()
                    let province_id = $('#province_id').val()
                    CollegeListUrl = CollegeListUrl + '?college_name=' + college_name + '&province_id=' + province_id;
                    render()
                }
            };

            $('.table-action-button .layui-btn').on('click', function () {
                let type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });

            //监听工具条
            table.on('tool(CollegeList)', function (obj) {
                let layEvent = obj.event;
                let data = obj.data;
                if (layEvent === 'edit') {
                    layer.open({
                        type: 2
                        , content: CollegeIndexUrl + '/' + data.id + '/edit'
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
                            url: CollegeIndexUrl + '/' + data.id,
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
                } else if (obj.event === 'viewCities') {
                    layer.open({
                        type: 2
                        , content: CollegeIndexUrl + '/' + data.id + '/edit'
                        , shadeClose: true
                        , area: admin.screen() < 2 ? ['100%', '80%'] : ['50%', '500px']
                        , maxmin: true
                    });
                } else if (layEvent === 'view') {
                    window.location.href = CollegeIndexUrl + '/' + data.province.id
                }
            });
        });
	</script>
@endsection()
