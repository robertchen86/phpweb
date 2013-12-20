<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
/***验证区*s**/
if((!$_REQUEST['member_email'])  or (!$_REQUEST['member_name']) or (!$_REQUEST['member_sex'])
 or (!$_REQUEST['member_city_id'])  or (!$_REQUEST['password']) or (!$_REQUEST['repassword'])){
    $this->err_info = '注册数据丢失！';
    $this->display('err.html');
    die();
}
//密码是否一致
if($_REQUEST['password'] != $_REQUEST['repassword']){
    $this->err_info = '登录密码与确认密码不一致！';
    $this->display('err.html');
    die();
} 
$bday = $_REQUEST['birth'][year].'-'.$_REQUEST['birth'][month].'-'.$_REQUEST['birth'][day];
if($bday != '--'){
	  if(!checkdate ((int)$_REQUEST['birth'][month],(int)$_REQUEST['birth'][day],(int)$_REQUEST['birth'][year])){
	  	  $this->err_info = '出生日期不正确！';
        $this->display('err.html');
        die();
	  }
}
/***验证区*e**/
if(!get_magic_quotes_gpc()) {
    $_REQUEST['member_email'] = addslashes($_REQUEST['member_email']);
    $_REQUEST['member_name'] = addslashes($_REQUEST['member_name']);
    $_REQUEST['member_school'] = addslashes($_REQUEST['member_school']);
}
$inrow = array(
    'member_uid'=> trim($_REQUEST['member_uid']),
    'member_name'=> trim($_REQUEST['member_name']),
    'member_city_id'=> trim($_REQUEST['member_city_id']),
    'member_sex'=> trim($_REQUEST['member_sex']),
    'member_birthday'=> $bday,
    'member_school'=> trim($_REQUEST['member_school']),
    'member_email'=> trim($_REQUEST['member_email']),
    'member_md5code'=> md5(trim($_REQUEST['member_email'])),
    'member_password'=> md5(trim($_REQUEST['password'])),
    'member_addtime'=> date('Y-m-d H:i:s'),
    'member_status'=> 1,
    'member_logintime'=> date('Y-m-d H:i:s'),
    'member_times'=> 1,
    'member_identity_type'=> (int)$_REQUEST['member_identity_type'],
    'member_kng_id'=> (int)$_REQUEST['member_kng_id'],
);
$resutl= add_member($inrow);
if($resutl == false){
    $this->err_info = '会员账号绑定失败！';
    $this->display('err.html');
    die();
}
setcookie('_onlinezixishi_', md5(trim($_REQUEST['member_email'])), time()+7200);
echo "<meta http-equiv=refresh content='0; url=".$web_site."'>";
