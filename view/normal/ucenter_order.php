<?php defined('ACC')||exit('ACC Denied');?>
<?php defined('ACC')||exit('ACC Denied');?>

<?php
	if (count($threads)==0) {
		echo '<div style="padding:20px 0;text-align: center;font-size: 20px;">订阅为空。</div>';
	} else {
		echo '<div style="padding:20px 0;text-align: center;font-size: 20px;">'.$_SESSION['username'].' 的订阅</div>';
	}
	foreach ($threads as $k => $t) {
?>
<div class="quoteview"></div>
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
	<span class="link-rep">[<a class="link" target="_blank" href="view.php?id=<?php echo $t['tid'];?>">查看</a>]</span>
	<p><?php echo $t['content'];?></p>
	<p style="top:5px;right:20px;position:relative;font-size:14px;font-weight:700;color:#07d">最新回复时间：<?php echo date('Y-m-d H:i:s', $t['lastreptime']);?></p>
	<?php echo $t['SAGE']==0?'':'<p style="top:5px;right:20px;position:relative;font-size:14px;font-weight:700;color:#D85030">本串已经被SAGE（<abbr style="border-bottom:1px dotted;cursor:default" title="该串不会因为新回应而被顶到页首">?</abbr>）</p>' ?>
</div>
<hr style="border:none;border-top:0.5px solid #ccc;"/>
<?php } ?>
<script src="view/normal/js/quoteview.js"></script>
<ul id="pagination-digg">
	<?php 
	if ($curr_page==1){
		echo '<li class="previous-off">到第一页</li>';
		echo '<li class="previous-off">«上一页</li>';
	} else {
		echo '<li class="previous"><a href="./ucenter.php?page=1">到第一页</a></li>';
		echo '<li class="previous"><a href="./ucenter.php?page='.($curr_page-1).'">«上一页</a></li>';
	}
	for (; $i<=$show; $i++) {
		if ($i==$curr_page) {
			echo '<li class="active">'.$i.'</li>';
			continue;
		}
		echo '<li><a href="./ucenter.php?page='.$i.'">'.$i.'</a></li>';
	}
	if ($curr_page>=$all) {
		echo '<li class="next-off">下一页»</li>';
		echo '<li class="next-off">最后一页</li>';
	} else {
		echo '<li class="next"><a href="./ucenter.php?page='.($curr_page+1).'">下一页»</a></li>';
		echo '<li class="next"><a href="./ucenter.php?page='.($all).'">最后一页</a></li>';
	}
	?>
</ul>