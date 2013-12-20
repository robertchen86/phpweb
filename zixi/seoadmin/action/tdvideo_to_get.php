<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="js/tdvideo_to_get.js"></script>
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script>
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="/?a=tdvideo_to_manage">视频管理</a>　┊　<a href="/?a=tdvideo_to_get">土豆视频采集</a></div>
<br>
<ul id="innouni_sub_title">
	<li class="sub">土豆视频采集</li>
</ul>
<div id="innouni_right_b">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" id="dotab">
  <form name="doform" id="doform" method="post" action="./?a=tdvideo_get" >
  	
  	<tr class="tdbg">
      <td width="12%" align="center">操作：</td>
      <td >
					<select name="do_type" id="do_type">
						<option value="1">上传视频状态信息更新</option>
						<option value="2">土豆视频信息采集</option>
					</select>&nbsp;&nbsp;
					<input type="button" class="bnt" id="btn_do" value="应 用">
			</td>
    </tr>
    <tr class="tdbg">
  		 <td ></td>
  		 <td >注：1.上传视频状态信息更新:本站上传的视频的状态信息更新 <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.土豆视频信息采集:在土豆上上传的视频信息采集到本站</td>
  	</tr>
    
	</form>
  </table>
  <div id="dodiv" style="display:none;">
     <img src="images/loading.gif"/> 数据采集更新中.....
  <div>
</div>
<!-- zixi.org.cn Baidu tongji analytics -->
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F373a5160f96b2e16d6ffc7ced7340f47' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>