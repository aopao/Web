@extends('student.layout.layout')
@section('content')
	<div class="userRight col-md-9 col-sm-9">
		<h2><span class="leftBorder">成绩信息</span></h2>
		<div class="table-responsive userTable">
			<form action="{{ route('student.score') }}" method="post">
				<table class="table table-striped table-responsive table-bordered">
					<thead>
					<tr>
						<th style="vertical-align: middle;">科目\学期</th>
						<th>高一（上）期末<br>成绩/满分</th>
						<th>高一（下）期末<br>成绩/满分</th>
						<th>高二（上）期末<br>成绩/满分</th>
						<th>高二（下）期末<br>成绩/满分</th>
						<th>高三（上）期末<br>成绩/满分</th>
						<th>会考<br>成绩/满分</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>语文</td>
						<td><input type="text" name="yuwen_gaoyi_shang_chengji" maxlength="10" value="{{ $data['yuwen_gaoyi_shang_chengji'] or "" }}">/<input type="text" name="yuwen_gaoyi_shang_manfen" maxlength="10" value="{{ $data['yuwen_gaoyi_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="yuwen_gaoyi_xia_chengji" maxlength="10" value="{{ $data['yuwen_gaoyi_xia_chengji'] or "" }}">/<input type="text" name="yuwen_gaoyi_xia_manfen" maxlength="10" value="{{ $data['yuwen_gaoyi_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="yuwen_gaoer_shang_chengji" maxlength="10" value="{{ $data['yuwen_gaoer_shang_chengji'] or "" }}">/<input type="text" name="yuwen_gaoer_shang_manfen" maxlength="10" value="{{ $data['yuwen_gaoer_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="yuwen_gaoer_xia_chengji" maxlength="10" value="{{ $data['yuwen_gaoer_xia_chengji'] or "" }}">/<input type="text" name="yuwen_gaoer_xia_manfen" maxlength="10" value="{{ $data['yuwen_gaoer_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="yuwen_gaosan_shang_chengji" maxlength="10" value="{{ $data['yuwen_gaosan_shang_chengji'] or "" }}">/<input type="text" name="yuwen_gaosan_shang_manfen" maxlength="10" value="{{ $data['yuwen_gaosan_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="yuwen_huikao_chengji" maxlength="10" value="{{ $data['yuwen_huikao_chengji'] or "" }}">/<input type="text" name="yuwen_huikao_manfen" maxlength="10" value="{{ $data['yuwen_huikao_manfen'] or "" }}"></td>
					</tr>
					<tr>
						<td>数学</td>
						<td><input type="text" name="shuxue_gaoyi_shang_chengji" maxlength="10" value="{{ $data['shuxue_gaoyi_shang_chengji'] or "" }}">/<input type="text" name="shuxue_gaoyi_shang_manfen" maxlength="10" value="{{ $data['shuxue_gaoyi_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="shuxue_gaoyi_xia_chengji" maxlength="10" value="{{ $data['shuxue_gaoyi_xia_chengji'] or "" }}">/<input type="text" name="shuxue_gaoyi_xia_manfen" maxlength="10" value="{{ $data['shuxue_gaoyi_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="shuxue_gaoer_shang_chengji" maxlength="10" value="{{ $data['shuxue_gaoer_shang_chengji'] or "" }}">/<input type="text" name="shuxue_gaoer_shang_manfen" maxlength="10" value="{{ $data['shuxue_gaoer_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="shuxue_gaoer_xia_chengji" maxlength="10" value="{{ $data['shuxue_gaoer_xia_chengji'] or "" }}">/<input type="text" name="shuxue_gaoer_xia_manfen" maxlength="10" value="{{ $data['shuxue_gaoer_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="shuxue_gaosan_shang_chengji" maxlength="10" value="{{ $data['shuxue_gaosan_shang_chengji'] or "" }}">/<input type="text" name="shuxue_gaosan_shang_manfen" maxlength="10" value="{{ $data['shuxue_gaosan_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="shuxue_huikao_chengji" maxlength="10" value="{{ $data['shuxue_huikao_chengji'] or "" }}">/<input type="text" name="shuxue_huikao_manfen" maxlength="10" value="{{ $data['shuxue_huikao_manfen'] or "" }}"></td>
					</tr>
					<tr>
						<td>外语</td>
						<td><input type="text" name="waiyu_gaoyi_shang_chengji" maxlength="10" value="{{ $data['waiyu_gaoyi_shang_chengji'] or "" }}">/<input type="text" name="waiyu_gaoyi_shang_manfen" maxlength="10" value="{{ $data['waiyu_gaoyi_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="waiyu_gaoyi_xia_chengji" maxlength="10" value="{{ $data['waiyu_gaoyi_xia_chengji'] or "" }}">/<input type="text" name="waiyu_gaoyi_xia_manfen" maxlength="10" value="{{ $data['waiyu_gaoyi_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="waiyu_gaoer_shang_chengji" maxlength="10" value="{{ $data['waiyu_gaoer_shang_chengji'] or "" }}">/<input type="text" name="waiyu_gaoer_shang_manfen" maxlength="10" value="{{ $data['waiyu_gaoer_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="waiyu_gaoer_xia_chengji" maxlength="10" value="{{ $data['waiyu_gaoer_xia_chengji'] or "" }}">/<input type="text" name="waiyu_gaoer_xia_manfen" maxlength="10" value="{{ $data['waiyu_gaoer_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="waiyu_gaosan_shang_chengji" maxlength="10" value="{{ $data['waiyu_gaosan_shang_chengji'] or "" }}">/<input type="text" name="waiyu_gaosan_shang_manfen" maxlength="10" value="{{ $data['waiyu_gaosan_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="waiyu_huikao_chengji" maxlength="10" value="{{ $data['waiyu_huikao_chengji'] or "" }}">/<input type="text" name="waiyu_huikao_manfen" maxlength="10" value="{{ $data['waiyu_huikao_manfen'] or "" }}"></td>
					</tr>
					<tr>
						<td>政治</td>
						<td><input type="text" name="zhengzhi_gaoyi_shang_chengji" maxlength="10" value="{{ $data['zhengzhi_gaoyi_shang_chengji'] or "" }}">/<input type="text" name="zhengzhi_gaoyi_shang_manfen" maxlength="10" value="{{ $data['zhengzhi_gaoyi_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="zhengzhi_gaoyi_xia_chengji" maxlength="10" value="{{ $data['zhengzhi_gaoyi_xia_chengji'] or "" }}">/<input type="text" name="zhengzhi_gaoyi_xia_manfen" maxlength="10" value="{{ $data['zhengzhi_gaoyi_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="zhengzhi_gaoer_shang_chengji" maxlength="10" value="{{ $data['zhengzhi_gaoer_shang_chengji'] or "" }}">/<input type="text" name="zhengzhi_gaoer_shang_manfen" maxlength="10" value="{{ $data['zhengzhi_gaoer_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="zhengzhi_gaoer_xia_chengji" maxlength="10" value="{{ $data['zhengzhi_gaoer_xia_chengji'] or "" }}">/<input type="text" name="zhengzhi_gaoer_xia_manfen" maxlength="10" value="{{ $data['zhengzhi_gaoer_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="zhengzhi_gaosan_shang_chengji" maxlength="10" value="{{ $data['zhengzhi_gaosan_shang_chengji'] or "" }}">/<input type="text" name="zhengzhi_gaosan_shang_manfen" maxlength="10" value="{{ $data['zhengzhi_gaosan_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="zhengzhi_huikao_chengji" maxlength="10" value="{{ $data['zhengzhi_huikao_chengji'] or "" }}">/<input type="text" name="zhengzhi_huikao_manfen" maxlength="10" value="{{ $data['zhengzhi_huikao_manfen'] or "" }}"></td>
					</tr>
					<tr>
						<td>历史</td>
						<td><input type="text" name="lishi_gaoyi_shang_chengji" maxlength="10" value="{{ $data['lishi_gaoyi_shang_chengji'] or "" }}">/<input type="text" name="lishi_gaoyi_shang_manfen" maxlength="10" value="{{ $data['lishi_gaoyi_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="lishi_gaoyi_xia_chengji" maxlength="10" value="{{ $data['lishi_gaoyi_xia_chengji'] or "" }}">/<input type="text" name="lishi_gaoyi_xia_manfen" maxlength="10" value="{{ $data['lishi_gaoyi_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="lishi_gaoer_shang_chengji" maxlength="10" value="{{ $data['lishi_gaoer_shang_chengji'] or "" }}">/<input type="text" name="lishi_gaoer_shang_manfen" maxlength="10" value="{{ $data['lishi_gaoer_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="lishi_gaoer_xia_chengji" maxlength="10" value="{{ $data['lishi_gaoer_xia_chengji'] or "" }}">/<input type="text" name="lishi_gaoer_xia_manfen" maxlength="10" value="{{ $data['lishi_gaoer_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="lishi_gaosan_shang_chengji" maxlength="10" value="{{ $data['lishi_gaosan_shang_chengji'] or "" }}">/<input type="text" name="lishi_gaosan_shang_manfen" maxlength="10" value="{{ $data['lishi_gaosan_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="lishi_huikao_chengji" maxlength="10" value="{{ $data['lishi_huikao_chengji'] or "" }}">/<input type="text" name="lishi_huikao_manfen" maxlength="10" value="{{ $data['lishi_huikao_manfen'] or "" }}"></td>
					</tr>
					<tr>
						<td>地理</td>
						<td><input type="text" name="dili_gaoyi_shang_chengji" maxlength="10" value="{{ $data['dili_gaoyi_shang_chengji'] or "" }}">/<input type="text" name="dili_gaoyi_shang_manfen" maxlength="10" value="{{ $data['dili_gaoyi_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="dili_gaoyi_xia_chengji" maxlength="10" value="{{ $data['dili_gaoyi_xia_chengji'] or "" }}">/<input type="text" name="dili_gaoyi_xia_manfen" maxlength="10" value="{{ $data['dili_gaoyi_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="dili_gaoer_shang_chengji" maxlength="10" value="{{ $data['dili_gaoer_shang_chengji'] or "" }}">/<input type="text" name="dili_gaoer_shang_manfen" maxlength="10" value="{{ $data['dili_gaoer_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="dili_gaoer_xia_chengji" maxlength="10" value="{{ $data['dili_gaoer_xia_chengji'] or "" }}">/<input type="text" name="dili_gaoer_xia_manfen" maxlength="10" value="{{ $data['dili_gaoer_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="dili_gaosan_shang_chengji" maxlength="10" value="{{ $data['dili_gaosan_shang_chengji'] or "" }}">/<input type="text" name="dili_gaosan_shang_manfen" maxlength="10" value="{{ $data['dili_gaosan_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="dili_huikao_chengji" maxlength="10" value="{{ $data['dili_huikao_chengji'] or "" }}">/<input type="text" name="dili_huikao_manfen" maxlength="10" value="{{ $data['dili_huikao_manfen'] or "" }}"></td>
					</tr>
					<tr>
						<td>物理</td>
						<td><input type="text" name="wuli_gaoyi_shang_chengji" maxlength="10" value="{{ $data['wuli_gaoyi_shang_chengji'] or "" }}">/<input type="text" name="wuli_gaoyi_shang_manfen" maxlength="10" value="{{ $data['wuli_gaoyi_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="wuli_gaoyi_xia_chengji" maxlength="10" value="{{ $data['wuli_gaoyi_xia_chengji'] or "" }}">/<input type="text" name="wuli_gaoyi_xia_manfen" maxlength="10" value="{{ $data['wuli_gaoyi_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="wuli_gaoer_shang_chengji" maxlength="10" value="{{ $data['wuli_gaoer_shang_chengji'] or "" }}">/<input type="text" name="wuli_gaoer_shang_manfen" maxlength="10" value="{{ $data['wuli_gaoer_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="wuli_gaoer_xia_chengji" maxlength="10" value="{{ $data['wuli_gaoer_xia_chengji'] or "" }}">/<input type="text" name="wuli_gaoer_xia_manfen" maxlength="10" value="{{ $data['wuli_gaoer_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="wuli_gaosan_shang_chengji" maxlength="10" value="{{ $data['wuli_gaosan_shang_chengji'] or "" }}">/<input type="text" name="wuli_gaosan_shang_manfen" maxlength="10" value="{{ $data['wuli_gaosan_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="wuli_huikao_chengji" maxlength="10" value="{{ $data['wuli_huikao_chengji'] or "" }}">/<input type="text" name="wuli_huikao_manfen" maxlength="10" value="{{ $data['wuli_huikao_manfen'] or "" }}"></td>
					</tr>
					<tr>
						<td>化学</td>
						<td><input type="text" name="huaxue_gaoyi_shang_chengji" maxlength="10" value="{{ $data['huaxue_gaoyi_shang_chengji'] or "" }}">/<input type="text" name="huaxue_gaoyi_shang_manfen" maxlength="10" value="{{ $data['huaxue_gaoyi_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="huaxue_gaoyi_xia_chengji" maxlength="10" value="{{ $data['huaxue_gaoyi_xia_chengji'] or "" }}">/<input type="text" name="huaxue_gaoyi_xia_manfen" maxlength="10" value="{{ $data['huaxue_gaoyi_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="huaxue_gaoer_shang_chengji" maxlength="10" value="{{ $data['huaxue_gaoer_shang_chengji'] or "" }}">/<input type="text" name="huaxue_gaoer_shang_manfen" maxlength="10" value="{{ $data['huaxue_gaoer_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="huaxue_gaoer_xia_chengji" maxlength="10" value="{{ $data['huaxue_gaoer_xia_chengji'] or "" }}">/<input type="text" name="huaxue_gaoer_xia_manfen" maxlength="10" value="{{ $data['huaxue_gaoer_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="huaxue_gaosan_shang_chengji" maxlength="10" value="{{ $data['huaxue_gaosan_shang_chengji'] or "" }}">/<input type="text" name="huaxue_gaosan_shang_manfen" maxlength="10" value="{{ $data['huaxue_gaosan_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="huaxue_huikao_chengji" maxlength="10" value="{{ $data['huaxue_huikao_chengji'] or "" }}">/<input type="text" name="huaxue_huikao_manfen" maxlength="10" value="{{ $data['huaxue_huikao_manfen'] or "" }}"></td>
					</tr>
					<tr>
						<td>生物</td>
						<td><input type="text" name="shengwu_gaoyi_shang_chengji" maxlength="10" value="{{ $data['shengwu_gaoyi_shang_chengji'] or "" }}">/<input type="text" name="shengwu_gaoyi_shang_manfen" maxlength="10" value="{{ $data['shengwu_gaoyi_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="shengwu_gaoyi_xia_chengji" maxlength="10" value="{{ $data['shengwu_gaoyi_xia_chengji'] or "" }}">/<input type="text" name="shengwu_gaoyi_xia_manfen" maxlength="10" value="{{ $data['shengwu_gaoyi_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="shengwu_gaoer_shang_chengji" maxlength="10" value="{{ $data['shengwu_gaoer_shang_chengji'] or "" }}">/<input type="text" name="shengwu_gaoer_shang_manfen" maxlength="10" value="{{ $data['shengwu_gaoer_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="shengwu_gaoer_xia_chengji" maxlength="10" value="{{ $data['shengwu_gaoer_xia_chengji'] or "" }}">/<input type="text" name="shengwu_gaoer_xia_manfen" _manfen maxlength="10" value="{{ $data['shengwu_gaoer_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="shengwu_gaosan_shang_chengji" maxlength="10" value="{{ $data['shengwu_gaosan_shang_chengji'] or "" }}">/<input type="text" name="shengwu_gaosan_shang_manfen" maxlength="10" value="{{ $data['shengwu_gaosan_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="shengwu_huikao_chengji" maxlength="10" value="{{ $data['shengwu_huikao_chengji'] or "" }}">/<input type="text" name="shengwu_huikao_manfen" maxlength="10" value="{{ $data['shengwu_huikao_manfen'] or "" }}"></td>
					</tr>
					<tr>
						<td>美术</td>
						<td><input type="text" name="meishu_gaoyi_shang_chengji" maxlength="10" value="{{ $data['meishu_gaoyi_shang_chengji'] or "" }}">/<input type="text" name="meishu_gaoyi_shang_manfen" maxlength="10" value="{{ $data['meishu_gaoyi_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="meishu_gaoyi_xia_chengji" maxlength="10" value="{{ $data['meishu_gaoyi_xia_chengji'] or "" }}">/<input type="text" name="meishu_gaoyi_xia_manfen" maxlength="10" value="{{ $data['meishu_gaoyi_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="meishu_gaoer_shang_chengji" maxlength="10" value="{{ $data['meishu_gaoer_shang_chengji'] or "" }}">/<input type="text" name="meishu_gaoer_shang_manfen" maxlength="10" value="{{ $data['meishu_gaoer_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="meishu_gaoer_xia_chengji" maxlength="10" value="{{ $data['meishu_gaoer_xia_chengji'] or "" }}">/<input type="text" name="meishu_gaoer_xia_manfen" maxlength="10" value="{{ $data['meishu_gaoer_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="meishu_gaosan_shang_chengji" maxlength="10" value="{{ $data['meishu_gaosan_shang_chengji'] or "" }}">/<input type="text" name="meishu_gaosan_shang_manfen" maxlength="10" value="{{ $data['meishu_gaosan_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="meishu_huikao_chengji" maxlength="10" value="{{ $data['meishu_huikao_chengji'] or "" }}">/<input type="text" name="meishu_huikao_manfen" maxlength="10" value="{{ $data['meishu_huikao_manfen'] or "" }}"></td>
					</tr>
					<tr>
						<td>体育</td>
						<td><input type="text" name="tiyu_gaoyi_shang_chengji" maxlength="10" value="{{ $data['tiyu_gaoyi_shang_chengji'] or "" }}">/<input type="text" name="tiyu_gaoyi_shang_manfen" maxlength="10" value="{{ $data['tiyu_gaoyi_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="tiyu_gaoyi_xia_chengji" maxlength="10" value="{{ $data['tiyu_gaoyi_xia_chengji'] or "" }}">/<input type="text" name="tiyu_gaoyi_xia_manfen" maxlength="10" value="{{ $data['tiyu_gaoyi_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="tiyu_gaoer_shang_chengji" maxlength="10" value="{{ $data['tiyu_gaoer_shang_chengji'] or "" }}">/<input type="text" name="tiyu_gaoer_shang_manfen" maxlength="10" value="{{ $data['tiyu_gaoer_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="tiyu_gaoer_xia_chengji" maxlength="10" value="{{ $data['tiyu_gaoer_xia_chengji'] or "" }}">/<input type="text" name="tiyu_gaoer_xia_manfen" maxlength="10" value="{{ $data['tiyu_gaoer_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="tiyu_gaosan_shang_chengji" maxlength="10" value="{{ $data['tiyu_gaosan_shang_chengji'] or "" }}">/<input type="text" name="tiyu_gaosan_shang_manfen" maxlength="10" value="{{ $data['tiyu_gaosan_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="tiyu_huikao_chengji" maxlength="10" value="{{ $data['tiyu_huikao_chengji'] or "" }}">/<input type="text" name="tiyu_huikao_manfen" maxlength="10" value="{{ $data['tiyu_huikao_manfen'] or "" }}"></td>
					</tr>
					<tr>
						<td>音乐</td>
						<td><input type="text" name="yinyue_gaoyi_shang_chengji" maxlength="10" value="{{ $data['yinyue_gaoyi_shang_chengji'] or "" }}">/<input type="text" name="yinyue_gaoyi_shang_manfen" maxlength="10" value="{{ $data['yinyue_gaoyi_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="yinyue_gaoyi_xia_chengji" maxlength="10" value="{{ $data['yinyue_gaoyi_xia_chengji'] or "" }}">/<input type="text" name="yinyue_gaoyi_xia_manfen" maxlength="10" value="{{ $data['yinyue_gaoyi_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="yinyue_gaoer_shang_chengji" maxlength="10" value="{{ $data['yinyue_gaoer_shang_chengji'] or "" }}">/<input type="text" name="yinyue_gaoer_shang_manfen" maxlength="10" value="{{ $data['yinyue_gaoer_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="yinyue_gaoer_xia_chengji" maxlength="10" value="{{ $data['yinyue_gaoer_xia_chengji'] or "" }}">/<input type="text" name="yinyue_gaoer_xia_manfen" maxlength="10" value="{{ $data['yinyue_gaoer_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="yinyue_gaosan_shang_chengji" maxlength="10" value="{{ $data['yinyue_gaosan_shang_chengji'] or "" }}">/<input type="text" name="yinyue_gaosan_shang_manfen" maxlength="10" value="{{ $data['yinyue_gaosan_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="yinyue_huikao_chengji" maxlength="10" value="{{ $data['yinyue_huikao_chengji'] or "" }}">/<input type="text" name="yinyue_huikao_manfen" maxlength="10" value="{{ $data['yinyue_huikao_manfen'] or "" }}"></td>
					</tr>
					<tr>
						<td>信息技术</td>
						<td><input type="text" name="xxjs_gaoyi_shang_chengji" maxlength="10" value="{{ $data['xxjs_gaoyi_shang_chengji'] or "" }}">/<input type="text" name="xxjs_gaoyi_shang_manfen" maxlength="10" value="{{ $data['xxjs_gaoyi_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="xxjs_gaoyi_xia_chengji" maxlength="10" value="{{ $data['xxjs_gaoyi_xia_chengji'] or "" }}">/<input type="text" name="xxjs_gaoyi_xia_manfen" maxlength="10" value="{{ $data['xxjs_gaoyi_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="xxjs_gaoer_shang_chengji" maxlength="10" value="{{ $data['xxjs_gaoer_shang_chengji'] or "" }}">/<input type="text" name="xxjs_gaoer_shang_manfen" maxlength="10" value="{{ $data['xxjs_gaoer_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="xxjs_gaoer_xia_chengji" maxlength="10" value="{{ $data['xxjs_gaoer_xia_chengji'] or "" }}">/<input type="text" name="xxjs_gaoer_xia_manfen" maxlength="10" value="{{ $data['xxjs_gaoer_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="xxjs_gaosan_shang_chengji" maxlength="10" value="{{ $data['xxjs_gaosan_shang_chengji'] or "" }}">/<input type="text" name="xxjs_gaosan_shang_manfen" maxlength="10" value="{{ $data['xxjs_gaosan_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="xxjs_huikao_chengji" maxlength="10" value="{{ $data['xxjs_huikao_chengji'] or "" }}">/<input type="text" name="xxjs_huikao_manfen" maxlength="10" value="{{ $data['xxjs_huikao_manfen'] or "" }}"></td>
					</tr>
					<tr>
						<td>文科综合</td>
						<td><input type="text" name="wenzong_gaoyi_shang_chengji" maxlength="10" value="{{ $data['wenzong_gaoyi_shang_chengji'] or "" }}">/<input type="text" name="wenzong_gaoyi_shang_manfen" maxlength="10" value="{{ $data['wenzong_gaoyi_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="wenzong_gaoyi_xia_chengji" maxlength="10" value="{{ $data['wenzong_gaoyi_xia_chengji'] or "" }}">/<input type="text" name="wenzong_gaoyi_xia_manfen" maxlength="10" value="{{ $data['wenzong_gaoyi_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="wenzong_gaoer_shang_chengji" maxlength="10" value="{{ $data['wenzong_gaoer_shang_chengji'] or "" }}">/<input type="text" name="wenzong_gaoer_shang_manfen" maxlength="10" value="{{ $data['wenzong_gaoer_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="wenzong_gaoer_xia_chengji" maxlength="10" value="{{ $data['wenzong_gaoer_xia_chengji'] or "" }}">/<input type="text" name="wenzong_gaoer_xia_manfen" maxlength="10" value="{{ $data['wenzong_gaoer_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="wenzong_gaosan_shang_chengji" maxlength="10" value="{{ $data['wenzong_gaosan_shang_chengji'] or "" }}">/<input type="text" name="wenzong_gaosan_shang_manfen" maxlength="10" value="{{ $data['wenzong_gaoyi_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="wenzong_huikao_chengji" maxlength="10" value="{{ $data['wenzong_huikao_chengji'] or "" }}">/<input type="text" name="wenzong_huikao_manfen" maxlength="10" value="{{ $data['wenzong_huikao_manfen'] or "" }}"></td>
					</tr>
					<tr>
						<td>理科综合</td>
						<td><input type="text" name="lizong_gaoyi_shang_chengji" maxlength="10" value="{{ $data['lizong_gaoyi_shang_chengji'] or "" }}">/<input type="text" name="lizong_gaoyi_shang_manfen" maxlength="10" value="{{ $data['lizong_gaoyi_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="lizong_gaoyi_xia_chengji" maxlength="10" value="{{ $data['lizong_gaoyi_xia_chengji'] or "" }}">/<input type="text" name="lizong_gaoyi_xia_manfen" maxlength="10" value="{{ $data['lizong_gaoyi_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="lizong_gaoer_shang_chengji" maxlength="10" value="{{ $data['lizong_gaoer_shang_chengji'] or "" }}">/<input type="text" name="lizong_gaoer_shang_manfen" maxlength="10" value="{{ $data['lizong_gaoer_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="lizong_gaoer_xia_chengji" maxlength="10" value="{{ $data['lizong_gaoer_xia_chengji'] or "" }}">/<input type="text" name="lizong_gaoer_xia_manfen" maxlength="10" value="{{ $data['lizong_gaoer_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="lizong_gaosan_shang_chengji" maxlength="10" value="{{ $data['lizong_gaosan_shang_chengji'] or "" }}">/<input type="text" name="lizong_gaosan_shang_manfen" maxlength="10" value="{{ $data['lizong_gaosan_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="lizong_huikao_chengji" maxlength="10" value="{{ $data['lizong_huikao_chengji'] or "" }}">/<input type="text" name="lizong_huikao_manfen" maxlength="10" value="{{ $data['lizong_huikao_manfen'] or "" }}"></td>
					</tr>
					<tr>
						<td>总分</td>
						<td><input type="text" name="zongfen_gaoyi_shang_chengji" maxlength="10" value="{{ $data['zongfen_gaoyi_shang_chengji'] or "" }}">/<input type="text" name="zongfen_gaoyi_shang_manfen" maxlength="10" value="{{ $data['zongfen_gaoyi_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="zongfen_gaoyi_xia_chengji" maxlength="10" value="{{ $data['zongfen_gaoyi_xia_chengji'] or "" }}">/<input type="text" name="zongfen_gaoyi_xia_manfen" maxlength="10" value="{{ $data['zongfen_gaoyi_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="zongfen_gaoer_shang_chengji" maxlength="10" value="{{ $data['zongfen_gaoer_shang_chengji'] or "" }}">/<input type="text" name="zongfen_gaoer_shang_manfen" maxlength="10" value="{{ $data['zongfen_gaoer_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="zongfen_gaoer_xia_chengji" maxlength="10" value="{{ $data['zongfen_gaoer_xia_chengji'] or "" }}">/<input type="text" name="zongfen_gaoer_xia_manfen" maxlength="10" value="{{ $data['zongfen_gaoer_xia_manfen'] or "" }}"></td>
						<td><input type="text" name="zongfen_gaosan_shang_chengji" maxlength="10" value="{{ $data['zongfen_gaosan_shang_chengji'] or "" }}">/<input type="text" name="zongfen_gaosan_shang_manfen" maxlength="10" value="{{ $data['zongfen_gaosan_shang_manfen'] or "" }}"></td>
						<td><input type="text" name="zongfen_huikao_chengji" maxlength="10" value="{{ $data['zongfen_huikao_chengji'] or "" }}">/<input type="text" name="zongfen_huikao_manfen" maxlength="10" value="{{ $data['zongfen_huikao_manfen'] or "" }}"></td>
					</tr>
					<tr>
						<td>年级排名</td>
						<td><input type="text" name="njpm_gaoyi_shang_chengji" maxlength="10" value="{{ $data['njpm_gaoyi_shang_chengji'] or "" }}" class="w79"></td>
						<td><input type="text" name="njpm_gaoyi_xia_chengji" maxlength="10" value="{{ $data['njpm_gaoyi_xia_chengji'] or "" }}" class="w79"></td>
						<td><input type="text" name="njpm_gaoer_shang_chengji" maxlength="10" value="{{ $data['njpm_gaoer_shang_chengji'] or "" }}" class="w79"></td>
						<td><input type="text" name="njpm_gaoer_xia_chengji" maxlength="10" value="{{ $data['njpm_gaoer_xia_chengji'] or "" }}" class="w79"></td>
						<td><input type="text" name="njpm_gaosan_shang_chengji" maxlength="10" value="{{ $data['njpm_gaosan_shang_chengji'] or "" }}" class="w79"></td>
						<td><input type="text" name="njpm_huikao_chengji" maxlength="10" value="{{ $data['njpm_huikao_chengji'] or "" }}" class="w79"></td>
					</tr>
					<tr>
						<td>年级人数</td>
						<td><input type="text" name="njrs_gaoyi_shang_chengji" maxlength="10" value="{{ $data['njrs_gaoyi_shang_chengji'] or "" }}" class="w79"></td>
						<td><input type="text" name="njrs_gaoyi_xia_chengji" maxlength="10" value="{{ $data['njrs_gaoyi_xia_chengji'] or "" }}" class="w79"></td>
						<td><input type="text" name="njrs_gaoer_shang_chengji" maxlength="10" value="{{ $data['njrs_gaoer_shang_chengji'] or "" }}" class="w79"></td>
						<td><input type="text" name="njrs_gaoer_xia_chengji" maxlength="10" value="{{ $data['njrs_gaoer_xia_chengji'] or "" }}" class="w79"></td>
						<td><input type="text" name="njrs_gaosan_shang_chengji" maxlength="10" value="{{ $data['njrs_gaosan_shang_chengji'] or "" }}" class="w79"></td>
						<td><input type="text" name="njrs_huikao_chengji" maxlength="10" value="{{ $data['njrs_huikao_chengji'] or "" }}" class="w79"></td>
					</tr>
					</tbody>
				</table>
				{{ csrf_field() }}
				<input type="submit" id="btnsubmit" value="保 存" class="submit submit1">
			</form>
		</div>
	</div>
	</div>
	</div>
@endsection()