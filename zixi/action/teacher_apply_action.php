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
$member_id = $result_member[0]['member_id'];
if($_REQUEST['kng_id']){
    //print_R($_REQUEST);
   if( (!$_REQUEST['m_t_apply_t_id'])  or (!$_REQUEST['m_t_apply_content']) ){
    $this->err_info = '数据丢失！';
    $this->display('err.html');
    die();
    }
    
    /***验证区*e**/
    if(!get_magic_quotes_gpc()) {
        $_REQUEST['m_t_apply_content'] = addslashes($_REQUEST['m_t_apply_content']);
    }
    $inrow = array(
        'm_t_apply_content'=> trim($_REQUEST['m_t_apply_content']),
        'm_t_apply_s_id'=> $member_id,
        'm_t_apply_t_id'=> $_REQUEST['m_t_apply_t_id'],
        'm_t_apply_addtime'=> date('Y-m-d H:i:s'),
        'm_t_apply_state'=>0,
        );
        
    $result = add_member_t_apply($inrow);
    if($result == false){
        $this->err_info = '申请添加失败！';
        $this->display('err.html');
        die();
    }
    echo "<meta http-equiv=refresh content='0; url=".$web_site."/profile/0/".$_COOKIE['_onlinezixishi_']."'>";
    die();
    //$result_member = get_member_by_code($_COOKIE['_onlinezixishi_']);
}
/*****/
//if($_REQUEST['type'])
//$this->member_type = $_REQUEST['type'];
//if($_REQUEST['type']){
$cur_kng_id = 0;
    $sql = ' select kng_id,kng_title from zx_knowledge ';
    $sql.= ' where kng_foot_id = 0 ';
    $sql.= ' order by kng_sort <> 0 desc,kng_sort asc ';
    $result_kng = get_info_by_sql($sql);
    $kng_option = '';
    $cur_kng_id = $result_kng[0]['kng_id'];
    foreach( $result_kng as $key => $value){
	      $kng_option .= '<option  value="'.$value['kng_id'].'" '.($result_member[0]['member_kng_id'] == $value['kng_id'] ? " selected" : "").'>'.$value['kng_title'].'</option>';
    }
    $this->kng_option = $kng_option;
//}
/****/
$sql = ' select member_id,member_name from zx_member ';

$sql.= ' where member_identity_type = 1 ';
$sql.= ' and member_kng_id = '.$cur_kng_id;
$sql.= ' and member_id not in (select m_t_apply_t_id from zx_member_t_apply where m_t_apply_s_id = '.$member_id.')';
//$sql.= ' order by kng_sort <> 0 desc,kng_sort asc ';
$result = get_info_by_sql($sql);
$m_option = '';
foreach( $result as $key => $value){
	
	  $m_option .= '<option  value="'.$value['member_id'].'" >'.$value['member_name'].'</option>';
}
$this->m_option = $m_option;


$this->title = '学科老师申请 - '.$web_name;
$this->keywords = '学科老师申请';
$this->description = '学科老师申请';
$this->display('t_apply.html');
