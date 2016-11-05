<?php

defined('ACC')||exit('ACC Denied');
//递归转义数组
function _addslashes($arr) {
	foreach ($arr as $key => $val) {
		$arr[$key] = is_array($val)?_addslashes($val):addslashes($val);
	}
	return $arr;
}

/**
 * 显示系统信息
 *
 * @param string $msg 信息
 * @param string $url 返回地址
 * @param boolean $isAutoGo 是否自动返回 true false
 */
function showMsg($msg, $isAutoGo = false, $url = '') {
	if ($url == '') {
		$url = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'javascript:history.back(-1);';
	}
	if ($msg == '404') {
		header("HTTP/1.1 404 Not Found");
		$msg = '抱歉，你所请求的页面不存在！';
	}
	echo <<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
EOT;
	if ($isAutoGo) {
		echo "<meta http-equiv=\"refresh\" content=\"1.25;url=$url\" />";
	}
	echo <<<EOT
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=0.7">
<title>提示信息</title>
<style type="text/css">
<!--
body {
	background-color:#F7F7F7;
	font-family: Arial;
	font-size: 12px;
	line-height: 150%;
	text-align: center;
}
.main {
	background-color:#FFFFFF;
	font-size: 12px;
	color: #666666;
	display: inline-block;
	margin:60px auto 0px;
	border-radius: 10px;
	padding:30px 10px;
	list-style:none;
	border:#DFDFDF 1px solid;
}
.main p {
	line-height: 18px;
	margin: 5px 20px;
}
-->
</style>
</head>
<body>
<div class="main">
<p style="color:#6a6a6a;font-weight:bold;font-size:22px;line-height:2em">$msg</p>
EOT;
	if (!$isAutoGo) {
		echo '<p><a href="' . $url . '">&laquo;点击返回</a></p>';
	} else {
		echo '<p style="margin-left:25px">自动跳转中……</p>';
	}
	echo <<<EOT
</div>
</body>
</html>
EOT;
	exit;
}