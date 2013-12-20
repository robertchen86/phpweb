<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
$sql = 'select kng_id,kng_title from zx_knowledge ';
$sql.= ' where kng_foot_id = 0 ';
$sql.= ' order by kng_sort <> 0 desc,kng_sort asc ';
$kng1_result = get_info_by_sql($sql);
foreach ($kng1_result as $key => $value){
    $sql = ' select  kng_id,kng_title,kng_description  from zx_knowledge ';
    //$sql.= ' left join zx_knowledge j on i.kng_id = j.kng_foot_id ';
    $sql.= ' where kng_foot_id = '.$value['kng_id'];
    //$sql.= ' group by i.kng_id ';	
    $sql.= ' order by kng_sort <> 0 desc,kng_sort asc ';
    $kng2_result = get_info_by_sql($sql);
    foreach ($kng2_result as $kng2_key => $kng2_value){
    	  $kng2_result[$kng2_key]['knglist']=get_kngidstr($kng2_value['kng_id']);
    	  /*if($kng2_value['kng_count'] == 0)
    	     continue;
    	  $kng2_result[$kng2_key]['kng_items'] = get_lib($kng2_value['kng_id']);*/
    	  
    	     $sql = ' select video_id,video_title  from zx_video ';
            $sql.= ' where video_kng_id = '.$kng2_value['kng_id'];
            $sql.= ' and video_isdel = 0 ';
            $sql.= ' and video_td_state = 1 ';	
            $sql.= ' order by video_sort<> 0 desc,video_sort asc ';
            $v_result = get_info_by_sql($sql);
            $kng2_result[$kng2_key]['vlist'] = $v_result;
            $sql = ' select count(video_id) as cnt  from zx_video ';
            $sql.= ' where video_kng_id = '.$kng2_value['kng_id'];
            $sql.= ' and video_isdel = 0 ';
            $sql.= ' and video_td_state = 1 ';	
            $sql.= ' order by video_sort<> 0 desc,video_sort asc ';
            $v1_result = get_info_by_sql($sql);
            $kng2_result[$kng2_key]['vcount'] = (int)(($v1_result[0]['cnt']+2)/3);
            $kng2_result[$kng2_key]['vcount2'] = (int)(($v1_result[0]['cnt'])/3);
    }
    $kng1_result[$key]['kng2_items']=$kng2_result;
}
//print_R($kng1_result);die();
$this->kng1_result = $kng1_result;
$this->title = '浏览所有视频 - '.$web_name;
$this->keywords = '浏览所有视频';
$this->description = '浏览所有视频';
$this->display('library.html');