$(function(){
	
	$('#switch_qlogin').click(function() {
		$('#switch_login').removeClass("switch_btn_focus").addClass('switch_btn');
		$('#switch_qlogin').removeClass("switch_btn").addClass('switch_btn_focus');
		$('#switch_bottom').animate({left:'0px',width:'70px'});
		$('#qlogin').css('display','none');
		$('#web_qr_login').css('display','block');
		$('sup').html('Sign in');
		var title = $('title');
		title.html('登陆'+title.html().substr(2));
		
	});
	$('#switch_login').click(function() {
		
		$('#switch_login').removeClass("switch_btn").addClass('switch_btn_focus');
		$('#switch_qlogin').removeClass("switch_btn_focus").addClass('switch_btn');
		$('#switch_bottom').animate({left:'154px',width:'70px'});
		$('#qlogin').css('display','block');
		$('#web_qr_login').css('display','none');
		$('sup').html('Sign up');
		var title = $('title');
		title.html('注册'+title.html().substr(2));
	});
	if (getParam("tab")=='2') {
		$('#switch_login').trigger('click');
	}

});
function getParam(pname) { 
    var params = location.search.substr(1);
    var ArrParam = params.split('&'); 
    if (ArrParam.length == 1) { 
        return params.split('=')[1]; 
    } 
    else { 
        for (var i = 0; i < ArrParam.length; i++) { 
            if (ArrParam[i].split('=')[0] == pname) { 
                return ArrParam[i].split('=')[1]; 
            }
        }
    }
}
function lmsg (e, m) { 
	$(e).focus().css({
		border: "1px solid red",
		boxShadow: "0 0 2px red"
	});
	$('#loginCue').css('display','block').html('<font color="red"><b>' + m + '</b></font>');
}
function rmsg (e, m) { 
	$(e).focus().css({
		border: "1px solid red",
		boxShadow: "0 0 2px red"
	});
	$('#userCue').html('<font color="red"><b>' + m + '</b></font>');
}
function refresh (e) {
	$(e).css({
		border: "1px solid #D7D7D7",
		boxShadow: "none"
	});
}
window.user_re = /^[a-zA-Z][\w]{4,15}$/;
$(document).ready(function() {

	$('#login_form').submit(function(){
		var user = $('#u').val(), pass = $('#p').val(), is_submit = true;
		if (pass.length<5||pass.length>16) {
			lmsg('#p', '请检查输入！');
			is_submit = false;
		} else {
			refresh('#p');
		}
		if (!user_re.test(user)) {
			lmsg('#u', '请检查输入！');
			is_submit = false;
		} else {
			refresh('#u');
		}
		return is_submit;
	});
	$('#regUser').submit(function(){
		var user = $('#user').val(),nickname = $('#nickname').val(), pass = $('#passwd').val(), pass2 = $('#passwd2').val();
		if (user=='') {
			rmsg('#user', '请输入用户名！');
			return false;
		} else {
			refresh('#user');
		}
		if (!user_re.test(user)) {
			rmsg('#user', '以字母开头，5-16位，可含数字字母下划线');
			return false;
		} else {
			refresh('#user');
		}
		if (nickname.length<2||nickname.length>10) {
			rmsg('#nickname', '昵称须是2-10个字符');
			return false;
		} else {
			refresh('#nickname');
		}
		if (pass.length<5||pass.length>16) {
			rmsg('#passwd', '密码长度须在5-16位');
			return false;
		} else {
			refresh('#passwd');
		}
		if (pass!==pass2) {
			rmsg('#passwd2', '两次输入密码不一致');
			return false;
		} else {
			refresh('#passwd2');
		}
	});
});