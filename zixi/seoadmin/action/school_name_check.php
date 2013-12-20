<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if((!$_POST['school_name'])){
	echo 0;
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
$cnt = $result[0]['cnt'];
if(0 !=  $cnt){
	echo 1;
	die();
}
echo 2;