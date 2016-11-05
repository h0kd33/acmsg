<?php defined('ACC')||exit('ACC Denied');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="view\normal\css\main.css">
	<script src="http://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
	<script src="view/normal/js/common.js"></script>
	<title><?php echo 'RID.',$threads[0]['tid'],' - ',$curr_cat['cat_name'],' - ',SITENAME;?></title>
</head>
<body>
<div class="container">
<?php require(ROOT . 'view/normal/header.php'); ?>
	<div class="quoteview"></div>
	<div class="side-tool">
		<a id="gotoTop" href="#" title="前往顶部">∧</a>
		<a style="font-size:17px;line-height:20px" href="#" onclick="location.reload();" title="刷新">︵<br />︶</a>
		<a id="gotoBottom" href="#new-discuss" title="前往底部">∨</a>
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
	<?php require(ROOT . 'view/normal/lmenu.php') ?>
	<div class="main">
		<?php
			foreach ($threads as $k => $t) {
		?>
		<div class="discussion" tid="<?php echo $t['tid'];?>">
			<span class="title"><?php echo $t['title'];?></span>
			<span class="user"><?php echo $t['name'];?></span>
			<span class="date"><?php echo date('Y-m-d H:i:s',$t['pubtime']);?></span>
			<?php $ID=$t['type']>0?userModel::getUsername($t['uid']):substr(md5($t['uid'].$t['title'].$t['tid']), -8);?>
			<span<?php echo $t['type']>0?' style="color:red"':'';?>><?php echo 'ID:',$ID;?></span>
			<?php if(userModel::isLogin()){ ?>
			<span class="link-normal">[<a target="_blank" class="link" href="view.php?id=<?php echo $report_tid;?>&reply=%3e%3e<?php echo $t['tid']?>">举报</a>]</span>
			<span class="link-normal">[<a class="link" href="subscribe.php?tid=<?php echo $t['tid']?>"><?php echo subscriptionModel::isSubscribed($t['tid'])?'取消订阅':'订阅';?></a>]</span>
			<?php } ?>
			<?php if(userModel::isLogin()&&$_SESSION['type']>0){ ?>
			<span class="link-normal">[<a class="link" target="_blank" href="edit.php?tid=<?php echo $t['tid']?>">编辑</a>]</span>
			<span class="link-normal">[<a class="link" onclick="if(!confirm('要<?php echo $t['SAGE']==1?'解除':'';?>SAGE吗?')){return false;};" href="sage.php?tid=<?php echo $t['tid']?>"><?php echo $t['SAGE']==1?'解除':'';?>SAGE</a>]</span>
			<span class="link-normal">[<a class="link" onclick="if(!confirm('确实要删除吗?')){return false;};" href="delete.php?tid=<?php echo $t['tid']?>">删除</a>]</span>
			<?php } ?>
			<span class="link-rep">[<a class="link" href="view.php?id=<?php echo $t['tid'],'&page=',$curr_page,'&reply=%3e%3e',$t['tid'];?>#reply">回应</a>]</span>
			<p><?php echo $t['content'];?></p>
			<?php echo $t['SAGE']==0?'':'<p style="top:5px;right:20px;position:relative;font-size:14px;font-weight:700;color:#D85030">本串已经被SAGE（<abbr style="border-bottom:1px dotted;cursor:default" title="该串不会因为新回应而被顶到页首">?</abbr>）</p>' ?>
			<?php 
				foreach ($replies[$k] as $key => $value) {
				?>

			…<div class="reply" floor=<?php echo $value['floor'],'>#',$value['floor'];?>
				<span class="user"><?php echo $value['name'];?></span>
				<span class="date"><?php echo date('Y-m-d H:i:s', $value['reptime']);?></span>
				<?php $ID=$value['type']>0?userModel::getUsername($value['uid']):substr(md5($value['uid'].$t['title'].$t['tid']), -8);?>
				<span<?php echo $value['type']>0?' style="color:red"':'';?>><?php echo 'ID:',$ID;?></span>
				<?php echo $value['uid']==$t['uid']?'<span style="font-size:14px;color:#2D7091">(PO主)</span>':'';?>
				<?php if(userModel::isLogin()){ ?>
				<span class="link-normal">[<a target="_blank" class="link" href="view.php?id=<?php echo $report_tid;?>&reply=%3e%3e<?php echo $t['tid'],'%3e',$value['floor'];?>">举报</a>]</span>
				<?php } ?>
				<?php if(userModel::isLogin()&&$_SESSION['type']>0){ ?>
				<span class="link-normal">[<a class="link" target="_blank" href="edit.php?tid=<?php echo $t['tid']?>&f=<?php echo $value['floor']?>">编辑</a>]</span>
				<span class="link-normal">[<a class="link" onclick="if(!confirm('确实要删除吗?')){return false;};" href="delete.php?tid=<?php echo $t['tid']?>&f=<?php echo $value['floor']?>">删除</a>]</span>
				<?php } ?>
				<span class="link-normal">[<a class="link" href="view.php?id=<?php echo $t['tid'],'&page=',$curr_page,'&reply=%3e%3e',$t['tid'],'%3e',$value['floor'];?>#reply">回复</a>]</span>
				<p><?php echo $value['content'];?></p>
			</div><br />
			<?php } ?>
		</div>
		<hr style="border:none;border-top:0.5px solid #ccc;"/>
		<?php } ?>
		<ul id="pagination-digg">
			<?php 
			if ($curr_page==1){
				echo '<li class="previous-off">到第一页</li>';
				echo '<li class="previous-off">«上一页</li>';
			} else {
				echo '<li class="previous"><a href="./view.php?id='.$tid.'&page=1">到第一页</a></li>';
				echo '<li class="previous"><a href="./view.php?id='.$tid.'&page='.($curr_page-1).'">«上一页</a></li>';
			}
			for (; $i<=$show; $i++) {
				if ($i==$curr_page) {
					echo '<li class="active">'.$i.'</li>';
					continue;
				}
				echo '<li><a href="./view.php?id='.$tid.'&page='.$i.'">'.$i.'</a></li>';
			}
			if ($curr_page>=$all) {
				echo '<li class="next-off">下一页»</li>';
				echo '<li class="next-off">最后一页</li>';
			} else {
				echo '<li class="next"><a href="./view.php?id='.$tid.'&page='.($curr_page+1).'">下一页»</a></li>';
				echo '<li class="next"><a href="./view.php?id='.$tid.'&page='.($all).'">最后一页</a></li>';
			}
			?>
			
		</ul>
		<hr style="height:10px;border:none;border-top:10px groove skyblue;" />
		<div class="new-discus" id="reply">
			<script src="view/normal/js/quoteview.js"></script>
			<p style="font-family:'Microsoft YaHei';font-weight:bold;font-size:2.5em;text-align:center;line-height:1.1em">发出回应</p>
			<form action="newreply.php" method="POST" style="padding-top:30px">

			<span class="formtext">回应讨论：</span><?php echo 'RID.',$threads[0]['tid'];?><br />
			<?php include(ROOT . 'view/normal/textface.html');?>
			<span class="formtext">正文：</span><input type="submit" style="padding:1px 6px;" value="发送"><br /><textarea name="content" id="content" cols="30" rows="10"><?php echo isset($_GET['reply'])?strip_tags($_GET['reply']):'';?></textarea>
			<input type="hidden" name="tid" value="<?php echo $threads[0]['tid'];?>">
			</form>
		</div>
	</div>
	</div>
	<?php include(ROOT . 'view/normal/footer.php');?>
</body>
</html>