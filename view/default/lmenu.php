<?php defined('ACC')||exit('ACC Denied'); ?>
<div id="lmenu" class="navbar-collapse collapse" style="padding:0">
	<p style="font-weight:bold;font-size:12px;color:#ccc">栏目目录</p>
	<ul class="nav nav-pills nav-stacked">
		<?php foreach ($allCats as $_cat) { ?>
		<li <?php echo $_cat['id']==$curr_cat_id?'class="active"':'';?>>
		<a href="./?cat=<?php echo $_cat['id'];?>"><?php echo str_repeat('&nbsp;', $_cat['lev']*2),$_cat['cat_name'];?></a></li>
		<?php } ?>
	</ul>
	<hr class="visible-xs">
</div>