<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
//有上传文件时
if (empty($_FILES) === false) {
	  //文件保存目录路径
    $save_path = APP_PATH.'/images/';
    //定义允许上传的文件扩展名
    $ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp');
    //最大文件大小
    $max_size = 1000000;
    //原文件名
	  $file_name = $_FILES['web_logo']['name'];
	  //服务器上临时文件名
	  $tmp_name = $_FILES['web_logo']['tmp_name'];
	  //文件大小
	  $file_size = $_FILES['web_logo']['size'];
	  //检查文件名
	  if (!$file_name)alert('请选择文件。');
	  //检查目录
	  if (@is_dir($save_path) === false)alert('上传目录不存在。');
	  //检查目录写权限
	  if (@is_writable($save_path) === false)alert('上传目录没有写权限。');
	  //检查是否已上传
	  if (@is_uploaded_file($tmp_name) === false)alert('临时文件可能不是上传文件。');
	  //检查文件大小
	  if ($file_size > $max_size) alert('上传文件大小超过限制。');
	  //获得文件扩展名
	  $temp_arr = explode('.', $file_name);
	  $file_ext = array_pop($temp_arr);
	  $file_ext = trim($file_ext);
	  $file_ext = strtolower($file_ext);
	  //检查扩展名
	  if (in_array($file_ext, $ext_arr) === false)alert('上传文件扩展名是不允许的扩展名。');
	  //新文件名
	  $new_name = md5(date("YmdHis")).'.'.$file_ext;
	  //移动文件
	  $file_path = $save_path.$new_name;
	  if (move_uploaded_file($tmp_name, $file_path) === false)alert('上传文件失败。');
	  $inrow['web_logo'] = $new_name;
	  if(!$_REQUEST['web_id']){
	  	  add_web($inrow);
    }else{
    	  update_web($_REQUEST['web_id'],$inrow);
  	}
  	if($_REQUEST['oldlogo'])unlink($save_path.$_REQUEST['oldlogo']);
}
$sql = 'select web_id,web_logo,web_site from zx_web ';
$result = get_info_by_sql($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!--<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="js/weblogo_set.js"></script>-->
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script>
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=weblogo_to_set&type=1">网站logo设置</a></div>
<br>
<ul id="innouni_sub_title">
	<li class="sub">网站logo设置</li>
</ul>
<div id="innouni_right_b">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form  method="post" action="./?a=weblogo_to_set" enctype="multipart/form-data">
  	<tr>
      <td width="12%" align="right" class="tdbg">上传LOGO图片(389*49)：<input name="web_id" id="web_id" type="hidden" value="<?=$result[0]['web_id'] ?>">
      </td>
      <td class="tdbg">
      	<input type="file" name="web_logo" id="web_logo">
      </td>
    </tr>
    <tr>
    	<td>&nbsp;</td>
       <td >
            <a href="<?=$result[0]['web_site'] ?>"><img alt="index_05" src="../images/<?=$result[0]['web_logo'] ?>" ></a>
           <input type="hidden" name="oldlogo" id="oldlogo" value="<?=$result[0]['web_logo'] ?>">
       </td>
    </tr>
    <tr class="tdbg">
	  <td>&nbsp;</td>
      <td><input type="submit" class="bnt" value="保 存"> </td>
    </tr>
	</form>
  </table>
</div>
<!-- zixi.org.cn Baidu tongji analytics -->
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F373a5160f96b2e16d6ffc7ced7340f47' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>