var
    line = $('.heading-line'),
    lLink = $('.login-link'),
    rLink = $('.reg-link'),
    title = $('title'),
    loginForm = $('.login-form'),
    regForm = $('.reg-form');

lLink.click(function() {
    line.stop().animate({left: '12%'}, 200);
    lLink.addClass('active');
    rLink.removeClass('active');
    title.html('登陆'+title.html().substr(2));
    $('sup').html('Sign in');
    loginForm.show();
    regForm.hide();
});

rLink.click(function() {
    line.stop().animate({left: '58%'}, 200);
    rLink.addClass('active');
    lLink.removeClass('active');
    title.html('注册'+title.html().substr(2));
    $('sup').html('Sign up');
    loginForm.hide();
    regForm.show();
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
if (getParam("tab")=='2') {
    rLink.click();
}

loginForm.submit(function() {
    var
        user = $('.login-form input[name=username]').val(),
        user_re = /^[a-zA-Z][\w]{4,15}$/,
        pass = $('.login-form input[name=password]').val();

    $('.login-form .form-group').removeClass('has-error');

    if (!user_re.test(user)) {
        $('.login-form input[name=username]').focus();
        $('.login-form .user').addClass('has-error');
        return false;
    }

    if (pass.length<5||pass.length>16) {
        $('.login-form input[name=password]').focus();
        $('.login-form .pwd').addClass('has-error');
        return false;
    }
});


regForm.submit(function() {
    var
        user = $('.reg-form .username').val(),
        user_re = /^[a-zA-Z][\w]{4,15}$/,
        nickname = $('.reg-form .nickname').val(),
        pass = $('.reg-form .password').val(),
        pass2 = $('.reg-form .repeat').val();

    nickname = nickname===''?'匿名':nickname;
    $('.reg-form .form-group').removeClass('has-error');

    if (user=='') {
        $('.reg-form .username').focus();
        $('.reg-form .user').addClass('has-error');
        return false;    
    }

    if (!user_re.test(user)) {
        $('.reg-form .username').focus();
        $('.reg-form .user').addClass('has-error');
        return false;
    }

    if (nickname.length<2||nickname.length>10) {
        $('.reg-form .nickname').focus();
        $('.reg-form .nname').addClass('has-error');
        return false;
    } else {
        $('.reg-form [name=nickname]').val(nickname);
    }

    if (pass.length<5||pass.length>16) {
        $('.reg-form .password').focus();
        $('.reg-form .pwd').addClass('has-error');
        return false;
    }

    if (pass!==pass2) {
        $('.reg-form .repeat').focus();
        $('.reg-form .rpwd').addClass('has-error');
        return false;
    }
    
});