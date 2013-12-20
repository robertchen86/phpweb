<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
if($_REQUEST['videoId']){
	  set_time_limit(0);
	  $this->footKngId = $_REQUEST['footKngId'];
    $this->twoKngId = $_REQUEST['twoKngId'];
    //$this->threeKngId = $_REQUEST['threeKngId'];
    $this->videoId = $_REQUEST['videoId'];
    $twoKng = get_kng_title_by_id($_REQUEST['twoKngId']);
    $this->twoKng = $twoKng;
    //$this->threeKng = get_kng_title_by_id($_REQUEST['threeKngId']);
	  $sql = 'select a.video_id,a.video_title,a.video_tags,a.video_description,a.video_playerurl,a.video_itemCode,a.video_itemId,
	  a.video_picurl,a.video_kng_id,b.kng_title  from zx_video a, zx_knowledge b ';
	  $sql.= ' where a.video_kng_id = b.kng_id ';
    $sql.= ' and  a.video_id = '.$_REQUEST['videoId'];
    $result = get_info_by_sql($sql);
	  //$video_kng_id = $result[0]['video_kng_id'];
	  //$this->video_kng_id = $video_kng_id;
	  //$this->video_kng_title = $result[0]['kng_title'];
	  $video_itemCode = $result[0]['video_itemCode'];
	  $this->video_itemCode = $video_itemCode;
	  
	  $this->video_picurl = str_replace("/p.jpg","/w.jpg",$result[0]['video_picurl']);
	  $this->video_itemId = $result[0]['video_itemId'];
	  $video_title = $result[0]['video_title'];
	  $video_tags = $result[0]['video_tags'];
	  $video_description = $result[0]['video_description'];
	  $this->video_title = $result[0]['video_title'];
	  $this->video_description = $result[0]['video_description'];
	  $this->video_playerurl = $result[0]['video_playerurl'];
	  //echo $result[0]['video_playerurl'];
	  //同一知识点下的视频列表
	  $sql = 'select video_id,video_title from zx_video ';
	  $sql.= ' where video_kng_id = '.$_REQUEST['twoKngId'];
    $sql.= ' order by video_sort <> 0 desc,video_sort asc ';
    $video_l_list = get_info_by_sql($sql);
	  $this->video_l_list = $video_l_list;
	  //该视频的留言
	  $leaves_count = 0;
	  $sql = 'select count(a.vcomment_id) as cnt  from zx_video_comment a, zx_member b ';
	  $sql.= ' where a.vcomment_member_id = b.member_id ';
    $sql.= ' and  a.vcomment_video_id = '.$_REQUEST['videoId'];
    $result = get_info_by_sql($sql);
    $leaves_count = $result[0]['cnt'];
    $this->leaves_count = $leaves_count;
	  $sql = 'select a.vcomment_id,a.vcomment_member_id,a.vcomment_content,a.vcomment_addtime,
	  a.vcomment_uptime,b.member_name  from zx_video_comment a, zx_member b ';
	  $sql.= ' where a.vcomment_member_id = b.member_id ';
    $sql.= ' and  a.vcomment_video_id = '.$_REQUEST['videoId'];
    $sql.= ' order by a.vcomment_addtime desc ';
    $vcomment_list = get_info_by_sql($sql);
    $this->vcomment_list = $vcomment_list;
    $cur_day_cnt = 0;
    //登录这个该视频 今日是否留言了
    if($member != ''){
        $sql = ' select count(vcomment_id) as cnt from zx_video_comment ';
        $sql.= ' where vcomment_video_id = '.$_REQUEST['videoId'];
        $sql.= ' and  vcomment_member_id = '.$member_vc_id ;
        $sql.= " and  vcomment_addtime like '".date('Y-m-d')."%' "; 
        $result = get_info_by_sql($sql);
        $cur_day_cnt = $result[0]['cnt']; 
    }
    $this->cur_day_cnt = $cur_day_cnt;
	  //土豆上的评论
	  $pageNo = 1;
	  $pageSize = 10;
	  /***本地暂时 注释先*s**/
	  /*$result = get_account_by_type(1);
    $app_key = $result[0]['account_app_key'];
    $obj = catch_comments($app_key,$video_itemCode,1);
    $objpage = object2array($obj['page']);
	  $totalCount = $objpage['totalCount'];
	  $pageCount = $objpage['pageCount']; 
	  $this->totalCount = $totalCount;
	  $this->pageCount = $pageCount;
	  $returnArray = array();
	  $objresults = object2array($obj['results']);
	  foreach ($objresults as $key => $value){
    	  $returnArray[$key] = object2array($value);
    }
    $this->vm_tudou_list = $returnArray;*/
    /***本地暂时 注释先*e**/
    $this->vm_tudou_list = array();
    $this->totalCount = 0;
	  $this->pageCount = 0;
    //die();
	  //该会员观看次
	  if($member != ''){
	  $view_count = 0;
	  $sql = 'select count(vlog_id) as cnt  from zx_video_log ';
	  $sql.= ' where vlog_member_id = '.$member_vc_id;
    $sql.= ' and vlog_video_id = '.$_REQUEST['videoId'];
    $result = get_info_by_sql($sql);
    $view_count = $result[0]['cnt'];
    $this->view_count = $view_count;
	  }
	  //视频总观看次数
	  $view_all_count = 0;
	  /***本地暂时 注释先*s**/
	  //$view_all_count =catch_playtimes($app_key,$video_itemCode);
	  /***本地暂时 注释先*e**/
	  $this->view_all_count = $view_all_count;
	  
	  $this->title = $twoKng.' - '.$video_title;
    $this->keywords = $video_tags;
    $this->description = $video_description;
  
    $this->display('video.html');
}