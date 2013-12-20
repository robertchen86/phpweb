<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$result = get_video_by_id($_REQUEST['video_id']);
$kng_list = '';
$kng_list .= '<option value="0">无</option>';
$kng_list .= get_kng_list2(0,$result[0]['video_kng_id']); 
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
<div class="innouni_notice"><span>管理操作：</span><a href="/?a=video_to_view&page=<?=$_REQUEST['page']?>&keyword=<?=$_REQUEST['keyword']?>&video_kng_id=<?=$_REQUEST['video_kng_id']?>&video_id=<?=$_REQUEST['video_id']?>">视频查看</a>　┊　<a href="/?a=video_to_manage">视频管理</a></div>
<br>
<ul id="innouni_sub_title">
	<li class="sub">视频信息编辑</li>
</ul>
<div id="innouni_right_b">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form name="edform" id="edform" method="post" action="./?a=video_edit&page=<?=$_REQUEST['page']?>&keyword=<?=$_REQUEST['keyword']?>&video_kng_id=<?=$_REQUEST['video_kng_id']?>&video_id=<?=$_REQUEST['video_id']?>" >
  	<tr class="tdbg">
      <td width="12%" align="center" >视频标题*：</td>
      <td ><input name="video_title" id="video_title" type="text" class="input" size="40" maxlength="150" value="<?=$result[0]['video_title']?>">&nbsp;&nbsp;<span id='video_title_span'></span></td>
    </tr>
    <tr class="tdbg">
      <td align="center">视频标签*(多个用逗号','分隔)：</td>
      <td><input name="video_tags" id="video_tags" type="text" class="input" size="40" maxlength="150" value="<?=$result[0]['video_tags']?>">&nbsp;&nbsp;<span id='video_tags_span'></span></td>
    </tr>
    <!--<tr class="tdbg">
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
    </tr>-->
    <tr class="tdbg">
			 <td align="center">相关知识点：</td>
				<td >
					<select name="kng_id" id="kng_id"><?=$kng_list?></select>
				</td>
			</tr>
		<tr class="tdbg">
      <td width="12%" align="center" >排序：</td>
      <td ><input name="video_sort" id="video_sort" type="text" class="input" value="<?=$result[0]['video_sort']?>" size="10" maxlength="6"  onkeyup="value=value.replace(/[^0-9]/g,&quot;&quot;) " onbeforepaste="clipboardData.setData(&quot;text&quot;,clipboardData.getData(&quot;text&quot;).replace(/[^0-9]/g,&quot;&quot;))"> </td>
    </tr>
		<tr class="tdbg">
      <td align="center">推荐：</td>
      <td >
					<select name="video_isrecommend" id="video_isrecommend">
						<option value="0" <?if($result[0]['video_isrecommend'] == 0){?>selected<?}?> >否</option>
						<option value="1" <?if($result[0]['video_isrecommend'] == 1){?>selected<?}?> >是</option>
					</select>
			</td>
    </tr>
    <tr class="tdbg">
      <td align="center">视频描述：</td>
      <td>
      	<textarea name="video_description" id="video_description" class="ke-textarea" style="height: 80px;width:320px"><?=$result[0]['video_description']?></textarea>
      </td>
    </tr>
    <tr class="tdbg">
	  <td>&nbsp;</td>
      <td><input type="button" class="bnt" value="保  存"></td>
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