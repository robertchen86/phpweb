<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
if($_REQUEST['kng_id']){
	$sql = ' select member_id,member_name from zx_member ';
    $sql.= ' where member_identity_type = 1 ';
    $sql.= ' and member_kng_id = '.$_REQUEST['kng_id'];
    $sql.= ' and member_id not in (select m_t_apply_t_id from zx_member_t_apply where m_t_apply_s_id = '.$member_id.' ';
    if($_REQUEST['aid'])$sql.= ' and m_t_apply_id <> '.$_REQUEST['aid'];
    $sql.= ' )';
//$sql.= ' order by kng_sort <> 0 desc,kng_sort asc ';
//  echo $sql;
    $result = get_info_by_sql($sql);
    $m_option = '';
    foreach( $result as $key => $value){
	      $m_option .= '<option  value="'.$value['member_id'].'" '. ($t_id == $video["member_id"] ? " selected" : "") .' >'.$value['member_name'].'</option>';
    }
}
echo $m_option;
//echo get_teacher_list_by_kng($_REQUEST['kng_id']);