<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
//require './phpmailer/class.phpmailer.php';
//推荐视频取得 3
$video_array = get_remd_video();
//print_R($video_array);
//die();
$this->video_array = $video_array;
//最近更新
$sql = 'select video_id,video_title,video_description,video_picurl,video_kng_id,video_lc_picurl from zx_video ';
$sql.= ' where video_isdel = 0 and video_kng_id <> 0 ';
$sql.= ' order by video_pubDate desc,video_addtime desc ';
$sql.= ' limit 0,2';
$result = get_info_by_sql($sql);
//$video_kng_id = $result[0]['video_kng_id'];
$this->nw_video_id = $result[0]['video_id'];
$this->nw_video_title = $result[0]['video_title'];
$this->nw_video_description = $result[0]['video_description'];
$this->nw_video_picurl = $result[0]['video_picurl'];
$this->nw_video_knglist=get_kngidstr($result[0]['video_kng_id']);

$result[0]['video_knglist'] = get_kngidstr($result[0]['video_kng_id']);
$result[1]['video_knglist'] = get_kngidstr($result[1]['video_kng_id']);
$this->nw_video_array = $result;



$browse_our_library = '浏览我们的视频库';
/*$title = 'online自习室';
$description = '';
$keywords = '';*/
$this->title = $web_name;
$this->keywords = $web_name;
$this->description = $web_name;
$this->browse_our_library = $browse_our_library;

///index
$this->display('index.html');