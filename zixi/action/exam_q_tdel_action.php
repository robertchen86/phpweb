<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
if (!isset($_COOKIE['_onlinezixishi_'])){
	 echo "<meta http-equiv=refresh content='0; url=".$web_site."/login'>"; 
	 die();
}
if($_REQUEST['qid']){
    //$result =  del_exam_question_by_id($_REQUEST['qid']);
    $inrow['m_exam_q_t_isdisplay'] = 1;
    $result =  update_exam_question($_REQUEST['qid'],$inrow);
	  if($result == false){
        $this->err_info = '试题质疑删除失败！';
        $this->display('err.html');
        die();
    }
	  echo "<meta http-equiv=refresh content='0; url=".$web_site."/profile/1/".$_COOKIE['_onlinezixishi_']."'>";
    die();
}