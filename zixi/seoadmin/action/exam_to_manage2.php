<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/

//print_R($_REQUEST);
$kng_list = '';
$kng_id = 0;
$kng_v_type = '';
$updown = '';
$exam_id = '';
//$exam_select_id = '';
if($_REQUEST['kng_id'])$kng_id = $_REQUEST['kng_id'];
if($_REQUEST['kng_v_type'])$kng_v_type = $_REQUEST['kng_v_type'];
if($_REQUEST['updown'])$updown = $_REQUEST['updown'];
if($_REQUEST['exam_id'])$exam_id = $_REQUEST['exam_id'];
//if($_REQUEST['exam_select_id'])$exam_select_id = $_REQUEST['exam_select_id'];

if($_REQUEST['act'] == 'save'){
	  $inrow = array(
	  'exam_video_id' => $_REQUEST['video_ids'],
	  'exam_true' => $_REQUEST['exam_true'],
	  'exam_isdel' => $_REQUEST['exam_isdel'],
	  'exam_kng_id' => $_REQUEST['kng_set_id'],
	  'exam_step_one' => $_REQUEST['step_one'],
	  'exam_step_two' => $_REQUEST['step_two'],
	  'exam_step_three' => $_REQUEST['step_three'],
	  );
	  update_exam($exam_id,$inrow);
	  $updown = '2';
}
//if($_REQUEST['act'] == 'del'){
//	 $inrow = array(
//	  'exam_isdel' => 1,
//	  );
//	  update_exam($exam_id,$inrow);
//}
if($_REQUEST['act'] == ''){
    $updown = '';
    $exam_id = '';
}

if($_REQUEST['act'] == 'tz'){
	 $updown = '';
	// echo $exam_id;
	 if($exam_id){
	 	 $examinfo = get_examinfo_by_id($exam_id);
	 	 $test = '';
     $test = $examinfo["exam_title"];
     if($test == ''){
	  	  echo "<script>alert('没有相关试题数据！');</script>";
	  	  $exam_id = $_REQUEST['exam_old_id'];
     }
     $examinfo = get_examinfo_by_id($exam_id);
     if((int)$examinfo["exam_kng_id"] == 0){
	 	 	  $knowledgedb = spClass("zx_knowledge");
        $rootkng = $knowledgedb->find(array("kng_foot_id" => 0));
        //$childkng = $knowledgedb->find(array("kng_foot_id" => $rootkng["kng_id"]));
        $childkng = $knowledgedb->find(array("kng_foot_id" => $rootkng["kng_id"]));
        $kng_id = $childkng['kng_id'];
	   }else{
	 	   $kng_id =$examinfo["exam_kng_id"];
	 	   
	 	 }
	 	 $video_list = get_video_list_by_ajax($kng_id, $examinfo["exam_video_id"]);
	 	 $kng_list .= get_kng_list_by_ajax($kng_id);
	 }
	 
}else{
	if($kng_id == 0){
    $knowledgedb = spClass("zx_knowledge");
    $rootkng = $knowledgedb->find(array("kng_foot_id" => 0));
    //$childkng = $knowledgedb->find(array("kng_foot_id" => $rootkng["kng_id"]));
    $childkng = $knowledgedb->find(array("kng_foot_id" => $rootkng["kng_id"]));
    $kng_id = $childkng['kng_id'];
}
	$kng_list .= get_kng_list_by_ajax($kng_id);
$examinfo = get_examinfo_by_kng_id($kng_id,$kng_v_type,$exam_id,$updown);
$video_list = '<option value="0">请选择视频</option>';
$video_list = get_video_list_by_ajax($kng_id, $examinfo["exam_video_id"]);
$test = '';
$test = $examinfo["exam_title"];
//echo $test;
//ECHO $exam_id;
if($test == ''){
	  if($exam_id){$examinfo = get_examinfo_by_id($exam_id);$video_list = get_video_list_by_ajax($kng_id, $examinfo["exam_video_id"]);}
	  if($updown){
	  	 //echo "<script>alert('没有相关试题数据！');</script>";
	  	 if($updown == '1') echo "<script>alert('已没有上一题！');</script>"; 
			 if($updown == '2') echo "<script>alert('已没有下一题！');</script>"; 
	  }else{
	  	  echo "<script>alert('没有相关试题数据！');</script>";
		}
}

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="js/exam_manage.js"></script>
<!--
<script type="text/x-mathjax-config"> MathJax.Hub.Config({extensions: ["tex2jax.js"],jax: ["input/TeX","output/HTML-CSS"],tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}});</script>
<script src="../mathjax/MathJax.js" ></script>-->
<style>
	.exam_title{boder:1px;}
</style>
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=exam_to_add">添加试题</a>　┊　<a href="./?a=exam_to_manage2">试题管理</a>　┊　<a href="./?a=exam_to_out">试题导出</a>　┊　<a href="./?a=exam_to_in">试题导入</a>　┊　<a href="./?a=exam_to_in_byself_ttt">试题自动导入</a></div>
<br>
<ul id="innouni_sub_title">
	 <li class="sub"><a class="hand" href="javascript:void(0)" onclick="selectTag('tagContent0',this)">试题管理</a></li>
	 <li class="unsub"><a class="hand" href="javascript:void(0)" onclick="selectTag('tagContent1',this)">试题解答</a></li>
</ul>
<div id="innouni_right_b">
	<form name="addform" id="addform" method="post" action="./?a=exam_to_manage2" >
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" id='tagContent0'>
  
  	<tr class="tdbg">
  		<td width="12%" align="center" >所属知识点：</td>
  		<td><select id="kng_id" name="kng_id"><?=$kng_list?></select>
  			<select id="kng_v_type" name="kng_v_type">
  				<option value="">全部</option>
  				<option value="1" <?if($kng_v_type == '1'){?>selected<?}?> >视频未关联</option>
   				<option value="2" <?if($kng_v_type == '2'){?>selected<?}?> >视频已经关联</option>
  			</select>
  			<span id='kng_exam_count'></span>
  		</td>
  	</tr>
    <tr class="tdbg">
      <td width="12%" align="center" >试题题目：</td>
      <td border=1>
      	<!--<textarea name="exam_title" id="exam_title" class="ke-textarea" style="height: 280px;width:680px"></textarea>-->
      	<span class="exam_title"><?=$examinfo["exam_title"]?></span>
      	<input name="act" id="act" value="" type="hidden"/>
      	<input name="updown" id="updown" value="1" type="hidden"/>
      </td>
    </tr>
      <tr class="tdbg">
		 	<td align="center">属性：</td>
			<td >
				关联知识点：
				<select name="kng_set_id" id="kng_set_id"><option value="0">请选择知识点</option><?=$kng_list?></select>&nbsp;&nbsp;<br/>
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
		 	<td align="center">试题序号：</td>
			<td ><input type="hidden" id="exam_old_id" name="exam_old_id"  size="5" value="<?=$examinfo["exam_id"]?>" />
				<input type="text" id="exam_id" name="exam_id"  size="5" value="<?=$examinfo["exam_id"]?>" />&nbsp;<input type="button" class="bnt" value="跳 转" id="btn_tiaoz">
			</td>
		</tr>
    <tr class="tdbg">
  		<td width="12%" align="center" >状态：</td>
  		<td>
  			<select id="exam_isdel" name="exam_isdel">
  				<option value="0" <?if($examinfo["exam_isdel"] == 0){?>selected<?}?> >正常</option>
   				<option value="1" <?if($examinfo["exam_isdel"] == 1){?>selected<?}?> >删除</option>
  			</select>
  			
  		</td>
  	</tr>
		
    <tr class="tdbg">
	  <td>&nbsp;</td>
      <td><input type="button" class="bnt" value="修 改" id="btn_save"> <input type="button" class="bnt" value="上一题" id="btn_pre"> <input type="button" class="bnt" value="下一题" id="btn_next"> </td>
    </tr>
	
  </table>
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" id='tagContent1' style="display: none;">
    <tr class="tdbg">
		 	<td width="12%" align="center">试题序号：</td>
			<td >
				<input type="text"  readonly size="5" value="<?=$examinfo["exam_id"]?>" /> </td>
		</tr>
		<tbody id="exam_step" name="exam_step">
		<tr class="tdbg">
		 	<td align="center">步骤1：</td>
			<td >
				<textarea id="step_one" name="step_one" style="width:700px;height:50px;"><?=$examinfo["exam_step_one"]?></textarea>
			</td>
		</tr>
		<tr class="tdbg">
		 	<td align="center">步骤2：</td>
			<td >
				<textarea id="step_two" name="step_two" style="width:700px;height:50px;"><?=$examinfo["exam_step_two"]?></textarea>
			</td>
		</tr>
		<tr class="tdbg">
		 	<td align="center">步骤3：</td>
			<td >
				<textarea id="step_three" name="step_three" style="width:700px;height:50px;"><?=$examinfo["exam_step_three"]?></textarea>
			</td>
		</tr>
	</tbody>
		<tbody id="exam_step_preview" name="exam_step_preview"  style="display: none;">
		<tr class="tdbg">
		 	<td align="center">预览：</td>
			<td >
			<iframe id="if_step_preview" name="if_step_preview" width="700px" height="160px;" frameborder="0" src=""></iframe>
			
			</td>
		</tr>
	  </tbody>
	  <tr class="tdbg">
		 	<td width="12%" align="center"></td>
			<td >
				
				<input type="button" class="bnt" value="预览" id="btn_preview" onclick="previewCheck();">
				<input type="button" class="bnt" value="取消预览" style="display: none;" id="btn_preview_cancle"  onclick="previewCancleCheck();">
			</td>
		</tr>
		 <tbody>
			<tr class="tdbg">
		 	<td colspan="2">
		 		<table width="98%" border="1" align="center" cellpadding="3" cellspacing="1" >
  	    <tr class="tdbg">
  	    	<td>
  	    	<textarea id="input_content" name="input_content" style="width:98%;height:50px;"></textarea>
			    <iframe id="if_input_preview" name="if_input_preview" width="98%" height="80px;" frameborder="0" src=""></iframe>
			    <input type="button" class="bnt" value="插入" id="btn_insertto" >
  	    </td>
  	    </tr>	
        </table>
			</td>
		</tr>
		</tbody>
  </table>
  
  </form>
</div>
</body>
</html>