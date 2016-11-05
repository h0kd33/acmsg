<?php

define('ACC', true);
require('init.php');
userModel::isLogin()||exit;
if (empty($_POST['oldpass'])||empty($_POST['newpass'])) {
	exit;
}
$data = array();
if ($_POST['oldpass']==$_SESSION['password']) {
	if (mb_strlen($_POST['newpass'],'UTF8')<5||mb_strlen($_POST['newpass'], 'UTF8')>16) {
		exit;
	}
	if ($_POST['newpass']==$_SESSION['password']) {
		exit('success');
	} else {
		$UM = new userModel();
		$data['password'] = $_POST['newpass'];
		if ($UM->update($_SESSION['uid'], $data)) {
			$_SESSION['password'] = $_POST['newpass'];
			exit('success');
		}
	}
}