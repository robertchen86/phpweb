<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
if (!isset($_COOKIE['_onlinezixishi_'])){
	 echo "<meta http-equiv=refresh content='0; url=".$web_site."/login'>"; 
	 die();
}
//
//$member_id = $result_member[0]['member_id'];
if($_REQUEST['state_v']){
	 $row['m_t_apply_state'] = $_REQUEST['state_v'];
	 $result =  update_member_t_apply($_REQUEST['aid'],$row);
	 if($result == false){
        $this->err_info = '申请审核失败！';
        $this->display('err.html');
        die();
   }
	 
	 if($_REQUEST['state_v'] == 2){
	 	   $inrow =  array(
        'm_belong_s_id'=> $_REQUEST['m_s_id'],
        'm_belong_t_id'=> $member_id,
        'm_belong_addtime'=> date('Y-m-d H:i:s'),
         'm_belong_g_id'=> ',0,',
        );
        $result = add_member_belong($inrow);
        if($result == false){
        	   $row['m_t_apply_state'] = 0;
	           update_member_t_apply($_REQUEST['aid'],$row);
             $this->err_info = '申请审核失败！';
            $this->display('err.html');
            die();
        }
	 }
	
    echo "<meta http-equiv=refresh content='0; url=".$web_site."/profile/1/".$_COOKIE['_onlinezixishi_']."'>";
    die();
    
}
/*****/
$sql = ' select a.m_t_apply_id,a.m_t_apply_s_id,a.m_t_apply_content,b.member_name,c.student_code,c.student_name from zx_member_t_apply a ';
	  $sql.= ' left join zx_member b on a.m_t_apply_s_id=b.member_id ';
	  $sql.= ' left join zx_student c on b.member_student_code=c.student_code ';
	  $sql.= ' where a.m_t_apply_id = '.$_REQUEST['aid'];
	  $sql.= ' and a.m_t_apply_state = 0 ';
	 
	  $result = get_info_by_sql($sql);
	  //echo $sql;
	  //print_R($result);
$this->aid = $_REQUEST['aid'];
$this->m_s_id = $result[0]['m_t_apply_s_id'];
$this->member_name = $result[0]['member_name'];
$this->student_code = $result[0]['student_code'];
$this->student_name = $result[0]['student_name'];
$this->m_t_apply_content = $result[0]['m_t_apply_content'];
$this->title = '老师申请审核 - '.$web_name;
$this->keywords = '老师申请审核';
$this->description = '老师申请审核';
$this->display('apply_check.html');
