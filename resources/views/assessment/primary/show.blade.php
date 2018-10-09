@include('assessment.comment.header')

<div id="report">
	<h2 align="center" style="font-family:'微软雅黑'">专业选择测试报告</h2>
	<p align="center">原著：[美]Myers-Briggs / 编译：黑马高考</p><br>
	<hr>
	<div class="r">
		<table>
			<tbody>
			<tr>
				<td>测试者:</td>
				<td width="130">{{ $info['serial_number_record']['username'] }}</td>
				<td>完成问卷时间:</td>
				<td width="120">{{ $info['serial_number_record']['created_at']  }}</td>
			</tr>
			</tbody>
		</table>
	</div>
	<div class="clear">
	</div>

	<div style="page-break-before:always;"></div>

	<h3 class="character_title" align="center">{{ $info['mbti_category']['mbti_name'] }}</h3>
	<div class="pctitle">一、你的MBTI图形</div>

	<table id="chart" width="774" border="0" style="margin: 0 auto;">
		<tbody>
		<tr>
			<td width="103"></td>
			<td width="542">
				<div align="center">MBTI倾向示意图(类型：ESTP&nbsp;总倾向：24.3)</div>
			</td>
			<td width="115"></td>
		</tr>
		<tr>
			<td>外向（E）</td>
			<td>
				<div class="graph2" id="one">
					{{ $info['e'] }}% <strong class="bar" style="width: {{ $info['e'] }}%;"><span></span></strong>
				</div>
				<div class="graph" id="two">
					<strong class="bar" style="width: {{ $info['i'] }};"><span></span></strong> {{ $info['i'] }}
				</div>
				<br><br></td>
			<td>（I）内向</td>
		</tr>
		<tr>
			<td>实感（S）</td>
			<td>
				<div class="graph2" id="one">
					{{ $info['s'] }}% <strong class="bar" style="width: {{ $info['s'] }}%;"><span></span></strong>
				</div>
				<div class="graph" id="two">
					<strong class="bar" style="width: {{ $info['n'] }};"><span></span></strong> {{ $info['n'] }}
				</div>
				<br><br></td>
			<td>（N）直觉</td>
		</tr>
		<tr>
			<td>思考（T）</td>
			<td>
				<div class="graph2" id="one">
					{{ $info['t'] }}% <strong class="bar" style="width: {{ $info['t'] }}%;"><span></span></strong>
				</div>
				<div class="graph" id="two">
					<strong class="bar" style="width: {{ $info['f'] }};"><span></span></strong> {{ $info['f'] }}
				</div>
				<br><br></td>
			<td>（F）情感</td>
		</tr>
		<tr>
			<td>判断（J）</td>
			<td>
				<div class="graph2" id="one">
					{{ $info['j'] }}% <strong class="bar" style="width: {{ $info['j'] }}%;"><span></span></strong>
				</div>
				<div class="graph" id="two">
					<strong class="bar" style="width: {{ $info['p'] }};"><span></span></strong> {{ $info['p'] }}
				</div>
				<br><br></td>
			<td>（P）知觉</td>
		</tr>
		<tr>
			<td height="34"></td>
			<td style="background:url(http://www.apesk.com/lee/images/dibiao1.jpg) no-repeat"></td>
			<td></td>
		</tr>
		</tbody>
	</table>
	<br>
	<p></p>
	<li style="font-size:16px;">倾向示意图表示四个维度分别的倾向程度。从中间往两侧看，绿色指示条对应下面坐标的哪个区间。</li>
	<li style="font-size:16px;">本报告地址不会长期有效，请复制报告内容到本地或自己的博客。</li>
	<p></p>
	<br>

	<!--图end-->
	<div style="page-break-before:always;"></div>

	<br>
	<br>
	<!--这里是优势劣势开始-->
	<p>
	</p>
	<div class="pctitle">二、优势与劣势</div>
	<p></p>
	<table align="center" width="100%" cellpadding="20">
		<tbody>
		<tr>
			<td class="style123">
				{!! $info['mbti_category']['advantage_and_disadvantage'] !!}
				<div style="page-break-before:always;"></div>

				<div class="pctitle">三、气质类型</div>
				{!! $info['mbti_category']['temperament_type'] !!}

				<div style="page-break-before:always;"></div>
				<div class="pctitle">四、基本描述</div>
				<table align="center" width="100%" cellpadding="20">
					<tbody>
					<tr>
						<td class="style123">

							<table id="leader" style="FLOAT: left; MARGIN: 0px 25px 10px 0px" width="200" bgcolor="#dddddd" cellpadding="0" cellspacing="5">
								<tbody>
								<tr>
									<td>
										<img align="center" width="200" alt="" style="border: 1px solid #333333;" src="./img/INTJ.jpg">
									</td>
								</tr>
								<tr>
									<td style="FONT-SIZE: 9pt; LINE-HEIGHT: 12pt; FONT-FAMILY: Arial,宋体; font-weight: none; color: #2F4F4F">
										<br> INTJ (Introverted Intuition with Thinking)代表人物：<br><br> 扎克伯格 facebook创始人<br><br> 语录：I'm going to change the world<br><br> 朋友雪儿桑德伯格对其的评价：他害羞而内向，常常让不熟悉他的人感觉有点冷冰冰的。
									</td>
								</tr>
								</tbody>
							</table>
							{!! $info['mbti_category']['brief_description'] !!}
							<div style="page-break-before:always;"></div>
							<div class="pctitle">五、后记</div>
							{!! $info['mbti_category']['afterword'] !!}
						</td>
					</tr>
					</tbody>
				</table>

			</td>
		</tr>
		</tbody>
	</table>
</div>
</div>
</div>
</body>

</html>