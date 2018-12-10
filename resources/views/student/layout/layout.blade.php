@include('student.common.header')
<body>
<header>
	<div class="top container">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-6 top_left">
				黑马高考<span>|</span>自主招生
			</div>
			<div class="col-md-6 col-sm-6 col-xs-6 top_right">
				欢迎，{{ Auth::guard('student')->user()->nickname }}<span>|</span>退出
			</div>
		</div>
	</div>
	<div class="banner">
		<img src="{{ asset('theme/layui/images/banner.jpg') }}" class="img-responsive">
	</div>
</header>
<div class="user bg">
	<div class="container">
		<div class="row">
			<div class="userLeft col-md-3 col-sm-3">
				<div class="userPhoto">
					<dl>
						<dd class="userPhotoWrap">
							<input type="file" id="file" name="" style="display: none"/>
							<label for="file" id="image"><img src="{{ asset('theme/layui/images/photo.jpg') }}"></label>
							<p>{{ Auth::guard('student')->user()->nickname }}</p>
						</dd>
					</dl>
				</div>
				<nav class="navBar" class="navbar-default navbar-static-side">
					<div class="sidebar-collapse">
						<ul class="nav">
							<li><a href="{{ route('student.dashboard') }}" class="active">首页</a></li>
							<li>
								<a href="javascript:void(0);">账号管理<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a>
								<ul class="navBar1">
									<li>
										<a href="{{ route('student.dashboard') }}">用户信息</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="javascript:void(0);">信息管理<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a>
								<ul class="navBar1">
									<li>
										<a href="{{ route('student.score') }}">成绩信息</a>
									</li>
									<li>
										<a href="{{ route('student.score.show') }}">院校推荐</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			</div>
			@yield('content')
@include('student.common.footer')



