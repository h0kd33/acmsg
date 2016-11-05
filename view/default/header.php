<?php defined('ACC')||exit('ACC Denied');$isLogin = userModel::isLogin();?>
<div class="container">
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<div class="navbar-header">
					<a href="javascript:void(0);" id="cat-btn" class="btn navbar-toggle pull-left" data-toggle="collapse" data-target="#lmenu">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<script>
						$('#cat-btn').click(function() {
							$('html, body').scrollTop(0);
						});
					</script>
					<a href="./" class="navbar-brand"><?php echo SITENAME;?></a>
					<button style="border:none" class="navbar-toggle" data-toggle="collapse" data-target="#userbar">
						<?php if (!$isLogin){ ?>
							<span class="glyphicon glyphicon-user" style="color:#fff"></span>
						<?php } else { ?>
							<span style="color:#fff"><?php echo $_SESSION['nickname'];?></span>
						<?php } ?>
					</button>
				</div>
				<div id="userbar" class="navbar-collapse collapse">
					<ul class="navbar-nav nav navbar-right">
						<?php if (!$isLogin){ ?>
							<li><a href="./login.php">登陆</a></li>
							<li><a href="./login.php?tab=2">注册</a></li>
						<?php } else { ?>
							<li class="hidden-xs curr-login">当前登陆：<?php echo $_SESSION['nickname'];?></li>
							<li><a href="./ucenter.php">个人中心</a></li>
							<li><a href="./logout.php">退出登陆</a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>