<?php
define('ACC', true);
require('init.php');

userModel::isLogin()||showMsg('请先登陆!', true,'./login.php');
$lastSendTime = empty($_SESSION['cd'])?0:$_SESSION['cd'];
time()-$lastSendTime<CD&&showMsg('发言CD中…先施法吧！');
empty($_POST['cat'])&&showMsg('请从正常页面发起讨论！', true, './');
(int)$_POST['cat']<1&&showMsg('参数错误！', true, './');
empty($_POST['content'])&&showMsg('请输入正文!');
$data = array();
$data['title'] = empty($_POST['title'])?'无标题':$_POST['title'];
$data['content'] = $_POST['content'];
$data['cat'] = (int)$_POST['cat'];
$data['uid'] = (int)$_SESSION['uid'];
$data['name'] = $_SESSION['nickname'];
$data['type'] = $_SESSION['type'];
$msg = new msgModel();
if ($msg->addThread($data)) {
	$_SESSION['cd'] = time();
	showMsg('成功发起讨论！', true);
} else {
	showMsg('发起讨论失败！');
}