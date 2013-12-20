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
if($_REQUEST['m_t_apply_t_id']){
	   //print_R($_REQUEST);
   if( (!$_REQUEST['m_t_apply_t_id'])  or (!$_REQUEST['m_t_apply_content']) ){
    $this->err_info = '数据丢失！';
    $this->display('err.html');
    die();
    }
    if(!get_magic_quotes_gpc()) {
        $_REQUEST['m_t_apply_content'] = addslashes($_REQUEST['m_t_apply_content']);
    }
    $inrow = array(
        'm_t_apply_content'=> trim($_REQUEST['m_t_apply_content']),
        //'m_t_apply_s_id'=> $member_id,
        'm_t_apply_t_id'=> $_REQUEST['m_t_apply_t_id'],
        'm_t_apply_addtime'=> date('Y-m-d H:i:s'),
        'm_t_apply_state'=> 0,
        );
    $result =  update_member_t_apply($_REQUEST['aid'],$inrow);
	 if($result == false){
        $this->err_info = '申请修改失败！';
        $this->display('err.html');
        die();
   }
	 echo "<meta http-equiv=refresh content='0; url=".$web_site."/profile/0/".$_COOKIE['_onlinezixishi_']."'>";
    die();

}
/*****/
$sql = ' select a.m_t_apply_id,a.m_t_apply_t_id,b.member_kng_id,a.m_t_apply_content from zx_member_t_apply a ';
	  $sql.= ' left join zx_member b on a.m_t_apply_s_id=b.member_id ';
	   $sql.= ' left join zx_knowledge c on c.kng_id=b.member_kng_id ';
	  $sql.= ' where a.m_t_apply_id = '.$_REQUEST['aid'];
	 // $sql.= ' and a.m_t_apply_state = 0 ';
	  $result = get_info_by_sql($sql);
$cur_kng_id = $result[0]['member_kng_id'];
$m_t_apply_t_id = $result[0]['m_t_apply_t_id'];
$m_t_apply_id = $result[0]['m_t_apply_id'];
$m_t_apply_content = $result[0]['m_t_apply_content'];
$this->m_t_apply_id = $m_t_apply_id;
$this->m_t_apply_content = $m_t_apply_content;
//$cur_kng_id = 0;
    $sql = ' select kng_id,kng_title from zx_knowledge ';
    $sql.= ' where kng_foot_id = 0 ';
    $sql.= ' order by kng_sort <> 0 desc,kng_sort asc ';
    $result_kng = get_info_by_sql($sql);
    $kng_option = '';
    $cur_kng_id = $result_kng[0]['kng_id'];
    foreach( $result_kng as $key => $value){
	      $kng_option .= '<option  value="'.$value['kng_id'].'" '.($cur_kng_id == $value['kng_id'] ? " selected" : "").'>'.$value['kng_title'].'</option>';
    }
    $this->kng_option = $kng_option;
 $sql = ' select member_id,member_name from zx_member ';
$sql.= ' where member_identity_type = 1 ';
$sql.= ' and member_kng_id = '.$cur_kng_id;
$sql.= ' and member_id not in (select m_t_apply_t_id from zx_member_t_apply where m_t_apply_s_id = '.$member_id.' and m_t_apply_id <> '.$_REQUEST['aid'].')';
//$sql.= ' order by kng_sort <> 0 desc,kng_sort asc ';
$result = get_info_by_sql($sql);
$m_option = '';
foreach( $result as $key => $value){
	
	  $m_option .= '<option  value="'.$value['member_id'].'" '.($m_t_apply_t_id == $value['member_id'] ? " selected" : "").' >'.$value['member_name'].'</option>';
}
$this->m_option = $m_option;
 
 /*
 
 
    
$sql = ' select a.m_t_apply_id,a.m_t_apply_s_id,a.m_t_apply_content,b.member_name from zx_member_t_apply a ';
	  $sql.= ' left join zx_member b on a.m_t_apply_s_id=b.member_id ';
	  $sql.= ' where a.m_t_apply_id = '.$_REQUEST['aid'];
	  $sql.= ' and a.m_t_apply_state = 0 ';
	 
	  $result = get_info_by_sql($sql);*/
$this->aid = $_REQUEST['aid'];
//$this->m_s_id = $result[0]['m_t_apply_s_id'];
//$this->member_name = $result[0]['member_name'];
//$this->m_t_apply_content = $result[0]['m_t_apply_content'];
$this->title = '老师申请修改 - '.$web_name;
$this->keywords = '老师申请修改';
$this->description = '老师申请修改';
$this->display('apply_edit.html');
