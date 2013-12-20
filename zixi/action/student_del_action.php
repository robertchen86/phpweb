<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
if (!isset($_COOKIE['_onlinezixishi_'])){
	 echo "<meta http-equiv=refresh content='0; url=".$web_site."/login'>"; 
	 die();
}
/*

$cnt = 0;
$sql = ' select count(m_belong_s_id) as cnt from zx_member_belong ';
$sql.= ' where m_belong_g_id like "%,'.$_REQUEST['mgid'].',%"';
$result = get_info_by_sql($sql);
$cnt = $result[0]['cnt']; 
if( $cnt != 0){
    $this->err_info = '分组删除失败，该分组下有学生成员！';
    $this->display('err.html');
    die();
}*/

$result = del_member_belong_by_id($_REQUEST['mgid']);
if($result == false){
        $this->err_info = '分组删除失败！';
        $this->display('err.html');
        die();
}
echo "<meta http-equiv=refresh content='0; url=".$web_site."/profile/1/".$_COOKIE['_onlinezixishi_']."'>";
die();
