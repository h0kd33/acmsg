<?php

/*
file config.inc.php
配置文件
 */

defined('ACC')||exit('ACC Denied');
$_CFG = array();
$_CFG['use_mysqli'] = true;		  //是否使用mysqli
$_CFG['host'] = '127.0.0.1';	  //数据库地址
$_CFG['user'] = 'root';			    //数据库用户名
$_CFG['pass'] = 'password';		  //数据库密码
$_CFG['db'] = 'msg';			      //数据库名
$_CFG['charset'] = 'utf8';		  //编码，请使用utf8确保安全性
$_CFG['report_tid'] = 39;		    //举报串id，默认即可
$_CFG['post_cd'] = 30;			    //发表内容cd
$_CFG['site_name'] = '讨论区';	  //网站名
