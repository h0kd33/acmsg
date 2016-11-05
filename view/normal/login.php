<?php defined('ACC')||exit('ACC Denied');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>登陆 - <?php echo SITENAME;?></title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="http://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="./view/normal/js/login.js"></script>
<link href="./view/normal/css/login.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1><a href='./'><?php echo SITENAME;?></a><sup>Sign in</sup></h1>

<div class="login" style="margin-top:50px;">
    
    <div class="header">
        <div class="switch" id="switch"><a class="switch_btn_focus" id="switch_qlogin" href="javascript:void(0);" tabindex="7">快速登录</a>
			<a class="switch_btn" id="switch_login" href="javascript:void(0);" tabindex="8">快速注册</a><div class="switch_bottom" id="switch_bottom" style="position: absolute; width: 64px; left: 0px;"></div>
        </div>
    </div>    
  
    
    <div class="web_qr_login" id="web_qr_login" style="display: block; padding-bottom: 20px">    

            <!--登录-->
            <div class="web_login" id="web_login">
               
               
               <div class="login-box">
    
            
			<div class="login_form">
				<form action="loginAct.php" name="loginform" accept-charset="utf-8" id="login_form" class="loginForm" method="post">
                <div id="loginCue" class="cue" style="display:none"></div>
                <div class="uinArea" id="uinArea">
                <label class="input-tips" for="u">账号：</label>
                <div class="inputOuter" id="uArea">
                    
                    <input type="text" id="u" name="username" class="inputstyle"/>
                </div>
                </div>
                <div class="pwdArea" id="pwdArea">
               <label class="input-tips" for="p">密码：</label> 
               <div class="inputOuter" id="pArea">
                    
                    <input type="password" id="p" name="password" maxlength="16" class="inputstyle"/>
                </div>
                </div>
               
                <div style="padding-left:50px;margin-top:20px;"><input type="submit" value="登 录" style="width:150px;" class="button_blue"/></div>
              </form>
           </div>
           
            	</div>
               
            </div>
            <!--登录end-->
  </div>

  <!--注册-->
    <div class="qlogin" id="qlogin" style="display: none; ">
   
    <div class="web_login"><form name="form2" id="regUser" accept-charset="utf-8"  action="regAct.php" method="post">
        <ul class="reg_form" id="reg-ul">
        		<div id="userCue" class="cue">用户名须以字母开头，昵称可重复可使用中文</div>
                <li>
                	
                    <label for="user"  class="input-tips2">用户名：</label>
                    <div class="inputOuter2">
                        <input type="text" id="user" name="username" maxlength="16" class="inputstyle2"/>
                    </div>
                    
                </li>
                <li>
                    
                    <label for="user"  class="input-tips2">昵称：</label>
                    <div class="inputOuter2">
                        <input type="text" value="匿名" id="nickname" name="nickname" maxlength="10" class="inputstyle2"/>
                    </div>
                    
                </li>
                
                <li>
                <label for="passwd" class="input-tips2">密码：</label>
                    <div class="inputOuter2">
                        <input type="password" id="passwd" maxlength="16" name="password" class="inputstyle2"/>
                    </div>
                    
                </li>
                <li>
                <label for="passwd2" class="input-tips2">确认密码：</label>
                    <div class="inputOuter2">
                        <input type="password" id="passwd2" maxlength="16" class="inputstyle2" />
                    </div>
                    
                </li>
                
                <li>
                    <div class="inputArea">
                        <input type="submit" style="margin-top:10px;margin-left:85px;" class="button_blue" value="确认信息并注册"/> <!--<a href="#" class="zcxy" target="_blank">注册协议</a>-->
                    </div>
                    
                </li><div class="cl"></div>
            </ul></form>
           
    
    </div>
   
    
    </div>
    <!--注册end-->
</div>
<div class="jianyi">*推荐使用ie8或以上版本ie浏览器或Chrome内核浏览器访问本站</div>
</body></html>