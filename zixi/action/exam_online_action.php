<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
if(!$_REQUEST['videoId']){die();}
//set_time_limit(0);
$this->footKngId = $_REQUEST['footKngId'];
$this->twoKngId = $_REQUEST['twoKngId'];
$this->videoId = $_REQUEST['videoId'];
if($member == ''){
			$this->error("请登录", $this->web_site . "/login");
}
//$memberinfo = spClass("zx_member")->findBy("member_name", $member);
//做题总时间
$this->timemax = $web_exam_time;
//最多选题数
$maxcount = 5;
//选题时间
$exam_g_time = date("Y-m-d H:i:s");
$this->exam_g_time = $exam_g_time;
$this->exam_num = 1;
//随机抽提
$exam_id_array = array();
//先判断库里可以题数
$sql = ' select count(exam_id) as cnt from zx_exam where exam_video_id LIKE "%,'.$_REQUEST['videoId'].',%" and exam_id NOT IN(SELECT er_exam_id FROM zx_exam_record WHERE er_member_id = '.$member_id.' and er_exam_selected <> -1) and exam_isdel = 0';
//"exam_video_id LIKE '%,{$_REQUEST["videoId"]},%' AND exam_id NOT IN(SELECT er_exam_id FROM zx_exam_record WHERE er_member_id = {$memberinfo["member_id"]} and er_exam_selected <> -1) AND exam_isdel = 0")
$result = get_info_by_sql($sql);
$cnt = $result[0]['cnt'];
unset($result,$sql);
if($cnt == 0)
   $this->error("该知识点下的题库还在更新中...请稍后过来测试", $this->web_site . "/kng/" . $this->footKngId . "/" . $this->twoKngId . "/video/" . $this->videoId);
$sql = ' select exam_id from zx_exam where exam_video_id LIKE  "%,'.$_REQUEST['videoId'].',%" and exam_id NOT IN(SELECT er_exam_id FROM zx_exam_record WHERE er_member_id = '.$member_id.' and er_exam_selected <> -1) and exam_isdel = 0';
$result = get_info_by_sql($sql);
if($cnt < 5){
	  $maxcount = $cnt;
    foreach( $result as $key => $value){
    	  $exam_id_array[] = $value['exam_id'];
    }
}else{
	  $r_count = count($result);
	  do {
       if(count($exam_id_array) == 5)break;
       $key = rand(0,$r_count-1);
       if(!in_array($result[$key]['exam_id'],$exam_id_array))
          $exam_id_array[] = $result[$key]['exam_id'];
    } while(count($exam_id_array) != 5);
}
$str_exam_ids= implode($exam_id_array,'_');
$this->exam_ids = $str_exam_ids;
$this->maxcount = $maxcount;
//第一题 内容
$sql = ' select exam_id,exam_title from zx_exam where exam_id ='.$exam_id_array[0];
$result = get_info_by_sql($sql);
$this->exam_id = $result[0]['exam_id'];
$exam_title = $result[0]['exam_title'];
$exam_title = preg_replace('/(src=")([^"]+)(\/.)/is', ' $1' . $web_site . "/files/" . '$2', $exam_title);
$exam_title = str_replace("mage", "/image", $exam_title);
$this->exam_title = $exam_title;
$this->title = '试题 - '.$web_name;
$this->keywords = '试题 - '.$web_name;
$this->description = '试题 - '.$web_name;
   
$this->display('exam_online.html');