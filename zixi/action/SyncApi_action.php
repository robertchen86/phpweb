<?php
require 'common_action.php';
//print_R($_REQUEST);
if($_REQUEST['m']){
   if($_REQUEST['m'] == 's'){
   	   //登录
       $t = $_REQUEST['at'];
       setcookie('__access_token',$t, time()+7200);
       $client = new SoapClient($wsdl);
       $param = array('Token'=>$UCenterToken,'AccessToken'=>$t);
       $result = $client->__soapCall('GetLoginResult', array('parameters' => $param));
       $obj = object2array($result);
       $obj = object2array($obj['GetLoginResultResult']);
       $uid = $obj['UID'];
       unset($result,$obj);
       // echo $uid;
       $cnt = 0;
       $sql = ' select count(member_id) as cnt from zx_member ';
       $sql.= ' where  member_uid = "'.$uid.'"';
	     $result = get_info_by_sql($sql);
	     $cnt = $result[0]['cnt'];
	     unset($result,$sql);
	   
       if($cnt == 1){//已经绑定
       	  $sql = ' select member_id,member_md5code from zx_member ';
          $sql.= ' where member_uid = "'.$uid.'"';
          $result = get_info_by_sql($sql);
       	  $member_code =$result[0]['member_md5code'];
       	  setcookie('_onlinezixishi_', $member_code, time()+7200);
       	  echo "<meta http-equiv=refresh content='0; url=./'>"; 
       }else{
       	  //继续完成注册
       	  $result = $client->__soapCall('GetUserInfo', array('parameters' => $param));
          $obj = object2array($result);
          $obj = object2array($obj['ds']);
          $obj = $obj['any'];
          $xml = simplexml_load_string($obj);
          $username = $xml->NewDataSet->UserInfo->USERNAME;
          $email = $xml->NewDataSet->UserInfo->EMAIL;
       	  $reg_url = './ct_signup/'.$uid.'/'.$username.'/'.$email;
       	  echo "<meta http-equiv=refresh content='0; url=".urldecode($reg_url)."'>"; 
       }
   }
   die();
}
/*if($_REQUEST['m'] == 's'){
    $t = $_REQUEST['at'];
    setcookie('__access_token',$t, time()+3600);
}*/
echo "<meta http-equiv=refresh content='0; url=".$web_site."'>"; 