<?php
define('ACC', true);
require('init.php');
userModel::isLogin()||showMsg('没有登陆！', true, './');
$_SESSION['type']>0||showMsg('权限不足！', true, './');
empty($_GET['tid'])&&showMsg('参数错误！', true, './');
$tid = (int)$_GET['tid'];
$f = isset($_GET['f'])?(int)$_GET['f']:'';
$msg = new msgModel();
if ($f==='') {
	if (isset($_POST['title'])&&isset($_POST['cat'])&&isset($_POST['content'])) {
		$cat = (int)$_POST['cat'];
		$cat<1&&showMsg('参数错误！');
		$title = empty($_POST['title'])?'无标题':$_POST['title'];
		$content = empty($_POST['content'])?'无本文':$_POST['content'];
		if ($msg->editThread($tid, $cat, $title, $content)) {
			showMsg('修改成功！', true);
		} else {
			showMsg('修改失败！');
		}
	}
	$cats = catModel::getCatTree();
	$info = $msg->getThread($tid);
} else {
	if (isset($_POST['content'])) {
		$content = empty($_POST['content'])?'无本文':$_POST['content'];
		if ($msg->editReply($tid, $f, $content)) {
			showMsg('修改成功！', true);
		} else {
			showMsg('修改失败！');
		}
	}
	$info = $msg->getReply($tid, $f);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit - tid.<?php echo $tid,$f===''?'':' & f:'.$f;?></title>
</head>
<body>
<h2>主题:tid.<?php echo $tid,$f===''?'':' & '.'楼层:'.$f;?></h2>
<form method="post">
	<?php if($f===''){ ?>
	<label>标题：<input value="<?php echo $info['title'];?>" style="width:250px" name="title" type="text" maxlength="30"></label><br /><br />
	<label>设置分类：
		<select name="cat">
			<?php foreach ($cats as $k => $v) {?>
			<option value="<?php echo $v['id'];?>"<?php echo $info['cat']==$v['id']?' selected':''?>><?php echo str_repeat('&nbsp;&nbsp;', $v['lev']),$v['cat_name'];?></option>
			<?php } ?>
		</select>
	</label>
	<?php }?>
	<input type="submit" value="提交" onclick="return confirm('确定吗?');">
	<input type="button" value="清空" onclick="if(confirm('确定吗?')){document.getElementById('content').value=''}">
	<br /><br />
	<textarea id="content" name="content" cols="40" rows="15"><?php echo strip_tags($info['content']);?></textarea>
</form>
</body>
</html>