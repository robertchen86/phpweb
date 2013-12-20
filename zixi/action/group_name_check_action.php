<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';


$cnt = 0;
$sql = ' select count(m_group_id) as cnt from zx_member_group ';
$sql.= ' where m_group_t_id ='.$_REQUEST['member_id'];
$sql.= ' and m_group_name = "'.trim($_REQUEST['m_group_name']).'"';
if($_REQUEST['mgid'])
     $sql.= ' and m_group_id <>'.$_REQUEST['mgid'];
$result = get_info_by_sql($sql);
$cnt = $result[0]['cnt']; 
echo $cnt; 