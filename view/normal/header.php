<?php defined('ACC')||exit('ACC Denied');?>
<div class="header">
<div class="container">
<a href="./" id="logo"><h1><?php echo SITENAME;?></h1></a>
<ul>
	<?php if (!userModel::isLogin()){ ?>
	<li style="float:right;width:100px"><a href="login.php?tab=2">注册</a></li>
	<li style="float:right;width:100px"><a href="login.php">登陆</a></li>
	<?php } else { ?>
	<li id="userinfo" style="float:right;"><a href="javascript:void(0)">&nbsp;&nbsp;<?php echo $_SESSION['nickname'];?>&nbsp;&nbsp;</a>
		<ul id="usermenu" style="display:none;float:right">
			<li style="border-bottom:1px solid #ccc"><a href="./ucenter.php">个人中心</a></li>
			<li><a href="./logout.php">退出登陆</a></li>
		</ul>
	</li>
	<?php } ?>
</ul>
</div>
</div>
<script src="http://cdn.bootcss.com/jquery-color/2.1.2/jquery.color.js"></script>
<script>
	var lis = $('.header>.container>ul>li');
	lis.mouseenter(function(){
		$(this).stop().animate({backgroundColor:'#0482BA'}).css('border-color', '#666');
	});
	lis.mouseleave(function(){
		$(this).stop().animate({backgroundColor:'#0593D3'}).css('border-color', '#0593D3');
	});
	<?php if(userModel::isLogin()){?>
	$('#userinfo').mouseenter(function(){
		$(this).css('width',$(this).width());
		typeof timeO != 'undefined'&&clearTimeout(timeO);
		$('#usermenu').stop().slideDown(200);
	});
	$('#userinfo').unbind('mouseleave').mouseleave(function(){
		window.timeO = setTimeout(function(){
			$('#userinfo').stop().animate({backgroundColor:'#0593D3'}).css('border-color', '#0593D3');
			$('#usermenu').stop().slideUp(200);
		}, 1000);
	});
	<?php } ?>
</script>