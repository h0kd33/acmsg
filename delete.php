<?php
define('ACC', true);
require('init.php');

userModel::isLogin()||showMsg('没有登陆！', true, './');
$_SESSION['type']>0||showMsg('权限不足！', true, './');
empty($_GET['tid'])&&showMsg('参数错误！', true, './');
$tid = (int)$_GET['tid'];
$f = empty($_GET['f'])?'':(int)$_GET['f'];
$f = $f===0?'':$f;
$msg = new msgModel();
$message = '';
if ($f==='') {
	$re = $msg->delThread($tid);
	if ($re[0]) {
		$message = '已删除tid为'.$tid.'的讨论主题。<br />';
	} else {
		$message = '删除tid为'.$tid.'的讨论主题失败！<br />';
	}
	if ($re[1]) {
		$message .= '已删除tid为'.$tid.'的讨论主题下的所有回应。';
	} else {
		$message .= '删除tid为'.$tid.'的讨论主题下的所有回应失败！';
	}
	if (isset($_SERVER['HTTP_REFERER'])&&stripos($_SERVER['HTTP_REFERER'],'view.php')===false) {
		showMsg($message, true);
	} else {
		showMsg($message, true, './');
	}
} else {
	$re = $msg->delReply($tid, $f);
	if ($re) {
		$message .= '已删除tid为'.$tid.'的讨论主题下第'.$f.'楼回应。';
	} else {
		$message .= '删除tid为'.$tid.'的讨论主题下第'.$f.'楼回应失败！';
	}
}
showMsg($message, true);