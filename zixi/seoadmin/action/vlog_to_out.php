<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$return_string =" vlog_id,member_id,member_name,video_id,video_title,vlog_st_time,vlog_end_time \n"; 

$sql = ' select a.vlog_id,a.vlog_st_time,a.vlog_end_time,b.member_name,b.member_id,
c.video_title,c.video_id from zx_video_log a ';
$sql .= ' Left join zx_member b on a.vlog_member_id = b.member_id ';
$sql .= ' Left join zx_video c on a.vlog_video_id = c.video_id ';
$sql .= ' where a.vlog_id <> 0 ';
if(isset($_REQUEST['m_id']) and ('' != $_REQUEST['m_id']))
   $sql .= ' and a.vlog_member_id ='.$_REQUEST['m_id'];
if(isset($_REQUEST['kng_id']) and ('' != $_REQUEST['kng_id']))
   $sql .= ' and c.video_kng_id ='.$_REQUEST['kng_id'];
if(isset($_REQUEST['v_id']) and ('' != $_REQUEST['v_id']))
   $sql .= ' and a.vlog_video_id ='.$_REQUEST['v_id']; 

$sql.= ' order by a.vlog_st_time desc ';
//$sql.= ' limit ' . (($curpage-1)*$percount) . ',' . $percount;
$result=get_info_by_sql($sql);
//print_R($result);
foreach ($result as $key => $value){
		$string = $value["vlog_id"] . "," .$value["member_id"] . "," .$value["member_name"] . "," .$value["video_id"] . "," .$value["video_title"] . ",". $value["vlog_st_time"] . "," . $value["vlog_end_time"]. "\n";
	  //$return_string .= iconv('UTF-8' , 'GB2312' , $string);
	  //echo $string;
	  $return_string .= mb_convert_encoding ($string,'gbk','UTF-8');
}
//echo $return_string;
//die();
header("Content-type:text/csv; charset=gbk");   
header("Content-Disposition:attachment;filename=vlog.csv"); 
header('Cache-Control:must-revalidate,post-check=0,pre-check=0');   
header('Expires:0');   
header('Pragma:public'); 
echo $return_string; 
