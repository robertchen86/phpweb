<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
$this->title = '会员注册 - '.$web_name;
$this->keywords = '会员注册';
$this->description = '会员注册';
if((!$_REQUEST['member_name'])  or (!$_REQUEST['member_email']) ){
    $this->display('signup.html');
    die();
}
if(!isEmail(trim($_REQUEST['member_email']))){
	  $this->member_name = $_REQUEST['member_name'];
	  $this->member_email = $_REQUEST['member_email'];
	  $this->err_email = '邮箱格式不正确！';
	  $this->display('signup.html');
    die();
}
$cnt = 0;
$sql = ' select count(*) as cnt from zx_member ';
$sql.= ' where member_email = "'.trim($_REQUEST['member_email']).'"';
$result = get_info_by_sql($sql);
$cnt = $result[0]['cnt'];
if(0 !=  $cnt){
	  $this->member_name = $_REQUEST['member_name'];
	  $this->member_email = $_REQUEST['member_email'];
	  $this->err_email =  '该邮箱已被注册！';
	  $this->display('signup.html');
	  die();
}
$cnt = 0;
$sql = ' select count(*) as cnt from zx_tmp_r ';
$sql.= ' where tmp_r_email = "'.trim($_REQUEST['member_email']).'"';
$result = get_info_by_sql($sql);
$cnt = $result[0]['cnt'];
if(0 !=  $cnt){
	  $this->toemail=$_REQUEST['member_email'];
    $this->display('signupsr.html');
	  die();
}


//require APP_PATH.'/phpmailer/class.phpmailer.php';
$result = get_sendemail();
//get 发送邮箱和目的邮箱
$smtp=$result[0]['sendemail_smtp'];
$sendemail=$result[0]['sendemail_email'];
$sendemailpw=$result[0]['sendemail_pwd'];
//$regurl = $web_site.'/signup.html';
$toemail = trim($_REQUEST['member_email']);
$member_name =$_REQUEST['member_name'];
$subject = $_REQUEST['member_name'].'，继续完成注册'; 
//验证
//$_SESSION['inni_ac_code_'.changeString1To(trim($_REQUEST['member_email']))] = md5(date("YmdHis") . rand(10000, 99999));
$regurl = $web_site.'/signup/ac='.md5(trim($_REQUEST['member_email'])).'&mname='.changeString1To(trim($_REQUEST['member_name'])).'&memail='.changeString1To(trim($_REQUEST['member_email']));
$body='
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>请继续注册你的账户</title>
<style>body {background:#fff;color:#000;font-size:12px;font-weight:normal;font-family:\'lucida Grande\',Verdana;padding:0 7px 6px 4px;margin:0;}</style>
</head>
<body context="ZC2608-Ou1XBokQSSvpcWk56vVXB2c" module="qmReadMail" class="netdisk_empty">
<div class="mailcontainer" id="qqmail_mailcontainer">
	<div id="mainmail" style="position:relative;z-index:1;">
		<div style="position:absolute;right:0px;width:1px;height:1px;">
			<div id="tip74container"></div>
		</div>
		<div id="contentDiv" onmouseover="getTop().stopPropagation(event);" onclick="getTop().preSwapLink(event, \'html\');" style="position:relative;font-size:14px;height:auto;padding:15px 15px 10px 15px;z-index:1;zoom:1;line-height:1.7;" class="body"><div id="mailContentContainer" style="height: auto; min-height: 100px; word-wrap: break-word; font-size: 14px; padding: 0px; font-family: \'lucida Grande\', Verdana;">
		<table width="700" border="0" align="center" cellspacing="0" style="width:700px;"><tbody><tr><td>
		<div style="background-color:#f5f5f5;margin:0 auto;width:700px;">
			<div style="padding:22px 40px 10px;"></div>
			<div style="background-color:#fff;margin:0 15px;padding:30px 25px;">
				<p style="font-size:14px;margin:0 0 15px 0;font-weight:bold;">亲爱的'.$_REQUEST['member_name'].'(<a href="mailto:'.$_REQUEST['member_email'].'" target="_blank">'.$_REQUEST['member_email'].'</a>)，</p>
				
				<p style="font-size:14px;margin:15px 0 20px 0;font-weight:bold;">您距离成功注册只差一步了。</p>
				<div><a href="'.$regurl.'" style="padding:6px 20px;font-size:14px;background:#f09512;border-radius:2px;color:#fff;text-decoration:none;font-weight: bold;" target="_blank">继续注册</a></div>
				
				<p style="margin:30px 0 3px 0;font-size:12px;">如果点击无效，请复制下方网页地址到浏览器地址栏中打开：</p>
				<p style="color:#808080;margin:3px 0 0 0;font-size:12px;"><a href="'.$regurl.'" target="_blank">'.$regurl.'</a></p>
			</div>
			<div style="padding:20px 40px;">
				<p style="color:#666;font-weight:bold;margin:0 0 10px 0;font-size:12px;">为什么我会收到这封邮件？</p>
			    <p style="color:#666;margin:0 0 3px 0;font-size:12px;">您在注册时，填写了此电子邮箱作为账户名，我们发送这封邮件，以确认您的确是邮箱的主人。</p>
			    <p style="color:#666;margin:3px 0 0 0;font-size:12px;">如果您没有注册，请忽略此邮件。可能是有人在注册时填错了自己的邮箱。</p>
			</div>
			<div style="padding:33px 0 20px 40px;margin:0;color:#999;">
				<p style="margin:0;font-size:12px;">此为系统邮件，请勿回复&nbsp; Copyright  2013 All Right Reserved</p>
			</div>
		</div>
		</td></tr></tbody></table>
  </div>
  <!-- --><style>#mailContentContainer .txt {height:auto;}</style>  
    </div>
  </div>
</div>
</body>
</html>';
if(!sendEmail($smtp,$sendemail,$sendemailpw,$web_name,$toemail,$member_name,$subject,$body,true)){
	  $this->member_name = $_REQUEST['member_name'];
	  $this->member_email = $_REQUEST['member_email'];
	  
	  //$this->err_email = $mail->ErrorInfo;
	  $this->err_email = '发送邮件失败！';
	  $this->display('signup.html');
    die();
}
$inrow = array();
$inrow['tmp_r_email']= $_REQUEST['member_email'];
$inrow['tmp_r_addtime']=date('Y-m-d H:i:s');
add_tmp_r($inrow);
$this->toemail=$toemail;
$this->display('signupsr.html');