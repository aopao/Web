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
												<a lay-href="component/layer/list.html">
													<i class="layui-icon layui-icon-website"></i>
													<cite>弹层</cite>
												</a>
											</li>
											<li class="layui-col-xs3">
												<a lay-href="component/button/index.html">
													<i class="layui-icon layui-icon-find-fill"></i>
													<cite>按钮</cite>
												</a>
											</li>
											<li class="layui-col-xs3">
												<a lay-href="component/progress/index.html">
													<i class="layui-icon layui-icon-loading-2"></i>
													<cite>进度条</cite>
												</a>
											</li>
											<li class="layui-col-xs3">
												<a layadmin-event="im">
													<i class="layui-icon layui-icon-chat"></i>
													<cite>聊天</cite>
												</a>
											</li>
											<li class="layui-col-xs3">
												<a lay-href="component/panel/index.html">
													<i class="layui-icon layui-icon-read"></i>
													<cite>面板</cite>
												</a>
											</li>
											<li class="layui-col-xs3">
												<a lay-href="component/badge/index.html">
													<i class="layui-icon layui-icon-tree"></i>
													<cite>徽章</cite>
												</a>
											</li>
											<li class="layui-col-xs3">
												<a lay-href="set/system/website.html">
													<i class="layui-icon layui-icon-set"></i>
													<cite>网站设置</cite>
												</a>
											</li>
											<li class="layui-col-xs3">
												<a lay-href="set/user/password.html">
													<i class="layui-icon layui-icon-password"></i>
													<cite>密码</cite>
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


