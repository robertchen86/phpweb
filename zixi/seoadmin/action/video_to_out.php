<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$return_string =" video_id,video_sort,video_itemCode,video_title,kng_id,kng_title,video_td_state,video_isrecommend,video_pubDate \n";


if(isset($_REQUEST['video_kng_id']) and ($_REQUEST['video_kng_id'] != ''))
    $cur_kng_id = $_REQUEST['video_kng_id'];

$sql = ' select a.video_id,a.video_title,a.video_tags,a.video_itemCode,
a.video_isrecommend,a.video_sort,a.video_td_state,a.video_pubDate,a.video_uptime,
b.kng_title,b.kng_id,a.video_addtime
 from zx_video a ';
$sql .= ' Left join zx_knowledge b on a.video_kng_id = b.kng_id ';
$sql .= ' where a.video_isdel = 0 ';
if(isset($_REQUEST['video_td_state']) and ($_REQUEST['video_td_state'] != '')){
    $sql .= ' and a.video_td_state ='.$_REQUEST['video_td_state'];
}
if($cur_kng_id != '')
    $sql .= ' and a.video_kng_id ='.$cur_kng_id;
if(isset($_REQUEST['keyword']) and ('' != $_REQUEST['keyword'])){
	  $sql .= " and (a.video_title like '%".$_REQUEST['keyword']."%'";
	  $sql .= " or  a.video_tags like '%".$_REQUEST['keyword']."%' ";
	  $sql .= " or  a.video_description like '%".$_REQUEST['keyword']."%' )";
}
$sql.= ' order by a.video_addtime desc ';
$result=get_info_by_sql($sql);
//$tuij = array('否','是');
//$state_array = array('','正常播放','审核中','转码中','不存在','重复上传','审核不通过');

foreach ($result as $key => $value){
	  $string = $value["video_id"].",".$value["video_sort"].",".$value["video_itemCode"].",".$value["video_title"].",".$value["kng_id"].",".$value["kng_title"].",".$value["video_td_state"].",".
	  $value["video_isrecommend"]. "," . $value["video_pubDate"]. "\n";
	  $return_string .= iconv('UTF-8' , 'GB2312' , $string);
}
header("Content-type:text/csv");   
header("Content-Disposition:attachment;filename=video.csv"); 
header('Cache-Control:must-revalidate,post-check=0,pre-check=0');   
header('Expires:0');   
header('Pragma:public'); 
echo $return_string; 
