<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
//if($_REQUEST['g_option']){
    $sql = ' select m_group_id,m_group_name from zx_member_group ';
    $sql.= ' where m_group_id = '.$_REQUEST['g_option'];
    $result = get_info_by_sql($sql);
    $m_group_name = $result[0]['m_group_name'];
    
	  $sql = ' select a.m_belong_id,a.m_belong_s_id,b.member_name,c.student_code,c.student_name  from zx_member_belong a ';
	  $sql.= ' left join zx_member b on a.m_belong_s_id=b.member_id ';
	  $sql.= ' left join zx_student c on b.member_student_code=c.student_code ';
	  //$sql.= ' left join zx_member_group c on a.m_belong_g_id=c.m_group_id ';
	  $sql.= ' where a.m_belong_t_id = '.$member_id;
	  $sql.= ' and a.m_belong_g_id like "%,'.$_REQUEST['g_option'].',%"';
	  //echo $sql;
	  $result = get_info_by_sql($sql);
	  $re_string = '';
	  foreach( $result as $key => $value){
	  	  $re_string .= '<tr class="tdbg"> <td width="5px"></td><td >'.($key+1).'</td>';
	  	  if($value['student_name']){
	  	  	$re_string .= '<td>'.$value['student_name'].'</td>';
	  	  }else{
	  	  	$re_string .= '<td>'.$value['member_name'].'</td>';
	  	  }
	  	 // $re_string .= '<td>'.$value['member_name'].'</td>';
	  	  $re_string .= '<td>'.$m_group_name.'</td>';
	  	  $re_string .= '<td align="center">';
	  	  $re_string .= ' &nbsp;<a class="foreground-link" href="'.$web_site.'/student_test_view/'.$value['m_belong_s_id'].'" >';
	  	  $re_string .= ' <span class="simple-button">查看</span></a>';
	  	  $re_string .= ' &nbsp;<a class="foreground-link" href="'.$web_site.'/student_group_set/'.$value['m_belong_s_id'].'" >';
	  	  $re_string .= ' <span class="simple-button">分组</span></a>';
	  	  $re_string .= ' &nbsp;<a class="foreground-link" href="'.$web_site.'/student_del/'.$value['m_belong_s_id'].'"  onclick="return confirm(\'确定要删除该学生（'.$value['member_name'].'）？\');">';
	  	  $re_string .= ' <span class="simple-button">删除</span></a>';
	  	  
	  	  $re_string .= '</td>';
	  	  $re_string .= '<td width="5px"></td></tr>';
	  }
	  echo  $re_string;
//}