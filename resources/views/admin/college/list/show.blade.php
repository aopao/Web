@extends('admin.layouts.wrap')
@section('content')
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md6">
				<div class="layui-card">
					<div class="layui-card-header">学校名称</div>
					<div class="layui-card-body">
						<table class="layui-table">
							<tbody>
							<tr>
								<td>大学名称</td>
								<td>北京大学</td>
							</tr>
							<tr>
								<td>大学英文名称</td>
								<td>Peking University</td>
							</tr>
							<tr>
								<td>曾用名</td>
								<td>曾用名</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="layui-col-md6">
				<div class="layui-card">
					<div class="layui-card-header">联系方式</div>
					<div class="layui-card-body">
						<table class="layui-table">
							<tbody>
							<tr>
								<td>联系电话</td>
								<td>010-62751407</td>
							</tr>
							<tr>
								<td>联系邮箱</td>
								<td>bdzsb@pku.edu.cn</td>
							</tr>
							<tr>
								<td>联系地址</td>
								<td>北京市海淀区颐和园路5号</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="layui-col-md8">
				<div class="layui-card">
					<div class="layui-card-header">基本信息</div>
					<div class="layui-card-body">
						<table class="layui-table">
							<tbody>
							<tr>
								<td>院校排名</td>
								<td>1</td>
								<td>建校时间</td>
								<td>2018年8月8日</td>
							</tr>
							<tr>
								<td>院校类型</td>
								<td>工科类</td>
								<td>院校国家标码ID</td>
								<td>22</td>
							</tr>
							<tr>
								<td>院校属性</td>
								<td>211/985/一流大学</td>
								<td>学校官网</td>
								<td><a href="http://www.pku.edu.cn">http://www.pku.edu.cn</a></td>
							</tr>
							<tr>
								<td>院校类别</td>
								<td>公办大学</td>
								<td>研究生点</td>
								<td>50个</td>
							</tr>
							<tr>
								<td>隶属部门</td>
								<td>教育部</td>
								<td>博士点</td>
								<td>50个</td>
							</tr>
							<tr>
								<td>院校层次</td>
								<td>本科</td>
								<td>全景</td>
								<td><a href="#">全景</a></td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="layui-col-md4">
				<div class="layui-card">
					<div class="layui-card-header">点击数及指数</div>
					<div class="layui-card-body">
						<table class="layui-table">
							<tbody>
							<tr>
								<td>总点击数</td>
								<td>2656</td>
							</tr>
							<tr>
								<td>月点击数</td>
								<td>265</td>
							</tr>
							<tr>
								<td>周点击数</td>
								<td>565</td>
							</tr>
							<tr>
								<td>学习指数</td>
								<td>2656</td>
							</tr>
							<tr>
								<td>生活指数</td>
								<td>265</td>
							</tr>
							<tr>
								<td>工作指数</td>
								<td>565</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">收费标准</div>
					<div class="layui-card-body">
						<p>一、生命科学学院、信息科学技术学院、元培计划实验班 5300元/学年</p>
						<p>二、医学部所有本科医学专业 6000元/学年</p>
						<p>三、其他院系 5000元/学年</p>
					</div>
				</div>
			</div>
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">就业前景</div>
					<div class="layui-card-body">
						<p>每年１０月份开始，企事业单位新一轮的人才争夺大战就在北大展开。北大本科毕业生的就业领域主要集中在国家机关、高等院校、新闻出版、金融机构、国有企业、三资企业等，近几年去著名跨国公司以及高新技术企业的毕业生比例明显增加。</p>
					</div>
				</div>
			</div>
			<div class="layui-col-md12">
				<div class="layui-card">
					<div class="layui-card-header">院校简介</div>
					<div class="layui-card-body">
						<p>北京大学创办于1898年，初名京师大学堂，是中国第一所国立综合性大学，也是当时中国最高教育行政机关。辛亥革命后，于1912年改为现名。</p>
						<p>作为新文化运动的中心和“五四”运动的策源地，作为中国最早传播马克思主义和民主科学思想的发祥地，作为中国共产党最早的活动基地，北京大学为民族的振兴和解放、国家的建设和发展、社会的文明和进步做出了不可替代的贡献，在中国走向现代化的进程中起到了重要的先锋作用。爱国、进步、民主、科学的传统精神和勤奋、严谨、求实、创新的学风在这里生生不息、代代相传。</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection()
@section('js')
	<!-- 引入在线资源 -->
	<script>
        layui.config({
            base: '/theme/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['index', 'console']);
	</script>
@endsection()
