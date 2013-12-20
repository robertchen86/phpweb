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
if($_REQUEST['m_group_name']){
	   //print_R($_REQUEST);
   if( (!$_REQUEST['m_group_name'])){
    $this->err_info = '数据丢失！';
    $this->display('err.html');
    die();
    }
    if(!get_magic_quotes_gpc()) {
        $_REQUEST['m_group_name'] = addslashes($_REQUEST['m_group_name']);
    }
    $cnt = 0;
$sql = ' select count(m_group_id) as cnt from zx_member_group ';
$sql.= ' where m_group_t_id ='.$member_id;
$sql.= ' and m_group_name = "'.trim($_REQUEST['m_group_name']).'"';
$sql.= ' and m_group_id <>'.$_REQUEST['mgid'];
$result = get_info_by_sql($sql);
$cnt = $result[0]['cnt']; 
    if($cnt > 0){
    	  $this->err_info = '该组名已经被使用！';
        $this->display('err.html');
        die();
    }
    $inrow = array(
        'm_group_name'=> trim($_REQUEST['m_group_name']),
        'm_group_uptime'=> date('Y-m-d H:i:s'),
        );
   $result = update_member_group($_REQUEST['mgid'],$inrow);
	 if($result == false){
        $this->err_info = '分组修改失败！';
        $this->display('err.html');
        die();
   }
	 echo "<meta http-equiv=refresh content='0; url=".$web_site."/profile/1/".$_COOKIE['_onlinezixishi_']."'>";
   die();

}
    $cnt = 0;
$sql = ' select m_group_id,m_group_name from zx_member_group ';
$sql.= ' where m_group_id ='.$_REQUEST['mgid'];
//$sql.= ' and m_group_name = "'.trim($_REQUEST['m_group_name']).'"';
$result = get_info_by_sql($sql);
$cnt = $result[0]['cnt']; 
$this->member_id =$member_id ;
$this->m_group_name =$result[0]['m_group_name'] ;
$this->mgid =$_REQUEST['mgid'];
$this->title = '分组修改 - '.$web_name;
$this->keywords = '分组修改';
$this->description = '分组修改';
$this->display('student_group_edit.html');
