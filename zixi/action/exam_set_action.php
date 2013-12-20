<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
//set_time_limit(0);
if($member == '')
		$this->error("请登录", $this->web_site . "/login");
$memberinfo = spClass("zx_member")->findBy("member_name", $member);
$member_id = $memberinfo["member_id"];
/*$cnt = 0;
$sql = ' select count(er_exam_id) as cnt   from zx_exam_record  ';
$sql.= ' where  er_member_id = '.$member_id;
$sql.= ' and  er_exam_selected=0';
$result = get_info_by_sql($sql);
$cnt =$result[0]['cnt'];
if($cnt != 0){
	  unset($result,$sql);
	  $sql = ' select a.er_exam_id,a.er_time,a.er_exam_answered,b.exam_true,b.exam_title,b.exam_video_id   from zx_exam_record a, zx_exam b';
	  $sql.= ' where a.er_member_id = '.$member_id;
	  $sql.= ' and a.er_exam_selected=0';
	  $sql.= ' and a.er_exam_id=b.exam_id ';
	  $sql.= ' order by a.er_time asc ';
	  $result = get_info_by_sql($sql);
	  $this->f_num = 1;
	  $this->f_er_time = $result[0]['er_time'];
	  $this->f_exam_true = $result[0]['exam_true'];
	  $this->f_exam_answered = str_replace("N", "", $result[0]['er_exam_answered']);
	  $f_exam_title = $result[0]['exam_title'];
	  
	  $f_exam_title = preg_replace('/(src=")([^"]+)(\/.)/is', ' $1' . $this->web_site . "/files/" . '$2', $f_exam_title);
	  $f_exam_title = str_replace("mage", "/image", $f_exam_title);
	  $this->f_exam_title =$f_exam_title;
	  $exam_video_id = $result[0]['exam_video_id'];
	  //$exam_video_id = str_replace(',','',$exam_video_id);
	  $exm_v_id_a = explode(',',$exam_video_id);
	  $exam_video_id =  $exm_v_id_a[1];
	   unset($result,$sql);
	  $sql = ' select video_kng_id from zx_video where video_id ='.$exam_video_id;
	  $result = get_info_by_sql($sql);
	  $video_kng_id = $result[0]['video_kng_id'];
	  $this->kng_list = get_kng_list2(0,$video_kng_id);
	  //echo $video_kng_id;
	  
	  $this->video_list = get_video_list2($video_kng_id,$exam_video_id);
	  //print_R($result);
}


//get_kng_list_by_ajax
//$examdb = spClass("zx_knowledge");
//$rootkng = $examdb->find(array("kng_foot_id" => 0));
//print_R($rootkng);
//echo $rootkng ;

$this->err_count = $cnt;
*/

//print_R($_REQUEST);
$kng_list = '';
$kng_id = 0;
$kng_v_type = '';
$updown = '';
$exam_id = '';
//$exam_select_id = '';
if($_REQUEST['kng_id'])$kng_id = $_REQUEST['kng_id'];
if($_REQUEST['kng_v_type'])$kng_v_type = $_REQUEST['kng_v_type'];
if($_REQUEST['updown'])$updown = $_REQUEST['updown'];
if($_REQUEST['exam_id'])$exam_id = $_REQUEST['exam_id'];
//if($_REQUEST['exam_select_id'])$exam_select_id = $_REQUEST['exam_select_id'];

if($_REQUEST['act'] == 'save'){
	  $inrow = array(
	  'exam_video_id' => $_REQUEST['video_ids'],
	  'exam_kng_id' => $_REQUEST['kng_set_id'],
	  );
	  update_exam($exam_id,$inrow);
	  $updown = '2';
}
if($_REQUEST['act'] == ''){
    $updown = '';
    $exam_id = '';
}

if($kng_id == 0){
    $knowledgedb = spClass("zx_knowledge");
    $rootkng = $knowledgedb->find(array("kng_foot_id" => 0));
    //$childkng = $knowledgedb->find(array("kng_foot_id" => $rootkng["kng_id"]));
    $childkng = $knowledgedb->find(array("kng_foot_id" => $rootkng["kng_id"]));
    $kng_id = $childkng['kng_id'];
}

//print_R($kng_id);
//\die();
$kng_list .= get_kng_list_by_ajax($kng_id);
$examinfo = get_examinfo_by_kng_id2($kng_id,$kng_v_type,$exam_id,$updown);
$video_list = '<option value="0">请选择视频</option>';
$video_list = get_video_list_by_ajax($kng_id, $examinfo["exam_video_id"]);
$test = '';
$test = $examinfo["exam_title"];
//echo $test;
//ECHO $exam_id;
if($test == ''){
	  if($exam_id){$examinfo = get_examinfo_by_id2($exam_id);$video_list = get_video_list_by_ajax($kng_id, $examinfo["exam_video_id"]);}
	  if($updown){
	  	 //echo "<script>alert('没有相关试题数据！');</script>";
	  	 if($updown == '1') echo "<script>alert('已没有上一题！');</script>"; 
			 if($updown == '2') echo "<script>alert('已没有下一题！');</script>"; 
	  }else{
	  	  echo "<script>alert('没有相关试题数据！');</script>";
		}
}

$this->kng_list = $kng_list;
$this->video_list = $video_list;
$this->kng_v_type = $kng_v_type;

$this->examinfo = $examinfo;
$this->display('exam_set.html');
die();
