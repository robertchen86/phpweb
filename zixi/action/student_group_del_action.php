<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
if (!isset($_COOKIE['_onlinezixishi_'])){
	 echo "<meta http-equiv=refresh content='0; url=".$web_site."/login'>"; 
	 die();
}

$result = del_member_group_by_id($_REQUEST['sid'],$member_id);
if($result == false){
        $this->err_info = '学生删除失败！';
        $this->display('err.html');
        die();
}
echo "<meta http-equiv=refresh content='0; url=".$web_site."/profile/1/".$_COOKIE['_onlinezixishi_']."'>";
die();
