<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if(!$_POST['school_name']){
	echo "发生不知名的错误，数据丢失！";
	echo "<meta http-equiv=refresh content='3; url=./?a=school_to_add'>";
	die();
}
if(!get_magic_quotes_gpc()) {
	$_POST['school_name'] = addslashes($_POST['school_name']);
}
$sql = ' select count(*) as cnt from zx_school ';
$sql.= ' where school_name = "'.$_POST['school_name'].'"';
$result = get_info_by_sql($sql);
if(FALSE == $result){
	echo "<script>alert('学校添加失败！');</script>";
	echo "<meta http-equiv=refresh content='0; url=./?a=school_to_add'>";
	die();
}
$cnt = $result[0]['cnt'];
if(0 !=  $cnt){
	echo '知识点 '.$_POST['school_name'].' 已经存在，添加失败！';
	echo "<meta http-equiv=refresh content='3; url=./?a=school_to_add'>";
	die();
}

$inrow = array(
	'school_name'=> $_POST['school_name'],
	'school_code'=> 'sc'.date('YmdHis'),
	'school_sort'=> (int)$_POST['school_sort'],
	'school_updatetime'=> date('Y-m-d H:i:s'),
);
$result = add_school($inrow);
if(FALSE == $result){
	echo "<script>alert('学校添加失败！');</script>";
	echo "<meta http-equiv=refresh content='0; url=./?a=school_to_add'>";
	die();
}
unset($result);
echo "<script>alert('学校添加成功！');</script>";
echo "<meta http-equiv=refresh content='0; url=./?a=school_to_manage'>";