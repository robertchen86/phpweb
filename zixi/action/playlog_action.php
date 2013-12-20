<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
/***验证区*s**/
if (!isset($_COOKIE['_onlinezixishi_'])){
	  echo 0;
    die();
}
if($member == ''){
	 	echo 0;
    die();
}
if(!$_POST['itemCode']){
    echo 0;
    die();
}
set_time_limit(0);

$sql = 'select video_id from zx_video  ';
$sql.= ' where  video_itemCode = "'.$_POST['itemCode'].'"';
$result = get_info_by_sql($sql);
if($result == false){
	 	echo 0;
    die();
}
$video_id = $result[0]['video_id'];

$cnt =0;
$sql = ' select count(*) as cnt from  zx_video_log ';
$sql.= ' where vlog_member_id = '.$member_vc_id ;
$sql.= ' and vlog_video_id = '.$video_id ;
$sql.= ' and vlog_st_time like"'.date('Y-m-d').'%" ' ;
$sql.= ' and vlog_end_time is null ';
$result = get_info_by_sql($sql);
if($result == false){
	 	echo 0;
    die();
}
$cnt = $result[0]['cnt'];
if($cnt == 0){
	 if(!$_POST['dotype']){
	  $inrow =array(
	      'vlog_member_id'=> $member_vc_id,
	      'vlog_video_id'=> $video_id,
	      'vlog_st_time'=> date('Y-m-d H:i:s'),
	      'vlog_addtime'=> date('Y-m-d H:i:s'),
	  );
	  $result =add_vlog($inrow);
	  if($result == false){
	 	echo 0;
    die();
    }
	  die();
	}
}else{
	  $tmpcnt = 0;
    $sql = ' select count(vlog_id) as cnt from  zx_video_log ';
    $sql.= ' where vlog_member_id = '.$member_vc_id ;
    $sql.= ' and vlog_video_id = '.$video_id ;
    $sql.= ' and vlog_st_time like"'.date('Y-m-d').'%" ' ;
    $sql.= ' and vlog_end_time is null ';
    $sql.= ' and  ((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`vlog_st_time`)) > 60 ) ';
    $result = get_info_by_sql($sql);
    if($result == false){
	 	    echo 0;
        die();
    }
    $tmpcnt = $result[0]['cnt'];
    if($tmpcnt == 0)die();
    $sql = ' select vlog_id  from  zx_video_log ';
    $sql.= ' where vlog_member_id = '.$member_vc_id ;
    $sql.= ' and vlog_video_id = '.$video_id ;
    $sql.= ' and vlog_st_time like"'.date('Y-m-d').'%" ' ;
    $sql.= ' and vlog_end_time is null ';
    $sql.= ' and  ((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`vlog_st_time`)) > 60 ) ';
    $result = get_info_by_sql($sql);
    
    $vlog_id = $result[0]['vlog_id'];
    $uprow['vlog_end_time'] = date('Y-m-d H:i:s');
     //echo $vlog_id;
    update_vlog_by_id($vlog_id,$uprow);
}
if($_POST['dotype']){
	  $sql = ' DELETE from zx_video_log  ';
	  $sql.= ' where vlog_member_id = '.$member_vc_id ;
    $sql.= ' and vlog_video_id = '.$video_id ;
    $sql.= ' and vlog_end_time is null ';
    del_log_by_sql($sql);
	  die();
}