<?php
define('ACC', true);
require('init.php');

if(empty($_POST['username'])||empty($_POST['password'])) {
	exit('ACC Denied');
}
userModel::isLogin()&&showMsg('已经处于登陆状态！', true, './');
$user = $_POST['username'];
$pass = $_POST['password'];
$UM = new userModel();
if ($UM->login($user, $pass)) {
	showMsg('登陆成功！即将跳转到主页！', true, './');
} else {
	showMsg('用户名或密码错误！<br />');
}