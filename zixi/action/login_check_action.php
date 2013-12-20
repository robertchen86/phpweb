<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if((!$_REQUEST['member_email'])){
    echo 0;
    die();
}
if(!get_magic_quotes_gpc()) {
    $_REQUEST['member_email'] = addslashes($_REQUEST['member_email']);
}
$cnt = 0;
$sql = ' select count(*) as cnt from zx_member ';
$sql.= ' where member_email = "'.trim($_REQUEST['member_email']).'"';
$result = get_info_by_sql($sql);
$cnt = $result[0]['cnt'];
if(0 ==  $cnt){
	  echo 1;
    die();
}
$cnt = 0;
$sql = ' select count(*) as cnt from zx_member ';
$sql.= ' where member_email = "'.trim($_REQUEST['member_email']).'"';
$sql.= ' and member_password = "'.md5(trim($_REQUEST['password'])).'"';
$result = get_info_by_sql($sql);
$cnt = $result[0]['cnt'];
if(0 ==  $cnt){
	  echo 2;
    die();
}
echo 3;