<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if((!$_POST['exam_title'])){
    echo 0;
    die();
}
if(!get_magic_quotes_gpc()) {
    $_POST['exam_title'] = addslashes($_POST['exam_title']);
}
$cnt = 0;
$sql = ' select count(*) as cnt from zx_exam ';
$sql.= ' where exam_title = "'.$_POST['exam_title'].'"';
if($_POST['exam_id']){
	  $sql.= ' and exam_id <>'.$_POST['exam_id'];
}
$result = get_info_by_sql($sql);
$cnt = $result[0]['cnt'];
if(0 !=  $cnt){
	  echo 1;
    die();
}
echo 2;