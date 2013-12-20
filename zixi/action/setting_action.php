<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
if (!isset($_COOKIE['_onlinezixishi_'])){
	 echo "<meta http-equiv=refresh content='0; url=".$web_site."/login'>"; 
	 die();
}
$member_birthday = $result_member[0]['member_birthday'];
if($_REQUEST['member_name']){
    //print_R($_REQUEST);
   if( (!$_REQUEST['member_sex'])  or (!$_REQUEST['member_city_id']) ){
    $this->err_info = '数据丢失！';
    $this->display('err.html');
    die();
    }
    //密码是否一致
    if(($_REQUEST['password']) or ($_REQUEST['repassword'])){
        if($_REQUEST['password'] != $_REQUEST['repassword']){
            $this->err_info = '登录密码与确认密码不一致，更新失败！';
            $this->display('err.html');
            die();
        }
    }
    $bday = $_REQUEST['birth'][year].'-'.$_REQUEST['birth'][month].'-'.$_REQUEST['birth'][day];
    if($bday != '--'){
        if(!checkdate ((int)$_REQUEST['birth'][month],(int)$_REQUEST['birth'][day],(int)$_REQUEST['birth'][year])){
            $this->err_info = '更新失败！';
            $this->display('err.html');
            die();
        }
        $member_birthday = $bday;
    }
    /***验证区*e**/
    if(!get_magic_quotes_gpc()) {
        $_REQUEST['member_name'] = addslashes($_REQUEST['member_name']);
        $_REQUEST['member_school'] = addslashes($_REQUEST['member_school']);
    }
    $inrow = array(
                   'member_name'=> trim($_REQUEST['member_name']),
                   'member_city_id'=> trim($_REQUEST['member_city_id']),
                   'member_sex'=> trim($_REQUEST['member_sex']),
                   'member_birthday'=> $bday,
                   'member_school'=> trim($_REQUEST['member_school']),
                   );
                   
    if($_REQUEST['member_kng_id'])
        $inrow['member_kng_id'] = $_REQUEST['member_kng_id'];        
    if($_REQUEST['password'])
        $inrow['member_password'] = md5(trim($_REQUEST['password']));
    $result = update_member_by_code($membercode,$inrow);
    if($result == false){
        $this->err_info = '更新失败！';
        $this->display('err.html');
       
        die();
    }
    $result_member = get_member_by_code($_COOKIE['_onlinezixishi_']);
}
/*****/
//if($_REQUEST['type'])
$this->member_type = $_REQUEST['type'];
if($_REQUEST['type']){
    $sql = ' select kng_id,kng_title from zx_knowledge ';
    $sql.= ' where kng_foot_id = 0 ';
    $sql.= ' order by kng_sort <> 0 desc,kng_sort asc ';
    $result_kng = get_info_by_sql($sql);
    $kng_option = '';
    foreach( $result_kng as $key => $value){
	      $kng_option .= '<option  value="'.$value['kng_id'].'" '.($result_member[0]['member_kng_id'] == $value['kng_id'] ? " selected" : "").'>'.$value['kng_title'].'</option>';
    }
    $this->kng_option = $kng_option;
}
/****/
//$this->member_name = $result_member[0]['member_name'];
$school_list = '';
$school_list .= get_school_list($result_member[0]['member_school_code']);
$school_list .= '<option  value="0000000000000000" >其他</option>';
$this->school_list = $school_list;

$this->member_student_code = $result_member[0]['member_student_code'];

$this->member_name = $result_member[0]['member_name'];
$member_city_id = $result_member[0]['member_city_id'];

$this->member_school = $result_member[0]['member_school'];
$this->member_sex = $result_member[0]['member_sex'];
$this->member_email = $result_member[0]['member_email'];
//$this->member_name = $result_member[0]['member_name'];
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
	  $city_option .= '<option  value="'.$value['city_id'].'" ';
	  if($value['city_id'] == $member_city_id) 
	      $city_option .= ' selected';
	  $city_option .= '>'.$value['city_name'].'</option>';
}
if($city_option != '')$city_option .= '</optgroup>'; 
$this->city_option = $city_option;
$birthday= explode('-', $member_birthday,3);
$year = $birthday[0];
$month = $birthday[1];
$day = $birthday[2];
$month_option = '';
$month_array = array('','1','2','3','4','5','6','7','8','9','10','11','12');
//$month_array = array('','一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月');
foreach( $month_array as $key => $value){
	  if($key== 0){
	      $month_option .= '<option  value="">'.$value.'</option>';
	  }else{
	  	  $month_option .= '<option  value="'.$key.'" ';
	  	  if($key == $month)
	  	      $month_option .= ' selected ';
	  	  $month_option .= '>'.$value.'</option>';
	  }
}
$this->month_option = $month_option;
$year_option = '<option  value=""></option>';
$max = (int)date('Y');
$min = $max - 120;
for ($i=$max; $i >= $min; $i--){
    $year_option .= '<option  value="'.$i.'" ';
	  if($i == $year)
	  	  $year_option .= ' selected ';
	  $year_option .= '>'.$i.'</option>';
}
$this->year_option = $year_option;
$day_option = '<option  value=""></option>';
for ($i=1; $i< 32; $i++){
    $day_option .= '<option  value="'.$i.'" ';
	  if($i == $day)
	  	  $day_option .= ' selected ';
	  $day_option .= '>'.$i.'</option>';
}
$this->day_option = $day_option;
$this->title = '个人信息设置 - '.$web_name;
$this->keywords = '个人信息设置';
$this->description = '个人信息设置';
$this->display('setting.html');
