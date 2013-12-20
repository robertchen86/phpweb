<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$result = get_student_by_id($_REQUEST['student_id']);
$school_list = '';
$school_list .= get_school_list($result[0]['student_s_code']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="js/student_edit.js"></script>
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script> 
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=student_to_add">添加学生</a>　┊　<a href="./?a=student_to_manage">学生管理</a></div><br>
<ul id="innouni_sub_title">
	<li class="sub"> 编辑学生</li>
</ul>
<div id="innouni_right_b">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form name="addform" id="addform" method="post" action="./?a=student_edit" >
   <tr class="tdbg">
	 <td align="center">所属学校：</td>
	 <td ><select name="student_s_code" id="student_s_code"><?=$school_list?></select> &nbsp;&nbsp;<span id='student_s_code_span'></span></td>
	</tr>
    <tr class="tdbg">
      <td width="12%" align="center" >学号：<input name="student_id" id="student_id" type="hidden" value="<?=$_REQUEST['student_id'] ?>"</td>
      <td ><input name="student_code" id="student_code" type="text" class="input" size="50" maxlength="30" value="<?=$result[0]['student_code']?>"> &nbsp;&nbsp;<span id='student_code_span'></span></td>
    </tr>
    <tr class="tdbg">
      <td width="12%" align="center" >姓名：</td>
      <td ><input name="student_name" id="student_name" type="text" class="input" size="50" maxlength="30" value="<?=$result[0]['student_name']?>"  onkeyup="value=value.replace(/[^\u4E00-\u9FA5]/g,&quot;&quot;) "> &nbsp;&nbsp;<span id='student_name_span'></span></td>
    </tr>
    <!-- 
    <tr class="tdbg">
      <td width="12%" align="center" >排序：</td>
      <td ><input name="kng_sort" id="kng_sort" type="text" class="input" size="10" maxlength="11" value="0" onkeyup="value=value.replace(/[^0-9]/g,&quot;&quot;) " onbeforepaste="clipboardData.setData(&quot;text&quot;,clipboardData.getData(&quot;text&quot;).replace(/[^0-9]/g,&quot;&quot;))"> </td>
    </tr>
   -->
    <tr class="tdbg">
	  <td>&nbsp;</td>
      <td><input type="button" class="bnt" id='btn_save'  value="保 存"> <input type="button" onClick="history.go(-1)" class="bnt" value="返 回"></td>
    </tr>
	</form>
  </table>
</div>

</body>
</html>