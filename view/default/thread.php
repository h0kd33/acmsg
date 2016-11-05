<?php defined('ACC')||exit('ACC Denied');?>
<span class="text-title"><?php echo $t['title'];?></span>
<span class="text-nickname"><?php echo $t['name'];?></span>
<span class="text-date"><?php echo date('Y-m-d H:i:s',$t['pubtime']);?></span>
<?php $ID=$t['type']>0?userModel::getUsername($t['uid']):substr(md5($t['uid'].$t['title'].$t['tid']), -8);?>
<span<?php echo $t['type']>0?' style="color:red"':'';?>><?php echo 'ID:',$ID;?></span>
<br class="visible-xs visible-sm"/>
<?php if(userModel::isLogin()){ ?>
<span class="text-link-sm">[<a class="link" href="view.php?tid=0&reply=%3e%3e<?php echo $t['tid']?>">举报</a>]</span>
<span class="text-link-sm">[<a class="link" href="subscribe.php?tid=<?php echo $t['tid']?>"><?php echo subscriptionModel::isSubscribed($t['tid'])?'取消订阅':'订阅';?></a>]</span>
<?php } ?>
<?php if(userModel::isLogin()&&$_SESSION['type']>0){ ?>
<span class="text-link-sm">[<a class="link" target="_blank" href="edit.php?tid=<?php echo $t['tid']?>">编辑</a>]</span>
<span class="text-link-sm">[<a class="link" onclick="if(!confirm('要<?php echo $t['SAGE']==1?'解除':'';?>SAGE吗?')){return false;};" href="sage.php?tid=<?php echo $t['tid']?>"><?php echo $t['SAGE']==1?'解除':'';?>SAGE</a>]</span>
<span class="text-link-sm">[<a class="link" onclick="if(!confirm('确实要删除吗?')){return false;};" href="delete.php?tid=<?php echo $t['tid']?>">删除</a>]</span>
<?php } ?>
<span class="text-link">[<a class="link" target="_blank" href="view.php?id=<?php echo $t['tid'],'&reply=%3e%3e',$t['tid'];?>#reply">回应</a>]</span>
<p class="text-content"><?php echo $t['content'];?></p>