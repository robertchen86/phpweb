<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if((!$_POST['video_title']) or (!$_POST['video_tags']) or (!$_POST['video_type']) ){
    echo "<script>alert('发生不知名的错误，数据丢失，请重试！');</script>";
    echo "<meta http-equiv=refresh content='3; url=./?a=tdvideo_to_up'>";
    die();
}
if(!get_magic_quotes_gpc()) {
    $_POST['video_title'] = addslashes($_POST['video_title']);
    $_POST['video_tags'] = addslashes($_POST['video_tags']);
    $_POST['video_description'] = addslashes($_POST['video_description']);
}
require(CF_PATH.'/OAuth.php');
require(CF_PATH.'/tdConfig.php');
$result = get_account_by_type(1);
if(FALSE == $result){
    echo "<script>alert('取得appKey失败，请重试！');</script>";
    echo "<meta http-equiv=refresh content='0; url=./?a=tdvideo_to_up'>";
    die();
}

$app_key = $result[0]['account_app_key'];
$app_key_secret = $result[0]['account_app_secret'];
$access_token = $result[0]['account_access_token'];
$access_token_secret = $result[0]['account_access_token_secret'];
if((trim($access_token) == '') | (trim($access_token_secret) == '') ){
	  echo "<script>alert('Access Token不存在！，请先到土豆帐户设置里取得Token！');</script>";
    echo "<meta http-equiv=refresh content='0; url=./?a=tdvideo_to_up'>";
    die();
}
$consumer = new OAuthConsumer($app_key, $app_key_secret);
$token = new OAuthConsumer($access_token, $access_token_secret);
$params = array();
$params['appKey'] = $app_key;
$params['title'] = $_POST['video_title'];
$params['tags'] = $_POST['video_tags'];
$params['channelId'] = (int)$_POST['video_type'];
$params['content'] = $_POST['video_description'];
$up_url = 'http://api.tudou.com/v3/gw?method=item.upload';
$up_req = OAuthRequest::from_consumer_and_token($consumer, $token, "POST", $up_url,$params);
$up_req->sign_request($sig_method, $consumer, $token);
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $up_req->to_url());
curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
curl_close($ch);
if('{"status":"failed","code":400}' == $result){
    echo "<script>alert('Access Token过期！，请到土豆帐户设置里重新取得Token！');</script>";
    echo "<meta http-equiv=refresh content='0; url=./?a=tdvideo_to_up'>";
    die();
}
$obj = array();
$obj = object2array(json_decode($result));
$obj = object2array($obj['itemUploadInfo']);
//echo $obj['itemCode'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="js/tdvideo_up.js"></script>
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script>
</head>
<body>
<!--<div class="innouni_notice"><span>管理操作：</span><a href="/?a=tdvideo_to_up">土豆上传视频</a>　┊　<a href="/?a=ykvideo_to_up">土豆上传视频</a></div>
<br>-->
<ul id="innouni_sub_title">
	<li class="sub">土豆上传视频</li>
</ul>
<div id="innouni_right_b">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" id="uptab">
  <!--<form name="upform" id="upform" action="<?=$obj['uploadUrl']?>" enctype="multipart/form-data" method="post">-->
  <form name="upform" id="upform" method="post" action="./?a=tdvideo_upload" enctype="multipart/form-data">
  	<tr class="tdbg">
      <td width="12%" align="center" >视频：<input type="hidden" name="uploadUrl" id="uploadUrl" value="<?=$obj['uploadUrl']?>">
      	<input type="hidden" name="itemCode" id="itemCode" value="<?=$obj['itemCode']?>">
      	<input type="hidden" name="video_title" id="video_title" value="<?=$_POST['video_title']?>">
      	<input type="hidden" name="video_tags" id="video_tags" value="<?=$_POST['video_tags']?>">
      	<input type="hidden" name="video_type" id="video_type" value="<?=$_POST['video_type']?>">
      	<input type="hidden" name="video_description" id="video_description" value="<?=$_POST['video_description']?>">
      	<input type="hidden" name="video_kng_id" id="video_kng_id" value="<?=$_POST['video_kng_id']?>">
      	<input type="hidden" name="app_key" id="app_key" value="<?=$app_key?>">
      	
      	</td>
      <td >
      	<input type="file" name="file" id="upfile" />
      	&nbsp;&nbsp;<span id='upfile_span'></span></td>
    </tr>
    <tr class="tdbg">
	  <td>&nbsp;</td>
      <td><input type="button" class="bnt" id="btn_up" value="上 传">&nbsp;&nbsp;&nbsp;&nbsp; <input type="button" onClick="history.go(-1)" class="bnt" value="上一步"></td>
    </tr>
	</form>
	
  </table>
  <div id="updiv" style="display:none;">
     <img src="images/loading.gif"/> 文件上传中.....
  <div>
</div>
<!-- zixi.org.cn Baidu tongji analytics -->
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F373a5160f96b2e16d6ffc7ced7340f47' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>