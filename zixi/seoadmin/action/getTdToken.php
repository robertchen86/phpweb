<?php
require(CF_PATH.'/OAuth.php');
require(CF_PATH.'/tdConfig.php');
$id = $_REQUEST['id'];
$app_key = $_REQUEST['app_key'];
$app_secret = $_REQUEST['app_secret'];
$consumer = new OAuthConsumer($app_key, $app_secret);
if($_REQUEST['request_token'])
    $request_token = $_REQUEST['request_token'];
if($_REQUEST['request_token_secret'])    
    $request_token_secret = $_REQUEST['request_token_secret'];
//if($act == ''){
	 $req_req = OAuthRequest::from_consumer_and_token($consumer, NULL, 'GET', $request_token_url);
   $req_req->sign_request($sig_method, $consumer, NULL);
   $ch = curl_init();
   curl_setopt($ch,CURLOPT_URL, $req_req->to_url());
   curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
   $result = curl_exec($ch);
   curl_close($ch);
   $result2= explode('&', $result, 2);
   $result2_0 = explode('=', $result2[0], 2);
   $request_token = $result2_0[1];
   $result2_1 = explode('=', $result2[1], 2);
   $request_token_secret = $result2_1[1];
  
   $webrlt = get_web();
   $web_site = $webrlt[0]['web_site'];
   //授权
   $callback_url = $web_site.'/seoadmin/?a=backTdToken&act=back&id='.$id.'&app_key='.$app_key.'&app_secret='.$app_secret.'&request_token='.$request_token.'&request_token_secret='.$request_token_secret;
   //$callback_url = APP_ADMIN_PATH.'/?a=getTdToken&act=back&id='.$id.'&app_key='.$app_key.'&app_secret='.$app_secret.'&request_token='.$request_token.'&request_token_secret='.$request_token_secret;
   $auth_url = $authorize_url.'?oauth_token='.$request_token.'&oauth_callback='.urlencode($callback_url);
   //echo  $auth_url;
   Header("Location: $auth_url");
//}
