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
            value: [holland_r, holland_i, holland_a, holland_s, holland_e, holland_c],
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


myChart[1] = echarts.init(document.getElementById('main2'));
option[1] = {
    tooltip: {},
    radar: {
        shape: 'circle',
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
        ]
    },
    series: [{
        name: '兴趣分析',
        type: 'radar',
        data: [{
            value: [holland_r, holland_i, holland_a, holland_s, holland_e, holland_c],
            name: '兴趣分值',
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

myChart[2] = echarts.init(document.getElementById('main3'));
option[2] = {
    tooltip: {},
    radar: [{
        indicator: [{
            text: '实验型',
            max: 100
        },
            {
                text: '研究型',
                max: 100
            },
            {
                text: '艺术型',
                max: 100
            },
            {
                text: '社会型',
                max: 100
            },
            {
                text: '企业型',
                max: 100
            },
            {
                text: '常规型',
                max: 100
            }
        ]
    }],
    series: [{
        name: '优势和兴趣',
        type: 'radar',
        label: {
            normal: {
                show: true,
                formatter: function (params) {
                    return params.value;
                },
                position: 'insideBottom'
            }
        },
        data: [{
            value: [40, 54, 37, 63, 54, 69],
            name: '优势分值'
        },
            {
                value: [30, 50, 40, 70, 30, 80],
                name: '兴趣分值',
                z: 10,
                areaStyle: {
                    normal: {
                        opacity: 0.9,
                        color: new echarts.graphic.RadialGradient(0.5, 0.5, 1, [{
                            color: '#B8D3E4',
                            offset: 0
                        },
                            {
                                color: '#72ACD1',
                                offset: 1
                            }
                        ])
                    }
                }
            }
        ]
    }]
}

var colors = ['#5793f3', '#d14a61', '#675bba'];
myChart[3] = echarts.init(document.getElementById('main4'));
option[3] = {
    color: colors,
    tooltip: {
        trigger: 'axis'
    },
    grid: {
        top: 50,
        bottom: 50
    },
    xAxis: [{
        type: 'category',
        axisLine: {
            onZero: false,
            lineStyle: {
                color: '#ccc'
            }
        },
        data: ["实用型", "研究型", "艺术型", "社会型", "企业型", "常规型"]
    }],
    yAxis: [{
        type: 'value',
        max: 100,
        splitNumber: 5,
        axisLine: {
            lineStyle: {
                color: '#ccc'
            }
        }
    }],
    series: [{
        name: '优势',
        type: 'line',
        smooth: true,
        data: [40, 54, 37, 63, 54, 69]
    },
        {
            name: '兴趣',
            type: 'line',
            smooth: true,
            data: [30, 50, 40, 70, 30, 80]
        }
    ]
};

myChart[4] = [
    echarts.init(document.getElementById('main5')),
    echarts.init(document.getElementById('main6')),
    echarts.init(document.getElementById('main7')),
    echarts.init(document.getElementById('main8')),
    echarts.init(document.getElementById('main9')),
    echarts.init(document.getElementById('main10')),
];

option[4] = [{
    tooltip: {
        formatter: "{a} : {c}%"
    },
    series: [{
        name: '机械操作',
        type: 'gauge',
        data: [{
            value: holland_ability_r
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
        name: '科学研究',
        type: 'gauge',
        data: [{
            value: holland_ability_i
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
        name: '艺术创新',
        type: 'gauge',
        data: [{
            value: holland_ability_a
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
        name: '解释表达',
        type: 'gauge',
        data: [{
            value: holland_ability_s
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
        name: '商务洽谈',
        type: 'gauge',
        data: [{
            value: holland_ability_e
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
        name: '事务执行',
        type: 'gauge',
        data: [{
            value: holland_ability_c
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

myChart[5] = echarts.init(document.getElementById('main11'));
option[5] = {
    tooltip: {},
    radar: {
        name: {
            textStyle: {
                color: '#fff',
                backgroundColor: '#001224',
                borderRadius: 3,
                padding: [7, 9]
            }
        },
        indicator: [{
            name: '执行力',
            max: 100
        },
            {
                name: '亲和力',
                max: 100
            },
            {
                name: '抗压力',
                max: 100
            },
            {
                name: '规划力',
                max: 100
            },
            {
                name: '推动力',
                max: 100
            },

        ]
    },
    series: [{
        name: '五力素质',
        type: 'radar',
        data: [{
            value: [43, 50, 50, 46, 65],
            name: '五力素质分值',
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

myChart[6] = echarts.init(document.getElementById('main12'));
option[6] = {
    angleAxis: {
        type: 'category',
        data: ['成就型', '勇敢型', '活跃型', '完美型', '友好型', '和平型', '思考型', '感觉型'],
        textStyle: {
            color: '#ccc'
        },
        axisLine: {
            lineStyle: {
                color: '#ccc'
            }
        }
    },
    tooltip: {
        trigger: 'axis',
        formatter: "分值: {c}"
    },
    radiusAxis: {
        z: 10,
        axisLine: {
            lineStyle: {
                color: '#ccc'
            }
        }
    },
    polar: {},
    series: [{
        type: 'bar',
        data: [50, 50, 46, 50, 50, 50, 52, 48],
        coordinateSystem: 'polar'
    }],
    legend: {
        show: true
    }
};

myChart[7] = echarts.init(document.getElementById('main13'));
option[7] = {
    tooltip: {
        formatter: function (e) {
            if (e.data.value > 50) {
                return '右脑:' + (50 - e.data.value / 2)
            } else if (e.data.value == 50) {
                return '平衡'
            } else {
                return '左脑:' + (50 - e.data.value + 10)
            }
        }
    },
    series: [{
        name: '大脑思维分析',
        type: 'gauge',
        data: [{
            value: 40
        }],
        axisLine: { // 坐标轴线
            lineStyle: { // 属性lineStyle控制线条样式
                width: 10
            }
        },
        axisLabel: {
            formatter: function (e) {
                switch (e + "") {
                    case "0":
                        return "左脑";
                    case "10":
                        return "80";
                    case "20":
                        return "60";
                    case "30":
                        return "40";
                    case "40":
                        return "20";
                    case "50":
                        return "平衡";
                    case "60":
                        return "20";
                    case "70":
                        return "40";
                    case "80":
                        return "60";
                    case "90":
                        return "80";
                    case "100":
                        return "右脑";
                    default:
                        return e;
                }
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
            formatter: function (e) {
                var efs = Number(e);
                if (efs > 50) {
                    return '右脑:' + (50 - efs / 2)
                } else if (efs == 50) {
                    return '平衡'
                } else {
                    return '左脑:' + (50 - efs + 10)
                }
            },
            textStyle: {
                fontSize: 22,
                color: '#ffffff'
            }
        }
    }]
};

myChart[8] = echarts.init(document.getElementById('main14'));
option[8] = {
    radar: [{
        indicator: [{
            text: '动觉智能',
            max: 100
        },
            {
                text: '语言智能',
                max: 100
            },
            {
                text: '逻辑智能',
                max: 100
            },
            {
                text: '人际智能',
                max: 100
            },
            {
                text: '自然智能',
                max: 100
            },
            {
                text: '空间智能',
                max: 100
            },
            {
                text: '内省智能',
                max: 100
            },
            {
                text: '音乐智能',
                max: 100
            }
        ]
    }],
    series: [{
        name: '智能分析',
        type: 'radar',
        smooth: 1,
        data: [{
            value: [30, 40, 50, 55, 40, 30, 50, 25],
            name: '智能分值',
            label: {
                normal: {
                    show: true,
                    formatter: function (params) {
                        return params.value;
                    },
                    position: 'insideBottom'
                }
            },
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
    }]
}


$("#main15").css('width', 1040);
$("#main15").css('height', 500);
myChart[9] = echarts.init(document.getElementById('main15'));
option[9] = {
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
myChart[10] = echarts.init(document.getElementById('main16'));
option[10] = {
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
myChart[11] = echarts.init(document.getElementById('main17'));
option[11] = {
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

$("#main18").css('width', 1040);
$("#main18").css('height', 500);
myChart[14] = echarts.init(document.getElementById('main18'));
option[14] = {
    color: ['#3398DB'],
    tooltip: {
        trigger: 'axis'
    },
    dataset: {
        source: [
            [55, '040301-体育教育'],
            [54, '110206-人力资源教育'],
            [54, '110202-市场营销'],
            [53, '110803-酒店管理'],
            [52, '020401-国际经济与贸易'],
            [52, '090301-动物科学'],
            [52, '120309-播音与主持艺术'],
            [51, '020202-税收学'],
            [51, '040307M-休闲体育'],
            [50, '020303-保险学']
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