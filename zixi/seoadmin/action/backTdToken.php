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
$test_token = new OAuthConsumer($request_token, $request_token_secret);
	 $acc_req = OAuthRequest::from_consumer_and_token($consumer, $test_token, "GET", $access_token_url);
   $acc_req->sign_request($sig_method, $consumer, $test_token);
   $ch = curl_init();
   curl_setopt($ch,CURLOPT_URL, $acc_req->to_url());
   curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
   $result = curl_exec($ch);
   curl_close($ch);
   //print_r($result);
   if(trim($result)=='oauth_problem=token_expired'){
   	   echo "<script>alert('Access Token 取得失败！');</script>";
   	   echo "<meta http-equiv=refresh content='0; url=./?a=account_to_set&type=1'>";
       die();
   }
   $result2= explode('&', $result, 2);
   $result2_0 = explode('=', $result2[0], 2);
   $access_token = $result2_0[1];
   $result2_1 = explode('=', $result2[1], 2);
   $access_token_secret = $result2_1[1];
   //print_R($result);
   $inrow = array(
    'account_access_token'=> $access_token,
    'account_access_token_secret'=> $access_token_secret,
    'account_uptime'=> date('Y-m-d h:i:s'),
   );
   $result = update_account($id,$inrow);
    if(FALSE == $result){
        echo "<script>alert('Access Token 保存失败！');</script>";
        echo "<meta http-equiv=refresh content='0; url=./?a=account_to_set&type=1'>";
        die();
    }
    echo "<script>alert('Access Token 取得成功！');</script>";
    echo "<meta http-equiv=refresh content='0; url=./?a=account_to_set&type=1'>";
