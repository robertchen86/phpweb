<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
//$sql = 'select account_id,account_name,account_password,account_app_key,account_app_secret,account_access_token,account_access_token_secret ';
//$sql .= 'from zx_account where account_type='.$_REQUEST['type'];
//$result = get_info_by_sql($sql);
$kng_list = '';
$kng_list .= '<option value="0">无</option>';
$kng_list .= get_kng_list(0); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="js/tdvideo_to_up.js"></script>
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script>
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="/?a=tdvideo_to_up">土豆视频上传</a>　┊　<a href="/?a=ykvideo_to_up">优酷视频上传</a></div>
<br>
<ul id="innouni_sub_title">
	<li class="sub">土豆上传视频</li>
</ul>
<div id="innouni_right_b">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form name="upform" id="upform" method="post" action="./?a=tdvideo_up" >
  	<tr class="tdbg">
      <td width="12%" align="center" >视频标题*：</td>
      <td ><input name="video_title" id="video_title" type="text" class="input" size="40" maxlength="150" >&nbsp;&nbsp;<span id='video_title_span'></span></td>
    </tr>
    <tr class="tdbg">
      <td align="center">视频标签*(多个用逗号','分隔)：</td>
      <td><input name="video_tags" id="video_tags" type="text" class="input" size="40" maxlength="150" >&nbsp;&nbsp;<span id='video_tags_span'></span></td>
    </tr>
    <tr class="tdbg">
      <td align="center">类型：</td>
      <td >
					<select name="video_type" id="video_type">
						<option value="1">娱乐</option><option value="3">乐活</option><option value="5">搞笑</option><option value="9">动画</option>
						<option value="10">游戏</option><option value="14">音乐</option><option value="15">体育</option><option value="21">科技</option>
						<option value="22">电影</option><option value="24">财富</option><option value="25" selected >教育</option><option value="26">汽车</option>
						<option value="27">女性</option><option value="29">热点</option><option value="30">电视剧</option><option value="31">综艺</option>
						<option value="32">风尚</option><option value="99">原创</option>
					</select>
			</td>
    </tr>
    <tr class="tdbg">
			 <td align="center">相关知识点：</td>
				<td >
					<select name="video_kng_id" id="video_kng_id"><?=$kng_list?></select>
				</td>
			</tr>
    <tr class="tdbg">
      <td align="center">视频描述：</td>
      <td>
      	<textarea name="video_description" id="video_description" class="ke-textarea" style="height: 80px;width:320px"></textarea>
      </td>
    </tr>
    <tr class="tdbg">
	  <td>&nbsp;</td>
      <td><input type="button" class="bnt" value="下一步"></td>
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