@extends('student.layout.layout')
@section('content')
	<div class="userRight col-md-9 col-sm-9">
		<h2><i class="fa fa-fw fa-user" aria-hidden="true"></i>用户信息</h2>
		<form id="userInfo" action="#">
			<h3><span class="leftBorder">基本信息</span></h3>
			<ul class="basicInfo">
				<li>
					<label class="inline-block">会员账号：</label>{{ Auth::guard('student')->user()->nickname }}</li>
				<li>
					<label class="inline-block">手机：</label>{{ Auth::guard('student')->user()->mobile }}
			</ul>
		</form>
	</div>
	</div>
	</div>
@endsection()