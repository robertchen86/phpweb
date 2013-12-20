<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$kng_list = '';
$kng_list .= '<option value="0">根级知识点</option>';
$kng_list .= get_kng_list(0); 
//$this->kng_list = $kng_list;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="js/kng_add.js"></script>
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script> 
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=kng_to_add">添加知识点</a>　┊　<a href="./?a=kng_to_manage">知识点管理</a></div>
<br>
<ul id="innouni_sub_title">
	<li class="sub">添加知识点</li>
</ul>
<div id="innouni_right_b">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form name="addform" id="addform" method="post" action="./?a=kng_add" >
    <tr class="tdbg">
      <td width="12%" align="center" >标题：</td>
      <td ><input name="kng_title" id="kng_title" type="text" class="input" size="50" maxlength="150"> &nbsp;&nbsp;<span id='kng_title_span'></span></td>
    </tr>
    <tr class="tdbg">
			 <td align="center">父级：</td>
				<td >
					<select name="kng_foot_id" id="kng_foot_id"><?=$kng_list?></select>
				</td>
			</tr>
    <tr class="tdbg">
      <td align="center">简介：</td>
      <td>
      	<textarea name="kng_description" id="kng_description" class="ke-textarea" style="height: 80px;width:320px"></textarea>
      </td>
    </tr>
    <tr class="tdbg">
      <td width="12%" align="center" >排序：</td>
      <td ><input name="kng_sort" id="kng_sort" type="text" class="input" size="10" maxlength="11" value="0" onkeyup="value=value.replace(/[^0-9]/g,&quot;&quot;) " onbeforepaste="clipboardData.setData(&quot;text&quot;,clipboardData.getData(&quot;text&quot;).replace(/[^0-9]/g,&quot;&quot;))"> </td>
    </tr>
    <tr class="tdbg">
      <td align="center">推荐：</td>
      <td >
					<select name="kng_isrecommend" id="kng_isrecommend">
						<option value="0">否</option>
						<option value="1">是</option>
					</select>
			</td>
    </tr>
    <tr class="tdbg">
	  <td>&nbsp;</td>
      <td><input type="button" class="bnt" value="保 存"> <!--<input type="button" onClick="history.go(-1)" class="bnt" value="返 回">--></td>
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