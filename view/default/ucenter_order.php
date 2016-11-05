<?php defined('ACC')||exit('ACC Denied');?>

<?php
	if (count($threads)==0) {
		echo '<div class="title"><div style="display:inline-block;width:45%" class="hidden-xs"></div>订阅为空。</div>';
	} else {
		echo '<div class="title"><div style="display:inline-block;width:45%" class="hidden-xs"></div><span class="glyphicon glyphicon-star"></span> 我的订阅<p>显示你订阅的串，按照最新回复时间进行排序。</p></div><hr>';
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
	<p style="font-size:14px;font-weight:700;color:#07d"><span class="glyphicon glyphicon-time"></span> 最新回复时间：<?php echo date('Y-m-d H:i:s', $t['lastreptime']);?></p>
	<?php echo $t['SAGE']==0?'':'<p style="font-size:14px;font-weight:700;color:#D85030"><span class="glyphicon glyphicon-thumbs-down"></span> 本串已经被SAGE（<abbr  title="该串不会因为新回应而被顶到页首">?</abbr>）</p>' ?>
</div>
<hr>
<?php } ?>
<?php require('view/default/pagination.php');?>
<script src="view/default/js/quoteview.js"></script>