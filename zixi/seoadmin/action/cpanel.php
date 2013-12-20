<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if(!$_SESSION['inni_zixishi_userid']){echo "<meta http-equiv=refresh content='0; url=./'>";
	die();
};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>自习室后台管理系统</title>
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="js/common.js"></script>
</head>
<body>
	<div id="head">
		<div class="left"><img src="images/innouni_logo.gif" alt="自习室后台管理系统"/></div>
		<div class="left head_txt">您好：<?=$_SESSION["inni_zixishi_user"]?>[ <a href="./?a=myadmin_to_edit" target="ifmain">我的帐户</a> <span><a href="./?a=loginout">退出</a></span> ]</div>
		<div class="right head_menu">
		  <ul id="head_menu">
		  	<li><a href="../" target="_blank">网站前台</a></li>  
			  <li><a href="http://www.innouni.com" target="_blank">售后服务中心</a></li>
		  </ul>
		</div>
	</div>
	<!--head is over-->
	<!--导航-->	
	<!--<div id="content">-->
		<div id="left">
			<div class="left_title"><a onclick="subMenuShow(1);" style="CURSOR:pointer;">系统首页</a></div>
			<ul id="submenu_1" class="dis">
				<?if($_SESSION['inni_zixishi_userid'] == 1){?>
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=admin_to_add" target="ifmain">添加帐户</a></li>
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=admin_to_manage" target="ifmain">帐户管理</a></li>
				<?}?>
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=myadmin_to_edit" target="ifmain">个人设置</a></li>
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=account_to_set&type=1" target="ifmain">土豆账号</a></li>
				<!-- <li class="left_link" onClick="doLocation(this)"><a href="./?a=account_to_set&type=2" target="ifmain">优酷账号</a></li> -->
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=loginout" >退出登录</a></li>
			</ul>
			  
			<div class="left_title"><a onclick="subMenuShow(2)" style="CURSOR:pointer;">知识点管理</a></div>
			<ul id="submenu_2" class="dis">
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=kng_to_add" target="ifmain">添加知识点</a></li>
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=kng_to_manage" target="ifmain">知识点管理</a></li>
		  </ul>
			<div class="left_title"><a onclick="subMenuShow(3)" style="CURSOR:pointer;">视频管理</a></div>
			<ul id="submenu_3" class="dis">
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=tdvideo_to_up" target="ifmain">土豆上传</a></li>
				<!-- <li class="left_link" onClick="doLocation(this)"><a href="./?a=ykvideo_to_up" target="ifmain">优酷上传</a></li>-->
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=video_to_manage" target="ifmain">视频管理</a></li>
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=tdvideo_to_get" target="ifmain">土豆视频采集</a></li>
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=video_to_trash" target="ifmain">视频回收站</a></li>
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=vcomment_to_manage" target="ifmain">留言管理</a></li>
			</ul>
			<div class="left_title"><a onclick="subMenuShow(4)" style="CURSOR:pointer;">会员管理</a></div>
			<ul id="submenu_4" class="dis">
			   <li class="left_link" onClick="doLocation(this)"><a href="./?a=school_to_manage" target="ifmain">学校管理</a></li>
			   <li class="left_link" onClick="doLocation(this)"><a href="./?a=student_to_manage" target="ifmain">学生名册管理</a></li>
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=member_to_manage" target="ifmain">会员管理</a></li>
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=vlog_to_manage" target="ifmain">视频记录管理</a></li>
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=examlog_to_manage" target="ifmain">试题记录管理</a></li>
			</ul>
			<div class="left_title"><a onclick="subMenuShow(5)" style="CURSOR:pointer;">试题管理</a></div>
			<ul id="submenu_5" class="dis">
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=exam_to_add" target="ifmain">添加试题</a></li>
				<!--<li class="left_link" onClick="doLocation(this)"><a href="./?a=exam_to_manage" target="ifmain">试题管理</a></li>-->
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=exam_to_manage2" target="ifmain">试题管理</a></li>
				
			</ul>
			<div class="left_title"><a onclick="subMenuShow(6)" style="CURSOR:pointer;">系统设置</a></div>
			<ul id="submenu_6" class="dis">
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=weblogo_to_set" target="ifmain">网站Logo设置</a></li>
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=webinfo_to_set" target="ifmain">网站信息设置</a></li>
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=exam_to_set" target="ifmain">试题设置</a></li>
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=tos_to_set" target="ifmain">服务协议设置</a></li>	
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=privacy_policy_to_set" target="ifmain">隐私权政策设置</a></li>	
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=sendemail_to_set" target="ifmain">发送邮箱设置</a></li>
				<li class="left_link" onClick="doLocation(this)"><a href="./?a=data_to_out" target="ifmain">数据导出</a></li>
				<!--<li class="left_link" onClick="doLocation(this)"><a href="<?=spUrl("main" , "tags_add")?>" target="main">添加标签</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?=spUrl("main" , "tags")?>" target="main">管理</a></li>
				-->
			</ul>
		</div>
		<div id="right">
			<iframe id="ifmain_r" name="ifmain" width="100%" onload="this.height=ifmain.document.body.scrollHeight" frameborder="0" src="./?a=kng_to_manage"></iframe>
		</div>
	<!--</div>
	-->

</body>
</html>