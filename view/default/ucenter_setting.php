<?php defined('ACC')||exit('ACC Denied');?>
<form class="form-inline" id="uuinfo" method="POST">
<br>
<h3><b>基础信息：</b></h3>
<div id="uinfo" class="alert alert-info">昵称2-10字符，可使用中文，可重复</div>
<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">昵称：</div>
		<input id="n" class="form-control" name="nickname" value="<?php echo $_SESSION['nickname'];?>" maxlength="10" type="text">
	</div>
</div>
<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">E-mail：</div>
		<input id="e" class="form-control" name="email" value="<?php echo $_SESSION['email'];?>" maxlength="30" type="text">
	</div>
</div>
<div class="form-group">
	<input class="btn btn-default" type="submit" value="确认修改">
</div>
</form>
<br>
<form id="ccpwd" method="POST">
<h3><b>修改密码：</b></h3>
<div id="cpwd" class="alert alert-info">密码须5-16位</div>
<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">原密码：</div>
		<input class="form-control" id="o" name="oldpass" maxlength="16" type="text">
	</div>
</div>
<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">新密码：</div>
		<input class="form-control" id="np" name="newpass" maxlength="16" type="text">
	</div>
</div>
<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">重复：</div>
		<input class="form-control" id="r" maxlength="16" type="text">
	</div>
</div>
<div class="form-group">
	<input class="btn btn-default" type="submit" value="确认修改">
</div>
</form>