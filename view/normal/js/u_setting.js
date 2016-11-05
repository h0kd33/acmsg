function umsg (e, m) { 
	$(e).focus().css({
		border: "1px solid red",
		boxShadow: "0 0 2px red"
	});
	$('#uinfo').html('<font color="red"><b>' + m + '</b></font>');
}
function dmsg (e, m) { 
	$(e).focus().css({
		border: "1px solid red",
		boxShadow: "0 0 2px red"
	});
	$('#cpwd').html('<font color="red"><b>' + m + '</b></font>');
}
function refresh (e) {
	$(e).css({
		border: "1px solid #D7D7D7",
		boxShadow: "none"
	});
}
function changeUserInfo(nickname, email) {
	var result = $.ajax({
	url: './settingAct.php',
	method: 'POST',
	data: 'nickname='+nickname+'&email='+email,
	async: false
	});
	if (result.responseText=='success') {
		$('#uinfo').html('<font color="green"><b>修改成功！</b></font>');
	} else {
		$('#uinfo').html('<font color="red"><b>修改失败！</b></font>');
	}
}
function changePassword(oldpass, newpass) {
	var result = $.ajax({
	url: './changePwdAct.php',
	method: 'POST',
	data: 'oldpass='+oldpass+'&newpass='+newpass,
	async: false
	});
	if (result.responseText=='success') {
		$('#cpwd').html('<font color="green"><b>修改成功！</b></font>');
	} else {
		$('#cpwd').html('<font color="red"><b>修改失败！</b></font>');
	}
}
window.email_re = /^[\w-]+(\.\w+)*@[\w-]+((\.\w{2,3}){1,3})$/;
$('#uuinfo').submit(function(){
	var nickname = $('#n').val(), email = $('#e').val(), is_submit = true;
	if (nickname.length<2||nickname.length>10) {
		umsg('#n', '昵称须2-10位！');
		is_submit = false;
	} else {
		refresh('#n');
	}
	if (!email_re.test(email)) {
		umsg('#e', 'E-mail格式不正确！');
		is_submit = false;
	} else {
		refresh('#e');
	}
	if(is_submit) {
		changeUserInfo(nickname, email);
	}
	return false;
});
$('#ccpwd').submit(function(){
	var oldpass = $('#o').val(), newpass = $('#np').val(), repeat = $('#r').val();
	if (oldpass.length<5||oldpass.length>16) {
		dmsg('#o', '旧密码输入错误！');
		return false;
	} else {
		refresh('#o');
	}
	if (newpass.length<5||newpass.length>16) {
		dmsg('#np', '密码须5-16位！');
		return false;
	} else {
		refresh('#np');
	}
	if (newpass!=repeat) {
		dmsg('#r', '2次密码输入不一致！');
		return false;
	} else {
		refresh('#r');
	}
	changePassword(oldpass, newpass);
	return false;
});
$('input[type=submit]').click(function(){
	return window.confirm('确定吗?');
});