<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
if($_REQUEST['search_query']){
	  //知识点
	  $kng_count = 0;
    $sql = ' select count(*) as cnt from zx_knowledge ';
    $sql .= " where kng_title like '%".$_REQUEST['search_query']."%'";
    $sql.= " and kng_grade <> 1 ";
    $result = get_info_by_sql($sql);	
    $kng_count = $result[0]['cnt'];
    $sql = ' select kng_id,kng_title from zx_knowledge ';
    $sql .= " where kng_title like '%".$_REQUEST['search_query']."%'";
     $sql.= " and kng_grade <> 1 ";
    $result = get_info_by_sql($sql);	
	  foreach ($result as $key => $value){
	  	  $result[$key]['kng_title'] = str_replace($_REQUEST['search_query'],'<span class="highlighted">'.$_REQUEST['search_query'].'</span>',$value['kng_title']);
			  $result[$key]['knglist']=get_kngidstr($value['kng_id']);
		}
		$this->kng_count = $kng_count;
		$this->kng_result = $result;
		$this->search_query = $_REQUEST['search_query'];
		//视频
		$video_count = 0;
    $sql = ' select count(*) as cnt from zx_video ';
    $sql .= " where (video_title like '%".$_REQUEST['search_query']."%'";
    $sql .= " or video_tags like '%".$_REQUEST['search_query']."%'";
    $sql .= " or video_description like '%".$_REQUEST['search_query']."%' ) ";
     $sql .= " and video_kng_id <> 0 ";
    $result = get_info_by_sql($sql);	
    $video_count = $result[0]['cnt'];
    $sql = ' select video_id,video_title,video_kng_id from zx_video ';
    $sql .= " where (video_title like '%".$_REQUEST['search_query']."%'";
    $sql .= " or video_tags like '%".$_REQUEST['search_query']."%'";
    $sql .= " or video_description like '%".$_REQUEST['search_query']."%' )";
      $sql .= " and video_kng_id <> 0 ";
    $result = get_info_by_sql($sql);	
	  foreach ($result as $key => $value){
          
	  	  $result[$key]['video_title'] = str_replace($_REQUEST['search_query'],'<span class="highlighted">'.$_REQUEST['search_query'].'</span>',$value['video_title']);
			  $result[$key]['videoknglist']= get_kngidstr($value['video_kng_id']);
			  $result[$key]['videoknglisttitle']= get_kngidstr2($value['video_kng_id'],$web_site);
		}
		$this->video_count = $video_count;
		$this->video_result = $result;
		
}
$this->title = '搜索 - '.$web_name;
$this->keywords = '搜索';
$this->description = '搜索';
$this->display('search.html');