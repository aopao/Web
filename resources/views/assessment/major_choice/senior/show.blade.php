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

					<p>实用型：<i>40分</i></p>

					<span>您比较善于调动氛围，善于理解和包容他人。请您尽量避免需要动手能力或动作协调能力的工作。</span>

					<p>研究型：<i>54分</i></p>

					<span>您比较善于思考，喜欢探索未知事物。您比较擅长逻辑分析，做事非常精确，考虑问题比较理性。</span>

					<p>艺术型：<i>37分</i></p>

					<span>您很少主动表达内心感受，很少凭借直觉做决策判断。请您尽量避免艺术类和创造类相关的工作。</span>

					<p>社会型：<i>63分</i></p>

					<span>您比较善于人际交往，有比较强的影响力和洞察力。您非常热情好客、重视友谊，比较关注社会问题。</span>

					<p>企业型：<i>54分</i></p>

					<span>您比较擅长领导或说服他人，有非常大的抱负，非常务实。您比较喜欢发表自己的意见，希望成就一番事业。</span>

					<p>常规型：<i>69分</i></p>

					<span>您比较擅长有规律、有秩序、有标准的工作。您非常遵守各项制度、做事比较谨慎，具有自我牺牲精神。</span>

				</div>

			</div>

		</div>

	</div>

	<!-- 第1屏 END -->

	<!-- 第2屏 -->
	<div class="section one">
		<div class="youshi part5 clear">

			<div class="ys_title">性格特征分析</div>

			<div class="clear">

				<div class="xinli_1">

					<div id="main2" class="xinli"></div>

					<div class="intro"><i>机械操作</i><br>表示自己对自己对力的自信程度</div>

				</div>

				<div class="xinli_1">

					<div id="main3" class="xinli"></div>

					<div class="intro"><i>科学研究</i><br>表示对周围事物的觉察力和观察力</div>

				</div>

				<div class="xinli_1">

					<div id="main4" class="xinli"></div>

					<div class="intro"><i>艺术创新</i><br>表示对人或事物所报有的希望程度</div>

				</div>

			</div>

			<div>

				<div class="xinli_1">

					<div id="main5" class="xinli"></div>

					<div class="intro"><i>解释表达</i><br>表示做判断或决定的模式</div>

				</div>

				<div class="xinli_1">

					<div id="main6" class="xinli"></div>

					<div class="intro"><i>商业洽谈</i><br>表示决策时需花费的时间</div>

				</div>

				<div class="xinli_1">

					<div id="main7" class="xinli"></div>

					<div class="intro"><i>事务执行</i><br>不同心态下的行为反应</div>

				</div>

			</div>
		</div>
	</div>
	<!-- 第2屏 END -->

	<!-- 第3屏 -->
	<div class="section one">
		<div class="youshi part5 clear">

			<div class="ys_title">心理特征分析</div>

			<div class="clear">

				<div class="xinli_1">

					<div id="main8" class="xinli"></div>

					<div class="intro"><i>体育技能</i><br>表示自己对自己对力的自信程度</div>

				</div>

				<div class="xinli_1">

					<div id="main9" class="xinli"></div>

					<div class="intro"><i>数学技能</i><br>表示对周围事物的觉察力和观察力</div>

				</div>

				<div class="xinli_1">

					<div id="main10" class="xinli"></div>

					<div class="intro"><i>音乐技能</i><br>表示对人或事物所报有的希望程度</div>

				</div>

			</div>

			<div>

				<div class="xinli_1">

					<div id="main11" class="xinli"></div>

					<div class="intro"><i>交际技能</i><br>表示做判断或决定的模式</div>

				</div>

				<div class="xinli_1">

					<div id="main12" class="xinli"></div>

					<div class="intro"><i>领导技能</i><br>表示决策时需花费的时间</div>

				</div>

				<div class="xinli_1">

					<div id="main13" class="xinli"></div>

					<div class="intro"><i>办公技能</i><br>不同心态下的行为反应</div>

				</div>

			</div>
		</div>
	</div>
	<!-- 第3屏 END -->

	<!-- 第6屏 -->
	<div class="section one">

		<div class="youshi  part3 clear">

			<div class="ys_title">专家推荐的金牌专业--专业和人才特质匹配度</div>

			<div>

				<div id="main17" class="ys_l"></div>

			</div>

		</div>

	</div>

	<!-- 第6屏 END -->

	<!-- 第7屏 -->
	<div class="section one">

		<div class="youshi clear">

			<div class="ys_title">专业推荐</div>

			<div class="wy_kuaicon">

				@foreach($report['major_category'] as $key=>$value)
					<div class="one clear">
						<div class="one_left">
							<i><img src="{{ asset('theme/report/images/wy_biaotou.png')}}"/></i>
							<div class="text">
								<span>{{ $value['code'] }}</span>
								<p>{{ $value['name'] }}</p>
							</div>
						</div>
						<div class="one_right">
							<p></p>
						</div>
					</div>
				@endforeach

			</div>

		</div>

	</div>

	<!-- 第7屏 END -->

	<!-- 第8屏 -->

	<div class="section one">

		<div class="youshi clear">

			<div class="ys_title">专家推荐金牌专业--专业课程</div>

			<div class="wy_kuaicon">

				@foreach($report['majors_subject'] as $key=>$value)
					@if(isset($value) && is_array($value) && count($value)>=1)
						@foreach($value as $k=>$v)
							<div class="one clear">
								<div class="one_left">
									<i><img src="{{ asset('theme/report/images/wy_biaotou.png') }}"/></i>
									<div class="text">
										<span>{{ $v['majors']['code'] }}</span>
										<p>{{ $v['majors']['name'] }}</p>
									</div>
								</div>
								<div class="one_right">
									<p>幼儿园语言教育、幼儿园数学教育、幼儿园音乐教育、幼儿园体育教育、幼儿美术教育、幼儿科学教育</p>
								</div>
							</div>
						@endforeach
					@endif()
				@endforeach
			</div>

		</div>

	</div>
	<!-- 第8屏 END -->

	<!-- 第10屏 -->
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

			</div>

		</div>

	</div>

	<!-- 第10屏 END -->

	<!-- 第11屏 -->

	<div class="section one">

		<div class="youshi part3 clear">

			<div class="ys_title">适合您孩子的专业为</div>

			<div class="zui">
				<p>根据上述所有测试，最适合您（您孩子）的专业为：<i>西安交通大学交管专业</i></p>
				<a href="print.html">打印测试结果</a>
			</div>

		</div>

	</div>

	<!-- 第11屏 END -->

</div>

<script src="js/page/3/index.js"></script>
<script type="text/javascript">
    var myChart = [], option = [];
    myChart[0] = echarts.init(document.getElementById('main1'));
    option[0] = {
        tooltip: {},
        radar: {
            name: {
                textStyle: {
                    color: '#fff',
                    backgroundColor: '#f00',
                    borderRadius: 3,
                    padding: [5, 7]
                }
            },
            indicator: [{
                name: '实用型',
                max: 100
            },
                {
                    name: '研究型',
                    max: 100
                },
                {
                    name: '艺术型',
                    max: 100
                },
                {
                    name: '社会型',
                    max: 100
                },
                {
                    name: '企业型',
                    max: 100
                },
                {
                    name: '常规型',
                    max: 100
                }
            ],
            center: ['45%', '50%'],
        },
        series: [{
            name: '优势分析',
            type: 'radar',
            data: [{
                value: [{{$report['holland_r']*2}}, {{$report['holland_i']*2}}, {{$report['holland_a']*2}}, {{$report['holland_s']*2}}, {{$report['holland_e']*2}}, {{$report['holland_c']*2}}],
                name: '优势分值',
                label: {
                    normal: {
                        show: true,
                        formatter: function (params) {
                            return params.value;
                        },
                        position: 'insideBottom'
                    }
                }
            }],
            areaStyle: {
                normal: {
                    opacity: 0.9,
                    color: new echarts.graphic.RadialGradient(0.5, 0.5, 1, [{
                        color: '#e83f3b',
                        offset: 0
                    },
                        {
                            color: '#C23531',
                            offset: 1
                        }
                    ])
                }
            }
        }]
    };

    myChart[1] = [
        echarts.init(document.getElementById('main2')),
        echarts.init(document.getElementById('main3')),
        echarts.init(document.getElementById('main4')),
        echarts.init(document.getElementById('main5')),
        echarts.init(document.getElementById('main6')),
        echarts.init(document.getElementById('main7')),
    ];
    option[1] = [{
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '机械操作',
            type: 'gauge',
            data: [{
                value: {{ceil($report['answer']->response->holland->ability->result->R/6*100)}}
            }],
            axisLine: { // 坐标轴线
                lineStyle: { // 属性lineStyle控制线条样式
                    width: 10
                }
            },
            axisTick: { // 坐标轴小标记
                length: 15, // 属性length控制线长
                lineStyle: { // 属性lineStyle控制线条样式
                    color: 'auto'
                }
            },
            splitLine: { // 分隔线
                length: 20, // 属性length控制线长
                lineStyle: { // 属性lineStyle（详见lineStyle）控制线条样式
                    color: 'auto'
                }
            },
            title: {
                textStyle: { // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    fontWeight: 'bolder',
                    fontSize: 14,
                    color: '#fff',
                    shadowColor: '#fff', //默认透明
                    shadowBlur: 10
                },
                offsetCenter: [0, '70%']
            },
            detail: {
                backgroundColor: 'rgba(0,0,0,0.6)',
                formatter: '{value}%',
                textStyle: {
                    fontSize: 22,
                    color: '#ffffff'
                }
            }
        }]
    }, {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '自信度',
            type: 'gauge',
            data: [{
                value: {{ceil($report['answer']->response->holland->ability->result->I/6*100)}}
            }],
            axisLine: { // 坐标轴线
                lineStyle: { // 属性lineStyle控制线条样式
                    width: 10
                }
            },
            axisTick: { // 坐标轴小标记
                length: 15, // 属性length控制线长
                lineStyle: { // 属性lineStyle控制线条样式
                    color: 'auto'
                }
            },
            splitLine: { // 分隔线
                length: 20, // 属性length控制线长
                lineStyle: { // 属性lineStyle（详见lineStyle）控制线条样式
                    color: 'auto'
                }
            },
            title: {
                textStyle: { // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    fontWeight: 'bolder',
                    fontSize: 14,
                    color: '#fff',
                    shadowColor: '#fff', //默认透明
                    shadowBlur: 10
                },
                offsetCenter: [0, '70%']
            },
            detail: {
                backgroundColor: 'rgba(0,0,0,0.6)',
                formatter: '{value}%',
                textStyle: {
                    fontSize: 22,
                    color: '#ffffff'
                }
            }
        }]
    }, {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '机械操作',
            type: 'gauge',
            data: [{
                value: {{ceil($report['answer']->response->holland->ability->result->A/6*100)}}
            }],
            axisLine: { // 坐标轴线
                lineStyle: { // 属性lineStyle控制线条样式
                    width: 10
                }
            },
            axisTick: { // 坐标轴小标记
                length: 15, // 属性length控制线长
                lineStyle: { // 属性lineStyle控制线条样式
                    color: 'auto'
                }
            },
            splitLine: { // 分隔线
                length: 20, // 属性length控制线长
                lineStyle: { // 属性lineStyle（详见lineStyle）控制线条样式
                    color: 'auto'
                }
            },
            title: {
                textStyle: { // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    fontWeight: 'bolder',
                    fontSize: 14,
                    color: '#fff',
                    shadowColor: '#fff', //默认透明
                    shadowBlur: 10
                },
                offsetCenter: [0, '70%']
            },
            detail: {
                backgroundColor: 'rgba(0,0,0,0.6)',
                formatter: '{value}%',
                textStyle: {
                    fontSize: 22,
                    color: '#ffffff'
                }
            }
        }]
    }, {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '自信度',
            type: 'gauge',
            data: [{
                value: {{ceil($report['answer']->response->holland->ability->result->S/6*100)}}
            }],
            axisLine: { // 坐标轴线
                lineStyle: { // 属性lineStyle控制线条样式
                    width: 10
                }
            },
            axisTick: { // 坐标轴小标记
                length: 15, // 属性length控制线长
                lineStyle: { // 属性lineStyle控制线条样式
                    color: 'auto'
                }
            },
            splitLine: { // 分隔线
                length: 20, // 属性length控制线长
                lineStyle: { // 属性lineStyle（详见lineStyle）控制线条样式
                    color: 'auto'
                }
            },
            title: {
                textStyle: { // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    fontWeight: 'bolder',
                    fontSize: 14,
                    color: '#fff',
                    shadowColor: '#fff', //默认透明
                    shadowBlur: 10
                },
                offsetCenter: [0, '70%']
            },
            detail: {
                backgroundColor: 'rgba(0,0,0,0.6)',
                formatter: '{value}%',
                textStyle: {
                    fontSize: 22,
                    color: '#ffffff'
                }
            }
        }]
    }, {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '自信度',
            type: 'gauge',
            data: [{
                value: {{ceil($report['answer']->response->holland->ability->result->E/6*100)}}
            }],
            axisLine: { // 坐标轴线
                lineStyle: { // 属性lineStyle控制线条样式
                    width: 10
                }
            },
            axisTick: { // 坐标轴小标记
                length: 15, // 属性length控制线长
                lineStyle: { // 属性lineStyle控制线条样式
                    color: 'auto'
                }
            },
            splitLine: { // 分隔线
                length: 20, // 属性length控制线长
                lineStyle: { // 属性lineStyle（详见lineStyle）控制线条样式
                    color: 'auto'
                }
            },
            title: {
                textStyle: { // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    fontWeight: 'bolder',
                    fontSize: 14,
                    color: '#fff',
                    shadowColor: '#fff', //默认透明
                    shadowBlur: 10
                },
                offsetCenter: [0, '70%']
            },
            detail: {
                backgroundColor: 'rgba(0,0,0,0.6)',
                formatter: '{value}%',
                textStyle: {
                    fontSize: 22,
                    color: '#ffffff'
                }
            }
        }]
    }, {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '自信度',
            type: 'gauge',
            data: [{
                value: {{ceil($report['answer']->response->holland->ability->result->C/6*100)}}
            }],
            axisLine: { // 坐标轴线
                lineStyle: { // 属性lineStyle控制线条样式
                    width: 10
                }
            },
            axisTick: { // 坐标轴小标记
                length: 15, // 属性length控制线长
                lineStyle: { // 属性lineStyle控制线条样式
                    color: 'auto'
                }
            },
            splitLine: { // 分隔线
                length: 20, // 属性length控制线长
                lineStyle: { // 属性lineStyle（详见lineStyle）控制线条样式
                    color: 'auto'
                }
            },
            title: {
                textStyle: { // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    fontWeight: 'bolder',
                    fontSize: 14,
                    color: '#fff',
                    shadowColor: '#fff', //默认透明
                    shadowBlur: 10
                },
                offsetCenter: [0, '70%']
            },
            detail: {
                backgroundColor: 'rgba(0,0,0,0.6)',
                formatter: '{value}%',
                textStyle: {
                    fontSize: 22,
                    color: '#ffffff'
                }
            }
        }]
    }];

    myChart[2] = [
        echarts.init(document.getElementById('main8')),
        echarts.init(document.getElementById('main9')),
        echarts.init(document.getElementById('main10')),
        echarts.init(document.getElementById('main11')),
        echarts.init(document.getElementById('main12')),
        echarts.init(document.getElementById('main13')),
    ];

    option[2] = [{
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '自信度',
            type: 'gauge',
            data: [{
                value: {{ceil($report['answer']->response->holland->skill->result->R/6*100)}}
            }],
            axisLine: { // 坐标轴线
                lineStyle: { // 属性lineStyle控制线条样式
                    width: 10
                }
            },
            axisTick: { // 坐标轴小标记
                length: 15, // 属性length控制线长
                lineStyle: { // 属性lineStyle控制线条样式
                    color: 'auto'
                }
            },
            splitLine: { // 分隔线
                length: 20, // 属性length控制线长
                lineStyle: { // 属性lineStyle（详见lineStyle）控制线条样式
                    color: 'auto'
                }
            },
            title: {
                textStyle: { // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    fontWeight: 'bolder',
                    fontSize: 14,
                    color: '#fff',
                    shadowColor: '#fff', //默认透明
                    shadowBlur: 10
                },
                offsetCenter: [0, '70%']
            },
            detail: {
                backgroundColor: 'rgba(0,0,0,0.6)',
                formatter: '{value}%',
                textStyle: {
                    fontSize: 22,
                    color: '#ffffff'
                }
            }
        }]
    }, {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '自信度',
            type: 'gauge',
            data: [{
                value:  {{ceil($report['answer']->response->holland->skill->result->I/6*100)}}
            }],
            axisLine: { // 坐标轴线
                lineStyle: { // 属性lineStyle控制线条样式
                    width: 10
                }
            },
            axisTick: { // 坐标轴小标记
                length: 15, // 属性length控制线长
                lineStyle: { // 属性lineStyle控制线条样式
                    color: 'auto'
                }
            },
            splitLine: { // 分隔线
                length: 20, // 属性length控制线长
                lineStyle: { // 属性lineStyle（详见lineStyle）控制线条样式
                    color: 'auto'
                }
            },
            title: {
                textStyle: { // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    fontWeight: 'bolder',
                    fontSize: 14,
                    color: '#fff',
                    shadowColor: '#fff', //默认透明
                    shadowBlur: 10
                },
                offsetCenter: [0, '70%']
            },
            detail: {
                backgroundColor: 'rgba(0,0,0,0.6)',
                formatter: '{value}%',
                textStyle: {
                    fontSize: 22,
                    color: '#ffffff'
                }
            }
        }]
    }, {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '自信度',
            type: 'gauge',
            data: [{
                value:  {{ceil($report['answer']->response->holland->skill->result->A/6*100)}}
            }],
            axisLine: { // 坐标轴线
                lineStyle: { // 属性lineStyle控制线条样式
                    width: 10
                }
            },
            axisTick: { // 坐标轴小标记
                length: 15, // 属性length控制线长
                lineStyle: { // 属性lineStyle控制线条样式
                    color: 'auto'
                }
            },
            splitLine: { // 分隔线
                length: 20, // 属性length控制线长
                lineStyle: { // 属性lineStyle（详见lineStyle）控制线条样式
                    color: 'auto'
                }
            },
            title: {
                textStyle: { // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    fontWeight: 'bolder',
                    fontSize: 14,
                    color: '#fff',
                    shadowColor: '#fff', //默认透明
                    shadowBlur: 10
                },
                offsetCenter: [0, '70%']
            },
            detail: {
                backgroundColor: 'rgba(0,0,0,0.6)',
                formatter: '{value}%',
                textStyle: {
                    fontSize: 22,
                    color: '#ffffff'
                }
            }
        }]
    }, {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '自信度',
            type: 'gauge',
            data: [{
                value:  {{ceil($report['answer']->response->holland->skill->result->S/6*100)}}
            }],
            axisLine: { // 坐标轴线
                lineStyle: { // 属性lineStyle控制线条样式
                    width: 10
                }
            },
            axisTick: { // 坐标轴小标记
                length: 15, // 属性length控制线长
                lineStyle: { // 属性lineStyle控制线条样式
                    color: 'auto'
                }
            },
            splitLine: { // 分隔线
                length: 20, // 属性length控制线长
                lineStyle: { // 属性lineStyle（详见lineStyle）控制线条样式
                    color: 'auto'
                }
            },
            title: {
                textStyle: { // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    fontWeight: 'bolder',
                    fontSize: 14,
                    color: '#fff',
                    shadowColor: '#fff', //默认透明
                    shadowBlur: 10
                },
                offsetCenter: [0, '70%']
            },
            detail: {
                backgroundColor: 'rgba(0,0,0,0.6)',
                formatter: '{value}%',
                textStyle: {
                    fontSize: 22,
                    color: '#ffffff'
                }
            }
        }]
    }, {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '自信度',
            type: 'gauge',
            data: [{
                value:  {{ceil($report['answer']->response->holland->skill->result->E/6*100)}}
            }],
            axisLine: { // 坐标轴线
                lineStyle: { // 属性lineStyle控制线条样式
                    width: 10
                }
            },
            axisTick: { // 坐标轴小标记
                length: 15, // 属性length控制线长
                lineStyle: { // 属性lineStyle控制线条样式
                    color: 'auto'
                }
            },
            splitLine: { // 分隔线
                length: 20, // 属性length控制线长
                lineStyle: { // 属性lineStyle（详见lineStyle）控制线条样式
                    color: 'auto'
                }
            },
            title: {
                textStyle: { // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    fontWeight: 'bolder',
                    fontSize: 14,
                    color: '#fff',
                    shadowColor: '#fff', //默认透明
                    shadowBlur: 10
                },
                offsetCenter: [0, '70%']
            },
            detail: {
                backgroundColor: 'rgba(0,0,0,0.6)',
                formatter: '{value}%',
                textStyle: {
                    fontSize: 22,
                    color: '#ffffff'
                }
            }
        }]
    }, {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '自信度',
            type: 'gauge',
            data: [{
                value:  {{ceil($report['answer']->response->holland->skill->result->C/6*100)}}
            }],
            axisLine: { // 坐标轴线
                lineStyle: { // 属性lineStyle控制线条样式
                    width: 10
                }
            },
            axisTick: { // 坐标轴小标记
                length: 15, // 属性length控制线长
                lineStyle: { // 属性lineStyle控制线条样式
                    color: 'auto'
                }
            },
            splitLine: { // 分隔线
                length: 20, // 属性length控制线长
                lineStyle: { // 属性lineStyle（详见lineStyle）控制线条样式
                    color: 'auto'
                }
            },
            title: {
                textStyle: { // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    fontWeight: 'bolder',
                    fontSize: 14,
                    color: '#fff',
                    shadowColor: '#fff', //默认透明
                    shadowBlur: 10
                },
                offsetCenter: [0, '70%']
            },
            detail: {
                backgroundColor: 'rgba(0,0,0,0.6)',
                formatter: '{value}%',
                textStyle: {
                    fontSize: 22,
                    color: '#ffffff'
                }
            }
        }]
    }];

    $("#main15").css('width', 1040);
    $("#main15").css('height', 500);
    myChart[3] = echarts.init(document.getElementById('main15'));
    option[3] = {
        title: {
            text: '12个学科门类,469多个专业',
            x: 'center',
            textStyle: {
                fontSize: 18,
                color: '#ccc'
            }
        },
        color: ['#2edfa3', '#bce672', '#ff4777', '#70f3ff', '#4b5cc4', '#f47983', '#8d4bbb', '#6635EF', '#FFAFDA', '#4572A7', '#92A8CD', '#A47D7C'],
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            data: ['哲学', '艺术学', '管理学', '医学', '农学', '工学', '理学', '历史学', '文学', '教育学', '法学', '经济学']
        },
        series: [{
            name: '系别与专业',
            type: 'pie',
            radius: '80%',
            center: ['50%', '60%'],
            data: [{
                value: 4,
                name: '哲学:4个专业'
            },
                {
                    value: 28,
                    name: '艺术学:28个专业'
                },
                {
                    value: 42,
                    name: '管理学:42个专业'
                },
                {
                    value: 36,
                    name: '医学:36个专业'
                },
                {
                    value: 25,
                    name: '农学:25个专业'
                },
                {
                    value: 157,
                    name: '工学:157个专业'
                },
                {
                    value: 36,
                    name: '理学:36个专业'
                },
                {
                    value: 4,
                    name: '历史学:4个专业'
                },
                {
                    value: 71,
                    name: '文学:71个专业'
                },
                {
                    value: 17,
                    name: '教育学:17个专业'
                },
                {
                    value: 32,
                    name: '法学:32个专业'
                },
                {
                    value: 17,
                    name: '经济学:17个专业'
                }
            ],
            itemStyle: {
                emphasis: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }]
    };

    $("#main16").css('width', 1040);
    myChart[4] = echarts.init(document.getElementById('main16'));
    option[4] = {
        color: ['#3398DB'],
        tooltip: {
            trigger: 'axis',
            formatter: "{b} : {c}",
            axisPointer: {
                type: 'shadow'
            }
        },
        grid: {
            left: '1%',
            right: '1%',
            bottom: '2%',
            containLabel: true
        },
        xAxis: [{
            type: 'category',
            data: ['哲学', '经济学', '法学', '教育学', '文学', '历史学', '理学', '工学', '农学', '医学', '管理学', '艺术学'],
            axisLine: {
                lineStyle: {
                    color: '#ccc'
                }
            }
        }],
        yAxis: [{
            name: '',
            type: 'value',
            max: 100,
            axisLine: {
                lineStyle: {
                    color: '#ccc'
                }
            }
        }],
        series: [{
            name: '学科匹配度分析',
            type: 'bar',
            barWidth: '40%',
            data: [30, 52, 34, 72, 54, 34, 40, 33, 56, 22, 49, 47]
        }]
    };

    $("#main17").css('width', 1040);
    $("#main17").css('height', 500);
    myChart[5] = echarts.init(document.getElementById('main17'));
    option[5] = {
        color: ['#3398DB'],
        tooltip: {
            trigger: 'axis'
        },
        dataset: {
            source: [
                [69, '040106-学前教育'],
            ]
        },
        grid: {
            left: '0',
            right: '1%',
            bottom: '2%',
            containLabel: true
        },
        xAxis: {
            name: '',
            max: 80,
            axisLine: {
                lineStyle: {
                    color: '#ccc'
                }
            }
        },
        yAxis: {
            type: 'category',
            axisLine: {
                lineStyle: {
                    color: '#ccc'
                }
            }
        },
        series: [{
            name: '专业和人才特质匹配度',
            type: 'bar',
            barWidth: '40%',
            encode: {
                // Map the "amount" column to X axis.
                x: 'amount',
                // Map the "product" column to Y axis
                y: 'product'
            }
        }]
    };
    $("#main18").css('width', 1040);
    $("#main18").css('height', 500);
    myChart[8] = echarts.init(document.getElementById('main18'));
    option[8] = {
        color: ['#3398DB'],
        tooltip: {
            trigger: 'axis'
        },
        dataset: {
            source: [
                [55, '040301-体育教育'],
            ]
        },
        grid: {
            left: '0',
            right: '1%',
            bottom: '2%',
            containLabel: true
        },
        xAxis: {
            name: '',
            max: 80,
            axisLine: {
                lineStyle: {
                    color: '#ccc'
                }
            }
        },
        yAxis: {
            type: 'category',
            axisLine: {
                lineStyle: {
                    color: '#ccc'
                }
            }
        },
        series: [{
            name: '专业和人才特质匹配度',
            type: 'bar',
            barWidth: '40%',
            encode: {

                x: 'amount',

                y: 'product'
            }
        }]
    };

    window.onload = function () {
        $(".page2").addClass('on');
    }

    function next() {
        $(".page1").fadeOut();
        $(".main_index").fadeOut("normal", function () {
            $(this).remove();
            $("#fullpage").show();
            myChart[0].setOption(option[0]);
            myChart[0].resize;
            $('#fullpage').fullpage({
                navigation: true,
                css3: true,
                afterLoad: function (index, nextIndex) {
                    if (index) {
                        var beforeindex = index.index;
                        if (myChart[beforeindex]) {
                            if (myChart[beforeindex].length > 1) {
                                Object.keys(myChart[beforeindex]).forEach(function (key) {
                                    myChart[beforeindex][key].clear();
                                });
                            } else {
                                myChart[beforeindex].clear();
                            }
                        }
                    }
                },
                onLeave: function (index, nextIndex, direction) {
                    var beforeindex = index.index;
                    var thisindex = nextIndex.index;
                    if (myChart[thisindex]) {
                        if (myChart[thisindex].length > 1) {
                            Object.keys(myChart[thisindex]).forEach(function (key) {
                                myChart[thisindex][key].setOption(option[thisindex][key]);
                                myChart[thisindex][key].resize;
                            });
                        } else {
                            myChart[thisindex].setOption(option[thisindex]);
                            myChart[thisindex].resize;
                        }
                    }
                }
            });
        });
        $(".page1").remove();
    }
</script>

</body>

</html>