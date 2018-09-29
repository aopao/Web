@include('assessment.comment.header')
<div class="bgf">
	<div class="tem_div">
		<h2 class="i_h">测评项目：@lang('assessment/primary.primary_name')</h2>
		<p class="i_num">测评题数：93道题</p>
		<p class="i_date">测评日期：{{ date('Y年m月d日',time()) }}</p>
	</div>
	<a href="javascript:void(0)" class="start_a">生成报告</a>
</div>

</body>

</html>