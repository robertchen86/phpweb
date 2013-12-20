<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
$this->footKngId = $_REQUEST['footKngId'];
$this->twoKngId = $_REQUEST['twoKngId'];
$this->videoId = $_REQUEST['videoId'];
if($member == ''){
			$this->error("请登录", $web_site . "/login");
}
$sql = ' select b.er_id,a.exam_id,a.exam_title,a.exam_true,a.exam_step_one,a.exam_step_two,a.exam_step_three,b.er_exam_selected,b.er_exam_answered,
b.er_exam_isdisplay,b.er_exam_selected,b.er_exam_type
from zx_exam a ';
$sql.= ' left join zx_exam_record b on a.exam_id =b.er_exam_id';
$sql.= ' where b.er_gtime="'.str_replace('_',' ',$_REQUEST['gtime']).'"';
$sql.= ' and er_member_id='.$member_id;
$sql.= ' order by b.er_id asc ';
$result = get_info_by_sql($sql);
foreach($result as $key => $value){
	  $result[$key]['exam_title'] = str_replace("mage", "/image",preg_replace('/(src=")([^"]+)(\/.)/is', ' $1' . $web_site . "/files/" . '$2', $value['exam_title']));
	  $result[$key]['er_exam_answered']  = str_replace('N', '',  $value['er_exam_answered']);
	  
	  //$result[$key]['exam_step_one'] = tr_rn($value['exam_step_one']);
	  //$result[$key]['exam_step_two'] = tr_rn($value['exam_step_two']);
	 //$result[$key]['exam_step_three'] = tr_rn($value['exam_step_three']);
	  ///$result[$key]['exam_step_space'] = '';
	  //if((trim($result[$key]['exam_step_one']) == '') and (trim($result[$key]['exam_step_two']) == '') and (trim($result[$key]['exam_step_three']) == ''))
	  //$result[$key]['exam_step_space'] =urlencode(str_replace('\\\\','\\',tr_rn($value['exam_step_one']).'<br>'.tr_rn($value['exam_step_two']).'<br>'. tr_rn($value['exam_step_three'])));
	   //$result[$key]['exam_step_space'] =urlencode(str_replace('\\\\','\\','$\overrightarrow {AD} = \overrightarrow {BC} $, $\overrightarrow {AB} + \overrightarrow {AD}  = \overrightarrow {AC} $；'));
	  //if((trim($result[$key]['exam_step_one']) == '') and (trim($result[$key]['exam_step_two']) == '') and (trim($result[$key]['exam_step_three']) == ''))
	  //    $result[$key]['exam_step_space'] = 1;
	  $result[$key]['exam_step_space'] =urlencode(($value['exam_step_one']).'<br>'.($value['exam_step_two']).'<br>'. ($value['exam_step_three']));
}
//print_R($result);
//echo '13';
$this->member_id = $member_id;
$this->result_list = $result;
$this->title = '试题测试结果 - '.$web_name;
$this->keywords = '试题测试结果 - '.$web_name;
$this->description = '试题测试结果 - '.$web_name;
$this->display('exam_result.html');