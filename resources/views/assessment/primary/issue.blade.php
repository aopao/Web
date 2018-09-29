@include('assessment.comment.header')

<form id="question" action="{{ route('assessment.primary.report') }}" method="post">
	{{ csrf_field() }}
	<input type="hidden" name="serial_number_id" value="{{ $data['serial_number_id'] }}">
	<input type="hidden" name="serial_number" value="{{ $data['serial_number'] }}">
	<input type="hidden" name="mobile" value="{{ $data['mobile'] }}">
	<input type="hidden" name="username" value="{{ $data['username'] }}">
	<div class="bgf">
		@foreach ($issues as $key=>$issue)
			<div class="mainbox_w ptbn unselected" @if($key==0) style="display: block;" @endif>
				<h3 class="progress_t" style="text-align:left;position:relative;">
					<div class="numbox"><span class="num1">{{ $issue['id'] }}</span><span class="num">/{{ count($issues) }}</span></div>
					{{ $issue['issue'] }}
				</h3>
				<div class="template_box Wspan">
					<span class="template_span" data-val="0"><p>{{ $issue['answer1'] }}</p></span>
					<span class="template_span" data-val="1"><p>{{ $issue['answer2'] }}</p></span>
					<input type="hidden" name="answer{{ $issue['id'] }}"></div>
			</div>
		@endforeach
	</div>
</form>
</div>
<script type="text/javascript" src="{{ asset("theme/layui/js/common.js") }}"></script>
<script type="text/javascript">
    var tt;
    $(function () {
        $('div.bgf>div.unselected:first-child').show();
        $(".template_span").click(function () {
            window.clearTimeout(tt);
            var opt = $(this);
            opt.parent(".template_box").children("span").removeClass("template_click");
            opt.addClass("template_click");
            opt.closest('.mainbox_w').removeClass('unselected');
            opt.parent(".template_box").find("input:hidden").val(opt.attr('data-val'));
            tt = setTimeout(function () {
                opt.closest('.mainbox_w').fadeOut(200, function () {
                    $('div.bgf div.unselected:first').show();
                    if ($('div.bgf div.unselected:first').size() == 0) {
                        $('#question').submit();
                    }
                });
            }, 400);
        })
    });
</script>
</body>
</html>