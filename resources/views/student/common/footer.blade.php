<script src="{{ asset("theme/layui/js/jquery.min.js") }}"></script>
<script src="{{ asset("theme/layui/js/bootstrap.min.js") }}"></script>
<script>
    $(function () {
        $(".nav>li>a").click(function () {
            $(this).siblings(".navBar1").toggle().parent('li').siblings(".navBar1").toggle();
            $(this).children('span').toggleClass("glyphicon-menu-right glyphicon-menu-down");
        });
    });
</script>
@yield('js')
</body>
</html>