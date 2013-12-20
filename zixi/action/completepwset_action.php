<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
/***验证区*s**/
if((!$_REQUEST['member_email']) or (!$_REQUEST['password']) or (!$_REQUEST['repassword'])){
    $this->err_info = '数据丢失！';
    $this->display('err.html');
    die();
}
//密码是否一致
if($_REQUEST['password'] != $_REQUEST['repassword']){
    $this->err_info = '登录密码与确认密码不一致，密码更新失败！';
    $this->display('err.html');
    die();
}

/***验证区*e**/
$inrow = array(
    'member_password'=> md5(trim($_REQUEST['password'])),
    'member_uptime'=> date('Y-m-d H:i:s'),
);
$result= update_member_by_code(md5(trim($_REQUEST['member_email'])),$inrow);
if($result == false){
    $this->err_info = '密码更新失败！';
    $this->display('err.html');
    die();
}
//setcookie('_onlinezixishi_', md5(trim($_REQUEST['member_email'])), time()+3600);
$_SESSION['inni_acps_code_'.changeString1To(trim($_REQUEST['member_email']))] = null;
echo "<meta http-equiv=refresh content='0; url=".$web_site."/login'>";
