function umsg (e, m) { 
	$(e).focus().parent().parent().attr('class', 'form-group has-error');
	$('#uinfo').attr('class', 'alert alert-danger').html(m);
}
function dmsg (e, m) { 
	$(e).focus().parent().parent().attr('class', 'form-group has-error');
	$('#cpwd').attr('class', 'alert alert-danger').html(m);
}
function refresh (e) {
	$(e).parent().parent().attr('class', 'form-group');
}
function changeUserInfo(nickname, email) {
	var result = $.ajax({
	url: './settingAct.php',
	method: 'POST',
	data: 'nickname='+nickname+'&email='+email,
	async: false
	});
	if (result.responseText=='success') {
		$('#uinfo').attr('class', 'alert alert-success').html('修改成功！');
	} else {
		$('#uinfo').attr('class', 'alert alert-danger').html('修改失败！');
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
		$('#cpwd').attr('class', 'alert alert-success').html('修改成功！');
	} else {
		$('#cpwd').attr('class', 'alert alert-danger').html('修改失败！');
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
		dmsg('#o', '原密码输入错误！');
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