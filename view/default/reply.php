<?php defined('ACC')||exit('ACC Denied');?>
<?php echo '#',$reply['floor'];?>	
<span class="text-nickname"><?php echo $reply['name'];?></span>
<span class="text-date"><?php echo date('Y-m-d H:i:s', $reply['reptime']);?></span>
<?php $ID=$reply['type']>0?userModel::getUsername($reply['uid']):substr(md5($reply['uid'].$t['title'].$tid), -8);?>
<span<?php echo $reply['type']>0?' style="color:red"':'';?> class="text-id">ID:<?php echo $ID;?></span>
<?php echo $reply['uid']==$t['uid']?'<span class="text-po">(PO主)</span>':'';?>
<br class="visible-xs visible-sm"/>
<?php if(userModel::isLogin()){ ?>
<span class="text-link-sm">[<a href="view.php?tid=0&reply=%3e%3e<?php echo $tid,'%3eF',$reply['floor'];?>">举报</a>]</span>
<?php } ?>
<?php if(userModel::isLogin()&&$_SESSION['type']>0){ ?>
<span class="text-link-sm">[<a target="_blank" href="edit.php?tid=<?php echo $tid?>&f=<?php echo $reply['floor']?>">编辑</a>]</span>
<span class="text-link-sm">[<a onclick="if(!confirm('确实要删除吗?')){return false;};" href="delete.php?tid=<?php echo $tid?>&f=<?php echo $reply['floor']?>">删除</a>]</span>
<?php } ?>
<span class="text-link-sm">[<a target="_blank" href="view.php?id=<?php echo $tid,'&reply=%3e%3e',$tid,'%3e',$reply['floor'];?>#reply">回复</a>]</span>
<p class="text-content"><?php echo $reply['content'];?></p>