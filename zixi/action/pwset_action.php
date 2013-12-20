<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
if(!$_SESSION['inni_acps_code_'.changeString1To(trim($_REQUEST['memail']))]){
    $this->err_info = '链接已过期失效！';
    $this->display('err.html');
    die();
}
if((!$_REQUEST['mname'])  or (!$_REQUEST['memail']) or (!$_REQUEST['ac']) ){
    $this->err_info = '数据丢失！';
    $this->display('err.html');
    die();
}
if($_SESSION['inni_acps_code_'.changeString1To(trim($_REQUEST['memail']))] != $_REQUEST['ac']){
	  $this->err_info = '该链接已失效！';
    $this->display('err.html');
	  die();
}
$cnt = 0;
$sql = ' select count(*) as cnt from zx_member ';
$sql.= ' where member_email = "'.trim($_REQUEST['memail']).'"';
$result = get_info_by_sql($sql);
$cnt = $result[0]['cnt'];
if(0 ==  $cnt){
	  $this->err_info = '该账号邮箱（'.$_REQUEST['memail'].'）不存在！';
	  $this->display('err.html');
    die();
}

$this->member_email = $_REQUEST['memail'];
$this->member_name = $_REQUEST['mname'];
$this->title = '密码重设 - '.$web_name;
$this->keywords = '密码重设';
$this->description = '密码重设';
$this->display('forgotpw2.html');