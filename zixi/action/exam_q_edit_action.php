<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
/*$this->footKngId = $_REQUEST['footKngId'];
$this->twoKngId = $_REQUEST['twoKngId'];
$this->videoId = $_REQUEST['videoId'];
if($member == ''){
			$this->error("请登录", $web_site . "/login");
}
$sql = ' select b.er_id,a.exam_id,a.exam_title,a.exam_true,a.exam_step_one,a.exam_step_two,a.exam_step_three,b.er_exam_selected,b.er_exam_answered from zx_exam a ';
$sql.= ' left join zx_exam_record b on a.exam_id =b.er_exam_id';
$sql.= ' where b.er_gtime="'.str_replace('_',' ',$_REQUEST['gtime']).'"';
$sql.= ' and er_member_id='.$member_id;
$sql.= ' order by b.er_id asc ';
$result = get_info_by_sql($sql);
foreach($result as $key => $value){
	  $result[$key]['exam_title'] = str_replace("mage", "/image",preg_replace('/(src=")([^"]+)(\/.)/is', ' $1' . $web_site . "/files/" . '$2', $value['exam_title']));
	  $result[$key]['er_exam_answered']  = str_replace('N', '',  $value['er_exam_answered']);
	  $result[$key]['exam_step_one'] = tr_rn($value['exam_step_one']);
	  $result[$key]['exam_step_two'] = tr_rn($value['exam_step_two']);
	  $result[$key]['exam_step_three'] = tr_rn($value['exam_step_three']);
	  $result[$key]['exam_step_space'] = 0;
	  if((trim($result[$key]['exam_step_one']) == '') and (trim($result[$key]['exam_step_two']) == '') and (trim($result[$key]['exam_step_three']) == ''))
	      $result[$key]['exam_step_space'] = 1;
}
//print_R($result);
//echo '13';
$this->result_list = $result;*/
//题目质疑
	  $sql = ' select  a.m_exam_q_id,a.m_exam_q_addtime,b.member_name,a.m_exam_q_examid,a.m_exam_q_content,a.m_exam_q_reply, a.m_exam_q_uptime,
	  c.exam_title,c.exam_true,c.exam_step_one,c.exam_step_two,c.exam_step_three,d.er_exam_selected,d.er_exam_answered
	  from zx_member_exam_question a ';
	  $sql.= ' left join zx_member b on a.m_exam_q_t_id=b.member_id ';
	  $sql.= ' left join zx_exam c on a.m_exam_q_examid=c.exam_id ';
	  $sql.= ' left join zx_exam_record d on a.m_exam_q_examid =d.er_exam_id';
	  //$sql.= ' left join zx_knowledge c on c.kng_id=b.member_kng_id ';
	 // $sql.= ' where a.m_exam_q_s_id = '.$member_id;
	   $sql.= ' where a.m_exam_q_id = '.$_REQUEST['qid'];
	 // $sql.= ' order by a.m_exam_q_uptime desc,a.m_exam_q_addtime desc ';
	  $result = get_info_by_sql($sql);
	  //$result[0]['exam_step_one']
	  //$result[0]['exam_step_one'] = tr_rn($result[0]['exam_step_one']);
	 //$result[0]['exam_step_two'] = tr_rn($result[0]['exam_step_two']);
	 // $result[0]['exam_step_three'] = tr_rn($result[0]['exam_step_three']);
	 $result[0]['exam_title'] = str_replace('src="', 'src="../files/', $result[0]['exam_title']);
	  $result[0]['exam_step_space'] =(str_replace('\\\\','\\',tr_rn($result[0]['exam_step_one']).'<br>'.tr_rn($result[0]['exam_step_two']).'<br>'. tr_rn($result[0]['exam_step_three'])));
	  $this->result_list = $result;
	  
	  
//print_R($result);

$this->member_id = $member_id;

$this->title = '试题质疑 - '.$web_name;
$this->keywords = '试题质疑 - '.$web_name;
$this->description = '试题质疑 - '.$web_name;
$this->display('exam_q_edit.html');