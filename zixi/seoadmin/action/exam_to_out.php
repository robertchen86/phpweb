<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$return_string =" exam_id,video_id,kng_id,exam_isdel \n"; 
$sql = ' select exam_id,exam_video_id,exam_isdel	from zx_exam ';
$result = get_info_by_sql($sql);
foreach ($result as $key => $value){
	  if($value['exam_video_id'] != ''){
    $exm_v_id_a = explode(',',$value['exam_video_id']);
	  $exam_video_id =  $exm_v_id_a[1];
	  //$result['kng_id'] = get_kng_id_by_video_id($exam_video_id);
	  $string = $value["exam_id"] . "," .str_replace(',','|',$value["exam_video_id"])  . "," .get_kng_id_by_video_id($exam_video_id) . "," . $value["exam_isdel"]. "\n";
	  }else{
	  	  $string = $value["exam_id"] . "," .str_replace(',','|',$value["exam_video_id"]) . ",," . $value["exam_isdel"]. "\n";
		}
	  $return_string .= iconv('UTF-8' , 'GB2312' , $string);
}
header("Content-type:text/csv");   
header("Content-Disposition:attachment;filename=exam.csv"); 
header('Cache-Control:must-revalidate,post-check=0,pre-check=0');   
header('Expires:0');   
header('Pragma:public'); 
echo $return_string; 
