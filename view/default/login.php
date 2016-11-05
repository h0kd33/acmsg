<?php defined('ACC')||exit('ACC Denied'); ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width" />
    <title>登陆 - <?echo SITENAME;?></title>
    <script src="http://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/default/css/login.css">
</head>
<body>
<div class="container">
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <div class="navbar-header">
                    <a href="./" class="navbar-brand"><?php echo SITENAME;?></a>
                    <button style="border:none" class="navbar-toggle" data-toggle="collapse" data-target="#userbar">
                        <span class="glyphicon glyphicon-user" style="color:#fff"></span>
                    </button>
                </div>
                <div id="userbar" class="navbar-collapse collapse">
                    <ul class="navbar-nav nav navbar-right">
                        <li><a href="./login.php">登陆</a></li>
                        <li><a href="./login.php?tab=2">注册</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <h1><a href="./"><?echo SITENAME;?></a><sup>Sign in</sup></h1>
    <div class="bar">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="javascript:void(0);" class="login-link active">快速登陆</a>
                <a href="javascript:void(0);" class="reg-link">快速注册</a>
            <div class="heading-line"></div>
            </div>
            <div class="panel-body">
                <form class="login-form" action="loginAct.php" method="POST">
                    <div class="form-group user">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input name="username" type="text" class="form-control" placeholder="输入用户名" maxlength="16">
                        </div>
                    </div>

                    <div class="form-group pwd">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input name="password" type="password" class="form-control" placeholder="输入密码" maxlength="16">
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="登陆">
                    </div>
                </form>

                <form class="reg-form" action="regAct.php" method="POST" accept-charset="utf-8">
                    <div class="form-group user">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input name="username" type="text" class="form-control input-sm username" placeholder="设置用户名，5-16位，以字母开头" maxlength="16">
                        </div>
                    </div>

                    <div class="form-group nname">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-heart"></span></span>
                            <input type="text" class="form-control input-sm nickname" placeholder="设置昵称，2-10位，不填默认为：&quot;匿名&quot;" maxlength="10">
                            <input type="hidden" name="nickname" value="匿名">
                        </div>
                    </div>

                    <div class="form-group pwd">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input name="password" type="password" class="form-control input-sm password" placeholder="设置密码，5-16位" maxlength="16">
                        </div>
                    </div>

                    <div class="form-group rpwd">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-ok-sign"></span></span>
                            <input type="password" class="form-control input-sm repeat" placeholder="重复密码" maxlength="16">
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="确认信息并注册">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="view/default/js/login.js"></script>
</body>
</html>