@include('assessment.comment.header')
<div class="report_box">
	<div class="cover">
		<h1>专业选择测试报告</h1>
		<p>原著：[美]Myers-Briggs / 编译：黑马高考</p>
		<p class="conner">
			<span>测试者: {{ $report['serial_number_record']['username'] }}</span>
			<span>完成问卷时间: {{ substr($report['serial_number_record']['created_at'],0,10) }}</span>
		</p>
		<h2>{{ $report['mbti_category']['mbti_name'] }}</h2>
	</div>
	<div class="chart">
		<h2 class="report_title">一、你的MBTI图形</h2>
		<div class="chart_box">
			<table>
				<tbody>
				<tr>
					<td colspan="3" align="center">MBTI倾向示意图(类型：{{$report['mbti_name']}} 倾向度:{{$report['inclination_degree']}})</td>
				</tr>
				<tr>
					<td>外向（E）</td>
					<td>
						<div class="layui-progress layui-progress1 layui-progress-big">
							<div class="layui-progress-bar" lay-percent="{{$report['e']}}%" style="width: {{$report['e']}}%;">
								<span class="layui-progress-text">{{$report['e']}}%</span>
							</div>
						</div>
						<div class="layui-progress layui-progress-big">
							<div class="layui-progress-bar" lay-percent="{{$report['i']}}%" style="width: {{$report['i']}}%;">
								<span class="layui-progress-text">{{$report['i']}}%</span>
							</div>
						</div>
					</td>
					<td>（I）内向</td>
				</tr>
				<tr>
					<td>实感（S）</td>
					<td>
						<div class="layui-progress layui-progress1 layui-progress-big">
							<div class="layui-progress-bar" lay-percent="{{$report['s']}}%" style="width: {{$report['s']}}%;">
								<span class="layui-progress-text">{{$report['s']}}%</span>
							</div>
						</div>
						<div class="layui-progress layui-progress-big">
							<div class="layui-progress-bar" lay-percent="{{$report['n']}}%" style="width: {{$report['n']}}%;">
								<span class="layui-progress-text">{{$report['n']}}%</span>
							</div>
						</div>
					</td>
					<td>（N）直觉</td>
				</tr>
				<tr>
					<td>思考（T）</td>
					<td>
						<div class="layui-progress layui-progress1 layui-progress-big">
							<div class="layui-progress-bar" lay-percent="{{$report['t']}}%" style="width: {{$report['t']}}%;">
								<span class="layui-progress-text">{{$report['t']}}%</span>
							</div>
						</div>
						<div class="layui-progress layui-progress-big">
							<div class="layui-progress-bar" lay-percent="{{$report['f']}}%" style="width: {{$report['f']}}%;">
								<span class="layui-progress-text">{{$report['f']}}%</span>
							</div>
						</div>
					</td>
					<td>（F）情感</td>
				</tr>
				<tr>
					<td>判断（J）</td>
					<td>
						<div class="layui-progress layui-progress1 layui-progress-big">
							<div class="layui-progress-bar" lay-percent="{{$report['j']}}%" style="width: {{$report['j']}}%;">
								<span class="layui-progress-text">{{$report['j']}}%</span>
							</div>
						</div>
						<div class="layui-progress layui-progress-big">
							<div class="layui-progress-bar" lay-percent="{{$report['p']}}%" style="width: {{$report['p']}}%;">
								<span class="layui-progress-text">{{$report['p']}}%</span>
							</div>
						</div>
					</td>
					<td>（P）知觉</td>
				</tr>
				<tr>
					<td height="34"></td>
					<td class="level"><span class="w50">强</span><span class="w82">明显</span><span class="w82">中等</span><span class="w82">轻微</span><span class="w82">中等</span><span class="w82">明显</span><span class="w50">强</span></td>
				</tr>
				</tbody>
			</table>
			<p>倾向示意图表示四个维度分别的倾向程度。从中间往两侧看，绿色指示条对应下面坐标的哪个区间。</p>
			<p>本报告地址不会长期有效，请复制报告内容到本地或自己的博客。</p>
		</div>
	</div>
	<div class="evaluate">
		<h2 class="report_title">二、优势与劣势</h2>
		<div class="evaluate_box">
			<p><b>{{ $report['mbti_category']['mbti_short_code'] }}的特质：{{ substr($report['mbti_category']['mbti_name'],4) }}</b></p>
			<div class="advantage_wrap">
				{!! $report['mbti_category']['personality_traits'] !!}
				<p><b>优势：</b></p>
				<div class="advantage">
					{!! $report['mbti_category']['personality_advantage'] !!}
				</div>
			</div>
			<div class="disadvantage_wrap">
				<p><b>劣势：</b></p>
				<div class="disadvantage">
					{!! $report['mbti_category']['personality_disadvantage'] !!}
				</div>
			</div>
		</div>
	</div>
	<div class="type">
		<h2 class="report_title">三、气质类型</h2>
		<div class="type_box">
			{!! $report['mbti_category']['temperament_lead'] !!}
			<div class="overview">
				{!! $report['mbti_category']['temperament_overview'] !!}
			</div>
			<div class="introduce_wrap">
				<p><b>总体描述 </b></p>
				<div class="introduce">
					{!! $report['mbti_category']['temperament_introduce'] !!}
				</div>
			</div>
			<div class="negative_wrap">
				<p><b>潜在的弱点</b></p>
				<div class="negative">
					{!! $report['mbti_category']['temperament_negative'] !!}
				</div>
			</div>
		</div>
	</div>
	<div class="describe">
		<h2 class="report_title">四、基本描述</h2>
		<div class="describe_box clearfix">
			<div class="describe_box_left pull-left">
				<img src="{{ asset('theme/layui/images/') }}/{{$report['mbti_category']['representative_avatar']}}">
				<p>{!! $report['mbti_category']['mbti_english_name'] !!}</p>
				<p>代表人物：{!! $report['mbti_category']['representative_person'] !!}</p>
				<p>语录：{!! $report['mbti_category']['representative_quotations'] !!}</p>
			</div>
			<div class="describe_box_right">
				<div>
					<div class="brief_description">
						{!! $report['mbti_category']['brief_description'] !!}
					</div>
				</div>
				{{--<div class="describe_box1">--}}
					{{--<p>您适合的职业有：</p>--}}
					{{--<p>企业家 ———— 相关专业：项目管理、工商管理</p>--}}
					{{--<p>个人理财专家 ———— 相关专业：投资学</p>--}}
				{{--</div>--}}
			</div>
		</div>
	</div>
	<div class="post">
		<h2 class="report_title">五、后记</h2>
		<div class="afterword">
			{!! $report['mbti_category']['afterword'] !!}
		</div>
	</div>
</div>
</div>
</body>
</html>