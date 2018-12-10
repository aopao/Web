var myChart = [],option = [];
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
			value: [40, 54, 37, 63, 54, 69],
			name: '优势分值',
			label: {
				normal: {
					show: true,
					formatter: function(params) {
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
		name: '自信度',
		type: 'gauge',
		data: [{
			value: 50
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
},{
	tooltip: {
		formatter: "{a} : {c}%"
	},
	series: [{
		name: '自信度',
		type: 'gauge',
		data: [{
			value: 50
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
},{
	tooltip: {
		formatter: "{a} : {c}%"
	},
	series: [{
		name: '自信度',
		type: 'gauge',
		data: [{
			value: 50
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
},{
	tooltip: {
		formatter: "{a} : {c}%"
	},
	series: [{
		name: '自信度',
		type: 'gauge',
		data: [{
			value: 50
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
},{
	tooltip: {
		formatter: "{a} : {c}%"
	},
	series: [{
		name: '自信度',
		type: 'gauge',
		data: [{
			value: 50
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
},{
	tooltip: {
		formatter: "{a} : {c}%"
	},
	series: [{
		name: '自信度',
		type: 'gauge',
		data: [{
			value: 50
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
			value: 50
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
},{
	tooltip: {
		formatter: "{a} : {c}%"
	},
	series: [{
		name: '自信度',
		type: 'gauge',
		data: [{
			value: 50
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
},{
	tooltip: {
		formatter: "{a} : {c}%"
	},
	series: [{
		name: '自信度',
		type: 'gauge',
		data: [{
			value: 50
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
},{
	tooltip: {
		formatter: "{a} : {c}%"
	},
	series: [{
		name: '自信度',
		type: 'gauge',
		data: [{
			value: 50
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
},{
	tooltip: {
		formatter: "{a} : {c}%"
	},
	series: [{
		name: '自信度',
		type: 'gauge',
		data: [{
			value: 50
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
},{
	tooltip: {
		formatter: "{a} : {c}%"
	},
	series: [{
		name: '自信度',
		type: 'gauge',
		data: [{
			value: 50
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

$("#main15").css('width',1040);
$("#main15").css('height',500);
myChart[3] = echarts.init(document.getElementById('main15'));
// option[3] = {
// 	title: {
// 		text: 'ESTP的特质： 挑战者型——不间断地尝试新的挑战',
// 		x: 'center',
// 		textStyle: {
// 			fontSize: 18,
// 			color: '#ccc'
// 		}
// 	},
// 	color: ['#2edfa3', '#bce672', '#ff4777', '#70f3ff', '#4b5cc4', '#f47983', '#8d4bbb', '#6635EF', '#FFAFDA', '#4572A7','#92A8CD', '#A47D7C'],
// 	tooltip: {
// 		trigger: 'item',
// 		formatter: "{a} <br/>{b} : {c} ({d}%)"
// 	},
// 	legend: {
// 		orient: 'vertical',
// 		left: 'left',
// 		data: ['哲学', '艺术学', '管理学', '医学', '农学', '工学', '理学', '历史学', '文学', '教育学', '法学', '经济学']
// 	},
// 	series: [{
// 		name: '系别与专业',
// 		type: 'pie',
// 		radius: '80%',
// 		center: ['50%', '60%'],
// 		data: [{
// 				value: 4,
// 				name: '哲学:4个专业'
// 			},
// 			{
// 				value: 28,
// 				name: '艺术学:28个专业'
// 			},
// 			{
// 				value: 42,
// 				name: '管理学:42个专业'
// 			},
// 			{
// 				value: 36,
// 				name: '医学:36个专业'
// 			},
// 			{
// 				value: 25,
// 				name: '农学:25个专业'
// 			},
// 			{
// 				value: 157,
// 				name: '工学:157个专业'
// 			},
// 			{
// 				value: 36,
// 				name: '理学:36个专业'
// 			},
// 			{
// 				value: 4,
// 				name: '历史学:4个专业'
// 			},
// 			{
// 				value: 71,
// 				name: '文学:71个专业'
// 			},
// 			{
// 				value: 17,
// 				name: '教育学:17个专业'
// 			},
// 			{
// 				value: 32,
// 				name: '法学:32个专业'
// 			},
// 			{
// 				value: 17,
// 				name: '经济学:17个专业'
// 			}
// 		],
// 		itemStyle: {
// 			emphasis: {
// 				shadowBlur: 10,
// 				shadowOffsetX: 0,
// 				shadowColor: 'rgba(0, 0, 0, 0.5)'
// 			}
// 		}
// 	}]
// };

$("#main16").css('width',1040);
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

$("#main17").css('width',1040);
$("#main17").css('height',500);
myChart[5] = echarts.init(document.getElementById('main17'));
option[5] = {
	color: ['#3398DB'],
	tooltip: {
		trigger: 'axis'
	},
	dataset: {
		source: [
			[69, '040106-学前教育'],
			[69, '040107-小学教育'],
			[63, '020304-投资学'],
			[59, '050107M-秘书学'],
			[59, '0502XX-小语种'],
			[57, '040202-应用心理学'],
			[57, '0823XX-农业工程类'],
			[56, '090101-农学'],
			[55, '060104-文物与博物馆学'],
			[54, '090601-水产养殖学']
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
$("#main18").css('width',1040);
$("#main18").css('height',500);
myChart[8] = echarts.init(document.getElementById('main18'));
option[8] = {
	color: ['#3398DB'],
	tooltip: {
		trigger: 'axis'
	},
	dataset: {
		source: [
			[55, '体育教育'],
			[54, '人力资源教育'],
			[54, '市场营销'],
			[53, '酒店管理'],
			[52, '国际经济与贸易'],
			[52, '动物科学'],
			[52, '播音与主持艺术'],
			[51, '税收学'],
			[51, '休闲体育'],
			[50, '保险学']
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

window.onload = function() {
	$(".page2").addClass('on');
}

function next() {
	$(".page1").fadeOut();
	$(".main_index").fadeOut("normal", function() {
		$(this).remove();
		$("#fullpage").show();
		myChart[0].setOption(option[0]);
		myChart[0].resize;
		$('#fullpage').fullpage({
			navigation: true,
			css3: true,
			afterLoad: function(index, nextIndex){
				if(index){
					var beforeindex = index.index;
					if(myChart[beforeindex]){
						if(myChart[beforeindex].length > 1){
							Object.keys(myChart[beforeindex]).forEach(function(key){
								myChart[beforeindex][key].clear();
							});
						}else{
							myChart[beforeindex].clear();
						}
					}
				}
			},
			onLeave: function(index, nextIndex, direction){
				var beforeindex = index.index;
				var thisindex = nextIndex.index;
				if(myChart[thisindex]){
					if(myChart[thisindex].length > 1){
						Object.keys(myChart[thisindex]).forEach(function(key){
							myChart[thisindex][key].setOption(option[thisindex][key]);
							myChart[thisindex][key].resize;
						});
					}else{
						myChart[thisindex].setOption(option[thisindex]);
						myChart[thisindex].resize;
					}
				}
			}
		});
	});
	$(".page1").remove();
}