<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
$callback_url = '/?a=SyncApi';
$authorize_url = $UCenterUrl.'/handle/main.ashx?m=g&t='.$UCenterToken.'&islogin=0&u='.urlencode($callback_url);
//echo $authorize_url;
//$authorize_url = $UCenterUrl.'/handle/main.ashx?m=signout&t='.$UCenterToken.'&at=&u='.urlencode($callback_url);
//setcookie('__access_token', '', time()- 1);
Header("Location: $authorize_url");