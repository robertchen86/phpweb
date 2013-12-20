<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
$this->title = '密码重设 - '.$web_name;
$this->keywords = '密码重设';
$this->description = '密码重设';
if((!$_REQUEST['memail'])){
    $this->display('forgotpw.html');
    die();
}
if(!isEmail(trim($_REQUEST['memail']))){
	  $this->memail = $_REQUEST['memail'];
	  $this->err_email = '邮箱格式不正确！';
	  $this->display('forgotpw.html');
    die();
}
$cnt = 0;
$sql = ' select count(*) as cnt from zx_member ';
$sql.= ' where member_email = "'.trim($_REQUEST['memail']).'"';
$result = get_info_by_sql($sql);
$cnt = $result[0]['cnt'];
if(0 ==  $cnt){
	  $this->memail = $_REQUEST['memail'];
	  $this->err_email = '该账号邮箱不存在！';
	  $this->display('forgotpw.html');
    die();
}
$sql = ' select member_name,member_id from zx_member ';
$sql.= ' where member_email = "'.trim($_REQUEST['memail']).'"';
$result = get_info_by_sql($sql);
$member_name=$result[0]['member_name'];
$result = get_sendemail();
$smtp=$result[0]['sendemail_smtp'];
$sendemail=$result[0]['sendemail_email'];
$sendemailpw=$result[0]['sendemail_pwd'];
$subject = $web_name.'账号恢复'; 

$_SESSION['inni_acps_code_'.changeString1To(trim($_REQUEST['memail']))] = md5(date("YmdHis") . rand(10000, 99999));
$pwseturl = $web_site.'/pwset/ac='.$_SESSION['inni_acps_code_'.changeString1To(trim($_REQUEST['memail']))].'&mname='.changeString1To($member_name).'&memail='.changeString1To(trim($_REQUEST['memail']));
//';
$body = '
<div id="mailContentContainer" style="height: auto; min-height: 100px; word-wrap: break-word; font-size: 14px; padding: 0px; font-family: \'lucida Grande\', Verdana;">
亲,<br><br>忘记密码？没关系 - 我们还没有把你忘了！&nbsp; <br> 点击以下链接，重新设置您的密码.<br><br>
<a href="'.$pwseturl.'" target="_blank">'.$pwseturl.'</a><br><br>
如果点击没有反应，您可以复制和粘贴链接到您的&nbsp; <br> 
浏览器的地址栏中。
<br><br>如果您也没想重设您的账号密码，您可以只是忽略此电子邮件。
<br><br>'.$web_name.'团队 竭诚为你服务<br>  </div>
';
/*$get_tt =sendEmail($smtp,$sendemail,$sendemailpw,$web_name,trim($_REQUEST['memail']),$member_name,$subject,$body,true);
if($get_tt != 'hao'){
	 $this->err_email = $get_tt;
	  $this->display('forgotpw.html');
    die();
}*/
if(!sendEmail($smtp,$sendemail,$sendemailpw,$web_name,trim($_REQUEST['memail']),$member_name,$subject,$body,true)){
	  $this->memail = $_REQUEST['memail'];
	  //$this->err_email = $mail->ErrorInfo;
	  $this->err_email = '发送邮件失败！';
	  $this->display('forgotpw.html');
    die();
}

/*$this->title = '密码重设 - '.$web_name;
$this->keywords = '密码重设';
$this->description = '密码重设';*/
$this->toemail=trim($_REQUEST['memail']);
$this->display('forgotpwsr.html');
