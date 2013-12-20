<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$kng_list = '';
$kng_list .= '<option value="0">请选择知识点</option>';
$kng_list .= get_kng_list_by_ajax();
$video_list = '<option value="0">请选择视频</option>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="js/exam_add.js"></script>
<script language="javascript" src="kindeditor/kindeditor.js"></script>
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
		KE.show({id:'exam_title'});
</script> 
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=exam_to_add">添加试题</a>　┊　<a href="./?a=exam_to_manage2">试题管理</a></div>
<br>
<ul id="innouni_sub_title">
	<li class="sub">添加试题</li>
</ul>
<div id="innouni_right_b">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form name="addform" id="addform" method="post" action="" >
    <tr class="tdbg">
      <td width="12%" align="center" >试题题目：</td>
      <td >
      	<textarea name="exam_title" id="exam_title" class="ke-textarea" style="height: 280px;width:680px"></textarea>
      	<input name="a" value="exam_add" type="hidden"/>
      </td>
    </tr>
    <tr class="tdbg">
		 	<td align="center">属性：</td>
			<td >
				关联知识点：
				<select name="kng_id" id="kng_id"><?=$kng_list?></select>&nbsp;&nbsp;<br/>
				关联视频：<br/>
				<input type="hidden" name="video_ids" id="video_ids"/>
				<table id="video_list_show">
					<tr>
						<td><?=$video_list?></td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr class="tdbg">
		 	<td align="center">正确答案：</td>
			<td >
				<input name="exam_true" id="exam_true" size=1 maxlength=1/>
			</td>
		</tr>

    <tr class="tdbg">
	  <td>&nbsp;</td>
      <td><input type="button" class="bnt" value="保 存"> </td>
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