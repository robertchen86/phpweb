<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
/*$result = get_video_by_id($_REQUEST['video_id']);
$kng_list = '';
$kng_list .= '<option value="0">无</option>';
$kng_list .= get_kng_list(0,$result[0]['video_kng_id']); */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="js/video_to_edit.js"></script>
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script>
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="/?a=data_to_out">数据导出</a></div>
<br>
<ul id="innouni_sub_title">
	<li class="sub">数据导出</li>
</ul>
<div id="innouni_right_b">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form name="edform" id="edform" method="post" action="./?a=data_out" >
  	<tr class="tdbg">
      <td width="12%" align="center">数据：</td>
      <td >
					<select name="out_db" id="out_db">
						<option value="zx_knowledge">知识点信息</option>
						<option value="zx_video">视频信息</option>
						<option value="zx_member">会员信息</option>
						<option value="zx_video_log">视频记录</option>
						<option value="zx_video_comment">视频留言</option>
					</select>
			</td>
    </tr>

    <tr class="tdbg">
	  <td>&nbsp;</td>
      <td><input type="submit" class="bnt" value="导   出"></td>
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