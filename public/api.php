<!doctype html>
<html lang="en">
<head>
	<meta charset="gb2312">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
	<title>Api</title>
</head>
<body>
<form accept-charset="gb2312"  action="http://cp.17985.cn/mensa/common_submit_hr/submit_mbti_conn_mm.asp" method="post">
	**姓名:<input type="text" name="test_name" value=""><br>
	**邮箱:<input type="text" name="test_email" value=""><br>
	选填:<input type="hidden" name="feishi" value="<?php rand(15, 25) ?>"><br>
	选填:<input type="text" name="hr_email" value="18613379888"><br>
	选填:<input type="text" name="host" value=""><br>
	选填:<input type="text" name="zyfou" value="yes"><br>
	选填:<input type="text" name="code" value=""><br>
	选填:<input type="text" name="tishu" value="93"><br>
	选填:<input type="text" name="sex" value="female"><br>
    <?php
    for ($i = 1; $i < 94; $i++) {
			echo '<input type="text" name="answer'.$i.'" value="'.ceil(rand(0,1)).'">';
    }
    ?>
	<input type="submit" onsubmit="document.charset='gb2312';" value="提交">
</form>
</body>
</html>