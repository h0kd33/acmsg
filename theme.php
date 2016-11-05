<?php
define('ACC', true);
require('init.php');

empty($_GET['id'])&&showMsg('参数错误！', true);
$id = (int)$_GET['id'];
$themes = array('default', 'normal');
if (isset($themes[$id-1])){
	$_SESSION['template'] = $themes[$id-1];
	showMsg('主题已更换！', true);
} else {
	showMsg('参数错误！', true);
}