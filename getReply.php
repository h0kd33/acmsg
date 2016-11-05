<?php
define('ACC', true);
require('init.php');

(empty($_GET['tid']))&&exit('ACC Denied');
$tid = (int)$_GET['tid'];
$f = empty($_GET['f'])?0:(int)$_GET['f'];
$msg = new msgModel();
if ($tid<=0||$f<0){
	exit('没有此信息!');
}
$t = $msg->getThread($tid);
if ($t === false) {
	exit('没有此信息!');
}
if ($f>0) {
	$reply = $msg->getReply($tid, $f);
	if ($reply === false) {
		exit('没有此信息!');
	}
}
if ($f>0) {
	require(ROOT . "view/$template_dir/reply.php");
	exit;
}
require(ROOT . "view/$template_dir/thread.php");