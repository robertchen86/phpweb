<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
//$authorize_url = $UCenterUrl.'/handle/main.ashx?m=signout&t='.$UCenterToken.'&&at=&u=./';
//setcookie('__access_token', '', time()- 1);
//$result_member = get_member_by_code($_COOKIE['_onlinezixishi_']);
$sql = ' select member_id,member_uid from zx_member ';
$sql.= ' where  member_md5code = "'.$_COOKIE['_onlinezixishi_'].'"';
$result = get_info_by_sql($sql);
$uid = $result[0]['member_uid'];
if($uid == ''){
setcookie('_onlinezixishi_', '', time()- 1);
if($_REQUEST['http_referer']){
    echo "<meta http-equiv=refresh content='0; url=".urldecode($_REQUEST['http_referer'])."'>";
}else{
	  echo "<meta http-equiv=refresh content='0; url=./'>";
}
}else{
	  setcookie('_onlinezixishi_', '', time()- 1);
	  $callback_url = '/?a=SyncApi';
	  $authorize_url = $UCenterUrl.'/handle/main.ashx?m=signout&t='.$UCenterToken.'&at='.$_COOKIE['__access_token'].'&u='.urlencode($callback_url);
	 // echo $authorize_url;
	  //die();
	  setcookie('__access_token', '', time()- 1);
	  Header("Location:$authorize_url");
//setcookie('__access_token', '', time()- 1);
//$result_member = get_member_by_code($_COOKIE['_onlinezixishi_']);
}