<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$rs_state = 0;
$rs_state = $_REQUEST['result'];
$resultarray = array('视频上传成功！','视频上传失败！');
if(!get_magic_quotes_gpc()) {
    $_REQUEST['video_title'] = addslashes($_REQUEST['video_title']);
    $_REQUEST['video_tags'] = addslashes($_REQUEST['video_tags']);
    $_REQUEST['video_description'] = addslashes($_REQUEST['video_description']);
}
if($rs_state == 0){
	  $up_url = 'http://api.tudou.com/v3/gw?method=item.state.get&appKey='.$_REQUEST['app_key'].'&format=json&itemCodes='.$_REQUEST['itemCode'];
	  $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $up_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_NOPROGRESS,0);
    curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    set_time_limit(0);
    $result = curl_exec($ch);
     //print_R($result);
    curl_close($ch);
    $obj = array();
    $obj = object2array(json_decode($result));
    $obj = object2array($obj['multiResult']);
    $obj = object2array($obj['results']);
    $obj = object2array($obj[0]);
    //保存
    if(($obj['state'] == 3) | ($obj['state'] == 2) | ($obj['state'] == 1) ){
    	 $inrow = array(
          'video_title'=> $_REQUEST['video_title'],
          'video_tags'=> $_REQUEST['video_tags'],
          'video_description'=> $_REQUEST['video_description'],
          'video_itemCode'=> $_REQUEST['itemCode'],
          'video_type'=> $_REQUEST['video_type'],
          'video_kng_id'=> $_REQUEST['video_kng_id'],
          'video_td_state'=> $obj['state'],
          'video_addtime'=> date('Y-m-d H:i:s'),
           );
        add_video($inrow);
    }else{
    	  $rs_state = 1;
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
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
  <?=$resultarray[$_REQUEST['result']]?>
</div>
<!-- zixi.org.cn Baidu tongji analytics -->
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F373a5160f96b2e16d6ffc7ced7340f47' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>