<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if(!$_POST['exam_title']){
    echo "发生不知名的错误，数据丢失！";
    echo "<meta http-equiv=refresh content='3; url=./?a=exam_to_add'>";
    die();
}
if(!get_magic_quotes_gpc()) {
    $_POST['exam_title'] = addslashes($_POST['exam_title']);
    $_POST['exam_answer'] = addslashes($_POST['exam_answer']);
}

$examdb = spClass("zx_exam");
if($examdb->findBy("exam_title", $POST['exam_title'])){
	echo '试题 '.$_POST['exam_title'].' 已经存在，添加失败！';
  echo "<meta http-equiv=refresh content='3; url=./?a=exam_to_add'>";
  die();
}

$newrow = array(
	"exam_kng_id" => $_POST['kng_id'],
	"exam_title" => $_POST['exam_title'],
	"exam_true" => strtoupper($_POST['exam_true']),
	"exam_video_id" => $_POST['video_ids'],
	"exam_addtime" => date("Y-m-d H:i:s")
);
!$examdb->create($newrow) && $this->error("试题添加失败！", "./?a=exam_to_add");
$this->error("试题添加成功！", "./?a=exam_to_manage2");