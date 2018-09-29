<?php
$str = <<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" /><meta name="viewport"content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes"/>

  <title> Ŵ     </title>
 
   <style>
.a-tips-Article-QQ:link {color:#66CCFF;border-bottom:1px 

dotted #0781C7;text-decoration:none}
.a-tips-Article-QQ:hover 

{color:#66CCFF;background:#EBF2FA;text-decoration:none}
.a-tips-Article-QQ:visited {color:#66CCFF;border-

bottom:1px dotted #0781C7;text-decoration:none}

.style123321{font-size:12pt;font-family:"΢   ź "}
</style>
 
<style type="text/css">

.container {
	width:300px;
	height:30px;
	border:solid 1px #CCC;
	margin:100px auto 0 auto;
	padding:1px;
	line-height:30px;
	*line-height:32px;
	position:relative;
	color:#000000;
	
}
#content {
	width:1px;
	height:30px;
	background-color: #cccccc;
}

/*footer*/

.footer {
	font-size: 10px;
	margin:15px auto;
	text-align: center;
}
.footer a {
	color: #cccccc;
	text-decoration: none;
}
.footer a:hover {
	color:#CCCCCC;
}
 
</style>
 <!--

<div id="jindutiao" class="container" >
  <div id="content"  ><span style="text-align:center;position:absolute;width:400px;font-family:'΢   ź '">   ڷ     ...</span></div>
  <br />

<div align="center" style="font-size:11pt;font-family:'΢   ź '">         by  Ŵ </div>
</div>
-->
 

 

 

<style type="text/css">
<!--
.STYLE11 {
	font-size: 11pt;
	line-height: 1.8;
}
.STYLE12 {
	font-size: 11pt;
	line-height: 1.8;
}
.STYLE13 {color: #FFFFFF}
#Layer2 {
	position:absolute;
	width:167px;
	height:115px;
	z-index:1;
	left: 798px;
	top: 154px;
}
.STYLE15 {color: #FF0000}
.STYLE29 {color: #669900}
.STYLE22 {color: #999999}
.STYLE28 {font-size: 11pt; color: #66CC00;}
.STYLE30 {font-size: 11pt}
.STYLE31 {font-size: 11pt; line-height: 1.8; color: #999999; }
.STYLE32 {color: #FFFFFF; font-size: 11pt; }
.STYLE19 {color: #006600}
a:hover {
	color: #990000;
}
.STYLE38 {font-size: 11pt; line-height: 1.8; font-weight: bold; }
/* ؼ  ָ   */
.wckey-tips{width:232px;height:132px;padding:2px 2px 4px 4px;border:#4d637c 1px solid; background:#ebf2fa;color:#666;font-size:12px; font-family:    ,Arial,sans-serif;line-height:18px;overflow:hidden;zoom:1;}
.wckey-tips .close1{ position:relative;width:14px;height:14px;margin:-128px 0 0 218px;line-height:13px; text-align:right; cursor:pointer;}
.wckey-tips .close2{ position:relative;width:14px;height:14px;margin:-126px 0 0 218px;line-height:13px; text-align:right; cursor:pointer;}
.wckey-tips .gamer img{width:50px;height:50px;margin-right:6px;border:none;}
.wckey-tips .gamer table{margin-bottom:4px;width:174px;border:#C6D4E5 1px solid; border-collapse:collapse;}
.wckey-tips .gamer table td{color:#666;border:#C6D4E5 1px solid;background:#fff;line-height:16px; text-align:center; }
.wckey-tips .team img{width:80px;height:60px;margin-right:6px;border:none;}
.wckey-tips .team table{margin-bottom:4px;width:144px;border:#C6D4E5 1px solid; border-collapse:collapse;}
.wckey-tips .team table td{color:#666;border:#C6D4E5 1px solid;background:#fff;line-height:16px; text-align:center; }
.wckey-tips a,.gamer-tips a:visited{color:#0B3B8C; text-decoration:none}
.wckey-tips a:hover{color:#0B3B8C; text-decoration: underline;}
.wckey-tips em{color:#000; font-style:normal;}

.a-tips-Article-QQ:link {color:#66CCFF;border-bottom:1px dotted #0781C7;text-decoration:none}
.a-tips-Article-QQ:hover {color:#66CCFF;background:#EBF2FA;text-decoration:none}
.a-tips-Article-QQ:visited {color:#66CCFF;border-bottom:1px dotted #0781C7;text-decoration:none}
.STYLE39 {font-size: 9pt}

/*    end*/
-->
</style>

<head>
 
 
</head>

<body ><br>
<br>


<table id="showtable"     border="0" align="center">
  <tr>
    <td>
        <span class="STYLE12">
        
 
  <iframe width="100%"  frameborder="0" scrolling="no" src="http://www.17985.cn/common/jiekou.php?hr_email=6mxm@msn.com&test_email=JzTO@sohu.com&theid=95534&liangbiao=MBTI-STEP-I-93-zy&zyfou=yes&test_name=怀鸣卿&host=">   </ifram>

EOT;

$pattern = "/src=\"(.*?)\"/";
if (preg_match($pattern, $str, $arr)) {
    if (is_array($arr) && isset($arr[1])) {
        $url = $arr[1];
        $arr = parse_url($url);
        print_r($arr);
        parse_str($arr['query'], $s);
        print_r($s);
    }
}
