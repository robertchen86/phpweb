<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if((!empty($_FILES) === false) or (!$_POST['uploadUrl'])){
	  echo "<script>alert('发生不知名的错误，数据丢失，请重试！');</script>";
    echo "<meta http-equiv=refresh content='3; url=./?a=tdvideo_to_up'>";
    die();
}
//print_R($_FILES);
//die();
//"file" => "@F:\hazhen3.mp4",
$post_data = array (
    // 要上传的本地文件地址
    "file" => "@".$_FILES['file']['tmp_name'],
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $_POST['uploadUrl']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_NOPROGRESS,0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
set_time_limit(0);
$output = curl_exec($ch);
curl_close($ch);
$result = 0;
if($output !='{"result":"ok","content":"ok"}'){
	 $result = 1;
}
$pms ='app_key='.$_POST['app_key'].'&itemCode='.$_POST['itemCode'].'&video_title='.$_POST['video_title'].'&video_tags='.$_POST['video_tags'];
$pms .='&video_type='.$_POST['video_type'].'&video_description='.$_POST['video_description'].'&video_kng_id='.$_POST['video_kng_id'];
echo "<meta http-equiv=refresh content='0; url=./?a=tdvideo_result&result=".$result."&".$pms."'>";
die();