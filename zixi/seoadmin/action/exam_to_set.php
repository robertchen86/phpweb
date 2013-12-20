<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if($this->spArgs("web_exam_time")){
  	spClass("zx_web")->update(null, array("web_exam_time" => $this->spArgs("web_exam_time")));
}
$sql = 'select web_exam_time from zx_web ';
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
  <form  method="post" action="./?a=exam_to_set" >
    <tr class="tdbg">
      <td width="12%" align="center" >试题时间设置：</td>
      <td ><input name="web_exam_time" id="web_exam_time" type="text" class="input" size="4" maxlength="100" value="<?=$result[0]['web_exam_time']?>"></td>
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