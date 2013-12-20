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
if($_REQUEST['group_ids']){
	   //print_R($_REQUEST);
    if((!$_REQUEST['group_ids'])){
    $this->err_info = '数据丢失！';
    $this->display('err.html');
    die();
    }
    $sql = ' update zx_member_belong  set m_belong_g_id ="'.$_REQUEST['group_ids'].'," ';
    $sql.= ' where m_belong_s_id ='.$_REQUEST['sid'];
    $sql.= ' and m_belong_t_id ='.$member_id;
    $result = up_info_by_sql($sql);
	 if($result == false){
        $this->err_info = '学生分组设置失败！';
        $this->display('err.html');
        die();
   }
	 echo "<meta http-equiv=refresh content='0; url=".$web_site."/profile/1/".$_COOKIE['_onlinezixishi_']."'>";
   die();

}
$sid = $_REQUEST['sid'];
$sql = ' select a.member_id,a.member_name,b.student_code,b.student_name from zx_member a ';
$sql.= ' left join zx_student b on a.member_student_code=b.student_code ';
$sql.= ' where member_id ='.$sid;
$result = get_info_by_sql($sql);
$s_name = $result[0]['member_name'];
if($result[0]['student_name'])$s_name = $result[0]['student_name'];
unset($result);
$sql = ' select m_belong_g_id from zx_member_belong ';
$sql.= ' where m_belong_s_id ='.$sid;
$sql.= ' and m_belong_t_id ='.$member_id;
$result = get_info_by_sql($sql);
$m_belong_g_id =  $result[0]['m_belong_g_id'];
$this->m_belong_g_id =$m_belong_g_id;
$g_id_arr = explode(',', $result[0]['m_belong_g_id']);
//
$sql = ' select m_group_id,m_group_name from zx_member_group ';
$sql.= ' where m_group_t_id ='.$member_id;
$result = get_info_by_sql($sql);
$gid_input = '';
foreach($result as $key => $value){
	$gid_input .= '<input name="gid_'.$value['m_group_id'].'" '.(in_array($value['m_group_id'], $g_id_arr) ? "checked" : "").'  type="checkbox" value="'.$value['m_group_id'].'"  />&nbsp;<label class="field-label" >'.$value['m_group_name'].'</label>&nbsp;&nbsp;';
}
	//$return_string .= "<input name='video_{$video["video_id"]}' " . (in_array($video["video_id"], $select) ? "checked" : "") . " type='checkbox' value='{$video['video_id']}'/>&nbsp;{$video['video_title']} &nbsp;&nbsp;";

$this->gid_input =$gid_input;
$this->s_name =$s_name;
$this->member_id =$member_id ;
$this->sid =$sid ;
$this->title = '学生分组 - '.$web_name;
$this->keywords = '学生分组';
$this->description = '学生分组';
$this->display('student_group_set.html');
