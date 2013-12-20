<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$result = get_video_by_id($_REQUEST['video_id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!--<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="js/kng_edit.js"></script>-->
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script> 
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=video_to_trash">视频回收站</a>　┊　<a href="./?a=video_to_manage">视频管理</a></div>
<br>
<ul id="innouni_sub_title">
	<li class="sub">视频查看</li>
</ul>
<div id="innouni_right_b">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form method="post" action="./?a=video_to_manage&page=<?=$_REQUEST['page']?>&keyword=<?=$_REQUEST['keyword']?>&video_kng_id=<?=$_REQUEST['video_kng_id']?>" >
    <tr class="tdbg">
      <td width="12%" align="center" >标题：</td>
      <td ><span><?=$result[0]['video_title']?></span></td>
    </tr>
    <tr class="tdbg">
			 <td align="center">标签：</td>
			 <td ><span><?=$result[0]['video_tags']?></span></td>
			</tr>
    <tr class="tdbg">
			 <td align="center">简介：</td>
			 <td ><span><?=$result[0]['video_description']?></span></td>
			</tr>
    
    <tr class="tdbg">
      <td width="12%" align="center" >
      </td>
      <td >
      	<!--<object width="900" height="450" data="./../files/xtplayer.swf" type="application/x-shockwave-flash">
                     		<param name="allowfullscreen" value="true" /> 
                     		<param name="allowscriptaccess" value="always" /> 
                     		<param name="wmode" value="opaque" /> 
                     		<param name="flashvars" value="iid=<?=$result[0]['video_itemId']?>&amp;hd=1&amp;isAutoPlay=false&amp;" />
        </object>
      	<!--<embed src="<?=$result[0]['video_playerurl']?>" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque" width="380" height="300"></embed> -->
      	 <embed width="900" height="450" src="http://js.tudouui.com/bin/player2/olc_8.swf?iid=<?=$result[0]['video_itemId']?>&amp;swfPath=http://js.tudouui.com/bin/lingtong/SocialPlayer_58.swf&amp;
                     tvcCode=-1&amp;tag=%E6%95%B0%E5%88%97&amp;title=<?=$result[0]['video_title']?>&amp;mediaType=vi&amp;totalTime=725800&amp;
                     hdType=0&amp;hasPassword=0&amp;nWidth=-1&amp;isOriginal=0&amp;channelId=25&amp;nHeight=-1&amp;banPublic=false&amp;videoOwner=118852054&amp;tict=3&amp;
                     channelId=25&amp;cs=&amp;k=%E6%95%B0%E5%88%97&amp;panelRecm=http://css.tudouui.com/bin/lingtong/PanelRecm_9.swz&amp;
                     panelDanmu=http://css.tudouui.com/bin/lingtong/PanelDanmu_1.swz&amp;
                     panelEnd=http://css.tudouui.com/bin/lingtong/PanelEnd_10.swz&amp;pepper=http://css.tudouui.com/bin/binder/pepper_15.png&amp;
                     panelShare=http://css.tudouui.com/bin/lingtong/PanelShare_7.swz&amp;panelCloud=http://css.tudouui.com/bin/lingtong/PanelCloud_8.swz&amp;
                     autoPlay=true&amp;listType=0&amp;rurl=http://www.tudou.com/programs/view/popplayer.action?iid_code=<?=$result[0]['video_itemCode']?>&amp;
                     playTimePos=0&amp;autoPlay=false&amp;withSearchBar=false+type%3D&amp;startSeekPoint=0&amp;videoClickNavigate=false&amp;withAD=false&amp;
                     autostart=false&amp;snap_pic=<?=str_replace("/p.jpg","/w.jpg",$result[0]['video_picurl'])?>&amp;code=<?=$result[0]['video_itemCode']?>&amp;aopRate=0.001&amp;p2pRate=0.5&amp;
                     adSourceId=81000&amp;yjuid=1372229674496z0q&amp;yseid=1383546138939IO95ld&amp;yseidtimeout=1383557027966&amp;yseidcount=12&amp;uid=118852054&amp;juid=017tvk68uvdv3&amp;vip=0" type="application/x-shockwave-flash">
      </td>
    </tr>
    <tr class="tdbg">
	  <td>&nbsp;</td>
      <td><input type="submit" class="bnt" value="返 回"> </td>
    </tr>
	</form>
  </table>
</div>
</body>
</html>