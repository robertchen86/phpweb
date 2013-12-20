<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$return_array['state'] = 0;
if((!$_POST['member_student_code']) or (!$_POST['member_school_code'])){
	echo json_encode($return_array);
	die();
}

$cnt = 0;
$sql = ' select count(*) as cnt from zx_student ';
$sql.= ' where student_code = "'.$_POST['member_student_code'].'"';
$sql.= ' and student_s_code = "'.$_POST['member_school_code'].'"';
$result = get_info_by_sql($sql);
$cnt = $result[0]['cnt'];
if(0 ==  $cnt){
	$return_array['state'] = 1;
	echo json_encode($return_array);
	die();
}
$return_array['state'] = 2;
echo json_encode($return_array);