<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/

$kng_list = '';
$kng_list .= get_kng_list_by_ajax();
if($_REQUEST['act'] == 'dl'){
	  $web_info = get_web();
    $web_url = $web_info[0]['web_site'];
	  $files_path = APP_PATH.'/files';
	  $doc_path =  APP_PATH.'/files/doc_tmp';
	  //rename($doc_path.'/20130812160435561587001376294675.files',$files_path.'/20130812160435561587001376294675');
	  
	  //echo $do_url;
    //htm2db($do_url,3);
	 // 	  unlink($doc_path.'/20130812160435561587001376294675.htm');
	  
	  //chmod($doc_path, 777);
	  
	  $dp = dir($doc_path);
	  while($file=$dp->read()){
	  	  $file = iconv('GB2312', 'UTF-8', $file);
	  	  if($file =='.')continue;
	  	  if($file =='..')continue;
	  	  $tmp=substr($file,-4,4);
	  	  if($tmp != '.doc')continue;
	  	  $docpath = $doc_path.'/'.$file;
	  	  $newname = date('YmdHis').str_replace(' ', '', substr(microtime(),2));
	  	  $hmlpath = $doc_path.'/'.$newname;
	  	  //if($files_path.'/'.$newname)
	  	  doc2htm($docpath,$hmlpath);
	  	  rename($doc_path.'/'.$newname.'.files',$files_path.'/'.$newname);
        //导入
        //$do_url = $web_url.'/files/doc_temp/'.$newname.'.htm';
        $do_url = $doc_path.'/'.$newname.'.htm';
        htm2db($do_url,$_REQUEST['kng_id']);
	  	  unlink($do_url);
	  }
	  echo "<script>alert('试题导入结束！');</script>";
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
	<li class="sub">试题自动导入</li>
	
</ul>
<div id="innouni_right_b">
	<form name="addform" id="addform" method="post" action="./?a=exam_to_in_byself_ttt&act=dl" >
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
    
		<tr class="tdbg">
	  <td colspan="2">点击开始按钮将自动从files\doc_tmp文件夹下所有doc文件中的试题导入数据库中!
      </td>
    </tr>
    <tr class="tdbg">
		 	<td width="12%" align="center">关联知识点：</td>
			<td >
				<select name="kng_id" id="kng_id"><?=$kng_list?></select>&nbsp;&nbsp;<br/>
				
			</td>
		</tr>
    <tr class="tdbg">
    	<td></td>
	  <td>
      <input type="submit" class="bnt" value="开 始"> </td>
    </tr>
	
  </table>
  </form>
</div>
</body>
</html>