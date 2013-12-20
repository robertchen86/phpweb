<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if((!$_POST['student_code']) or (!$_POST['student_s_code'])){
	echo 0;
	die();
}
$cnt = 0;
$sql = ' select count(*) as cnt from zx_student ';
$sql.= ' where student_code = "'.$_POST['student_code'].'"';
$sql.= ' and student_s_code = "'.$_POST['student_s_code'].'"';
if($_POST['student_id']){
	$sql.= ' and student_id <>'.$_POST['student_id'];
}
$result = get_info_by_sql($sql);
$cnt = $result[0]['cnt'];
if(0 !=  $cnt){
	echo 1;
	die();
}
echo 2;