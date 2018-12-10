<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>升学评测报告</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://gw.alipayobjects.com/as/g/datavis/g2/2.3.13/index.js"></script>
	<link rel="stylesheet" type="text/css" href="{{ asset('theme/layui/css/wd.css') }}"/>
</head>

<body>
<div class="content">
	<div class="test_info bgColor mb30 container">
		<h1>升学规划评测报告</h1>
		<div class="row">
			<div class="col-md-2 col-sm-2"></div>
			<div class="col-md-4 col-sm-4">
				<div class="test_wrap">
					<p>姓名：{{ $report['username'] }}</p>
					<p>测试时间：{{ substr($report['created_at'],0,10) }}</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-4">
				<div class="test_wrap">
					<p><a href="http://www.heima211.com" target="_blank">WWW.HEIMA211.COM</a></p>
					<p>黑马高考,您身边的报考专家!</p>
				</div>
			</div>
			<div class="col-md-2 col-sm-2"></div>
		</div>
	</div>
	<!---------------------优势分析---------------------------->
	<div class="evaluate bgColor mb30 container">
		<div class="test_tit">优势分析</div>
		<div class="row">
			<div class="col-md-6">
				<div id="evaluate"></div>
			</div>
			<div class="col-md-6">
				<div class="evaluate_main">
					<p>实用型：<i>{{$report['holland_r']*2}}分</i></p>
					<span>您比较善于调动氛围，善于理解和包容他人。请您尽量避免需要动手能力或动作协调能力的工作。</span>
					<p>研究型：<i>{{$report['holland_i']*2}}分</i></p>
					<span>您比较善于思考，喜欢探索未知事物。您比较擅长逻辑分析，做事非常精确，考虑问题比较理性。</span>
					<p>艺术型：<i>{{$report['holland_a']*2}}分</i></p>
					<span>您很少主动表达内心感受，很少凭借直觉做决策判断。请您尽量避免艺术类和创造类相关的工作。</span>
					<p>社会型：<i>{{$report['holland_s']*2}}分</i></p>
					<span>您比较善于人际交往，有比较强的影响力和洞察力。您非常热情好客、重视友谊，比较关注社会问题。</span>
					<p>企业型：<i>{{$report['holland_e']*2}}分</i></p>
					<span>您比较擅长领导或说服他人，有非常大的抱负，非常务实。您比较喜欢发表自己的意见，希望成就一番事业。</span>
					<p>常规型：<i>{{$report['holland_c']*2}}分</i></p>
					<span>您比较擅长有规律、有秩序、有标准的工作。您非常遵守各项制度、做事比较谨慎，具有自我牺牲精神。</span>
				</div>
			</div>
		</div>
	</div>
	<!---------------------优势分析---------------------------->

	<!---------------------能力分析---------------------------->
	<div class="ability bgColor mb30 container">
		<div class="test_tit">能力分析</div>
		<div class="row ability_main">
			<div class="col-md-4 col-sm-6">
				<div id="ability1" class="ability_hight"></div>
				<div class="ability_text">
					<h3>机械操作能力</h3>
					<p>表示个体认知空间关系与操作机械设备的能力</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-6">
				<div id="ability2" class="ability_hight"></div>
				<div class="ability_text">
					<h3>科学研究能力</h3>
					<p>表示科学工作者具备的思维方法和操作能力</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-6">
				<div id="ability3" class="ability_hight"></div>
				<div class="ability_text">
					<h3>艺术创作能力</h3>
					<p>表示创造艺术品所需要的综合心理素质</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-6">
				<div id="ability4" class="ability_hight"></div>
				<div class="ability_text">
					<h3>解释表达能力</h3>
					<p>个人把自己的思想、情感、想法等准确表达出来</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-6">
				<div id="ability5" class="ability_hight"></div>
				<div class="ability_text">
					<h3>商业洽谈能力</h3>
					<p>表示在谈判中最大限度争取和维护公司利益的能力</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-6">
				<div id="ability6" class="ability_hight"></div>
				<div class="ability_text">
					<h3>事务执行能力</h3>
					<p>表示把想法变成行动，把行动变成结果</p>
				</div>
			</div>
		</div>
	</div>
	<!---------------------能力分析---------------------------->

	<!---------------------技能分析---------------------------->
	<div class="skill ability bgColor mb30 container">
		<div class="test_tit">技能分析</div>
		<div class="row skill_main ability_main">
			<div class="col-md-4 col-sm-6">
				<div id="skill4" class="ability_hight"></div>
				<div class="ability_text">
					<h3>交际技能</h3>
					<p>表示对一种语言的语言形式的理解和掌握</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-6">
				<div id="skill3" class="ability_hight"></div>
				<div class="ability_text">
					<h3>音乐技能</h3>
					<p>表示先天具备以及后天通过学习获得的能力</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-6">
				<div id="skill6" class="ability_hight"></div>
				<div class="ability_text">
					<h3>办公技能</h3>
					<p>表示个人工作中所必备的内涵素养及才华</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-6">
				<div id="skill1" class="ability_hight"></div>
				<div class="ability_text">
					<h3>体育技能</h3>
					<p>表示各种知识、素质、能力有机组成的综合能力</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-6">
				<div id="skill2" class="ability_hight"></div>
				<div class="ability_text">
					<h3>数学技能</h3>
					<p>表示过学习而形成的合法则的数学活动方式</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-6">
				<div id="skill5" class="ability_hight"></div>
				<div class="ability_text">
					<h3>领导技能</h3>
					<p>表示每一位领导者都必须具备带头领导能力</p>
				</div>
			</div>
		</div>
	</div>
	<!---------------------技能分析---------------------------->

	<!---------------------MBTI倾向示意图---------------------------->
	<div class="mbti bgColor mb30 container">
		<div class="test_tit">MBTI倾向示意图</div>
		<div class="row">
			<div class="col-md-12">
				<div id="c1"></div>
			</div>
		</div>
	</div>
	<!---------------------MBTI倾向示意图---------------------------->

	<!---------------------优势与劣势---------------------------->
	<div class="yl bgColor mb30 container">
		<div class="test_tit">优势与劣势</div>
		<div class="row">
			<div class="col-md-12">
				<div class="yl_main">
					<h4>{!!$report['mbti_category']['personality_traits']!!}</h4>
					<p class="subtitle">优势：</p>
					{!!$report['mbti_category']['personality_advantage']!!}
					<p class="subtitle">劣势：</p>
					{!!$report['mbti_category']['personality_disadvantage']!!}
				</div>
			</div>
		</div>
	</div>

	<!---------------------优势与劣势---------------------------->

	<!---------------------气质类型---------------------------->
	<div class="type bgColor mb30 container">
		<div class="test_tit">气质类型</div>
		<div class="row">
			<div class="col-md-12">
				<div class="type_main">
					<span>根据大卫.凯尔西（David Keirsey）气质与性情理论，你属于“{!!$report['mbti_category']['temperament_category']!!}”，下面是对“{!!$report['mbti_category']['temperament_category']!!}”的描述：</span>
					{!!$report['mbti_category']['temperament_overview']!!}
					<p class="subtitle">总体描述</p>
					{!!$report['mbti_category']['temperament_introduce']!!}
					<p class="subtitle">潜在的弱点</p>
					{!!$report['mbti_category']['temperament_negative']!!}
				</div>
			</div>
		</div>
	</div>
	<!---------------------气质类型---------------------------->

	<!---------------------基本描述---------------------------->
	<div class="describe bgColor mb30 container">
		<div class="test_tit">基本描述</div>
		<div class="row describe_main">
			<div class="col-md-2 col-sm-3 col-xs-12 describe_main_left">
				<div class="describe_box_left pull-left">
					<img src="{!! asset('theme/layui/images/') !!}/{!!$report['mbti_category']['representative_avatar']!!}" class="img-responsive center-block">
					<div>
						<p>{!!$report['mbti_category']['mbti_english_name']!!}</p>
						<p>代表人物：{!!$report['mbti_category']['representative_person']!!}</p>
						<p>语录：{!!$report['mbti_category']['representative_quotations']!!}</p>
					</div>
				</div>
			</div>
			<div class="col-md-10 col-sm-9 col-xs-12">
				<div class="describe_main_right">
					<div>
						<div class="brief_description">
							{!!$report['mbti_category']['brief_description']!!}
						</div>
					</div>
					{{--<div class="describe_box1">--}}
					{{--<p>您适合的职业有：</p>--}}
					{{--</div>--}}
				</div>
			</div>
		</div>
	</div>
	<!---------------------基本描述---------------------------->

	<!---------------------学科兴趣---------------------------->
	<div class="subject bgColor mb30 container">
		<div class="test_tit">学科兴趣</div>
		<div class="row">
			<div class="col-md-12">
				<div id="subject"></div>
			</div>
		</div>
	</div>
	<!---------------------学科兴趣---------------------------->

	<!---------------------专业排行---------------------------->
	<div class="rank bgColor mb30 container">
		<div class="test_tit">专业排行</div>
		<div class="row">
			<div class="col-md-12">
				<div id="major"></div>
			</div>
		</div>
	</div>
	<!---------------------专业排行---------------------------->

    <!---------------------院校列表---------------------------->
  <div class="rank bgColor mb30 container">
    <div class="test_tit">推荐院校</div>
    <div class="table-responsive userTable" id="school">
      <table class="table table-responsive table-bordered">
        <thead>
          <tr>
            <th>院校名称</th>
            <th>院校代码</th>
            <th>院校性质</th>
            <th>211</th>
            <th>985</th>
            <th>综合排名</th></tr>
        </thead>
        <tbody>
          <tr>
            <td>北京大学</td>
            <td>4111010001</td>
            <td>公办</td>
            <td>是</td>
            <td>是</td>
            <td>2</td></tr>
          <tr>
            <td>北京交通大学</td>
            <td>4111010004</td>
            <td>公办</td>
            <td>是</td>
            <td>否</td>
            <td>55</td></tr>
          <tr>
            <td>北京航空航天大学</td>
            <td>4111010006</td>
            <td>公办</td>
            <td>是</td>
            <td>是</td>
            <td>24</td></tr>
        </tbody>
      </table>
    </div>
  </div>
  <!---------------------院校列表---------------------------->


</div>
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts.min.js"></script>
<!-- 优势 -->
<script type="text/javascript">
    var dom = document.getElementById("evaluate");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    option = {
        tooltip: {},
        radar: {
            name: {
                textStyle: {
                    color: '#fff',
                    backgroundColor: '#f00',
                    borderRadius: 3,
                    padding: [5, 5]
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
            center: ['50%', '50%'],
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
    ;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>
<!-- 能力分析 -->
<script type="text/javascript">
    var dom = document.getElementById("ability1");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    option = {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '机械操作能力',
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
                    fontSize: 16,
                    color: '#ffffff'
                }
            }
        }]
    };
    ;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>
<script type="text/javascript">
    var dom = document.getElementById("ability2");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    option = {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '科学研究能力',
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
                    fontSize: 16,
                    color: '#ffffff'
                }
            }
        }]
    };
    ;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>
<script type="text/javascript">
    var dom = document.getElementById("ability3");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    option = {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '艺术创作能力',
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
                    fontSize: 16,
                    color: '#ffffff'
                }
            }
        }]
    };
    ;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>
<script type="text/javascript">
    var dom = document.getElementById("ability4");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    option = {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '解释表达能力',
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
                    fontSize: 16,
                    color: '#ffffff'
                }
            }
        }]
    };
    ;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>
<script type="text/javascript">
    var dom = document.getElementById("ability5");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    option = {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '商业洽谈能力',
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
                    fontSize: 16,
                    color: '#ffffff'
                }
            }
        }]
    };
    ;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>
<script type="text/javascript">
    var dom = document.getElementById("ability6");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    option = {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '事务执行能力',
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
                    fontSize: 16,
                    color: '#ffffff'
                }
            }
        }]
    };
    ;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>
<!-- 技能分析 -->
<script type="text/javascript">
    var dom = document.getElementById("skill1");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    option = {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '体育技能',
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
                    fontSize: 16,
                    color: '#ffffff'
                }
            }
        }]
    };
    ;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>
<script type="text/javascript">
    var dom = document.getElementById("skill2");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    option = {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '数学技能',
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
                    fontSize: 16,
                    color: '#ffffff'
                }
            }
        }]
    };
    ;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>
<script type="text/javascript">
    var dom = document.getElementById("skill3");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    option = {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '音乐技能',
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
                    fontSize: 16,
                    color: '#ffffff'
                }
            }
        }]
    };
    ;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>
<script type="text/javascript">
    var dom = document.getElementById("skill4");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    option = {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '交际技能',
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
                    fontSize: 16,
                    color: '#ffffff'
                }
            }
        }]
    };
    ;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>
<script type="text/javascript">
    var dom = document.getElementById("skill5");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    option = {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '领导技能',
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
                    fontSize: 16,
                    color: '#ffffff'
                }
            }
        }]
    };
    ;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>
<script type="text/javascript">
    var dom = document.getElementById("skill6");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    option = {
        tooltip: {
            formatter: "{a} : {c}%"
        },
        series: [{
            name: '办公技能',
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
                    fontSize: 16,
                    color: '#ffffff'
                }
            }
        }]
    };
    ;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>
<!-- MBTI倾向示意图 -->
<script>
    var data = [
        {
            "维度": "外倾(E)",
            "维度组": "外倾/内倾",
            "维度值": {{ $report['mbti_e'] }}
        },
        {
            "维度": "内倾(I)",
            "维度组": "外倾/内倾",
            "维度值": -{{ $report['mbti_i'] }}
        },
        {
            "维度": "感觉(S)",
            "维度组": "感觉/直觉",
            "维度值": {{ $report['mbti_s'] }}
        },
        {
            "维度": "直觉(N)",
            "维度组": "感觉/直觉",
            "维度值": -{{ $report['mbti_n'] }}
        },
        {
            "维度": "思维(T)",
            "维度组": "思维/情感",
            "维度值": {{ $report['mbti_t'] }}
        },
        {
            "维度": "情感(F)",
            "维度组": "思维/情感",
            "维度值": -{{ $report['mbti_f'] }}
        },
        {
            "维度": "判断(J)",
            "维度组": "判断/理解",
            "维度值": {{ $report['mbti_j'] }}
        },
        {
            "维度": "理解(p)",
            "维度组": "判断/理解",
            "维度值": -{{ $report['mbti_p'] }}
        },
    ];
    // 按照维度排序
    data.sort(function (obj1, obj2) {
        return obj1['维度'] > obj2['维度'] ? 1 : -1;
    });

    var Frame = G2.Frame;
    var frame = new Frame(data);
    // 将'维度值','未维度值' 合并成一列，增加完成状态字段
    frame = Frame.combinColumns(frame, ['维度值'], '维度数值');
    var chart = new G2.Chart({
        // id: 'c1',
        container: document.getElementById('c1'),
        forceFit: true,
        // width: 1040,
        height: 450,
        plotCfg: {
            margin: [10, 75, 20]
        },
        licenseKey: 'OPEN-SOURCE-GPLV3-LICENSE'
    });
    chart.source(frame, {
        '维度数值': {
            min: -30,
            max: 30,
        }
    });
    chart.coord().transpose();
    chart.axis('维度组', {
        title: null,
        labels: {
            // autoRotate: true | false, // 文本是否允许自动旋转
            label: {
                // textAlign: 'left', // 文本对齐方向，可取值为： left center right
                fill: '#666', // 文本的颜色
                fontSize: '12', // 文本大小

                // rotate: 30 // 文本旋转角度
            }
        }
    });

    chart.axis('维度数值', {
        formatter: function (value) {
            value = parseInt(value);
            return Math.abs(value); // 将负数格式化成正数
        },
        title: null,

        labels: {
            autoRotate: true, // 文本是否允许自动旋转
            label: {
                textAlign: 'center', // 文本对齐方向，可取值为： left center right
                fill: '#666', // 文本的颜色
                fontSize: '12', // 文本大小

                // rotate: 30 // 文本旋转角度
            }
        },
    });
    chart.legend({
        title: {
            fill: '#333',
            fontSize: 12
        },
        word: {
            fill: '#333',
            fontSize: 12
        }
    });
    chart.interval().shape('textInterval').position('维度组*维度数值').color('维度');
    chart.render();
    chart.on('tooltipchange', function (e) {
        e.items[0].value = Math.abs(e.items[0].value);
        e.items[1].value = Math.abs(e.items[1].value);
    });
</script>
<!-- 学科兴趣 -->
<script type="text/javascript">
    var dom = document.getElementById("subject");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    app.title = '坐标轴刻度与标签对齐';

    option = {
        color: ['#3398DB'],
        tooltip: {
            trigger: 'axis',
            axisPointer: { // 坐标轴指示器，坐标轴触发有效
                type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
            }
        },
        grid: {
            left: '0%',
            right: '0%',
            bottom: '2%',
            containLabel: true
        },
        xAxis: [{
            type: 'category',
            data: ['语文', '数学', '外语', '物理', '化学', '生物', '历史', '政治', '地理'],

            textStyle: {
                fontSize: 12,
                color: 'red'
            },

            axisLine: {
                lineStyle: {
                    color: '#666'
                }
            },
            axisLabel: {
                formatter: function (val) {
                    return val.split("").join("\n");
                }
            }
        }],
        yAxis: [{
            name: '',
            type: 'value',
            max: 100,
            axisLine: {
                lineStyle: {
                    color: '#666'
                }
            }
        }],
        series: [{
            name: '学科匹配度分析',
            type: 'bar',
            barWidth: '40%',
            data: [{{ $report['subject_ratio']['chinese'] }}, {{ $report['subject_ratio']['math'] }},
				{{ $report['subject_ratio']['english'] }}, {{ $report['subject_ratio']['physics'] }},
				{{ $report['subject_ratio']['chemistry'] }}, {{ $report['subject_ratio']['biology'] }},
				{{ $report['subject_ratio']['history'] }}, {{ $report['subject_ratio']['politics'] }},
				{{ $report['subject_ratio']['geography'] }}]
        }]
    };
    ;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>
<!-- 专业排行 -->
<script type="text/javascript">
    var dom = document.getElementById("major");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    app.title = '堆叠条形图';

    option = {
        color: ['#3398DB'],
        tooltip: {
            trigger: 'axis'
        },
        dataset: {
			@php
				$a = array_reverse($report['majors_subject'])
			@endphp
            source: [
					@foreach($a as $key=>$value)
					@if(is_array($value))
					@foreach($value as $k=>$v)
                [{{$report['subject_ratio'][$key] + $k}}, "{{$v['majors']['name']}}"],
				@endforeach
				@endif
				@endforeach
            ]
        },
        grid: {
            left: '0',
            right: '2%',
            bottom: '2%',
            containLabel: true
        },
        xAxis: {
            name: '',
            max: 100,
            axisLine: {
                lineStyle: {
                    color: '#666'
                }
            }
        },
        yAxis: {
            type: 'category',
            axisLine: {
                lineStyle: {
                    color: '#666'
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
    ;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>
</body>

</html>