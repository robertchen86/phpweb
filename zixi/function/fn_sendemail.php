<?php
require APP_PATH.'/phpmailer/class.phpmailer.php';
function sendEmail($SMTP,$SendEmail,$EmailPassword,$FromName,$ToEmail,$ToName,$subject,$body,$IsHTML = false,$ReplyTo = '',$ReplyToName = '',$CharSet = 'utf-8',$Encoding = 'base64') {
    //声明类 
    $mail = new PHPMailer();
    $mail->CharSet = $CharSet;
    $mail->Encoding = $Encoding;
    // 设置使用 SMTP 
    $mail->IsSMTP(); 
    // 指定的 SMTP 服务器地址                  
    $mail->Host = $SMTP; 
    // 设置为安全验证方式   
    $mail->SMTPAuth = true; 
    // SMTP 发邮件人的用户名 
    $mail->Username = $SendEmail;   
    // SMTP 密码 
    $mail->Password = $EmailPassword; 
    $mail->From = $SendEmail; 
    $mail->FromName = $FromName; 
    $mail->AddAddress($ToEmail,$ToName);
    if((trim($ReplyToName) != '') and (trim($ReplyTo) != ''))
        $mail->AddReplyTo($ReplyTo, $ReplyToName);
    $mail->WordWrap = 50;
    // 设置邮件格式为 HTML 
    $mail->IsHTML($IsHTML);  
    // 标题         
    $mail->Subject = $subject; 
    $mail->Body  = $body; 
    if(!$mail->Send()) return $mail->ErrorInfo.'=='.$mail->ErrorMessage();
    return 'hao';
}