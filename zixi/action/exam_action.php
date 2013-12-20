<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
if($_REQUEST['videoId']){
	  set_time_limit(0);
	  $this->footKngId = $_REQUEST['footKngId'];
    $this->twoKngId = $_REQUEST['twoKngId'];
    $this->videoId = $_REQUEST['videoId'];
		
		if($member == ''){
			$this->error("请登录", $this->web_site . "/login");
		}
		$memberinfo = spClass("zx_member")->findBy("member_name", $member);
		$examdb = spClass("zx_exam");
		//$this->examcount = $examdb->findCount(array("exam_video_id" => $_REQUEST["videoId"]));
		$this->examcount = 5;
		$maxcount = 5;
		/*
		list($this->current_exam, $this->next_exam) = $examdb->findAll(array("exam_video_id" => $_REQUEST["videoId"]), "exam_order", null, ($this->spArgs("examId", 1) - 1) . ", 2");
		if($select = $this->spArgs("select")){
			spClass("zx_exam_record")->create(array("er_member_id" => $memberinfo["member_id"], "er_exam_id" => $this->current_exam["exam_id"], 
																				"er_exam_selected" => $select, "er_exam_time" => date("Y-m-d H:i:s")));
			if($this->current_exam["exam_true"] == $select){
				$examid = $this->spArgs("examId", 1) + 1;
			}else{
				echo json_encode(array("exam" => null, "examid" => $this->spArgs("examId", 1)));
	  		die();
			}
			if($examid > $this->examcount) $examid = 0;
	  	echo json_encode(array("exam" => $this->next_exam, "examid" => $examid));
	  	die();
	  }
	  */
	  if($select = $this->spArgs("select")){
	  //	echo 'a';
	  	$selectid = $this->spArgs("selectId");
	  	$selectexam = $examdb->findBy("exam_id", $selectid);  
	  	$er_exam_selected = 0;
	  	if($select == 'N')$er_exam_selected = -1;       
	  	if($select == $selectexam["exam_true"]) $er_exam_selected = 1;    
	  	spClass("zx_exam_record")->create(array("er_member_id" => $memberinfo["member_id"], "er_exam_id" => $this->spArgs("selectId"),
	  																					"er_exam_selected" => $er_exam_selected, "er_exam_answered" => $select, 
	  																					"er_exam_usetime" => $this->spArgs("time", 999), "er_time" => date("Y-m-d H:i:s"),"er_gtime" => str_replace('_',' ',$_REQUEST['g_time'])));
	  }
	  //echo 'a';
	  $examid = $this->spArgs("examId", 1);  
	  $exam_g_time = '';
	  if($_REQUEST['g_time']){
	  	  $exam_g_time = str_replace('_',' ',$_REQUEST['g_time']);
	  }else{
	  	  $exam_g_time = date("Y-m-d H:i:s");
	  }
	   $this->exam_g_time = $exam_g_time;
	  $exam_isnull = false;
	  $exam_array = $examdb->findAll("exam_video_id LIKE '%,{$_REQUEST["videoId"]},%' AND exam_id NOT IN(SELECT er_exam_id FROM zx_exam_record WHERE er_member_id = {$memberinfo["member_id"]} and er_exam_selected <> -1) AND exam_isdel = 0");
	 	$examcount = count($exam_array);
	 	if(!$exam_array || $examid >=$maxcount)$exam_isnull = true;
	 	
		if($examcount < $this->examcount && ($this->spArgs("examId") == 1)) $this->examcount = $examcount;
		
		if(!$exam_array && !$this->spArgs("examId")) $this->examcount = 0;
	  $current_index = rand(0, $examcount - 1);
	  $exam_array[$current_index]["exam_title"] = preg_replace('/(src=")([^"]+)(\/.)/is', ' $1' . $this->web_site . "/files/" . '$2', $exam_array[$current_index]["exam_title"]);
	  $exam_array[$current_index]["exam_title"] = str_replace("mage", "/image", $exam_array[$current_index]["exam_title"]);
	  $this->current_exam = $exam_array[$current_index];
		//echo 'b';
	  if($select){
	  	//echo 'f';
	  	$zxdd = spClass("zx_exam_record");
	  	$count = $zxdd->findSql("SELECT count(*) as c FROM (SELECT * FROM zx_exam_record WHERE er_member_id = {$memberinfo["member_id"]} ORDER BY er_time DESC Limit {$examid}) AS r WHERE r.er_exam_selected = 1");
	  	$return_array = array("exam" => $this->current_exam, "examid" => $exam_isnull == true ? 0: $examid, "istrue" => $select == $selectexam["exam_true"]? 1 : 0);
	  	if($exam_isnull == true || (!$this->current_exam) ){
	  		$return_array["count"] = array("c" => $examid, "truecount" => $count[0]["c"], "falsecount" => $examid - $count[0]["c"]);
	  	}

	  	echo json_encode($return_array);
	  	die();
	  }
		
	  $this->title = $twoKng.' - 试题';
    $this->keywords = "";
    $this->description = "";
    if($this->current_exam["exam_title"] == ""){
    	$this->error("该知识点下的题库还在更新中...请稍后过来测试", $this->web_site . "/kng/" . $this->footKngId . "/" . $this->twoKngId . "/video/" . $this->videoId);
    }
    $webinfo = spClass("zx_web")->find();
    $this->timemax = $webinfo["web_exam_time"];
    $this->display('exam.html');
}