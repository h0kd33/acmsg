<?php defined('ACC')||exit('ACC Denied');?>
<div style="padding:5px 0 0 15px">
<form id="uuinfo" method="POST">
<p style="padding:0;font-size:22px">基础信息:</p>
<p style="color:#666;text-align:center;width:250px;border:2px solid #D7D7D7;font-size:15px;margin:0;margin:5px 0 10px" id="uinfo">昵称2-10字符，可使用中文，可重复</p>
<label><span class="formtext">昵称：</span><input id="n" name="nickname" value="<?php echo $_SESSION['nickname'];?>" maxlength="10" type="text"></label><br />
<label><span class="formtext">E-mail：</span><input id="e" name="email" value="<?php echo $_SESSION['email'];?>" maxlength="30" type="text"></label>
<input style="padding:2px 6px" type="submit" value="确认修改">
</form>

<form id="ccpwd" method="POST">
<p style="padding:0;font-size:22px">修改密码:</p>
<p style="color:#666;text-align:center;width:250px;border:2px solid #D7D7D7;font-size:15px;margin:0;margin:5px 0 10px" id="cpwd">密码须5-16位</p>
<label><span class="formtext">原密码：</span><input id="o" name="oldpass" maxlength="16" type="text"></label><br />
<label><span class="formtext">新密码：</span><input id="np" name="newpass" maxlength="16" type="text"></label><br />
<label><span class="formtext">重复：</span><input id="r" maxlength="16" type="text"></label>
<input style="padding:2px 6px" type="submit" value="确认修改">
</form>
<script type="text/javascript" src="./view/normal/js/u_setting.js"></script>
</div>