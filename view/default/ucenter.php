<?php defined('ACC')||exit('ACC Denied');?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width" />
	<title><?php echo $_SESSION['username']?> 的用户中心</title>
	<script src="http://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="view/default/css/main.css">
	<link rel="stylesheet" href="view/default/css/ucenter.css">
</head>
<body>
<?php require(ROOT . 'view/default/header.php');?>
<div class="quoteview"></div>
<div class="container">
	<div class="row">
		<div class="lbar col-sm-3">
			<div class="userinfo">
				<p class=""><?php echo $_SESSION['username']?></p>
				<p class="text-date">注册日期：<?php echo date('Y-m-d', $_SESSION['regtime']);?></p>
				<p class="text-date">上次登录：<?php echo date('Y-m-d', $_SESSION['lastlogin']);?></p>
			</div>
			<div id="lmenu" class="navbar-collapse collapse" style="padding:0">
				<ul class="nav nav-pills nav-stacked">
					<li <?php echo $cat==1?'class="active" ':''?>><a href="./ucenter.php?cat=1">我发起的讨论</a></li>
					<li <?php echo $cat==2?'class="active" ':''?>><a href="./ucenter.php?cat=2">我的历史回复</a></li>
					<li <?php echo $cat==3?'class="active" ':''?>><a href="./ucenter.php?cat=3">我的订阅串</a></li>
					<li <?php echo $cat==4?'class="active" ':''?>><a href="./ucenter.php?cat=4">信息设定</a></li>
				</ul>
				<hr class="visible-xs">
			</div>
		</div>
		<div class="col-sm-9 main">
			<?php
				$arr = array('threads','replies','order','setting');
				require(ROOT . 'view/default/ucenter_' . $arr[$cat-1] . '.php');
			?>
		</div>
	</div>
</div>
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./view/default/js/u_setting.js"></script>
</body>
</html>