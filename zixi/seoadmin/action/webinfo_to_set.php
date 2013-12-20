<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if(($_REQUEST['web_name'])  or ($_REQUEST['web_cnzz']) or ($_REQUEST['web_site']) ){
	  if($_REQUEST['web_name'])$inrow['web_name'] = $_REQUEST['web_name'];
	  if($_REQUEST['web_cnzz'])$inrow['web_cnzz'] = $_REQUEST['web_cnzz'];
	  if($_REQUEST['web_site'])$inrow['web_site'] = $_REQUEST['web_site'];
	  
	  $inrow['web_notice'] = $_REQUEST['web_notice'];
	  if(!$_REQUEST['web_id']){
	  	  add_web($inrow);
    }else{
    	  update_web($_REQUEST['web_id'],$inrow);
  	}
}
$sql = 'select web_id,web_name,web_cnzz,web_site,web_notice from zx_web ';
$result = get_info_by_sql($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!--<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="js/weblogo_set.js"></script>-->
<script charset="utf-8" src="kindeditor/kindeditor.js"></script>
<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
  <script> KE.show({id:'web_notice'});</script>
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script>
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=weblogo_to_set">网站信息设置</a></div>
<br>
<ul id="innouni_sub_title">
	<li class="sub">网站信息设置</li>
</ul>
<div id="innouni_right_b">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form  method="post" action="./?a=webinfo_to_set" >
  	<tr class="tdbg">
      <td width="12%" align="center" >网站名称：<input name="web_id" id="web_id" type="hidden" value="<?=$result[0]['web_id'] ?>"></td>
      <td ><input name="web_name" id="web_name" type="text" class="input" size="40" maxlength="100" value="<?=$result[0]['web_name']?>"></td>
    </tr>
    <tr class="tdbg">
      <td width="12%" align="center" >网站网址：</td>
      <td ><input name="web_site" id="web_site" type="text" class="input" size="40" maxlength="100" value="<?=$result[0]['web_site']?>"></td>
    </tr>
    <tr class="tdbg">
      <td width="12%" align="center" >网站公告：</td>
      <td >
      	<textarea name="web_notice" id="web_notice" class="ke-textarea" style="height: 283px;width:536px"><?=$result[0]['web_notice']?></textarea>
      </td>
    </tr>
    <tr class="tdbg">
      <td align="center">流量统计代码：</td>
      <td>
      	<textarea name="web_cnzz" id="web_cnzz"  style="height: 80px;width:320px"><?=$result[0]['web_cnzz']?></textarea>
      </td>
    </tr>
  	
    <tr class="tdbg">
	  <td>&nbsp;</td>
      <td><input type="submit" class="bnt" value="保 存"> </td>
    </tr>
	</form>
  </table>
</div>
<!-- zixi.org.cn Baidu tongji analytics 
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F373a5160f96b2e16d6ffc7ced7340f47' type='text/javascript'%3E%3C/script%3E"));
</script>-->
</body>
</html>