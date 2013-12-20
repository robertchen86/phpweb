<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';

if($_REQUEST['http_referer'])
    $this->http_referer = $_REQUEST['http_referer'];
//已经登录
if($member != ''){
	  if($_REQUEST['http_referer']){
	      echo "<meta http-equiv=refresh content='0; url=".urldecode($_REQUEST['http_referer'])."'>";
	  }else{
	  	  echo "<meta http-equiv=refresh content='0; url=".$web_site."'>";
	  }
	  die();
}
if((!$_REQUEST['member_email'])  or (!$_REQUEST['password']) ){
	  $this->title = '会员登录 - '.$web_name;
    $this->keywords = '会员登录';
    $this->description = '会员登录';
    $this->display('login.html');
    die();
}
$cnt = 0;
$sql = ' select count(*) as cnt from zx_member ';
$sql.= ' where member_email = "'.trim($_REQUEST['member_email']).'"';
$sql.= ' and member_password = "'.md5(trim($_REQUEST['member_password'])).'"';
$result = get_info_by_sql($sql);
$cnt = $result[0]['cnt'];
if(0 !=  $cnt){
	  $this->member_email = $_REQUEST['member_email'];
	  $this->err_email = '账号邮箱或者密码不正确！';
	  $this->display('login.html');
    die();
}
$sql = 'update zx_member set member_times = member_times + 1,member_logintime="'.date('Y-m-d H:i:s').'" where member_email ="'.trim($_REQUEST['member_email']).'"';
$result = up_info_by_sql($sql);
if($result == false){
	  $this->member_email = $_REQUEST['member_email'];
	  $this->err_email = '登录失败！';
	  $this->display('login.html');
    die();
}


setcookie('_onlinezixishi_', md5(trim($_REQUEST['member_email'])), time()+7200);
$re_url = '';
$re_url = $_REQUEST['http_referer'];
$completepwset =urlencode($web_site.'/completepwset');
$signup =urlencode($web_site.'/signup');
if($re_url == $completepwset)
    $re_url = $web_site;
if($re_url == $signup)
    $re_url = $web_site;  
if($re_url == '')
    $re_url = $web_site; 
echo "<meta http-equiv=refresh content='0; url=".urldecode($re_url)."'>"; 