<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
//set_time_limit(0);
//$memberinfo = spClass("zx_member")->findBy("member_name", $member);
//$member_id = $memberinfo["member_id"];
$vid = $this->spArgs("vid");
$c_time = $this->spArgs("c_time");
$sql = ' select a.er_exam_id,a.er_id,a.er_time,a.er_exam_answered,b.exam_true,b.exam_title,b.exam_video_id,b.exam_step_one,b.exam_step_two,b.exam_step_three,a.er_exam_type,a.er_exam_comments  from zx_exam_record a, zx_exam b';
$sql.= ' where a.er_member_id = '.$member_id;
$sql.= ' and  a.er_exam_selected <> 1';
$sql.= ' and  a.er_exam_isdisplay=0';
$sql.= ' and a.er_exam_id=b.exam_id ';
if($vid != '')
    $sql.= ' and b.exam_video_id like "%,'.$vid.',%"';
if($c_time != ''){
	  if($_REQUEST['prenext'] == 'up')
	      $sql.= ' and a.er_time < "'.$c_time.'"';
	  if($_REQUEST['prenext'] == 'down')
        $sql.= ' and a.er_time > "'.$c_time.'"';
}
$sql.= ' order by a.er_time asc ';
$result = get_info_by_sql($sql);
$return_array['state'] = 0;
if($result[0]['er_time'] == ''){
	  $return_array['state'] = 1;
	  if($_REQUEST['prenext'] == 'up')
	      $return_array['err_msg'] = '已经没有上一题！';
	  if($_REQUEST['prenext'] == 'down')
        $return_array['err_msg'] = '已经没有下一题！';
}
$exam_step_one = tr_rn($result[0]['exam_step_one']);
$exam_step_two = tr_rn($result[0]['exam_step_two']);
$exam_step_three = tr_rn($result[0]['exam_step_three']);
$exam_step_space = $exam_step_one.'<br>'.$exam_step_two.'<br>'.$exam_step_three;
//if((trim($exam_step_one) == '') and (trim($exam_step_two) == '') and (trim($exam_step_three) == ''))
//	   $exam_step_space = '没有解题步骤信息';
$return_array['exam_step_space'] = str_replace('\\\\','\\',$exam_step_space);
//$return_array['exam_step_space'] = str_replace('\\\\','\\','$\frac{1}{3}(-3a+6b) = -a+2b$');
$return_array['exam_id'] = $result[0]['er_exam_id'];
//$return_array['er_exam_type'] = $result[0]['er_exam_type'];
$er_exam_type = $result[0]['er_exam_type'];
$op_exam_type .='<option value="2"';
if($er_exam_type == 2)$op_exam_type .=' selected ';
$op_exam_type .=' >不会</option>';
$op_exam_type .='<option value="3"';
if($er_exam_type == 3)$op_exam_type .=' selected ';
$op_exam_type .=' >粗心</option>';
$op_exam_type .='<option value="1"';
if($er_exam_type == 1)$op_exam_type .=' selected ';
$op_exam_type .=' >蒙一个</option>';
$return_array['op_exam_type'] = $op_exam_type;
$return_array['er_exam_comments'] = $result[0]['er_exam_comments'];
$return_array['er_time'] = $result[0]['er_time'];
$return_array['er_exam_answered'] = str_replace("N", " ", $result[0]['er_exam_answered']);
$return_array['exam_true'] = $result[0]['exam_true'];
$return_array['exam_title'] = str_replace('src="', 'src="./files/', $result[0]['exam_title']);

//if($exam_isnull == true || (!$this->current_exam) ){
	//  		$return_array["count"] = array("c" => $examid, "truecount" => $count[0]["c"], "falsecount" => $examid - $count[0]["c"]);
	  //	}
      
echo json_encode($return_array);
//echo $result[0]['er_time'],'*****',str_replace("N", " ", $result[0]['er_exam_answered']),'*****',$result[0]['exam_true'],'*****',str_replace('src="', 'src="./files/', $result[0]['exam_title']);
//echo get_video_list2($kngid);$f_exam_title = str_replace('src="', 'src="./files/', $f_exam_title);