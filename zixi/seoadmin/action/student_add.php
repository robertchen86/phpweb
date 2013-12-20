<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if(!$_POST['student_name']){
	echo "发生不知名的错误，数据丢失！";
	echo "<meta http-equiv=refresh content='3; url=./?a=student_to_add'>";
	die();
}
if(!get_magic_quotes_gpc()) {
	$_POST['student_name'] = addslashes($_POST['student_name']);
}
$sql = ' select count(*) as cnt from zx_student ';
$sql.= ' where student_code = "'.$_POST['student_code'].'"';
$sql.= ' and student_s_code = "'.$_POST['student_s_code'].'"';
$result = get_info_by_sql($sql);
if(FALSE == $result){
	echo "<script>alert('学生添加失败！');</script>";
	echo "<meta http-equiv=refresh content='0; url=./?a=student_to_add'>";
	die();
}
$cnt = $result[0]['cnt'];
if(0 !=  $cnt){
	echo ' 学号 '.$_POST['student_code'].' 已经存在，添加失败！';
	echo "<meta http-equiv=refresh content='3; url=./?a=student_to_add'>";
	die();
}

$inrow = array(
		'student_name'=> $_POST['student_name'],
		'student_code'=> $_POST['student_code'],
		'student_s_code'=> $_POST['student_s_code'],
		'student_updatetime'=> date('Y-m-d H:i:s'),
);
$result = add_student($inrow);
if(FALSE == $result){
	echo "<script>alert('学生添加失败！');</script>";
	echo "<meta http-equiv=refresh content='0; url=./?a=student_to_add'>";
	die();
}
unset($result);
echo "<script>alert('学生添加成功！');</script>";
echo "<meta http-equiv=refresh content='0; url=./?a=student_to_manage'>";