<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$result = get_school_by_id($_REQUEST['school_id']);
//$kng_list = '';
//$kng_list .= '<option value="0">根级知识点</option>';
//$kng_list .= get_kng_list(0,$kng_foot_id,$kng_g,'',$_REQUEST['kng_id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="js/school_edit.js"></script>
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script> 
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=school_to_add">添加学校</a>　┊　<a href="./?a=school_to_manage">学校管理</a></div>
<br>
<ul id="innouni_sub_title">
	<li class="sub">编辑学校</li>
</ul>
<div id="innouni_right_b">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form name="addform" id="addform" method="post" action="./?a=school_edit&page=<?=$_REQUEST['page']?>&keyword=<?=$_REQUEST['keyword']?>" >
    <tr class="tdbg">
      <td width="12%" align="center" >学校名称：<input name="school_id" id="school_id" type="hidden" value="<?=$_REQUEST['school_id'] ?>"></td>
      <td ><input name="school_name" id="school_name" type="text" class="input" size="50" maxlength="150" value="<?=$result[0]['school_name']?>"> &nbsp;&nbsp;<span id='school_name_span'></span></td>
    </tr>
    <!--  
    <tr class="tdbg">
      <td align="center">简介：</td>
      <td>
      	<textarea name="kng_description" id="kng_description" class="ke-textarea" style="height: 80px;width:320px"></textarea>
      </td>
    </tr>-->
    <tr class="tdbg">
      <td width="12%" align="center" >排序：</td>
      <td ><input name="school_sort" id="school_sort" type="text" class="input" size="10" maxlength="5" value="<?=$result[0]['school_sort']?>" onkeyup="value=value.replace(/[^0-9]/g,&quot;&quot;) " onbeforepaste="clipboardData.setData(&quot;text&quot;,clipboardData.getData(&quot;text&quot;).replace(/[^0-9]/g,&quot;&quot;))"> </td>
    </tr>
    
    <tr class="tdbg">
	  <td>&nbsp;</td>
      <td><input type="button" class="bnt" id='btn_save'  value="保 存"> <input type="button" onClick="history.go(-1)" class="bnt" value="返 回"></td>
    </tr>
	</form>
  </table>
</div>

</body>
</html>