<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
set_time_limit(0);
$result = get_account_by_type(1);
if(FALSE == $result){
    echo "<script>alert('取得appKey失败，请重试！');</script>";
    echo "<meta http-equiv=refresh content='0; url=./?a=tdvideo_to_get'>";
    die();
}
$app_key = $result[0]['account_app_key'];
$account_name = $result[0]['account_name'];
//更新状态
if($_REQUEST['do_type'] == 1){
	  $resultarr = array();
	  $sql = ' select video_id,video_itemCode,video_td_state from zx_video ';
	  $sql .= ' where video_td_state < 4 ';
	  $sql .= ' and video_isdel = 0 ';
	  $result = get_info_by_sql($sql);
	  $itemCodes = '';
	  foreach ($result as $key => $value){
	 	    $itemCodes.= ','.$value['video_itemCode'];
	 	    $resultarr[$value['video_itemCode']] = $value['video_td_state'];
	  }
	  $itemCodes = substr($itemCodes, 1);
	  //读取状态
	  $curlPost = 'appKey='.$app_key.'&format=json&itemCodes='.$itemCodes;
	  $up_url = 'http://api.tudou.com/v3/gw?method=item.state.get';
    $resultone = get_jsonData_by_url($up_url,$curlPost);
	  $obj = array();
    $obj = object2array(json_decode($resultone));
    if(!$obj['multiResult']){
    	  $err = $obj['desc'];
    	  if($obj['code'] == '4036') $err .= ',请确认应用Key是否可用！';
    	  if($err == '')$err ='请求失败！';
    	  echo "<script>alert('".$err."');</script>";
        echo "<meta http-equiv=refresh content='0; url=./?a=tdvideo_to_get'>";
        die();
    }
    $obj = object2array($obj['multiResult']);
    $obj = object2array($obj['results']);
    $upstate_arry = array();
    $tmpvalue = '';
    $getinfo_itemCodes = '';
    foreach ($obj as $key => $value){
    	  $tmpvalue = object2array($value);
	 	    if($resultarr[$tmpvalue['itemCode']] == $tmpvalue['state'])
	 	        continue;
	 	    $upstate_arry[$tmpvalue['itemCode']] = $tmpvalue['state'];
	 	    if(($resultarr[$tmpvalue['itemCode']] == 2) and ($tmpvalue['state'] == 1) ){
	 	    	  $getinfo_itemCodes .= ','.$tmpvalue['itemCode'];
	 	    }
	 	    if(($resultarr[$tmpvalue['itemCode']] == 3) and ($tmpvalue['state'] == 1) ){
	 	    	  $getinfo_itemCodes .= ','.$tmpvalue['itemCode'];
	 	    }
	  }
	  $sql = "insert into zx_video (video_itemCode,video_td_state,video_uptime) values ";
	  $tmp_sql = '';
	  foreach ($upstate_arry as $key => $value){
	  	  $tmp_sql.=",('".$key."',".$value.",'".date('Y-m-d H:i:s')."')";
	  }
	  //replace into test_tbl (id,dr) values (1,'2'),(2,'3'),...(x,'y');
	  if($tmp_sql != ''){
	  	  $sql.= substr($tmp_sql, 1).' on duplicate key update video_td_state=values(video_td_state),video_uptime=values(video_uptime);';
	  	  //print_R($sql);
	  	  $result_up = up_info_by_sql($sql);
	  	  if(FALSE == $result_up){
            echo "<script>alert('数据库更新数据失败，请重试！');</script>";
            echo "<meta http-equiv=refresh content='0; url=./?a=tdvideo_to_get'>";
            die();
        }
	  }
	  //echo "ddddd";
	  //读取数据
	  if($getinfo_itemCodes != ''){
	  	  $getinfo_itemCodes = substr($getinfo_itemCodes, 1);
	  	  $curlPost = 'appKey='.$app_key.'&format=json&itemCodes='.$getinfo_itemCodes;
	  	  $read_url = 'http://api.tudou.com/v3/gw?method=item.info.get';
	  	  $resultwo = get_jsonData_by_url($read_url,$curlPost);
	  	  $obj = array();
        $obj = object2array(json_decode($resultwo));
        if(!$obj['multiResult']){
    	      $err = $obj['desc'];
    	      if($obj['code'] == '4036') $err .= ',请确认应用Key是否可用！';
    	      //if($err == '')$err ='请确认应用Key、视频编码等是否正确！';
    	      if($err == '')$err ='请求失败！';
    	      echo "<script>alert('".$err."');</script>";
            echo "<meta http-equiv=refresh content='0; url=./?a=tdvideo_to_get'>";
            die();
        }
         //print_R($obj);
        $obj = object2array($obj['multiResult']);
        $obj = object2array($obj['results']);
        //$sql = " insert into zx_video (video_itemCode,video_playerurl,video_picurl,video_pubDate,video_lc_picurl,video_itemId) values ";
        $sql = " insert into zx_video (video_itemCode,video_picurl,video_pubDate,video_lc_picurl,video_itemId) values ";
        $tmp_sql = '';
	  	  foreach ($obj as $key => $value){
    	      $tmpvalue = object2array($value);
    	     // $tmp_sql.=",('".$tmpvalue['itemCode']."','".$tmpvalue['outerPlayerUrl']."','".$tmpvalue['picUrl']."','".$tmpvalue['pubDate']."','".changeStringTo($tmpvalue['picUrl'])."','".$tmpvalue['itemId']."')";
    	      $tmp_sql.=",('".$tmpvalue['itemCode']."','".$tmpvalue['picUrl']."','".$tmpvalue['pubDate']."','".changeStringTo($tmpvalue['picUrl'])."','".$tmpvalue['itemId']."')";
    	  }
	  	  if($tmp_sql != ''){
	  	  	  //$sql.= substr($tmp_sql, 1).' on duplicate key update video_playerurl=values(video_playerurl),video_picurl=values(video_picurl),video_pubDate=values(video_pubDate),video_lc_picurl=values(video_lc_picurl),video_itemId=values(video_itemId);';
	  	      $sql.= substr($tmp_sql, 1).' on duplicate key update video_picurl=values(video_picurl),video_pubDate=values(video_pubDate),video_lc_picurl=values(video_lc_picurl),video_itemId=values(video_itemId);';
	  	      
	  	      //print_R($sql);
	  	      $result_get = up_info_by_sql($sql);
	  	      if(FALSE == $result_get){
                echo "<script>alert('数据库更新数据失败，请重试！');</script>";
                echo "<meta http-equiv=refresh content='0; url=./?a=tdvideo_to_get'>";
                die();
            }
	  	  }
	  }
	  //删除 4 5 6
	  $sql = 'UPDATE zx_video SET video_isdel = 1 where video_td_state > 3 ';
	  $result_up = up_info_by_sql($sql);
	 //echo $itemCodes;
}
//采集
if($_REQUEST['do_type'] == 2){
   /* $sql = " insert into zx_video (video_itemCode,video_title,video_tags,video_description,video_type,
    video_playerurl,video_picurl,video_pubDate,video_addtime,video_td_state,video_lc_picurl,video_itemId) values ";*/
    $sql = " insert into zx_video (video_itemCode,video_title,video_tags,video_description,video_type,
    video_picurl,video_pubDate,video_addtime,video_td_state,video_lc_picurl,video_itemId,video_kng_id) values ";
    $tmp_sql = '';
    $tmp_sql = catch_videos($app_key,$account_name,1);
    if($tmp_sql != ''){
	  	  //$sql.= substr($tmp_sql, 1).'on duplicate key update video_playerurl=values(video_playerurl),video_picurl=values(video_picurl),video_pubDate=values(video_pubDate),video_lc_picurl=values(video_lc_picurl),video_itemId=values(video_itemId);';
	  	  $sql.= substr($tmp_sql, 1).'on duplicate key update video_picurl=values(video_picurl),video_pubDate=values(video_pubDate),video_lc_picurl=values(video_lc_picurl),video_itemId=values(video_itemId),video_kng_id=values(video_kng_id);';
	  	  //print_R($sql);
	  	  //die();
	  	  $result_int = up_info_by_sql($sql);
	  	  if(FALSE == $result_int){
            echo "<script>alert('数据库更新数据失败，请重试！');</script>";
            echo "<meta http-equiv=refresh content='0; url=./?a=tdvideo_to_get'>";
            die();
        }
	  }
}
//tup
$file_path = APP_PATH.'/files/video-logo/';
$sql = ' select video_id,video_picurl from zx_video ';
$sql .= ' where video_isdel = 0 ';
$result = get_info_by_sql($sql);
foreach ($result as $key => $value){
	  $tmp_path = '';
	  $tmp_path = $file_path.changeStringTo($value['video_picurl']);
	 // echo $tmp_path;
	  if (!file_exists($tmp_path)) {
		    //move_uploaded_file($value['video_picurl'], $tmp_path);
		    getImage($value['video_picurl'],$tmp_path);
	  }
}
//die();
$msg_array = array('','上传视频状态更新成功！','土豆视频信息采集成功！');
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
	<li class="sub">土豆视频采集</li>
</ul>
<div id="innouni_right_b">
  <?=$msg_array[$_REQUEST['do_type']]?>
</div>
<!-- zixi.org.cn Baidu tongji analytics -->
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F373a5160f96b2e16d6ffc7ced7340f47' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>