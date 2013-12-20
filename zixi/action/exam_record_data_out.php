<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$user = spClass("zx_member")->findBy("member_id", $this->spArgs("memberid"));
$examrecorddb = spClass("zx_exam_record");
$result = $examrecorddb->findAll(array("er_member_id" => $this->spArgs("memberid"), "er_time desc"));
$return_string .="member_id,selected_answer,use_time,isright,selected_time \n"; 
foreach ($result as $key => $value){
	$string = $value["er_member_id"] . "," . $value["er_exam_answered"] . "," . $value["er_exam_usetime"];
	$string .= "," . $value['er_exam_selected'] . "," . $value["er_time"] . "\n";
  $return_string .= iconv('UTF-8' , 'GB2312' , $string);
}
header("Content-type:text/csv");   
header("Content-Disposition:attachment;filename=".$user["member_name"].".csv"); 
header('Cache-Control:must-revalidate,post-check=0,pre-check=0');   
header('Expires:0');   
header('Pragma:public'); 
echo $return_string; 
