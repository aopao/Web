@include('assessment.comment.header')
<div class="bgf">
	<div class="tem_div test_input">
		<form action="{{ route('assessment.primary.issue') }}" class="form_info layui-form" method="post">
			<input type="hidden" name="serial_number_id" value="{{ $data['id'] }}">
			<input type="hidden" name="serial_number" value="{{ $data['number'] }}">
			{{ csrf_field() }}
			<h2 class="i_h">
				<input type="text" lay-verify="phone" class="name_user w395" name="mobile" placeholder="请输入手机号">
			</h2>
			<h2 class="i_h" style="padding-top: 26px;">
				<input type="text" lay-verify="required" required="true" class="name_user w395" name="username" value="" placeholder="请输入姓名">
			</h2>
			<button class="start_a" lay-submit lay-filter="go">开始测试</button>
		</form>
	</div>
</div>
<script type="text/javascript">
    jQuery('[placeholder]').focus(function () {
        var input = jQuery(this);
        if (input.val() == input.attr('placeholder')) {
            input.val('');
            input.removeClass('placeholder');
        }
    }).blur(function () {
        var input = jQuery(this);
        if (input.val() == '' || input.val() == input.attr('placeholder')) {
            input.addClass('placeholder');
            input.val(input.attr('placeholder'));
        }
    }).blur().parents('form').submit(function () {
        jQuery(this).find('[placeholder]').each(function () {
            var input = jQuery(this);
            if (input.val() == input.attr('placeholder')) {
                input.val('');
            }
        })
    });
</script>
<script src="{{ asset("theme/layui/layui.js") }}"></script>
<script>
    layui.config({
        base: '/theme/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'form'], function () {
        let form = layui.form
        form.on('submit(go)', function (data) {
            if (data.field['username'] === '请输入姓名') {
                layer.msg('请输入姓名', {offset: '100px', icon: 5, time: 1000});
                return false;
            }
        });
    });
</script>
</body>
</html>