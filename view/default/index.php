<?php defined('ACC')||exit('ACC Denied');?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width" />
	<title><?php echo $curr_cat['cat_name'],' - ',SITENAME;;?></title>
	<script src="http://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="view/default/css/main.css">
</head>
<body>
<?php require(ROOT . 'view/default/header.php');?>
<div class="side-tool hidden-xs">
	<a href="./theme.php?id=2" title="切换到蓝色主题（适合电脑浏览）"><span class="glyphicon glyphicon-adjust"></span></a>
	<br>
	<a id="gotoTop" href="#" title="前往顶部"><span class="glyphicon glyphicon-chevron-up"></span></a>
	<a href="#" onclick="location.reload();" title="刷新"><span class="glyphicon glyphicon-refresh"></span></a>
	<a id="gotoBottom" href="#new-discuss" title="前往底部"><span class="glyphicon glyphicon-chevron-down"></span></a>
	<script>
		$('#gotoTop').click(function(){
			$('html, body').animate({scrollTop:0}, 300);
			return false;
		});
		$('#gotoBottom').click(function(){
			$('html, body').animate({scrollTop:$(document).height()}, 300);
			return false;
		});
	</script>
</div>
<div class="quoteview"></div>
<div class="container">
	<div class="row">
		<div class="col-sm-3">
			<?php require(ROOT . 'view/default/lmenu.php');?>
		</div>
		<div class="col-sm-9 main">
			<h2 style="text-align:center"><b><?php echo $curr_cat['cat_name'];?></b></h2>
			<p style="text-align:center;color:#CC0000"><?php echo $curr_cat['intro'];?></p>
			<hr />
			<?php
				if (count($threads)==0) {
					echo '<div style="padding:20px 0;text-align: center;font-size: 20px;">还没有人发起讨论，由你发起第一个讨论吧！</div>';
				}
				foreach ($threads as $k => $t) {
			?>
			<div class="discussion" tid="<?php echo $t['tid'];?>">
				<span class="text-title"><?php echo $t['title'];?></span>
				<span class="text-nickname"><?php echo $t['name'];?></span>
				<span class="text-date"><?php echo date('Y-m-d H:i:s',$t['pubtime']);?></span>
				<?php $ID=$t['type']>0?userModel::getUsername($t['uid']):substr(md5($t['uid'].$t['title'].$t['tid']), -8);?>
				<span<?php echo $t['type']>0?' style="color:red"':'';?> class="text-id">ID:<?php echo $ID;?></span>
				<br class="visible-xs visible-sm"/>
				<?php if(userModel::isLogin()){ ?>
				<span class="text-link-sm">[<a target="_blank" href="view.php?id=<?php echo $report_tid;?>&reply=%3e%3e<?php echo $t['tid']?>">举报</a>]</span>
				<span class="text-link-sm">[<a href="subscribe.php?tid=<?php echo $t['tid']?>"><?php echo subscriptionModel::isSubscribed($t['tid'])?'取消订阅':'订阅';?></a>]</span>
				<?php } ?>
				<?php if(userModel::isLogin()&&$_SESSION['type']>0){ ?>
				<span class="text-link-sm">[<a target="_blank" href="edit.php?tid=<?php echo $t['tid']?>">编辑</a>]</span>
				<span class="text-link-sm">[<a onclick="if(!confirm('要<?php echo $t['SAGE']==1?'解除':'';?>SAGE吗?')){return false;};" href="sage.php?tid=<?php echo $t['tid']?>"><?php echo $t['SAGE']==1?'解除':'';?>SAGE</a>]</span>
				<span class="text-link-sm">[<a onclick="if(!confirm('确实要删除吗?')){return false;};" href="delete.php?tid=<?php echo $t['tid']?>">删除</a>]</span>
				<?php } ?>
				<span class="text-link">[<a target="_blank" href="view.php?id=<?php echo $t['tid'];?>">回应</a>]</span>
				<p class="text-content"><?php echo $t['content'];?></p>
				<?php echo $t['SAGE']==0?'':'<p style="font-size:14px;font-weight:700;color:#D85030"><span class="glyphicon glyphicon-thumbs-down"></span> 本串已经被SAGE（<abbr  title="该串不会因为新回应而被顶到页首">?</abbr>）</p>' ?>
				<?php 
					$reply_num = $msg->countReplies($t['tid']);
					if ($reply_num-5 > 0) {
						echo '<p style="color:#707070"><span class="glyphicon glyphicon-plus-sign"></span> 提示: 回应有'.($reply_num-5).'篇被省略。要阅读所有回应请按下回应链接。</p>';
					}
					foreach ($replies[$k] as $key => $value) { 
				?>
				…<div class="reply" floor=<?php echo $value['floor'],'>#',$value['floor'];?>
					<span class="text-nickname"><?php echo $value['name'];?></span>
					<span class="text-date"><?php echo date('Y-m-d H:i:s', $value['reptime']);?></span>
					<?php $ID=$value['type']>0?userModel::getUsername($value['uid']):substr(md5($value['uid'].$t['title'].$t['tid']), -8);?>
					<span<?php echo $value['type']>0?' style="color:red"':'';?> class="text-id">ID:<?php echo $ID;?></span>
					<?php echo $value['uid']==$t['uid']?'<span class="text-po">(PO主)</span>':'';?>
					<br class="visible-xs visible-sm"/>
					<?php if(userModel::isLogin()){ ?>
					<span class="text-link-sm">[<a target="_blank" href="view.php?id=<?php echo $report_tid;?>&reply=%3e%3e<?php echo $t['tid'],'%3e',$value['floor'];?>">举报</a>]</span>
					<?php } ?>
					<?php if(userModel::isLogin()&&$_SESSION['type']>0){ ?>
						<span class="text-link-sm">[<a target="_blank" href="edit.php?tid=<?php echo $t['tid']?>&f=<?php echo $value['floor']?>">编辑</a>]</span>
						<span class="text-link-sm">[<a onclick="if(!confirm('确实要删除吗?')){return false;};" href="delete.php?tid=<?php echo $t['tid']?>&f=<?php echo $value['floor']?>">删除</a>]</span>
						<?php } ?>
					<span class="text-link-sm">[<a target="_blank" href="view.php?id=<?php echo $t['tid'];?>&reply=%3e%3e<?php echo $t['tid'],'%3e',$value['floor'];?>#reply">回复</a>]</span>
					<p class="text-content"><?php echo $value['content'];?></p>
				</div>
				<br>
				<?php } ?>
			</div>
			<hr>
			<?php } ?>
			<script src="view/default/js/quoteview.js"></script>
			<?php require(ROOT . 'view/default/pagination.php') ?>
			<hr>
			<div id="new-discuss">
				<p>快速发起新的讨论</p>
				<form action="newdiscus.php" method="POST">
					<span class="formtext">标题：</span><input type="text" name="title" maxlength="30"><br>
					<?php include(ROOT . 'view/default/textface.html');?>
					<span class="formtext">正文：</span><input class="btn btn-default" type="submit" value="发送"><br>
					<textarea name="content" id="content" cols="30" rows="7"></textarea>
					<input type="hidden" name="cat" value="<?php echo $curr_cat_id;?>">
				</form>
			</div>
		</div>
	</div>
</div>
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</body>
</html>