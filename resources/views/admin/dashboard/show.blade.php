@extends('admin.layouts.wrap')
@section('content')
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md8">
				<div class="layui-row layui-col-space15">
					<div class="layui-col-md6">
						<div class="layui-card">
							<div class="layui-card-header">快捷方式</div>
							<div class="layui-card-body">
								<div class="layui-carousel layadmin-carousel layadmin-shortcut">
									<div carousel-item>
										<ul class="layui-row layui-col-space10">
											<li class="layui-col-xs3">
												<a lay-href="{{ route('admin.agent.index') }}">
													<i class="layui-icon layui-icon-website"></i>
													<cite>@lang('admin/dashboard.agent_list')</cite>
												</a>
											</li>
											<li class="layui-col-xs3">
												<a lay-href="{{ route('admin.college.index') }}">
													<i class="layui-icon layui-icon-find-fill"></i>
													<cite>@lang('admin/dashboard.college_list')</cite>
												</a>
											</li>
											<li class="layui-col-xs3">
												<a lay-href="{{ route('admin.college.category.index') }}">
													<i class="layui-icon layui-icon-loading-2"></i>
													<cite>@lang('admin/dashboard.college_category_list')</cite>
												</a>
											</li>
											<li class="layui-col-xs3">
												<a lay-href="{{ route('admin.college.diplomas.index') }}">
													<i class="layui-icon layui-icon-chat"></i>
													<cite>@lang('admin/dashboard.college_level_list')</cite>
												</a>
											</li>
											<li class="layui-col-xs3">
												<a lay-href="{{ route('admin.major.index') }}">
													<i class="layui-icon layui-icon-read"></i>
													<cite>@lang('admin/dashboard.professional_list')</cite>
												</a>
											</li>
											<li class="layui-col-xs3">
												<a lay-href="{{ route('admin.province.score.index') }}">
													<i class="layui-icon layui-icon-tree"></i>
													<cite>@lang('admin/dashboard.province_control_score_list')</cite>
												</a>
											</li>
											<li class="layui-col-xs3">
												<a lay-href="{{ route('admin.agent.index') }}">
													<i class="layui-icon layui-icon-set"></i>
													<cite>@lang('admin/dashboard.student_list')</cite>
												</a>
											</li>
											<li class="layui-col-xs3">
												<a lay-href="{{ route('admin.agent.index') }}">
													<i class="layui-icon layui-icon-password"></i>
													<cite>@lang('admin/dashboard.student_list')</cite>
												</a>
											</li>
										</ul>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection()
@section('js')
	<script>
        layui.config({
            base: '/theme/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['index', 'console']);
	</script>
@endsection()


