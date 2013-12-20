<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
//echo $_SESSION['inni_ac_code_'.changeString1To(trim($_REQUEST['memail']))];
//print_R($_SESSION);
//die();
/*if(!$_SESSION['inni_ac_code_'.changeString1To(trim($_REQUEST['memail']))]){
    $this->err_info = '注册链接已过期失效！';
    $this->display('err.html');
    die();
}
if((!$_REQUEST['mname'])  or (!$_REQUEST['memail']) or (!$_REQUEST['ac']) ){
    $this->err_info = '注册数据丢失！';
    $this->display('err.html');
    die();
}
if(md5(trim($_REQUEST['memail'])) != $_REQUEST['ac']){
	  $this->err_info = '注册链接已失效！';
    $this->display('err.html');
	  die();
}
$cnt = 0;
$sql = ' select count(*) as cnt from zx_tmp_r ';
$sql.= ' where tmp_r_email = "'.trim($_REQUEST['memail']).'"';
$result = get_info_by_sql($sql);
$cnt = $result[0]['cnt'];
if(0 ==  $cnt){
    $this->err_info = '注册链接已失效！';
    $this->display('err.html');
	  die();
}
$cnt = 0;
$sql = ' select count(*) as cnt from zx_member ';
$sql.= ' where member_email = "'.trim($_REQUEST['memail']).'"';
$result = get_info_by_sql($sql);
$cnt = $result[0]['cnt'];
if(0 !=  $cnt){
    $this->err_info = '该邮箱（'.$_REQUEST['memail'].'）已被注册！';
    $this->display('err.html');
	  die();
}

$this->member_email = $_REQUEST['memail'];
$this->member_name = $_REQUEST['mname'];
*/
$this->member_email = $_REQUEST['email'];
$this->member_name = $_REQUEST['username'];
$this->uid = $_REQUEST['uid'];
//echo  $_REQUEST['uid'];
$sql = ' select city_id,city_name,city_foot_id from zx_city ';
$sql.= ' where city_id <> 0';
$result = get_info_by_sql($sql);
$city_option = '';
foreach( $result as $key => $value){
	  if($value['city_foot_id'] == 0){
	  	  if($key != 0)$city_option .= '</optgroup>'; 
	  	  $city_option .= '<optgroup label="'.$value['city_name'].'">';
	  	  continue;
	  }
	  $city_option .= '<option  value="'.$value['city_id'].'" ' . ($value['city_id'] == 388 ? "selected" : "") . '>'.$value['city_name'].'</option>';
}
if($city_option != '')$city_option .= '</optgroup>'; 
$this->city_option = $city_option;
/**/
$sql = ' select kng_id,kng_title from zx_knowledge ';
$sql.= ' where kng_foot_id = 0 ';
$sql.= ' order by kng_sort <> 0 desc,kng_sort asc ';
$result_kng = get_info_by_sql($sql);
$kng_option = '';
foreach( $result_kng as $key => $value){
	  $kng_option .= '<option  value="'.$value['kng_id'].'" >'.$value['kng_title'].'</option>';
}
$this->kng_option = $kng_option;


/**/
$month_option = '';
$month_array = array('','1','2','3','4','5','6','7','8','9','10','11','12');
//$month_array = array('','一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月');
foreach( $month_array as $key => $value){
	  if($key== 0){
	      $month_option .= '<option  value="">'.$value.'</option>';
	  }else{
	  	  $month_option .= '<option  value="'.$key.'" ';
	  	  $month_option .= '>'.$value.'</option>';
	  }
}
$this->month_option = $month_option;
$year_option = '<option  value=""></option>';
$max = (int)date('Y');
$min = $max - 120;
for ($i=$max; $i >= $min; $i--){
    $year_option .= '<option  value="'.$i.'" ';
	  $year_option .= '>'.$i.'</option>';
}
$this->year_option = $year_option;
$day_option = '<option  value=""></option>';
for ($i=1; $i< 32; $i++){
    $day_option .= '<option  value="'.$i.'" ';
	  $day_option .= '>'.$i.'</option>';
}


$this->day_option = $day_option;
$this->title = '会员注册 - '.$web_name;
$this->keywords = '会员注册';
$this->description = '会员注册';
$this->display('signup3.html');