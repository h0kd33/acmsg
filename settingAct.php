<?php

define('ACC', true);
require('init.php');
userModel::isLogin()||exit;
if (empty($_POST['nickname'])||empty($_POST['email'])) {
	exit;
}
$data = array();
if ($_POST['nickname']!=$_SESSION['nickname']) {
	if (mb_strlen($_POST['nickname'],'UTF8')<2||mb_strlen($_POST['nickname'], 'UTF8')>10) {
		exit;
	}
	$data['nickname']=$_POST['nickname'];
}
if ($_POST['email']!=$_SESSION['email']) {
	$email_re = '/^[\\w-]+(\\.\\w+)*@[\\w-]+((\\.\\w{2,3}){1,3})$/';
	if (!preg_match($email_re, $_POST['email'])) {
		exit;
	}
	$data['email']=$_POST['email'];
}
if (count($data)==0) {
	exit('success');
} else {
	$UM = new userModel();
	if ($UM->update($_SESSION['uid'], $data)) {
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['nickname'] = htmlspecialchars($_POST['nickname']);
		exit('success');
	}
}