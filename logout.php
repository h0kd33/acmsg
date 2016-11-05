<?php
define('ACC', true);
require('init.php');
userModel::isLogin()||showMsg('你还没有登陆！', true, './login.php');
userModel::logout();
showMsg('你已退出登陆！', true);