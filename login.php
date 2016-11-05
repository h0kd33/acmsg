<?php

define('ACC', true);
require('init.php');
userModel::isLogin()&&showMsg('您已经处于登陆状态，将跳转到主页！', true, './');
require(ROOT . "view/$template_dir/login.php");