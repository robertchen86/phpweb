<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
//die();
require 'common_action.php';
set_time_limit(0);
if($member == '')
		$this->error("请登录", $this->web_site . "/login");
$memberinfo = spClass("zx_member")->findBy("member_name", $member);
$member_id = $memberinfo["member_id"];


$cnt = 0;
$sql = ' select count(er_exam_id) as cnt   from zx_exam_record  ';
$sql.= ' where  er_member_id = '.$member_id;
$sql.= ' and  er_exam_selected=0';
$result = get_info_by_sql($sql);
$cnt =$result[0]['cnt'];
if($cnt != 0){
	
	  unset($result,$sql);
	  $sql = ' select a.er_exam_id,a.er_time,a.er_exam_answered,b.exam_true,b.exam_title,b.exam_video_id,b.exam_step_one,b.exam_step_two,b.exam_step_three   from zx_exam_record a, zx_exam b';
	  $sql.= ' where a.er_member_id = '.$member_id;
	  $sql.= ' and a.er_exam_selected=0';
	  $sql.= ' and a.er_exam_id=b.exam_id ';
	  $sql.= ' order by a.er_time asc ';
	  $result = get_info_by_sql($sql);
	 
	  $exam_step_one = tr_rn($result[0]['exam_step_one']);
	  $exam_step_two = tr_rn($result[0]['exam_step_two']);
	  $exam_step_three = tr_rn($result[0]['exam_step_three']);
	  /*$exam_step_space = 0;
	  if((trim($exam_step_one) == '') and (trim($exam_step_two) == '') and (trim($exam_step_three) == ''))
	      $exam_step_space = 1;
	  $this->exam_step_one = $exam_step_one;
	  $this->exam_step_two = $exam_step_two;
	  $this->exam_step_three = $exam_step_three;*/
	  $exam_step_space = $exam_step_one.'<br>'.$exam_step_two.'<br>'.$exam_step_three;
	  $exam_step_space = '$\frac{1}{3}(-3a+6b) = -a+2b$';
	  //$this->exam_step_space =  urlencode(str_replace('\\\\','\\',$exam_step_space));
	  
	 // $this->exam_step ='ddddd';
	 
	  $this->f_num = 1;
	  $this->f_er_time = $result[0]['er_time'];
	  $this->f_exam_true = $result[0]['exam_true'];
	  $this->f_exam_answered = str_replace("N", "", $result[0]['er_exam_answered']);
	  $f_exam_title = $result[0]['exam_title'];
	  
	  $f_exam_title = preg_replace('/(src=")([^"]+)(\/.)/is', ' $1' . $web_site . "/files/" . '$2', $f_exam_title);
	  $f_exam_title = str_replace("mage", "/image", $f_exam_title);
	  $this->f_exam_title =$f_exam_title;
	  $exam_video_id = $result[0]['exam_video_id'];
	  $exam_video_id = str_replace(',','',$exam_video_id);
	   unset($result,$sql);
	  
	  $sql = ' select video_kng_id from zx_video where video_id ='.$exam_video_id;
	  $result = get_info_by_sql($sql);
	  $video_kng_id = $result[0]['video_kng_id'];
	  $this->kng_list = get_kng_list2(0,$video_kng_id);
	  //echo $video_kng_id;
	  $this->video_list = get_video_list2($video_kng_id,$exam_video_id);
	  //print_R($result);
}

$this->err_count = $cnt;

echo 'ddd';
echo $exam_step;
$this->display('exam_err.html');
die();
