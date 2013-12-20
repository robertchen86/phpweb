<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if(($_REQUEST['sendemail_smtp'])  or ($_REQUEST['sendemail_email']) or ($_REQUEST['sendemail_pwd']) ){
	  if($_REQUEST['sendemail_smtp'])$inrow['sendemail_smtp'] = $_REQUEST['sendemail_smtp'];
	  if($_REQUEST['sendemail_email'])$inrow['sendemail_email'] = $_REQUEST['sendemail_email'];
	  if($_REQUEST['sendemail_pwd'])$inrow['sendemail_pwd'] = $_REQUEST['sendemail_pwd'];
	  //if($_REQUEST['sendemail_port'])$inrow['sendemail_port'] = $_REQUEST['sendemail_port'];
	  if(!$_REQUEST['sendemail_id']){
	  	  add_sendemail($inrow);
    }else{
    	  update_sendemail($_REQUEST['sendemail_id'],$inrow);
  	}
}
$sql = 'select sendemail_id,sendemail_smtp,sendemail_email,sendemail_port,sendemail_pwd from zx_sendemail';
$result = get_info_by_sql($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!--
<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="js/sendemail_set.js"></script>-->
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script>
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=sendemail_to_set">发送邮箱设置</a></div>
<br>
<ul id="innouni_sub_title">
	<li class="sub">发送邮箱设置</li>
</ul>
<div id="innouni_right_b">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form  method="post" action="./?a=sendemail_to_set" >
  	<tr class="tdbg">
      <td width="12%" align="center" >SMTP：<input name="sendemail_id" id="sendemail_id" type="hidden" value="<?=$result[0]['sendemail_id'] ?>"></td>
      <td ><input name="sendemail_smtp" id="sendemail_smtp" type="text" class="input" size="40" maxlength="100" value="<?=$result[0]['sendemail_smtp']?>"></td>
    </tr>
    <tr class="tdbg">
      <td width="12%" align="center" >邮箱：</td>
      <td ><input name="sendemail_email" id="sendemail_email" type="text" class="input" size="40" maxlength="100" value="<?=$result[0]['sendemail_email']?>"></td>
    </tr>
    <!--<tr class="tdbg">
      <td width="12%" align="center" >端口：</td>
      <td ><input name="sendemail_port" id="sendemail_port" type="text" class="input" size="10" maxlength="6" value="<?=$result[0]['sendemail_port']?>" onkeyup="value=value.replace(/[^0-9]/g,&quot;&quot;) " onbeforepaste="clipboardData.setData(&quot;text&quot;,clipboardData.getData(&quot;text&quot;).replace(/[^0-9]/g,&quot;&quot;))"></td>
    </tr>-->
    <tr class="tdbg">
      <td width="12%" align="center" >密码：</td>
      <td ><input name="sendemail_pwd" id="sendemail_pwd" type="text" class="input" size="40" maxlength="100" value="<?=$result[0]['sendemail_pwd']?>"></td>
    </tr>
    <tr class="tdbg">
	  <td>&nbsp;</td>
      <td><input type="submit" class="bnt" value="保 存"> </td>
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