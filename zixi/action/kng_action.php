<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
/*
if($_REQUEST['threeKngId']){
	  $cnt = get_kngson_count_by_id($_REQUEST['threeKngId']);
    if($cnt > 0){//有子 dao kng1
	      require 'kng11_action.php';
    }else{//无子 
	      require 'kng12_action.php';
    }
    die();
}
if($_REQUEST['twoKngId']){
    $cnt = get_kngson_count_by_id($_REQUEST['twoKngId']);
    if($cnt > 1 )require 'kng1_action.php';
    if($cnt == 1){
    	  $sql = 'select kng_id,kng_sort from zx_knowledge  ';
        $sql.= ' where  kng_foot_id = '.$_REQUEST['twoKngId'];
        $result = get_info_by_sql($sql);
        echo "<meta http-equiv=refresh content='0; url=".$web_site."/kng/".$_REQUEST['footKngId']."/".$_REQUEST['twoKngId']."/".$result[0]['kng_id']."'>";
	  }
    die();
}
*/
$this->footKngId = $_REQUEST['footKngId'];
$this->twoKngId = $_REQUEST['twoKngId'];
$this->footKng = get_kng_title_by_id($_REQUEST['footKngId']);
//$this->threeKngId = $_REQUEST['threeKngId'];
//$this->twoKng = get_kng_title_by_id($_REQUEST['twoKngId']);
/*$sql = 'select a.kng_id,a.kng_title from zx_knowledge a ';
$sql.= ' where a.kng_foot_id = '.$_REQUEST['twoKngId'];
$sql.= ' order by a.kng_sort <> 0 desc,a.kng_sort asc ';
$kng_left_list= get_info_by_sql($sql);
$this->kng_left_list = $kng_left_list;*/
$sql = 'select a.kng_id,a.kng_title from zx_knowledge a ';
$sql.= ' where a.kng_foot_id = '.$_REQUEST['footKngId'];
$sql.= ' order by a.kng_sort <> 0 desc,a.kng_sort asc ';
$kng_left_list= get_info_by_sql($sql);
$this->kng_left_list = $kng_left_list;
$result = get_kng_by_id($_REQUEST['twoKngId']);
$kng_title = $result[0]['kng_title'];
$this->kng_title = $result[0]['kng_title'];
$kng_description = $result[0]['kng_description'];
$this->kng_description = $result[0]['kng_description'];
$sql = 'select video_id,video_title from zx_video ';
$sql.= ' where video_kng_id = '.$_REQUEST['twoKngId']; 
$sql.= ' order by video_sort asc'; 
$video_list= get_info_by_sql($sql);
$this->video_list = $video_list;
$this->title = $kng_title;
$this->keywords = $kng_title;
$this->description = $kng_description;
$this->display('kng.html');