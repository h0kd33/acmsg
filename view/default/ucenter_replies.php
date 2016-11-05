<?php defined('ACC')||exit('ACC Denied');?>

<?php
	if (count($threads)==0) {
		echo '<div class="title"><div style="display:inline-block;width:45%" class="hidden-xs"></div>你还没有回复过。</div>';
	} else {
		echo '<div class="title"><div style="display:inline-block;width:45%" class="hidden-xs"></div><span class="glyphicon glyphicon-star"></span> 发出的回应<p>你发出的回应都在这里，按照时间进行排序。</p></div><hr>';
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
		$topFloor = $msg->getNextFloor($t['tid'])-1;
		foreach ($t['replies'] as $key => $value) { 
			$flag = false;
			if (!isset($t['replies'][$key-1])) {
				if ($value['floor']<$topFloor) {
					$flag = true;
				}
			} elseif ($t['replies'][$key-1]['floor']-1!=$value['floor']) {
				$flag = true;
			}
			if ($flag) {
				echo '<p style="color:#707070"><span class="glyphicon glyphicon-plus-sign"></span> 其他用户的回应被省略……</p>';
			}
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
	<?php 
		$flag = false;
		if (!isset($t['replies'][$key+1])) {
			if ($value['floor']>1) {
				$flag = true;
			}
		}
		if ($flag) {
			echo '<p style="color:#707070"><span class="glyphicon glyphicon-plus-sign"></span> 其他用户的回应被省略……</p>';
		}
	}
	?>
</div>
<hr>
<?php } ?>
<?php require('view/default/pagination.php');?>
<script src="view/default/js/quoteview.js"></script>