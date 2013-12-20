<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
if (!isset($_COOKIE['_onlinezixishi_'])){
	 echo "<meta http-equiv=refresh content='0; url=".$web_site."/login'>"; 
	 die();
}

$this->title = '个人头像设置 - '.$web_name;
$this->keywords = '个人头像设置';
$this->description = '个人头像设置';

//有上传文件时
if (empty($_FILES) === false) {
	  //文件保存目录路径
    $save_path = APP_PATH.'/images/mlogo/';
    //定义允许上传的文件扩展名
    $ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp');
    //最大文件大小
    $max_size = 1000000;
    //原文件名
	  $file_name = $_FILES['avatar']['name'];
	  //服务器上临时文件名
	  $tmp_name = $_FILES['avatar']['tmp_name'];
	  //文件大小
	  $file_size = $_FILES['avatar']['size'];
	  //检查文件名
	  if (!$file_name){
	  	 $this->err='请选择头像图片！';
	     $this->display('avatar.html');
	     die();
	  };
	  //检查目录
	  if (@is_dir($save_path) === false){
	  	 $this->err='上传目录不存在！';
	     $this->display('avatar.html');
	     die();
	  };
	  //检查目录写权限
	  if (@is_writable($save_path) === false){
	  	 $this->err='上传目录没有写权限。';
	     $this->display('avatar.html');
	     die();
	  };
	  //检查是否已上传
	  if (@is_uploaded_file($tmp_name) === false){
	  	 $this->err='临时文件可能不是头像图片。';
	     $this->display('avatar.html');
	     die();
	  };
	  //检查文件大小
	  if ($file_size > $max_size){
	  	 $this->err='头像图片大小超过限制！';
	     $this->display('avatar.html');
	     die();
	  };
	  //获得文件扩展名
	  $temp_arr = explode('.', $file_name);
	  $file_ext = array_pop($temp_arr);
	  $file_ext = trim($file_ext);
	  $file_ext = strtolower($file_ext);
	  //检查扩展名
	  if (in_array($file_ext, $ext_arr) === false){
	  	 $this->err='上传文件不是头像图片。！';
	     $this->display('avatar.html');
	     die();
	  };
	  //新文件名
	  $new_name = $membercode.'.'.$file_ext;
	  //移动文件
	  $file_path = $save_path.$new_name;
	  if (move_uploaded_file($tmp_name, $file_path) === false){
	  	 $this->err='上传头像图片失败！';
	     $this->display('avatar.html');
	     die();
	  };
	  $inrow['member_logo'] = $new_name;
	  
	  $result = update_member_by_code($membercode,$inrow);
	  if ($result === false){
	  	 $this->err='上传头像图片失败！';
	     $this->display('avatar.html');
	     die();
	  };  
	   $this->member_logo = $new_name;          
	  //$this->display('avatar.html');      
	  /*if(!$_REQUEST['web_id']){
	  	  add_web($inrow);
    }else{
    	  update_web($_REQUEST['web_id'],$inrow);
  	}*/
  	///if($_REQUEST['oldlogo'])unlink($save_path.$_REQUEST['oldlogo']);
}

$this->display('avatar.html');