<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/



$kng_list = '';
//$kng_list .= '<option value="0">请选择知识点</option>';
$kng_list .= get_kng_list_by_ajax();
$web_info = get_web();
$web_url = $web_info[0]['web_site'];
//$video_list = '<option value="0">请选择视频</option>';
//set_time_limit(0);
//print_R();
//有上传文件时
if(isset($_REQUEST['kng_id'])){
	  //$p_string = '<p class=MsoNormal><span lang=EN-US><o:p>&nbsp;</o:p></span></p>';
	  //$p_string =strip_tags($p_string,'');
	 // echo $p_string;
	  //$p_string = '<p class=MsoNormal><span lang=EN-US style=\'font-family:"Times New Roman","serif"\'>C<o:p></o:p></span></p>';
	 // $p_string =strip_tags($p_string,'');
	 // echo $p_string;
	 // die();
    //if (empty($_FILES) === false) {
	  
	  //文件保存目录路径
    $save_path = APP_PATH.'/files/';
    //定义允许上传的文件扩展名
    $ext_arr = array('doc', 'docx','html','htm');
    //原文件名
	  $file_name = $_FILES['infile']['name'];
	  //服务器上临时文件名
	  $tmp_name = $_FILES['infile']['tmp_name'];
	  //检查文件名
	  if (!$file_name)alert('请选择文件。');
	  //检查目录
	  if (@is_dir($save_path) === false)alert('上传目录不存在。');
	  if (@is_dir($save_path.$_REQUEST['map_filename']) === false)mkdir($save_path.$_REQUEST['map_filename']);
	  //检查目录写权限
	  if (@is_writable($save_path) === false)alert('上传目录没有写权限。');
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
    //$do_url = 'http://192.168.1.100/zixi_org_cn/files/'.$new_name;
	  $do_url = $web_url.'/files/'.$new_name;
	  //echo  $do_url;
	  if (move_uploaded_file($tmp_name, $file_path) === false)alert('上传文件失败。');
	  //$do_url = $web_url.'/files/eac084b0afad577d2232962f828af5bc.htm';
	 /* $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $do_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);//设置HTTP头
    curl_setopt($ch, CURLOPT_POST, 1);
    //curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);//POST数据
   echo  curl_exec($ch);
    $return_str = mb_convert_encoding (curl_exec($ch),'UTF-8','gbk');
    curl_close($ch);*/
     $return_str = mb_convert_encoding (file_get_contents($do_url),'UTF-8','gbk');
   //echo ;
    
    //echo $return_str;die();
    //$return_str = cut($return_str ,"<div class=WordSection1 style='layout-grid:15.6pt'>","</div>",false,false);
    $return_str = cut($return_str ,"<div class=Section1 style='layout-grid:15.6pt'>","</div>",false,false);
	  $return_str =strip_tags($return_str,'<img><span><p>');
	  $old_map_adress =cut($return_str ,'src="','_files/',false,ture);
	  $return_str = str_replace($old_map_adress,$_REQUEST['map_filename'].'/',$return_str );
	  $tmp_str = '';
	  $shiti_array = array();
	  $daan_array = array();
	  $is_as = false;
	  while (trim($return_str) != ''){
	  	  $get_tmp_p = cut($return_str ,"<p ","</p>",true,true);
	  	  $return_str =substr($return_str, strlen($get_tmp_p));
        //statement
        //判断是否标题  = 选择题
        if(isOption($get_tmp_p))continue;
        //判断是否到了 取答案的
        if(isAnswer($get_tmp_p))break;
        //判断是否 &nbsp;isSpace
        if(isSpace($get_tmp_p)){
        	  if($tmp_str !=''){
        	  	  $shiti_array[] = $tmp_str;
        	  	  $tmp_str = '';
        	  }
        	  continue;
        }
        //判断 是分割线 = 我是分割线
        if(isDividingLine($get_tmp_p)){
        	  if($tmp_str !=''){
        	  	  $shiti_array[] = $tmp_str;
        	  	  $tmp_str = '';
        	  }
        	  continue;
        }
        $tmp_str .= $get_tmp_p;
    }
    $return_str = strip_tags($return_str,'');
    $temp_arr2 = explode('我是分割线', $return_str);
    //print_R($temp_arr2);
    foreach($temp_arr2 as $key => $value){
    	  if(isRightAnswer($value))$daan_array[] = trim($value);
    }
    $sql = ' INSERT INTO `zx_exam` (`exam_true` ,`exam_title`, `exam_kng_id`) VALUES ';
    $temp_sql = '';
    //print_R($shiti_array);
    foreach($shiti_array as $key => $value){
    	  if($temp_sql != '')$temp_sql .= ',';
    	  $ins_value = str_replace('"','\"',$value );
    	  $ins_value = str_replace("'","\'",$ins_value );
    	  $temp_sql .= '("'.$daan_array[$key].'","'.$ins_value.'",'.$_REQUEST['kng_id'].')';
    }
    if($temp_sql != ''){
    	  $sql.= $temp_sql.';';
    	  //echo $sql;
    	  $result = up_info_by_sql($sql);
    	  if($result === false){
    	  	  echo "<script>alert('试题导入失败！');</script>";
    	  }else{
    	  	  echo "<script>alert('试题导入成功！');</script>";
    		}
    }
    unlink($file_path);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="js/exam_in.js"></script>
<script language="javascript" src="kindeditor/kindeditor.js"></script>
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
		KE.show({id:'exam_title'});
</script> 
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=exam_to_add">添加试题</a>　┊　<a href="./?a=exam_to_manage2">试题管理</a></div>
<br>
<ul id="innouni_sub_title">
	<li class="sub">试题导入</li>
	
</ul>
<div id="innouni_right_b">
	<form name="addform" id="addform" method="post" action="./?a=exam_to_in" enctype="multipart/form-data" >
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  

    <tr class="tdbg">
		 	<td width="12%" align="center">关联知识点：</td>
			<td >
				<select name="kng_id" id="kng_id"><?=$kng_list?></select>&nbsp;&nbsp;<br/>
				<!--关联视频：<br/>
				<input type="hidden" name="video_ids" id="video_ids"/>
				<table id="video_list_show">
					<tr>
						<td><?=$video_list?></td>
					</tr>
				</table>-->
			</td>
		</tr>
		<tr class="tdbg">
		 	<td width="12%" align="center">图片存放文件夹名：</td>
			<td >
				<input type="text" name="map_filename" id="map_filename" />
			</td>
		</tr>
		<tr class="tdbg">
		 	<td width="12%" align="center">html导入文件：</td>
			<td >
				<input type="file" name="infile" id="infile" />
			</td>
		</tr>

    <tr class="tdbg">
	  <td>&nbsp;</td>
      <td><input type="button" class="bnt" value="保 存"> </td>
    </tr>
	
  </table>
  </form>
</div>
</body>
</html>