@include('assessment.comment.header')
<div class="loading_box">
	<div class="tem_div loading">正在生成报告中，请稍后 ...</div>
	<div class="scene">
		<svg version="1.1" id="dc-spinner" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width:
		"38" height: "38" viewBox="0 0 38 38" preserveAspectRatio="xMinYMin meet">
		<text x="17" y="23" font-family="Monaco" font-size="10px" id="time_delay" style="letter-spacing:0.6" fill="grey">
			<animate attributeName="opacity" values="0;1;0" dur="1.8s" repeatCount="indefinite"></animate>
		</text>
		<path fill="#373a42" d="M20,35c-8.271,0-15-6.729-15-15S11.729,5,20,5s15,6.729,15,15S28.271,35,20,35z M20,5.203
    C11.841,5.203,5.203,11.841,5.203,20c0,8.159,6.638,14.797,14.797,14.797S34.797,28.159,34.797,20
    C34.797,11.841,28.159,5.203,20,5.203z">
		</path>
		<path fill="#373a42" d="M20,33.125c-7.237,0-13.125-5.888-13.125-13.125S12.763,6.875,20,6.875S33.125,12.763,33.125,20
    S27.237,33.125,20,33.125z M20,7.078C12.875,7.078,7.078,12.875,7.078,20c0,7.125,5.797,12.922,12.922,12.922
    S32.922,27.125,32.922,20C32.922,12.875,27.125,7.078,20,7.078z">
		</path>

		<path fill="#2AA198" stroke="#2AA198" stroke-width="0.6027" stroke-miterlimit="10" d="M5.203,20
      c0-8.159,6.638-14.797,14.797-14.797V5C11.729,5,5,11.729,5,20s6.729,15,15,15v-0.203C11.841,34.797,5.203,28.159,5.203,20z">
			<animateTransform attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" calcMode="spline" keySplines="0.4, 0, 0.2, 1" keyTimes="0;1" dur="2s" repeatCount="indefinite"/>
		</path>

		<path fill="#859900" stroke="#859900" stroke-width="0.2027" stroke-miterlimit="10" d="M7.078,20
  c0-7.125,5.797-12.922,12.922-12.922V6.875C12.763,6.875,6.875,12.763,6.875,20S12.763,33.125,20,33.125v-0.203
  C12.875,32.922,7.078,27.125,7.078,20z">
			<animateTransform attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="1.8s" repeatCount="indefinite"/>
		</path>
		</svg>
	</div>
</div>
<div class="bgf">
	<div class="tem_div tem_div1">
		<h2 class="i_h">测评项目：@lang('assessment/primary.primary_name')</h2>
		<p class="i_date">测评日期：{{ date('Y年m月d日',time()) }}</p>
		<a target="_blank" href="{{ route('assessment.senior.show',['serial_number'=>$db_report['serial_number']]) }}" class="start_a">查看报告</a>
	</div>
</div>

</body>
<script type="text/javascript" src="{{ asset("theme/layui/layui.js") }}"></script>
<script type="text/javascript">
	@if(isset($msg))
    layui.config({
        base: '/theme/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'table'], function () {
        let $ = layui.$
        layer.msg('不要重新刷新!', {icon: 5})
        $('.loading_box').hide();
        $('.tem_div1').fadeIn(1000);
    });
	@else
    setTimeout("show_index()", {{ config('assessment.reprot_parse_time')*1000 }});
    $('#time_delay').text("{{ config('assessment.reprot_parse_time') }}");
    resetCode()

    //倒计时
    function resetCode() {
        $('#time_delay').text("{{ config('assessment.reprot_parse_time') }}");
        $('#J_resetCode').show();
        var second = {{ config('assessment.reprot_parse_time') }};
        var timer = null;
        timer = setInterval(function () {
            second -= 1;
            if (second > 0) {
                $('#time_delay').text(second);
            } else {
                clearInterval(timer);
                $('#time_delay').show();
                $('#J_resetCode').hide();
            }
        }, 1000);
    }

    function show_index() {
        $('.loading_box').hide();
        $('.tem_div1').fadeIn(1000);
    }
	@endif
</script>
</html>