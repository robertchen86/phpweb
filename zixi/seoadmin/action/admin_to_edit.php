<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$result = get_admin_by_id($_REQUEST['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="js/admin_edit.js"></script>
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script> 
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=admin_to_add">添加帐户</a>　┊　<a href="./?a=admin_to_manage">帐户管理</a></div>
<br>
<ul id="innouni_sub_title">
	<li class="sub">编辑帐户</li>
</ul>
<div id="innouni_right_b">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form name="addform" id="addform" method="post" action="./?a=admin_edit" >
    <tr>
      <td width="12%" align="center" class="tdbg">帐 户：      <input name="admin_id" id="admin_id" type="hidden" value="<?=$_REQUEST['id'] ?>"></td>
      <td class="tdbg"><input name="username" id="username" type="text" class="input" size="30" value="<?=$result[0]['admin_name'] ?>" > &nbsp;&nbsp;<span id='username_span'></span></td>
    </tr>
    
    <tr class="tdbg">
      <td align="center">密 码：      </td>
      <td><input name="password" id="password" type="password" class="input" size="30">&nbsp;&nbsp;<span id='password_span'></span></td>
    </tr>
    <tr class="tdbg">
      <td align="center">确认密码：      </td>
      <td><input name="repassword" id="repassword"type="password" class="input" size="30">&nbsp;&nbsp;<span id='repassword_span'></span></td>
    </tr>
    <!--<tr class="tdbg">
      <td align="center">类 别：</td>
      <td><input name="permissions" type="radio" value="1" id="p1"><label for="p1">超级管理员</label> <input name="permissions" type="radio" value="0" checked id="p2"><label for="p2">普通管理员</label></td>
    </tr>-->
    <tr class="tdbg">
	  <td>&nbsp;</td>
      <td><input type="button" class="bnt" value="保 存"> <input type="button" onClick="history.go(-1)" class="bnt" value="返 回"></td>
    </tr>
	</form>
  </table>
</div>
<!-- zixi.org.cn Baidu tongji analytics -->
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F373a5160f96b2e16d6ffc7ced7340f47' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>