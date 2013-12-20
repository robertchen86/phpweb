<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$sql = ' select a.member_id,a.member_name,a.member_email,a.member_md5code,a.member_status,b.city_name,
a.member_sex,a.member_birthday,a.member_addtime,a.member_school,a.member_identity_type,c.kng_title
 from zx_member a ';
$sql .= ' Left join zx_city b on a.member_city_id = b.city_id ';
$sql .= ' Left join zx_knowledge c on a.member_kng_id = c.kng_id ';
$sql .= ' where a.member_id ='.$_REQUEST['member_id'];
$result=get_info_by_sql($sql);
$sex_array = array('','男','女');
$itype_array = array('学生','老师');
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
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=member_to_manage">会员管理</a></div>
<br>
<ul id="innouni_sub_title">
	<li class="sub">会员信息查看</li>
</ul>
<div id="innouni_right_b">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form method="post" action="./?a=member_to_manage&page=<?=$_REQUEST['page']?>&keyword=<?=$_REQUEST['keyword']?>&search_op=<?=$_REQUEST['search_op']?>&member_identity_type=<?=$_REQUEST['cur_identity_type']?>&member_sex=<?=$_REQUEST['member_sex']?>&member_status=<?=$_REQUEST['member_status']?>&member_city_id=<?=$_REQUEST['member_city_id']?>" >
    <tr class="tdbg">
      <td width="12%" align="center" >昵称：</td>
      <td ><span><?=$result[0]['member_name']?></span></td>
    </tr>
    <tr class="tdbg">
			 <td align="center">账号：</td>
			 <td ><span><?=$result[0]['member_email']?></span></td>
			</tr>
    <tr class="tdbg">
			 <td align="center">性别：</td>
			 <td ><span><?=$sex_array[$result[0]['member_sex']]?></span></td>
		</tr>
		<tr class="tdbg">
			 <td align="center">身份：</td>
			 <td ><span><?=$itype_array[$result[0]['member_identity_type']]?></span></td>
		</tr>
		<?if($result[0]['member_identity_type']==1){?>
		<tr class="tdbg">
			 <td align="center">学科：</td>
			 <td ><span><?=$result[0]['kng_title']?></span></td>
		</tr>
		<?}?>
		<tr class="tdbg">
			 <td align="center">城市：</td>
			 <td ><span><?=$result[0]['city_name']?></span></td>
		</tr>
		<tr class="tdbg">
			 <td align="center">生日：</td>
			 <td ><span><?=$result[0]['member_birthday']?></span></td>
		</tr>
		<tr class="tdbg">
			 <td align="center">学校：</td>
			 <td ><span><?=$result[0]['member_school']?></span></td>
		</tr>
		<tr class="tdbg">
			 <td align="center">注册时间：</td>
			 <td ><span><?=$result[0]['member_addtime']?></span></td>
		</tr>
    
    
    <tr class="tdbg">
	  <td>&nbsp;</td>
      <td><input type="submit" class="bnt" value="返 回"> </td>
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