<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
if($member == ''){
			$this->error("请登录", $web_site . "/login");
}
//$memberinfo = spClass("zx_member")->findBy("member_name", $member);
//$member_id
$examdb = spClass("zx_exam");
$selectexam = $examdb->findBy("exam_id", $_REQUEST['exam_id']); 
//记录当前数据
$er_exam_selected = 0;
$er_exam_isdisplay = 1;
if($_REQUEST['selectval'] == 'N')$er_exam_selected = -1;
if($_REQUEST['selectval'] == $selectexam['exam_true']){ $er_exam_selected = 1;   $er_exam_isdisplay = 0;}
spClass("zx_exam_record")->create(array('er_member_id' => $member_id, 'er_exam_id' => $_REQUEST['exam_id'],
	'er_exam_selected' => $er_exam_selected, 'er_exam_answered' => $_REQUEST['selectval'], 'er_exam_usetime' =>  $_REQUEST['usetime'],
	'er_exam_type' => $_REQUEST['type'],	'er_exam_isdisplay' => $er_exam_isdisplay,	
	'er_time' => date('Y-m-d H:i:s'),'er_gtime' => str_replace('_',' ',$_REQUEST['g_time'])));
//explode('|', $str)
$ids_array = explode('_',$_REQUEST['exam_ids']);
//echo '3';
//if($_REQUEST['timeout'] == 1);//超时
//if(count($ids_array) == $_REQUEST['exam_num']);//数据记录完成
//echo $_REQUEST['timeout'];
//echo '--',$_REQUEST['exam_num'],'--',count($ids_array);
if(($_REQUEST['timeout'] == 1) or (count($ids_array) == $_REQUEST['exam_num'])){
	 //如果是超时结束 题目没有做完的 都是放弃 记录
	 if(($_REQUEST['timeout'] == 1) and (count($ids_array) != $_REQUEST['exam_num'])){
	 	   for ($i=$_REQUEST['exam_num']; $i< 5 ; $i++) {
           spClass("zx_exam_record")->create(array('er_member_id' => $member_id, 'er_exam_id' => $ids_array[$i],
	         'er_exam_selected' => -1, 'er_exam_answered' => 'N', 'er_exam_usetime' =>  0,'er_exam_type' => $_REQUEST['type'],'er_exam_isdisplay' => $er_exam_isdisplay,
	         'er_time' => date('Y-m-d H:i:s'),'er_gtime' => str_replace('_',' ',$_REQUEST['g_time'])));
       }
	 }
	 $return_array['state'] = 1;//结束
	 echo json_encode($return_array);
	 // echo 'ee';
}else{//未结束
	  //echo 'ddd';
	  $exam_id = $ids_array[$_REQUEST['exam_num']];
	  $sql = ' select exam_id,exam_title from zx_exam where exam_id ='.$exam_id;
    $result = get_info_by_sql($sql);
    $exam_title = $result[0]['exam_title'];
    $exam_title = preg_replace('/(src=")([^"]+)(\/.)/is', ' $1' . $web_site . "/files/" . '$2', $exam_title);
    $exam_title = str_replace("mage", "/image", $exam_title);
    $return_array['state'] = 0;//继续
    $return_array['exam_id'] = $exam_id;
    $return_array['exam_num'] = $_REQUEST['exam_num']+1;
    $return_array['exam_title'] = $exam_title;
    echo json_encode($return_array);
}