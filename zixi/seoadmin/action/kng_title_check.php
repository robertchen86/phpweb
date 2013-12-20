<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if((!$_POST['kng_title'])){
    echo 0;
    die();
}
if(!get_magic_quotes_gpc()) {
    $_POST['kng_title'] = addslashes($_POST['kng_title']);
}
$cnt = 0;
$sql = ' select count(*) as cnt from zx_knowledge ';
$sql.= ' where kng_title = "'.$_POST['kng_title'].'"';
if($_POST['kng_id']){
	  $sql.= ' and kng_id <>'.$_POST['kng_id'];
}
$result = get_info_by_sql($sql);
$cnt = $result[0]['cnt'];
if(0 !=  $cnt){
	  echo 1;
    die();
}
echo 2;