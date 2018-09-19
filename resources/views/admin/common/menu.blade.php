<div class="layui-side layui-side-menu">
	<div class="layui-side-scroll">
		<div class="layui-logo" lay-href="home/console.html">
			<span>layuiAdmin</span>
		</div>
		<ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu"
			lay-filter="layadmin-system-side-menu">
			<li data-name="home" class="layui-nav-item">
				<a href="javascript:void(0);" lay-tips="主页" lay-direction="1">
					<i class="layui-icon layui-icon-home"></i>
					<cite>主页</cite>
				</a>
				<dl class="layui-nav-child">
					<dd data-name="console" class="layui-this">
						<a lay-href="{{ route('admin.dashboard.show') }}">控制台</a>
					</dd>
				</dl>
			</li>

			<li data-name="college" class="layui-nav-item">
				<a href="javascript:void(0);" lay-tips="院校" lay-direction="2">
					<i class="layui-icon layui-icon-component"></i>
					<cite>院校管理</cite>
				</a>
				<dl class="layui-nav-child">
					<dd>
						<a lay-href="{{ route('admin.college.index') }}">院校列表</a>
					</dd>
					<dd>
						<a lay-href="{{ route('admin.college.create') }}">添加院校</a>
					</dd>
					<dd>
						<a lay-href="{{ route('admin.college.level.index') }}">层次列表</a>
					</dd>
					<dd>
						<a lay-href="{{ route('admin.college.category.index') }}">类型列表</a>
					</dd>
					<dd>
						<a lay-href="{{ route('admin.batch.index') }}">批次列表</a>
					</dd>
				</dl>
			</li>
			<li data-name="professional" class="layui-nav-item">
				<a href="javascript:void(0);" lay-tips="专业" lay-direction="4">
					<i class="layui-icon layui-icon-template-1"></i>
					<cite>专业管理</cite>
				</a>
				<dl class="layui-nav-child">
					<dd>
						<a lay-href="{{ route('admin.professional.category.index') }}">专业分类列表</a>
					</dd>
					<dd>
						<a lay-href="{{ route('admin.professional.index') }}">专业详细列表</a>
					</dd>
				</dl>
			</li>
			<li data-name="data" class="layui-nav-item">
				<a href="javascript:void(0);" lay-tips="数据" lay-direction="3">
					<i class="layui-icon layui-icon-search"></i>
					<cite>数据查询</cite>
				</a>
				<dl class="layui-nav-child">
					<dd>
						<a lay-href="{{ route('admin.province.score.index') }}">历年省控线查询</a>
					</dd>
					<dd>
						<a lay-href="{{ route('admin.college.create') }}">大学录取分数线</a>
					</dd>
				</dl>
			</li>
			<li data-name="data_import" class="layui-nav-item">
				<a href="javascript:void(0);" lay-tips="数据维护" lay-direction="3">
					<i class="layui-icon layui-icon-list"></i>
					<cite>数据维护</cite>
				</a>
				<dl class="layui-nav-child">
					<dd>
						<a lay-href="{{ route('admin.province.score.index') }}">数据检索</a>
					</dd>
					<dd>
						<a lay-href="{{ route('admin.college.create') }}">数据查重</a>
					</dd>
					<dd>
						<a lay-href="{{ route('admin.province.score.create') }}">数据采集</a>
					</dd>
					<dd>
						<a lay-href="{{ route('admin.province.score.create') }}">高级导入</a>
					</dd>
				</dl>
			</li>
			<li data-name="agent" class="layui-nav-item">
				<a href="javascript:void(0);" lay-tips="代理管理" lay-direction="4">
					<i class="layui-icon layui-icon-user"></i>
					<cite>代理管理</cite>
				</a>
				<dl class="layui-nav-child">
					<dd>
						<a lay-href="{{ route('admin.province.index') }}">代理商列表</a>
					</dd>
					<dd>
						<a lay-href="{{ route('admin.college.create') }}">添加代理商</a>
					</dd>
				</dl>
			</li>
			<li data-name="student" class="layui-nav-item">
				<a href="javascript:void(0);" lay-tips="代理管理" lay-direction="4">
					<i class="layui-icon layui-icon-username"></i>
					<cite>学生管理</cite>
				</a>
				<dl class="layui-nav-child">
					<dd>
						<a lay-href="{{ route('admin.province.index') }}">学生列表</a>
					</dd>
					<dd>
						<a lay-href="{{ route('admin.college.create') }}">添加学生</a>
					</dd>
				</dl>
			</li>
			<li data-name="event" class="layui-nav-item">
				<a href="javascript:void(0);" lay-tips="赛事" lay-direction="4">
					<i class="layui-icon layui-icon-notice"></i>
					<cite>赛事管理</cite>
				</a>
				<dl class="layui-nav-child">
					<dd>
						<a lay-href="{{ route('admin.province.index') }}">赛事列表</a>
					</dd>
					<dd>
						<a lay-href="{{ route('admin.college.create') }}">添加赛事</a>
					</dd>
				</dl>
			</li>
			<li data-name="article" class="layui-nav-item">
				<a href="javascript:void(0);" lay-tips="资讯" lay-direction="4">
					<i class="layui-icon layui-icon-read"></i>
					<cite>资讯管理</cite>
				</a>
				<dl class="layui-nav-child">
					<dd>
						<a lay-href="{{ route('admin.province.index') }}">资讯列表</a>
					</dd>
					<dd>
						<a lay-href="{{ route('admin.college.create') }}">添加资讯</a>
					</dd>
				</dl>
			</li>
			<li data-name="region" class="layui-nav-item">
				<a href="javascript:void(0);" lay-tips="地域" lay-direction="4">
					<i class="layui-icon layui-icon-location"></i>
					<cite>地域管理</cite>
				</a>
				<dl class="layui-nav-child">
					<dd>
						<a lay-href="{{ route('admin.province.index') }}">省份列表</a>
					</dd>
					<dd>
						<a lay-href="{{ route('admin.city.index') }}">城市列表</a>
					</dd>
					<dd>
						<a lay-href="{{ route('admin.college.level.index') }}">地区列表</a>
					</dd>
				</dl>
			</li>
			<li data-name="log" class="layui-nav-item">
				<a href="javascript:void(0);" lay-tips="系统日志" lay-direction="4">
					<i class="layui-icon layui-icon-speaker"></i>
					<cite>系统日志</cite>
				</a>
				<dl class="layui-nav-child">
					<dd>
						<a lay-href="{{ route('log.student.login.index') }}">学生登录日志</a>
					</dd>
					<dd>
						<a lay-href="{{ route('log.agent.login.index') }}">代理商登录日志</a>
					</dd>
					<dd>
						<a lay-href="{{ route('log.admin.login.index') }}">管理员操作日志</a>
					</dd>
				</dl>
			</li>
			<li data-name="friendlink" class="layui-nav-item">
				<a href="javascript:void(0);" lay-tips="友链管理" lay-direction="4">
					<i class="layui-icon layui-icon-senior"></i>
					<cite>友链管理</cite>
				</a>
				<dl class="layui-nav-child">
					<dd>
						<a lay-href="{{ route('admin.province.index') }}">友情链接列表</a>
					</dd>
					<dd>
						<a lay-href="{{ route('admin.college.create') }}">添加友情链接</a>
					</dd>
				</dl>
			</li>
			<li data-name="setting" class="layui-nav-item">
				<a href="javascript:void(0);" lay-tips="系统" lay-direction="4">
					<i class="layui-icon layui-icon-set"></i>
					<cite>系统管理</cite>
				</a>
				<dl class="layui-nav-child">
					<dd>
						<a lay-href="{{ route('admin.province.index') }}">网站设置</a>
					</dd>
					<dd>
						<a lay-href="{{ route('admin.college.create') }}">邮箱设置</a>
					</dd>
					<dd>
						<a lay-href="{{ route('admin.college.level.index') }}">短信设置</a>
					</dd>
				</dl>
			</li>
		</ul>
	</div>
</div>