<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$kngid = $this->spArgs("kngid", 1);
if(!$kngid){
    die();
}
/*
$examdb = spClass("zx_exam");
$video_array = spClass("zx_video")->findAll(array("video_kng_id" => $kngid));
$videoids = "";
$sqlw = "0";
foreach($video_array as $key => $video){
	$sqlw .= " OR exam_video_id LIKE '%,{$video["video_id"]},%'";
}

if($exam_id = $this->spArgs("examid")){
	$sql = "exam_id < {$exam_id} AND ({$sqlw})";
}else{
	$sql = $sqlw;
}
$examinfo = $examdb->find($sql, "exam_id desc");
//echo $examdb->dumpSql();
$examinfo["videoids"] = explode(",", $examinfo["exam_video_id"]);
$examinfo["video_select"] = get_video_list_by_ajax($kngid, $examinfo["videoids"]);

$examinfo["exam_title"] = preg_replace('/(src=")([^"]+)(\/.)/is', ' $1' . "../files/" . '$2', $examinfo["exam_title"]);
$examinfo["exam_title"] = str_replace("mage", "/image", $examinfo["exam_title"]);
*/
$examinfo = get_examinfo_kngid($kngid, $this->spArgs("examid"));
if($this->spArgs("act") == "del"){
	$examdb = spClass("zx_exam");
	$examdb->update(array("exam_id" => $this->spArgs("examid", 1)), array("exam_isdel" => 1));
	//echo $examdb->dumpSql();
}
//print_r($examinfo);
echo json_encode($examinfo);