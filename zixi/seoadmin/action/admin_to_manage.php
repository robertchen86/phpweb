<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if($_REQUEST['act'] = 'del'){
	  del_admin_by_id($_REQUEST['id']);
}
$result = get_all_admin();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script> 
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=admin_to_add">添加帐户</a>　┊　<a href="./?a=admin_to_manage">帐户管理</a></div><br>
<ul id="innouni_sub_title">
	<li class="sub">账户管理</li>
</ul>
<div id="innouni_right_b">
	<form>
	  <table border="0" align="center" cellpadding="3" cellspacing="1" class="table_b">
		<tr>
		  <td width="30" class="title_bg">ID</td>
		  <td class="title_bg">帐户</td>
		  <td class="title_bg">级别</td>
		  <td class="title_bg">添加时间</td>
		  <td class="title_bg">更新时间</td>
		  <!--<td class="title_bg">最后一次IP</td>-->
		  <td class="title_bg">管理</td>
		</tr>
		<?foreach($result as $value){ ?>
		<tr onmouseover=this.bgColor='#EBFFDC'; onmouseout=this.bgColor='#ffffff'; bgcolor='#ffffff'>
			<td align="center"><?=$value['admin_id']?></td>
			<td align="center"><?=$value['admin_name']?></td>
			
			<!--<td align="center"><?=$value["upurview"]? "超级管理员" : "普通管理员"?></td>-->
			<td align="center">普通管理员</td>
			<td align="center"><?=$value['admin_addtime']?></td>
			<td align="center"><?=$value['admin_uptime']?></td>
			<!--<td align="center"><?=$value["ln_lastip"]?></td>-->
			<td align="center"><a href="./?a=admin_to_edit&id=<?=$value['admin_id']?>">编辑</a> <a href="./?a=admin_to_manage&act=del&id=<?=$value['admin_id']?> " onclick="return confirm('确定要删除帐户 <?=$value['admin_name']?>？')">删除</a></td>
		</tr>
		<?}?>
	  </table>
	</form>
</div>
<!-- zixi.org.cn Baidu tongji analytics -->
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F373a5160f96b2e16d6ffc7ced7340f47' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>
