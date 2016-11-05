<?php

define('ACC',true);
require('init.php');
//实例化留言板操作类
$msg = new msgModel();
//获取全部分类
$allCats = catModel::getCatTree();

//获取当前分类
$curr_cat_id = empty($_GET['cat'])?1:(int)$_GET['cat'];
$curr_cat_id<1 && $curr_cat_id=1;
$curr_cat = catModel::getInfo($curr_cat_id);

//总页数
$all = ceil($msg->countThreads($curr_cat_id)/10);

//获取当前页数
$curr_page = empty($_GET['page'])?1:(int)$_GET['page'];
$curr_page>$all && $curr_page=$all;
$curr_page<1 && $curr_page=1;

//$i开始显示页数，$show结束显示页数
if ($curr_page<=6) {
	$i = 1;
	$show = $all<11?$all:11;
} elseif ($curr_page>6&&$curr_page<=$all-5) {
	$i = $curr_page - 5;
	$show = $curr_page + 5;
} else {
	$i = $all-10;
	$show = $all;
}

//取得<=10个主题
$threads = $all?$msg->getTopThreads(($curr_page-1)*10,$curr_cat_id):array();

//取得每个主题5个以内回复
$replies = array();
foreach ($threads as $k=>$v) {
	$replies[$k] = $msg->getTopReplies($v['tid'], 0);
}

//view
require(ROOT . "view/$template_dir/index.php");