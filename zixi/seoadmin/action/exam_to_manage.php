<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$kng_list = '';
//$kng_list .= '<option value="0">请选择知识点</option>';
//$kng_list .= get_kng_list_by_ajax();
$video_list = '<option value="0">请选择视频</option>';

//$videodb = spClass("zx_video");
//$video = $videodb->find(array("video_kng_id" => $kng_id));

//$videodb = spClass("zx_video");
//$video_list = $videodb->findAll(array("video_kng_id" => $kng_id));
$knowledgedb = spClass("zx_knowledge");
$rootkng = $knowledgedb->find(array("kng_foot_id" => 0));
$childkng = $knowledgedb->find(array("kng_foot_id" => $rootkng["kng_id"]));
$kng_list .= get_kng_list_by_ajax($childkng["kng_id"]);

$examinfo = get_examinfo_kngid($childkng["kng_id"]);
$video_list = get_video_list_by_ajax($childkng["kng_id"], $examinfo["exam_video_id"]);
if($examid = $this->spArgs("exam_id")){
	
}
//$examid = $this->spArgs("exam_id");
//$examdb = spClass("zx_exam");
//$examinfo = $examdb->findBy("exam_id", $examid);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="js/exam_edit.js"></script>
<style>
	.exam_title{boder:1px;}
</style>
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=exam_to_add">添加试题</a>　┊　<a href="./?a=exam_to_manage">试题管理</a>　┊　<a href="./?a=exam_to_out">试题导出</a>　┊　<a href="./?a=exam_to_in">试题导入</a></div>
<br>
<ul id="innouni_sub_title">
	<li class="sub">试题管理</li>
</ul>
<div id="innouni_right_b">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form name="addform" id="addform" method="post" action="" >
  	<tr class="tdbg">
  		<td width="12%" align="center" >所属知识点：</td>
  		<td><select id="kng_video_show"><?=$kng_list?></select></td>
  	</tr>
    <tr class="tdbg">
      <td width="12%" align="center" >试题题目：</td>
      <td border=1>
      	<!--<textarea name="exam_title" id="exam_title" class="ke-textarea" style="height: 280px;width:680px"></textarea>-->
      	<span class="exam_title"><?=$examinfo["exam_title"]?></span>
      	<input name="a" value="exam_edit" type="hidden"/>
      </td>
    </tr>
    <tr class="tdbg">
		 	<td align="center">属性：</td>
			<td >
				关联知识点：
				<select name="kng_id" id="kng_id"><?=$kng_list?></select>&nbsp;&nbsp;<br/>
				关联视频：<br/>
				<input type="hidden" name="video_ids" id="video_ids" value="<?=$examinfo["exam_video_id"]?>"/>
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
				<input name="exam_true" id="exam_true" size=1 maxlength=1 value="<?=$examinfo["exam_true"]?>" />
			</td>
		</tr>

		<tr class="tdbg">
	  <td>&nbsp;</td>
      <td>试题序号：<input type="text" id="exam_id" name="exam_id" size="5" value="<?=$examinfo["exam_id"]?>"> &nbsp;<input type="button" class="bnt" value="选 题"> </td>
    </tr>
    <tr class="tdbg">
	  <td>&nbsp;</td>
      <td><input type="button" class="bnt" value="修 改"> <input type="button" class="bnt" value="下一题"> <input type="button" class="bnt" value="<?=$examinfo["exam_isdel"] == 0 ? "删除" : "已删除"?>"> </td>
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