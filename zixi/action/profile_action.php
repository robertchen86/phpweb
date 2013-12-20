<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
if (!isset($_COOKIE['_onlinezixishi_'])){
	 echo "<meta http-equiv=refresh content='0; url=".$web_site."/login'>"; 
	 die();
}
if(!$_REQUEST['mc']){
	 die();
}
//echo $_REQUEST['mc'],'==',$membercode;
if($_REQUEST['mc'] != $membercode){
	 echo "<meta http-equiv=refresh content='0; url=".$web_site."/login'>";
	 die();
}

$this->m_type = $_REQUEST['type'];

$this->title = '个人中心 - '.$web_name;
$this->keywords = '个人中心';
$this->description = '个人中心';
if($_REQUEST['type'] == 0){//学生
//视频个数	
$sql = ' select count(distinct video_id) as cnt from  zx_video ';
$sql.= ' where video_isdel = 0 ';
$sql.= ' and video_td_state = 1 ';
$result = get_info_by_sql($sql);
$videos_count = $result[0]['cnt'];
$this->videos_count = $videos_count;
if($videos_count != 0){
//最近观看	
$sql = ' select distinct a.vlog_id,a.vlog_addtime,b.video_title,b.video_id,b.video_kng_id  from  zx_video_log a ';
$sql.= ' left join zx_video b on b.video_id = a.vlog_video_id ';
$sql.= ' where a.vlog_member_id = '.$member_vc_id ;
//$sql.= ' and vlog_video_id = '.$video_id ;
//$sql.= ' and vlog_st_time like"'.date('Y-m-d').'%" ' ;
$sql.= ' and (a.vlog_end_time is not null )';
$sql.= ' and b.video_isdel = 0 ';
$sql.= ' and b.video_td_state = 1 ';
$sql.= ' order by a.vlog_addtime desc ';
$sql.= ' limit 0,5';
$result = get_info_by_sql($sql);
$v_array = array();
$k_array = array();
    $kkey = 0;
foreach ($result as $key => $value){
    $kkey += 1;
	  $result[$key]['knglist'] = get_kngidstr($value['video_kng_id']);
	  $v_array[] = $value['video_id'];
	  if($value['video_kng_id'] == 0)
	      continue;
	  if(!in_array($value['video_kng_id'],$k_array))
	      $k_array[] = $value['video_kng_id'];
}
    if( $kkey != 0)
       $this->videos_recent = $result;
       

//学习推荐
//知识点
$tmp_video_kng_id ='';
$sql = ' select distinct b.video_kng_id  from  zx_video_log a ';
$sql.= ' left join zx_video b on b.video_id = a.vlog_video_id ';
$sql.= ' where a.vlog_member_id = '.$member_vc_id ;
$sql.= ' and (a.vlog_end_time is not null )';
$sql.= ' and b.video_isdel = 0 ';
$sql.= ' and b.video_td_state = 1 ';
$sql.= ' order by a.vlog_addtime desc ';
$result = get_info_by_sql($sql);
//print_R($result );
//$tmp_video_kng_id = $result[0]['video_kng_id'];
//echo $tmp_video_kng_id;
$tj_kng_result = array();
$jkey = 0;
$tmp_k_result = array();
$tmp_result_k = array();
foreach ($result as $key => $value){
	  if($value['video_kng_id'] == 0)
	    continue;
	  $tmp_result_k[] = $value['video_kng_id'];
}
foreach ($result as $key => $value){
	  if($value['video_kng_id'] == 0)
	      continue;
	  $tmp_tj_kng_result = get_kngidstr3($value['video_kng_id']);
	  //print_R($tmp_tj_kng_result );
	  foreach ($tmp_tj_kng_result as $tmp_key => $tmp_value){
	  	   if(in_array($tmp_value['kng_id'],$tmp_k_result))
    	        continue;
    	   if(in_array($tmp_value['kng_id'],$tmp_result_k))
    	        continue;
    	   if($jkey >= 3)
    	        break;
    	  $tmp_k_result[] = $tmp_value['kng_id'];
	  	  $tj_kng_result[$jkey]['kng_id'] = $tmp_value['kng_id'];
	  	  $tj_kng_result[$jkey]['kng_title'] = $tmp_value['kng_title'];
	  	  $tj_kng_result[$jkey]['knglist'] = $tmp_value['knglist'];
	  	  $jkey+=1;
	  }
	 if($jkey >= 3)
    	break;
}
if($jkey != 0)
    $this->tj_kng_result = $tj_kng_result;
//视频
$tj_v_result = array();
$ikey = 0;
foreach ($k_array as $key => $value){
	  $sql = ' select video_id,video_title  from  zx_video ';
    $sql.= ' where video_kng_id = '.$value;
    $tmp_result = get_info_by_sql($sql);
    foreach ($tmp_result as $tmp_key => $tmp_value){
    	   if(in_array($tmp_value['video_id'],$v_array))
    	        continue;
    	   if($ikey >= 3)
    	        break;
    	   $tj_v_result[$ikey]['video_id'] = $tmp_value['video_id'];
    	   $tj_v_result[$ikey]['video_title'] = $tmp_value['video_title'];
    	   $tj_v_result[$ikey]['knglist'] = get_kngidstr($value);
    	   $ikey+=1;
    }
    if($ikey >= 3)
    	        break;
}
if($ikey == 0){
	  foreach ($tj_kng_result as $key => $value){
	  	  $sql = ' select video_id,video_title  from  zx_video ';
        $sql.= ' where video_kng_id = '.$value['kng_id'];
        $tmp_result = get_info_by_sql($sql);
        foreach ($tmp_result as $tmp_key => $tmp_value){
    	      if(in_array($tmp_value['video_id'],$v_array))
    	          continue;
    	      if($ikey >= 3)
    	           break;
    	      $tj_v_result[$ikey]['video_id'] = $tmp_value['video_id'];
    	      $tj_v_result[$ikey]['video_title'] = $tmp_value['video_title'];
    	      $tj_v_result[$ikey]['knglist'] = get_kngidstr($value['kng_id']);
    	      $ikey+=1;
        }
        if($ikey >= 3)
    	        break;
	  }
}
if($ikey != 0)
    $this->tj_v_result = $tj_v_result;
}
//学生申请列表
	  $sql = ' select a.m_t_apply_id,a.m_t_apply_s_id,a.m_t_apply_addtime,b.member_name,c.student_name,a.m_t_apply_state from zx_member_t_apply a ';
	  $sql.= ' left join zx_member b on a.m_t_apply_t_id=b.member_id ';
	  $sql.= ' left join zx_student c on b.member_student_code=c.student_code ';
	  
	  $sql.= ' where a.m_t_apply_s_id = '.$member_id;
	  $sql.= ' and a.m_t_apply_state <> 2 ';
	  $sql.= ' order by a.m_t_apply_uptime desc,a.m_t_apply_addtime desc ';
	  $result = get_info_by_sql($sql);
	  $this->apply_list = $result;
//老师列表
   $sql = ' select  a.m_belong_id,a.m_belong_addtime,b.member_name,c.kng_title,b.member_email from zx_member_belong a ';
	  $sql.= ' left join zx_member b on a.m_belong_t_id=b.member_id ';
	  $sql.= ' left join zx_knowledge c on c.kng_id=b.member_kng_id ';
	  $sql.= ' where a.m_belong_s_id = '.$member_id;
	  //$sql.= ' and a.m_t_apply_state = 0 ';
	  $sql.= ' order by a.m_belong_uptime desc,a.m_belong_addtime desc ';
	  $result = get_info_by_sql($sql);
	  $this->tcher_list = $result;
	  //题目质疑
	  $sql = ' select  a.m_exam_q_id,a.m_exam_q_addtime,b.member_name,c.student_name,a.m_exam_q_examid,a.m_exam_q_reply from zx_member_exam_question a ';
	  $sql.= ' left join zx_member b on a.m_exam_q_s_id=b.member_id ';
	  $sql.= ' left join zx_student c on b.member_student_code=c.student_code ';
	  //$sql.= ' left join zx_knowledge c on c.kng_id=b.member_kng_id ';
	  $sql.= ' where a.m_exam_q_s_id = '.$member_id;
	  $sql.= ' order by a.m_exam_q_uptime desc,a.m_exam_q_addtime desc ';
	  $result = get_info_by_sql($sql);
	  $this->exam_q_list = $result;
	  $t_apply_bool = 1;
	  if( count($result) >= 15)$t_apply_bool = 0;
	  $this->t_apply_bool = $t_apply_bool;
    $this->display('s_profile.html');
}else{//老师
	  //学生申请列表
	  $sql = ' select a.m_t_apply_id,a.m_t_apply_s_id,a.m_t_apply_addtime,b.member_name,c.student_name from zx_member_t_apply a ';
	  $sql.= ' left join zx_member b on a.m_t_apply_s_id=b.member_id ';
	  $sql.= ' left join zx_student c on b.member_student_code=c.student_code ';
	  $sql.= ' where a.m_t_apply_t_id = '.$member_id;
	  $sql.= ' and a.m_t_apply_state = 0 ';
	  $sql.= ' order by a.m_t_apply_uptime desc,a.m_t_apply_addtime desc ';
	  $result = get_info_by_sql($sql);
	  $this->apply_list = $result;
	  
	 
	  //分组列表
	  $sql = ' select a.m_group_id,a.m_group_name from zx_member_group a ';
	  //$sql.= ' left join (select count(m_belong_s_id) as s_count ,m_belong_g_id from zx_member_belong where m_belong_t_id='.$member_id.' group by m_belong_g_id) b on a.m_group_id=b.m_belong_g_id ';
	  $sql.= ' where a.m_group_t_id = '.$member_id;
	  $sql.= ' order by a.m_group_addtime asc ';
	  $result = get_info_by_sql($sql);
	  
	  //分组op
	  $g_option =  '<option  value="0" >未分组</option>';
	  foreach($result as $key => $value){
	  	  $sql = ' select count(m_belong_s_id) as s_count  from zx_member_belong where m_belong_t_id='.$member_id.' and m_belong_g_id like"%,'.$value['m_group_id'].',%"';
	  	  $result_tm = get_info_by_sql($sql);
	  	  $result[$key]['s_count'] = $result_tm[0]['s_count'];
	  	  $g_option .= '<option  value="'.$value['m_group_id'].'"  >'.$value['m_group_name'].'</option>';
	  }
	  $this->group_list = $result;
	  $this->g_option = $g_option;
	 // $m_option .= '<option  value="'.$value['member_id'].'" '. ($t_id == $video["member_id"] ? " selected" : "") .' >'.$value['member_name'].'</option>';
	  
	  //学生列表
	  $sql = ' select  a.m_belong_id,a.m_belong_s_id,b.member_name,c.student_name  from zx_member_belong a ';
	  $sql.= ' left join zx_member b on a.m_belong_s_id=b.member_id ';
	  $sql.= ' left join zx_student c on b.member_student_code=c.student_code ';
	  //$sql.= ' left join zx_member_group c on a.m_belong_g_id=c.m_group_id ';
	  $sql.= ' where a.m_belong_t_id = '.$member_id;
	  $sql.= ' and a.m_belong_g_id = ",0,"';
	  $result = get_info_by_sql($sql);
	  $this->st_list = $result;
	  //学生数
	  $sql = ' select count(m_belong_id) as count from zx_member_belong ';
	  $sql.= ' where m_belong_t_id = '.$member_id;
	  $result = get_info_by_sql($sql);
	  $count = 0;
	  $count = $result[0]['count'];
	  $this->s_count= $count;
	  //题目质疑
	  $sql = ' select  a.m_exam_q_id,a.m_exam_q_addtime,b.member_name,d.student_name,a.m_exam_q_examid,a.m_exam_q_reply from zx_member_exam_question a ';
	  $sql.= ' left join zx_member b on a.m_exam_q_s_id=b.member_id ';
	  
	  $sql.= ' left join zx_member_belong c on c.m_belong_s_id=a.m_exam_q_s_id ';
	  $sql.= ' left join zx_student d on b.member_student_code=d.student_code ';
	  $sql.= ' where c.m_belong_t_id = '.$member_id;
	  $sql.= ' and a.m_exam_q_t_isdisplay = 0'; 
	  
	  $sql.= ' order by a.m_exam_q_uptime desc,a.m_exam_q_addtime desc ';
	  $result = get_info_by_sql($sql);
	  //print_R($result);
	  
	  $this->exam_q_list = $result;
	  /* $tmp_ar = array();
	  for($i = 0; $i<= 100; $i++){
	  	   $tmp_ar[]=$i;
	  }
	  $this->tmp_list = $tmp_ar;*/
	  
	  //$this->applylistcount = count($result);
	  $this->display('t_profile.html');
}

	