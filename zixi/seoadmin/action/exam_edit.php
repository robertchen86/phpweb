<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
/*if(!$_POST['exam_title']){
    echo "发生不知名的错误，数据丢失！";
    echo "<meta http-equiv=refresh content='3; url=./?a=exam_to_add'>";
    die();
}
*/
if(!get_magic_quotes_gpc()) {
  //  $_POST['exam_title'] = addslashes($_POST['exam_title']);
  //  $_POST['exam_answer'] = addslashes($_POST['exam_answer']);
}

$examdb = spClass("zx_exam");
/*if($examdb->findBy("exam_title", $POST['exam_title'])){
	echo '试题 '.$_POST['exam_title'].' 已经存在，添加失败！';
  echo "<meta http-equiv=refresh content='3; url=./?a=exam_to_add'>";
  die();
}
*/
$newrow = array(
	//"exam_title" => $_POST['exam_title'],
	"exam_true" => strtoupper($this->spArgs('exam_true')),
	"exam_video_id" => $this->spArgs('video_ids'),
	//"exam_addtime" => date("Y-m-d H:i:s")
);
!$examdb->update(array("exam_id" => $this->spArgs("exam_id")), $newrow) && $this->error("试题添加失败！", "./?a=exam_to_add");
echo json_encode(get_examinfo_kngid($this->spArgs("kng_id"), $this->spArgs("exam_id")));
//$this->error("试题修改成功！", "./?a=exam_to_manage&examid={$_POST["exam_id"]}");