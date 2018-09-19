<div class="layui-header">
	<!-- 头部区域 -->
	<ul class="layui-nav layui-layout-left">
		<li class="layui-nav-item layadmin-flexible" lay-unselect>
			<a href="javascript:void(0);" layadmin-event="flexible" title="侧边伸缩">
				<i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
			</a>
		</li>
		<li class="layui-nav-item layui-hide-xs" lay-unselect>
			<a href="" target="_blank" title="首页">
				<i class="layui-icon layui-icon-website"></i>
			</a>
		</li>
		<li class="layui-nav-item" lay-unselect>
			<a href="javascript:void(0);" layadmin-event="refresh" title="刷新">
				<i class="layui-icon layui-icon-refresh-3"></i>
			</a>
		</li>
	</ul>
	<ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">
		<li class="layui-nav-item" lay-unselect>
			<a href="javascript:void(0);">
				<cite>{{ Auth::guard('admin')->user()->nickname }}</cite>
			</a>
			<dl class="layui-nav-child">
				<dd><a lay-href="set/user/info.html">基本资料</a></dd>
				<dd><a lay-href="set/user/password.html">修改密码</a></dd>
				<hr/>
				<dd style="text-align: center;">
					<a></a>
					<a href="{{ route('admin.logout') }}"
					   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
						退出
					</a>

					<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</dd>
			</dl>
		</li>
		<li class="layui-nav-item layui-hide-xs" lay-unselect>
			<a href="javascript:void(0);" layadmin-event="theme">
				<i class="layui-icon layui-icon-theme"></i>
			</a>
		</li>
	</ul>
</div>