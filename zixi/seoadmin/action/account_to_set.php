<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$sql = 'select account_id,account_name,account_password,account_app_key,account_app_secret,account_access_token,account_access_token_secret ';
$sql .= 'from zx_account where account_type='.$_REQUEST['type'];
$result = get_info_by_sql($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="js/account_set.js"></script>
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script>
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=account_to_set&type=1">土豆帐户设置</a>　┊　<a href="./?a=account_to_set&type=2">优酷帐户设置</a></div>
<br>
<ul id="innouni_sub_title">
	<li class="sub"><?if($_REQUEST['type'] == 1){echo '土豆帐户设置';}else{echo '优酷帐户设置';}?></li>
</ul>
<div id="innouni_right_b">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form name="setform" id="setform" method="post" action="./?a=account_set" >
  	<tr>
      <td width="12%" align="center" class="tdbg">帐户：<input name="id" id="id" type="hidden" value="<?=$result[0]['account_id'] ?>">
      	<input name="type" id="type" type="hidden" value="<?=$_REQUEST['type'] ?>">
      	</td>
      <td class="tdbg"><input name="account_name" id="account_name" type="text" class="input" size="40" maxlength="150" value="<?=$result[0]['account_name'] ?>" ></td>
    </tr>
    <tr class="tdbg">
      <td align="center">密 码：</td>
      <td><input name="account_password" id="account_password" type="text" class="input" size="40" maxlength="50"" value="<?=$result[0]['account_password'] ?>" ></td>
    </tr>
     <tr>
      <td width="12%" align="center" class="tdbg">应用Key：</td>
      <td class="tdbg"><input name="app_key" id="app_key" type="text" class="input" size="40" maxlength="16" value="<?=$result[0]['account_app_key'] ?>" ></td>
    </tr>
    <tr>
      <td width="12%" align="center" class="tdbg">应用Secret：</td>
      <td class="tdbg"><input name="app_secret" id="app_secret" type="text" class="input" size="40" maxlength="32" value="<?=$result[0]['account_app_secret'] ?>" ></td>
    </tr>
    <tr>
      <td width="12%" align="center" class="tdbg">Access Token：</td>
      <td class="tdbg"><input name="account_access_token" id="account_access_token" type="text" class="input" size="40" maxlength="32" value="<?=$result[0]['account_access_token'] ?>" ></td>
    </tr>
    <tr>
      <td width="12%" align="center" class="tdbg">Access Token Secret：</td>
      <td class="tdbg"><input name="account_access_token_secret" id="account_access_token_secret" type="text" class="input" size="40" maxlength="32" value="<?=$result[0]['account_access_token_secret'] ?>" ></td>
    </tr>
    
    <tr class="tdbg">
	  <td>&nbsp;</td>
      <td><input type="submit" class="bnt" value="保 存"> &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="bnt" value="获取Token"></td>
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