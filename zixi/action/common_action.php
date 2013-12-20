<?php

//当前url
//$cur_url = $_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];
//$this->cur_url =  urlencode($cur_url);
//获取登录cookie
$member = '';
if (isset($_COOKIE['_onlinezixishi_'])){
	  $result_member = get_member_by_code($_COOKIE['_onlinezixishi_']);
	  $member = $result_member[0]['member_name'];
	  $member_vc_id = $result_member[0]['member_id'];
	  $member_id = $result_member[0]['member_id'];
	  $membercode = $result_member[0]['member_md5code'];
	  $this->member_addtime = $result_member[0]['member_addtime'];
	  
	  $this->member_exam_vlink = $result_member[0]['member_exam_vlink'];
	  
	  $this->member_id = $result_member[0]['member_id'];
	  $this->member_identity_type = $result_member[0]['member_identity_type'];
	  $this->membercode = $result_member[0]['member_md5code'];
	  $this->member_logo = $result_member[0]['member_logo'];
	  //已观看视频个
	  $v_videos = 0;
	  $sql = ' select count(distinct vlog_id) as cnt from  zx_video_log ';
    $sql.= ' where vlog_member_id = '.$member_vc_id ;
    $sql.= ' and vlog_end_time is not null ';
	  $result = get_info_by_sql($sql);
	  $v_videos = $result[0]['cnt'];
	  $this->v_videos = $v_videos;
	  //观看视频此时
	  $v_times = 0;
	  $sql = ' select count(vlog_id) as cnt from  zx_video_log ';
    $sql.= ' where vlog_member_id = '.$member_vc_id ;
    $sql.= ' and vlog_end_time is not null ';
	  $result = get_info_by_sql($sql);
	  $v_times = $result[0]['cnt'];
	  $this->v_times = $v_times;
}
$this->member = $member;
//print_R($member);
//取得网站配置信息
$result = get_web();
$web_site = $result[0]['web_site'];
$web_name = $result[0]['web_name'];
$web_logo = $result[0]['web_logo'];
$web_cnzz = $result[0]['web_cnzz'];
$web_tos = $result[0]['web_tos'];
$web_notice = $result[0]['web_notice'];
$web_exam_time = $result[0]['web_exam_time'];
$web_tos_uptime = $result[0]['web_tos_uptime'];
$web_privacy = $result[0]['web_privacy'];
$web_privacy_uptime = $result[0]['web_privacy_uptime'];
$this->web_site = $web_site;
$this->web_name = $web_name;
$this->web_logo = $web_logo;
$this->web_cnzz = $web_cnzz;
$this->web_notice = $web_notice;

$this->web_tos = $web_tos;
$this->web_tos_uptime = $web_tos_uptime;
$this->web_privacy = $web_privacy;
$this->web_privacy_uptime = $web_privacy_uptime;
//来源
$referer = '';
if($_SERVER['HTTP_REFERER'] != str_replace($web_site,'',$_SERVER['HTTP_REFERER'])){
	  $referer = $_SERVER['HTTP_REFERER'];
}
$this->http_referer = urlencode($referer);
//echo urlencode($referer);
//导航
/*
Learn 学习/ Coach 辅导/Donate 赠送/Home 首页//Talks and Interviews/*/
$nav_array = array(
    'Learn'=>'学习','Coach'=>'辅导','About'=>'关于','Donate'=>'赠送',
    'Home'=>'首页','Knowledge_Map'=>'知识树','Talks_and_Interviews'=>'讲座及访谈',
    'Coach_Resources'=>'辅导资源','Browse_all_videos'=>'浏览所有视频'
    );
$this->nav_array = $nav_array;
//知识点导航
$sql = 'select kng_id,kng_title from zx_knowledge ';
$sql.= ' where kng_foot_id = 0 ';
$sql.= ' order by kng_sort <> 0 desc,kng_sort asc ';
$nav_kng_result = get_info_by_sql($sql);
foreach ($nav_kng_result as $key => $value){
	/*$sql = ' select  i.kng_id,i.kng_title, count(j.kng_id) as kng_count  from zx_knowledge i ';
    $sql.= ' left join zx_knowledge j on i.kng_id = j.kng_foot_id ';
    $sql.= ' where i.kng_foot_id = '.$value['kng_id'];
    $sql.= ' group by i.kng_id ';	
    $sql.= ' order by i.kng_sort <> 0 desc,i.kng_sort asc ';*/
    $sql = ' select  i.kng_id,i.kng_title  from zx_knowledge i ';
    $sql.= ' where i.kng_foot_id = '.$value['kng_id'];
    //$sql.= ' group by i.kng_id ';	
    $sql.= ' order by i.kng_sort <> 0 desc,i.kng_sort asc ';
    $tmp_result = get_info_by_sql($sql);
    $nav_kng_result[$key]['kng_items']=$tmp_result;
}
$this->nav_kng_result = $nav_kng_result;

// 与UCenter中应用一一对应的Token
//$UCenterToken = '9HG3VWKF254EE542659FEDC8A4282A1B5EC7CEF6C2BB0BAD3A5524B6A6D76E4FE292900C2431498E7C58F5C8CC7B962340E33E9C8D07B9F08B06CE711';
$UCenterToken = '2C2LZUE9QZ57BE88A8F17971F25D15402E9B071735575B49B5FD88949199EAF724B04143CB56A7CADEBAF9E31DED4D015019E519110B9A95BC8CD3403';
//UCenter地址 UCenterUrl
$UCenterUrl = 'http://oa.h14z.com:8081';
$wsdl = "http://oa.h14z.com:8081/UCenter.asmx?WSDL";