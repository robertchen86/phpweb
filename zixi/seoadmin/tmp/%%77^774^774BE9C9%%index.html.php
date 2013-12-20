<?php /* Smarty version 2.6.26, created on 2013-08-03 10:52:39
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<title>自习室后台管理</title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link   type="text/css" href="css/home.css" rel="stylesheet" /> 
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script> 
<script type="text/javascript" src="js/login.js"></script> 
<script type="text/javascript"> 
    if (window.top.location.href != window.location.href) window.location.href = "./";
</script> 
</head> 
<body>
	<!--
<div id="login"> 
	<div id="login_logo"><img src="images/login_logo.jpg" alt="" /></div> 
	<div id="login_login"> 
    	<div class="login_login_body"> 
        	<div id="loginbox"> 
              <ul> 
               <li class="b zi_13">用户名 <span id="username_span"></span></li>  
               <li><input type="text" name="username" id="username" /></li> 
               <li class="b zi_13">密　码 <span id="password_span"></span></li> 
               <li><input type="password" name="password" id="password"/></li> 
               <li> 
                <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
                      <tr> 
                        <td style="width: 80px;"><input type="text" id="checkcode"  name="checkcode" style="width: 80px;" maxlength="5" /></td> 
                        <td style="width: 100px;" align="center"><img alt="验证码" src="./?a=checkcode" onclick="this.src=this.src" /></td> 
                        <td align="right"><input type="image" class="input_72x24" name="button" src="images/admin_cg_11.jpg" value="登录" /></td> 
                      </tr> 
                 </table> 
                </li> 
              </ul> 
       	    </div> 
       	    <div id="info" style="display:none">登陆中,请稍候...</div>
        </div> 
    </div> 
</div>-->
<div class="b_w">
   <div class="l_t">
      <div class="left l_title">网站管理系统</div>
	  <div class="right"><a href="../"><img src="images/icon_back.gif" alt="返回" hspace="4" vspace="8" border="0"  /></a><!--<a href="javascript:window.close()"><img src="images/icon_close.gif" alt="关闭" hspace="4" vspace="8" border="0"/></a>--></div>
   </div>
  <div class="l_bg">
    <ul class="l_user">
    <form >
	  <li>帐户：<input name="username" id="username"  size="14" type="text" class="l_input" /></li>
	  <li>密码：<input name="password" id="password" size="14" type="password" class="l_input" /></li>
	  <li>验证：<input name="checkcode" id="checkcode"  size="3" type="text" class="l_input" maxlength="5" /> <img src="./?a=checkcode" align="absmiddle" title="看不清楚?请点击刷新验证码" style=cursor:pointer onClick="this.src=this.src"></li>
	  <li><input class="l_bnt" value="登 录" type="button" id="btg_login"/>　<input class="l_bnt" value="重 写" type="reset" /></li>
	  </form>
	 </ul>
  </div>
  <div class="l_f">
    <div class="left"><img src="images/f_l.gif" /></div>
	<div class="left"><img src="images/f_bg.gif" width="378" height="36"/></div>
	<div class="right"><img src="images/f_r.gif" /></div>
  </div>
</div>

<!-- zixi.org.cn Baidu tongji analytics -->
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F373a5160f96b2e16d6ffc7ced7340f47' type='text/javascript'%3E%3C/script%3E"));
</script>
</body> 
</html>