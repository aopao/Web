<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>升学评测系统</title>
	<script src="{{ asset('theme/report/js/jquery.min.js') }}"></script>
	<script src="{{ asset('theme/report/js/echarts.min.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('theme/report/css/web.css') }}"/>
	<!-- main_index -->
	<link rel="stylesheet" href="{{ asset('theme/report/css/fullpage.min.css') }}"/>
	<script src="{{ asset('theme/report/js/easings.min.js') }}"></script>
	<script src="{{ asset('theme/report/js/scrolloverflow.min.js') }}"></script>
	<script src="{{ asset('theme/report/js/fullpage.min.js') }}"></script>
	<!-- main_index END -->
	<link rel="stylesheet" href="{{ asset('theme/report/js/page/1/css/style.css') }}"/>

</head>

<body>

<div class="main_index">

	<div id="wrapper">
		<div class="main_title" id="main_title">
			<div class="t">升学规划评测报告</div>
			<div class="p">姓名：{{ $report['username'] }}&nbsp;&nbsp;&nbsp;手机号：{{ $report['mobile'] }}</div>
			<div class="p2">评测时间：{{ substr($report['created_at'],0,10) }}</div>
			<div class="next">
				<a href="javascript:next();"><img src="{{ asset('theme/report/images/next.png') }}"></a>
			</div>
		</div>
	</div>
</div>

<div class="show_page page1 on" style="z-index:1;"><img src="{{ asset('theme/report/images/bg_img004.png') }}"/></div>

<div class="show_page page2">
	<canvas id="page2"></canvas>
</div>

<div id="fullpage" style="display:none;">
	<!-- 第1屏 -->
	<div class="section one">
		<div class="youshi clear">
			<div class="ys_title">优势分析</div>
			<div>
				<div id="main1" class="ys_l"></div>
				<div class="ys_r">
					<p>实用型(R)：<i>{{ $report['holland_r']*2 }}分</i></p>
					<span>您比较善于调动氛围，善于理解和包容他人。请您尽量避免需要动手能力或动作协调能力的工作。</span>
					<p>研究型(I)：<i>{{ $report['holland_i']*2 }}分</i></p>
					<span>您比较善于思考，喜欢探索未知事物。您比较擅长逻辑分析，做事非常精确，考虑问题比较理性。</span>
					<p>艺术型(A)：<i>{{ $report['holland_a']*2 }}分</i></p>
					<span>您很少主动表达内心感受，很少凭借直觉做决策判断。请您尽量避免艺术类和创造类相关的工作。</span>
					<p>社会型(S)：<i>{{ $report['holland_s']*2 }}分</i></p>
					<span>您比较善于人际交往，有比较强的影响力和洞察力。您非常热情好客、重视友谊，比较关注社会问题。</span>
					<p>企业型(E)：<i>{{ $report['holland_e']*2 }}分</i></p>
					<span>您比较擅长领导或说服他人，有非常大的抱负，非常务实。您比较喜欢发表自己的意见，希望成就一番事业。</span>
					<p>常规型(C)：<i>{{ $report['holland_c']*2 }}分</i></p>
					<span>您比较擅长有规律、有秩序、有标准的工作。您非常遵守各项制度、做事比较谨慎，具有自我牺牲精神。</span>
				</div>
			</div>
		</div>
	</div>
	<!-- 第1屏 END -->
	<!-- 第2屏 -->
	<div class="section one">
		<div class="youshi part2 clear">
			<div class="ys_title">兴趣分析</div>
			<div>
				<div id="main2" class="ys_l"></div>
				<div class="ys_r">
					<p>六个<i>维度</i>的含义</i></p>
					<span>
						<b>实用型：</b>喜欢户外活动、追求实际效果。 <br>
						<b>研究型：</b>喜欢抽象推理和智力活动。<br>
						<b>艺术型：</b>喜欢自我展示，属于理想主义者。<br>
						<b>社会型：</b>喜欢结交新朋友、喜欢帮组别人。<br>
						<b>企业型：</b>喜欢冒险、充满自信、精力旺盛。<br>
						<b>常规型：</b>喜欢互相支持、喜欢井然有序。
					</span>
					<p>六个<i>分值</i>的含义</p>
					<span>分值代表的是喜欢的强烈度 <br>
						按分值从高到低的顺序查阅
					</span>
				</div>
			</div>
		</div>
	</div>
	<!-- 第2屏 END -->
	<!-- 第3屏 -->
	<div class="section one">
		<div class="youshi part3 clear">
			<div class="ys_title">优势和兴趣匹配分析</div>
			<div>
				<div id="main3" class="ys_l"></div>
				<div class="ys_r">
					<p class="rtext">1.您的优势（蓝色）和兴趣（橙色）非常吻合。</p>
					<p class="rtext">2.各项优势比较接近，说明您的优势和劣势不明显。</p>
					<p class="rtext">3.各项兴趣具有显著特点，这有利于把握您的爱好。</p>
				</div>
			</div>
		</div>
	</div>
	<!-- 第3屏 END -->
	<!-- 第4屏 -->
	<div class="section one">
		<div class="youshi part4 clear">
			<div class="ys_title">优势和兴趣对比分析</div>
			<div>
				<div id="main4" class="ys_l"></div>
				<div class="ys_r">
					<p class="ytext"> 1.蓝色线代表优势</p>
					<p class="ytext"> 2.红色线代表兴趣</p>
					<p class="ytext"> 3.优势值和兴趣值各有大小，说明综合能力较强。</p>
				</div>
			</div>
		</div>
	</div>
	<!-- 第4屏 END -->
	<!-- 第5屏 -->
	<div class="section one">
		<div class="youshi part5 clear">
			<div class="ys_title">行为特征分析</div>
			<div class="clear">
				<div class="xinli_1">
					<div id="main5" class="xinli"></div>
					<div class="intro"><i>机械操作</i><br>表示自己对自己对力的自信程度</div>
				</div>
				<div class="xinli_1">
					<div id="main6" class="xinli"></div>
					<div class="intro"><i>科学研究</i><br>表示对周围事物的觉察力和观察力</div>
				</div>
				<div class="xinli_1">
					<div id="main7" class="xinli"></div>
					<div class="intro"><i>艺术创新</i><br>表示对人或事物所报有的希望程度</div>
				</div>
			</div>
			<div>
				<div class="xinli_1">
					<div id="main8" class="xinli"></div>
					<div class="intro"><i>解释表达</i><br>表示做判断或决定的模式</div>
				</div>
				<div class="xinli_1">
					<div id="main9" class="xinli"></div>
					<div class="intro"><i>商业洽谈</i><br>表示决策时需花费的时间</div>
				</div>
				<div class="xinli_1">
					<div id="main10" class="xinli"></div>
					<div class="intro"><i>事务执行</i><br>不同心态下的行为反应</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 第5屏 END -->
	<!-- 第6屏 -->
	<div class="section one">
		<div class="youshi part3 part2 clear">
			<div class="ys_title">五力素质</div>
			<div>
				<div id="main11" class="ys_l"></div>
				<div class="ys_r">
					<p>五力<i>素质</i>模型含义</i></p>
					<span>
						<b>执行力：</b>是指把目标变成结果的能力。<br>
						<b>亲和力：</b>是指使人愿意接触、亲近的力量。<br>
						<b>抗压力：</b>是指精神上所能承受的各种负担的能力。<br>
						<b>规划力：</b>是指制定未来发展计划的能力。<br>
						<b>推动力：</b>是指解决问题、突破困难的能力。
					</span>
					<p>五个<i>分值</i>的含义</p>
					<span>分值代表的是喜欢的强烈度 <br>
						按分值从高到低的顺序查阅
					</span>
				</div>
			</div>
		</div>
	</div>
	<!-- 第6屏 END -->
	<!-- 第7屏 -->
	<div class="section one">
		<div class="youshi clear">
			<div class="ys_title">职业性格</div>
			<div>
				<div id="main12" class="ys_l"></div>
				<div class="ys_r">
					<img class="xingge" src="{{ asset('theme/report/images/xinge.png') }}">
				</div>
			</div>
		</div>
	</div>
	<!-- 第7屏 END -->
	<!-- 第8屏 -->
	<div class="section one">

		<div class="youshi part8 clear">
			<div class="ys_title">大脑思维分析</div>
			<div class="clear">
				<div id="main13" class="ys_l"></div>
				<div class="ys_r">
					<strong>结果：您更加善于用<i>左脑</i></strong>
					<p><img class="danao" src="{{ asset('theme/report/images/danao.png') }}"></p>
				</div>
			</div>
			<div class="paiming  clear">
				<div class="paimingtit">根据分析您（您孩子）擅长的项目依次为：</div>
				<div class="pai">
					<span>1.逻辑</span>
					<span>2.表达</span>
					<span>3.画画</span>
					<span>4.音乐</span>
					<span>5.数学</span>
					<span>6.韵律</span>
					<span>7.分析</span>
					<span>8.推理</span>
				</div>
			</div>
		</div>
	</div>
	<!-- 第8屏 END -->
	<!-- 第9屏 -->
	<div class="section one">
		<div class="youshi part3 part9 clear">
			<div class="ys_title">智能分析</div>
			<div>
				<div id="main14" class="ys_l"></div>
				<div class="ys_r">
					<p>各项<i>智能</i>的含义</i></p>
					<span>
						<b>动觉智能：</b> 是指控制躯干和四肢，做出恰当的身体反应。<br>
						<b>语言智能：</b> 是指用语言表达清晰、写作规范、用词准确。<br>
						<b>逻辑智能：</b> 是指抽象概念的分析能力和数学推理能力。<br>
						<b>人际智能：</b> 是指通过与他人的交往和交流，实现良好关系。<br>
						<b>自然智能：</b> 是指对动物、植物、自然规律的认识和掌握程度。<br>
						<b>空间智能：</b> 是指人对空间方位的感知能力和形象思维能力。<br>
						<b>内省智能：</b> 是指个人通过分析反思，不断了解自己的能力。<br>
						<b>音乐智能：</b> 是指欣赏、演唱、演奏、创作音乐的能力。
					</span>
					<p>八个<i>分值</i>的含义</p>
					<span>分值代表的是智能的强弱度<br>按分值从高到低的顺序查阅</span>
					<p>上一页的答案</p>
					<span>左脑控制奇数项，右脑控制偶数项</span>
				</div>
			</div>
		</div>
	</div>

	<!-- 第9屏 END -->

	<!-- 第9屏 -->

	<div class="section one">
		<div class="youshi clear">
			<div class="ys_title">系别与专业</div>
			<div>
				<div id="main15" class="ys_l"></div>
			</div>
		</div>
	</div>
	<!-- 第9屏 END -->
	<!-- 第10屏 -->
	<div class="section one">
		<div class="youshi clear">
			<div class="ys_title">学科匹配度分析</div>
			<div>
				<div id="main16" class="ys_l"></div>
			</div>
		</div>
	</div>
	<!-- 第10屏 END -->
	<!-- 第11屏 -->
	<div class="section one">
		<div class="youshi  part3 clear">
			<div class="ys_title">专家推荐的金牌专业--专业和人才特质匹配度</div>
			<div>
				<div id="main17" class="ys_l"></div>
			</div>
		</div>
	</div>
	<!-- 第11屏 END -->

	<!-- 第12屏 -->
	<div class="section one">
		<div class="youshi clear">
			<div class="ys_title">专家推荐金牌专业--就业方向</div>
			<div class="wy_kuaicon">
				<div class="one clear">
					<div class="one_left">
						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>
						<div class="text">
							<span>040106</span>
							<p>学前教育</p>
						</div>
					</div>
					<div class="one_right">
						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育</p>
					</div>
				</div>
				<div class="one clear">
					<div class="one_left">
						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>
						<div class="text">
							<span>040106</span>
							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育、学前心理学</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育、学前心理学</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育</p>

					</div>

				</div>

			</div>

		</div>

	</div>

	<!-- 第12屏 END -->

	<!-- 第13屏 -->

	<div class="section one">

		<div class="youshi clear">

			<div class="ys_title">专家推荐金牌专业--专业课程</div>

			<div class="wy_kuaicon">

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育、学前心理学</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育、学前心理学</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育</p>

					</div>

				</div>

			</div>

		</div>

	</div>

	<!-- 第13屏 END -->

	<!-- 第14屏 -->

	<div class="section one">

		<div class="youshi   part3 clear">

			<div class="ys_title">专家推荐的银牌专业--专业和人才特质匹配度</div>

			<div>

				<div id="main18" class="ys_l"></div>

			</div>

		</div>

	</div>

	<!-- 第14屏 END -->

	<!-- 第15屏 -->

	<div class="section one">

		<div class="youshi clear">

			<div class="ys_title">专家推荐银牌专业--就业方向</div>

			<div class="wy_kuaicon">

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育、学前心理学</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育、学前心理学</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育</p>

					</div>

				</div>

			</div>

		</div>

	</div>

	<!-- 第15屏 END -->

	<!-- 第16屏 -->

	<div class="section one">

		<div class="youshi clear">

			<div class="ys_title">专家推荐银牌专业--专业课程</div>

			<div class="wy_kuaicon">

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育、学前心理学</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育、学前心理学</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育</p>

					</div>

				</div>

				<div class="one clear">

					<div class="one_left">

						<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>

						<div class="text">

							<span>040106</span>

							<p>学前教育</p>

						</div>

					</div>

					<div class="one_right">

						<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育、幼儿健康教育</p>

					</div>

				</div>

			</div>

		</div>

	</div>

	<!-- 第16屏 END -->

	<!-- 第16屏 -->

	<div class="section one">

		<div class="youshi part3 clear">

			<div class="ys_title">适合您孩子的专业为</div>

			<div class="zui">
				<p>根据上述所有测试，最适合您（您孩子）的专业为：<i>西安交通大学交管专业</i></p>
				<a href="print.html">打印测试结果</a>
			</div>

		</div>

	</div>

	<!-- 第16屏 END -->

</div>
<script>
    holland_r = {{$report['holland_r']*2}}
        holland_i = {{$report['holland_i']*2}}
        holland_a = {{$report['holland_a']*2}}
        holland_s = {{$report['holland_s']*2}}
        holland_e = {{$report['holland_e']*2}}
        holland_c = {{$report['holland_c']*2}}
        holland_ability_r = {{ceil($report['answer']['parse_data']['holland']['ability']['result']['R']/6*100)}}
        holland_ability_i = {{ceil($report['answer']['parse_data']['holland']['ability']['result']['I']/6*100)}}
        holland_ability_a = {{ceil($report['answer']['parse_data']['holland']['ability']['result']['A']/6*100)}}
        holland_ability_s = {{ceil($report['answer']['parse_data']['holland']['ability']['result']['S']/6*100)}}
        holland_ability_e = {{ceil($report['answer']['parse_data']['holland']['ability']['result']['E']/6*100)}}
        holland_ability_c = {{ceil($report['answer']['parse_data']['holland']['ability']['result']['C']/6*100)}}
</script>
<script src="{{ asset('theme/report/js/page/3/index.js') }}"></script>
<script src="{{ asset('theme/report/js/tubiao.js') }}"></script>

</body>

</html>