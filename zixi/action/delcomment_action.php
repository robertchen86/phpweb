<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
/***验证区*s**/
if((!$_REQUEST['vc_id'])  or (!$_REQUEST['member_id'])){
    echo 0;
    die();
}
$cnt = 0;
$sql = ' select count(*) as cnt from zx_video_comment ';
$sql.= ' where vcomment_id = '.$_REQUEST['vc_id'];
$sql.= ' and vcomment_member_id='.$_REQUEST['member_id'];
$result = get_info_by_sql($sql);
if(FALSE == $result){
    echo 0;
    die();
}
$cnt = $result[0]['cnt'];
if(0 ==  $cnt){
	  echo 0;
    die();
}
$result = del_vcomment_by_id($_REQUEST['vc_id']);
if(FALSE == $result){
    echo 0;
    die();
}
echo 1;