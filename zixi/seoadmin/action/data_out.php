<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$sql = ' select * from '.$_REQUEST['out_db'];
$result = get_info_by_sql($sql);
$out = get_csv_content($result,$_REQUEST['out_db']);
header("Content-type:text/csv");   
header("Content-Disposition:attachment;filename=".$_REQUEST['out_db'].".csv"); 
header('Cache-Control:must-revalidate,post-check=0,pre-check=0');   
header('Expires:0');   
header('Pragma:public'); 
echo $out; 
