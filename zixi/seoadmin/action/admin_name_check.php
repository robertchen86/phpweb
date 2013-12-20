<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if((!$_POST['username'])){
    echo 0;
    die();
}
if(!get_magic_quotes_gpc()) {
    $_POST['username'] = addslashes($_POST['username']);
}
$cnt = 0;
$sql = ' select count(*) as cnt from zx_admin ';
$sql.= ' where admin_name = "'.$_POST['username'].'"';
if($_POST['id']){
	  $sql.= ' and admin_id <>'.$_POST['id'];
}
$result = get_info_by_sql($sql);
$cnt = $result[0]['cnt'];
if(0 !=  $cnt){
	  echo 1;
    die();
}
echo 2;