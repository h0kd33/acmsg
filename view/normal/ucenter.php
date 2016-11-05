<?php defined('ACC')||exit('ACC Denied');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION['username']?> 的用户中心</title>
	<link rel="stylesheet" href="view/normal/css/main.css">
	<script src="http://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<div class="container" style="padding:0">
	<div class="lmenu" style="padding-top:15px">
		<p style="font-size:25px;text-align:center;margin-bottom:10px"><?php echo $_SESSION['username']?></p>
		<p style="font-size:13px;text-align:center;margin-bottom:5px;color:#666">注册日期：<?php echo date('Y-m-d', $_SESSION['regtime']);?></p>
		<p style="font-size:13px;text-align:center;margin-bottom:10px;color:#666">上次登录：<?php echo date('Y-m-d', $_SESSION['lastlogin']);?></p>
		<ul>
			<li><a <?php echo $cat==1?'class="lmenu-active" ':''?>href="./ucenter.php?cat=1">我发起的讨论</a></li>
			<li><a <?php echo $cat==2?'class="lmenu-active" ':''?>href="./ucenter.php?cat=2">我的历史回复</a></li>
			<li><a <?php echo $cat==3?'class="lmenu-active" ':''?>href="./ucenter.php?cat=3">我的订阅串</a></li>
			<li><a <?php echo $cat==4?'class="lmenu-active" ':''?>href="./ucenter.php?cat=4">信息设定</a></li>
		</ul>
	</div>
	<div class="main" style="min-height:500px">
	<?php
		$arr = array('threads','replies','order','setting');
		require(ROOT . 'view/normal/ucenter_' . $arr[$cat-1] . '.php');
	?>
	</div>
	<?php require(ROOT . 'view/normal/header.php'); ?>
</div>
<?php include(ROOT . 'view/normal/footer.php');?>
</body>
</html>