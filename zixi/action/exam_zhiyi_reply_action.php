<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/

if($_REQUEST['qid']){
	$return_array['state'] = 0;
$inrow = array(
'm_exam_q_reply'=> $_REQUEST['reply_content'],
'm_exam_q_t_id'=> $_REQUEST['member_id'],
'm_exam_q_uptime'=> date('Y-m-d H:i:s')
);
$result = update_exam_question($_REQUEST['qid'],$inrow);
if($result === false) $return_array['state'] = 1;
echo json_encode($return_array);
}
