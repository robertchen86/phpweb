<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$sql = ' select city_id,city_name,city_first_letter2,city_ping from zx_city ';
$sql.= ' where city_foot_id <> 0';
$sql.= ' and (city_first_letter2 like "'.$_REQUEST['keyvalue'].'%"';
$sql.= ' or city_ping like "'.$_REQUEST['keyvalue'].'%")';
//$sql.= ' order by a.product_id asc ';
$sql.= ' limit 0,50';
$result = get_info_by_sql($sql);
$tmp_str = '';
$tmp_one = '';
foreach ($result as $key => $value){
	 $tmp_one = "{name:'".$value['city_name']."',id:'".$value['city_id']."',letter:'".$value['city_first_letter2']."',ping:'".$value['city_ping']."'}";
	 $tmp_str .= ",".$tmp_one;
}
echo "[",substr($tmp_str,1),"]";