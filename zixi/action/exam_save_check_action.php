<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$return_array['state'] = 0;
$inrow = array(
	'er_exam_comments'=> $_REQUEST['save_content'],
	'er_exam_type'=> $_REQUEST['save_type'],
	'er_exam_isdisplay'=> 0
);
$result = update_exam_record($_REQUEST['er_id'],$inrow);
if($result === false) $return_array['state'] = 1;

echo json_encode($return_array);