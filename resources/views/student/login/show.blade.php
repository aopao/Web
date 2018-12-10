<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>黑马高考后台管理系统</title>
		<link rel="stylesheet" href="{{ asset("theme/layui/css/base.css") }}" media="all">
	</head>
	<body>
		<div class="header Cgreen">
			<div class="wrapper clearfix">
			<h1>黑马高考后台管理系统</h1>
			<span class="QRspan">
				<i class="iconfont">&#xe61b;</i>
				<span>关注公众号</span>
				<img class="QRimg" src="{{ asset("theme/layui/images/qr.png") }}"/>
			</span>
			</div>
		</div>
		<div class="content">
			<div class="wrapper">
				<img class="bg1" src="{{ asset("theme/layui/images/bg1.png") }}"/>
				<div class="loginBox">
					<div class="logo"></div>
					<div class="formDiv">
						<form action="{{ route('student.login') }}" method="post">
							<label class="user">
								<input type="text" name="mobile" placeholder="请输入用户名" value="{{ old('mobile') }}"/>
								<i class="iconfont">&#xe614;</i>
							</label>
							<label class="pwd">
								<input type="password" name="password" placeholder="请输入密码" value="{{ old('password') }}"/>
								<i class="iconfont">&#xe615;</i>
							</label>
							{{ csrf_field() }}
							<input type="submit" class="submit" value="登录">
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="footer">
			<div class="wrapper">
			<span>Copyright © 2005-2018 版权所有 京ICP备16039949号-1 京公网备案 11010802022079号</span>
			</div>
		</div>
	</body>
	<script>
		window.onload = function() {
			setContentHeight();
			window.onresize = setContentHeight;
			function setContentHeight () {
				let windowHeight = document.documentElement.clientHeight;
				document.getElementsByClassName('content')[0].style.height = windowHeight - 102 - 138 + 'px';
			}
		}
	</script>
</html>
