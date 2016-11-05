<?php defined('ACC')||exit('ACC Denied'); ?>
<div class="lmenu">
	<p style="font-weight:bold;font-size:12px;margin:30px 0 5px;color:#ccc">栏目目录</p>
	<ul>
		<?php foreach ($allCats as $_cat) { ?><li style="margin-left:<?php echo ($_cat['lev']*25),'px;';
		echo $_cat['id']==$curr_cat_id?'background:#00A8E6">':'">';
		?>
		<a <?php echo $_cat['id']==$curr_cat_id?'class="lmenu-active"':'';?> href="./?cat=<?php echo $_cat['id'],'">',$_cat['cat_name'],'</a></li>';} ?>
		<!--<li style="margin-left:25px"><a class="lmenu-active" href="#">综合1</a></li>-->
	</ul>
</div>