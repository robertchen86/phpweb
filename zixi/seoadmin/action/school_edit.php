<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if((!$_POST['school_name'])  or (!$_POST['school_id']) ){
	echo "发生不知名的错误，数据丢失！";
	echo "<meta http-equiv=refresh content='3; url=./?a=school_to_manage'>";
	die();
}
if(!get_magic_quotes_gpc()) {
	$_POST['school_name'] = addslashes($_POST['school_name']);
}
$cnt = 0;
$sql = ' select count(*) as cnt from zx_school ';
$sql.= ' where school_name = "'.$_POST['school_name'].'"';
if($_POST['school_id']){
	$sql.= ' and school_id <>'.$_POST['school_id'];
}
$result = get_info_by_sql($sql);
if(FALSE == $result){
	echo "<script>alert('学校编辑失败，请重试！');</script>";
	echo "<meta http-equiv=refresh content='0; url=./?a=school_to_manage'>";
	die();
}
$cnt = $result[0]['cnt'];
if(0 !=  $cnt){
	echo '学校 '.$_POST['school_name'].' 已经存在，编辑失败！';
	echo "<meta http-equiv=refresh content='3; url=./?a=school_to_manage'>";
	die();
}
$inrow = array(
	'school_name'=> $_POST['school_name'],
	'school_sort'=> (int)$_POST['school_sort'],
	'school_updatetime'=> date('Y-m-d H:i:s'),
);
$result = update_school($_POST['school_id'],$inrow);
if(FALSE == $result){
	echo "<script>alert('学校编辑失败！');</script>";
	echo "<meta http-equiv=refresh content='0; url=./?a=school_to_edit&school_id=".$_POST['school_id']."&page=".$_REQUEST['page']."&keyword=".$_REQUEST['keyword']."'>";
	die();
}
unset($result);
echo "<script>alert('学校编辑成功！');</script>";
echo "<meta http-equiv=refresh content='0; url=./?a=school_to_manage&page=".$_REQUEST['page']."&keyword=".$_REQUEST['keyword']."'>";