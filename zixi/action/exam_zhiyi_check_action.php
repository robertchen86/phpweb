<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$return_array['state'] = 0;
if($_REQUEST['qid']){
$inrow = array(
'm_exam_q_content'=> $_REQUEST['zhiyi_content'],
'm_exam_q_uptime'=> date('Y-m-d H:i:s')
);
$result = update_exam_question($_REQUEST['qid'],$inrow);
if($result === false) $return_array['state'] = 1;

}else{
$sql = ' select count(m_exam_q_id) as cnt from zx_member_exam_question ';
$sql.= ' where m_exam_q_s_id='.$_REQUEST['member_id'];
$sql.= ' and m_exam_q_examid='.$_REQUEST['exam_id'];
$result = get_info_by_sql($sql);
if($result === false){
	 $return_array['state'] = 1;
	 echo json_encode($return_array);
	 die();
}
$cnt = 0;
$cnt = $result[0]['cnt'];

if($cnt == 0){
$inrow = array(
'm_exam_q_s_id'=> $_REQUEST['member_id'],
'm_exam_q_examid'=> $_REQUEST['exam_id'],
'm_exam_q_content'=> $_REQUEST['zhiyi_content'],
'm_exam_q_addtime'=> date('Y-m-d H:i:s')
);
$result = add_exam_question($inrow);
if($result === false) $return_array['state'] = 1;
}else{
	  $return_array['state'] = 2; 
}
}
echo json_encode($return_array);