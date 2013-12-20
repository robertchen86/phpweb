<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$school_list = '';
$school_list .= get_school_list('');
/***/
/*if($_GET['act'] and ($_GET['act'] == 'trash')){
	  if($_GET['video_id']){
	 	    $inrow['video_isdel'] = 1;
	  	  $inrow['video_uptime'] = date('Y-m-d H:i:s');
	 	    update_video($_GET['video_id'],$inrow);
	  }
}
if($_POST['act'] and ($_POST['act'] == 'trash') and $_POST['check_select']){
	  $keys =  explode(',',$_POST['check_select']);
	  foreach ($keys as $key => $value){
	  	  if($value == '')
	  	      continue;
	 	    $inrow['video_isdel'] = 1;
	  	  $inrow['video_uptime'] = date('Y-m-d H:i:s');
	 	    update_video($_POST[$value.'_sort_id'],$inrow);
	  }
}
if($_POST['act'] and ($_POST['act'] == 'sortup') and $_POST['check_select']){
	  $keys =  explode(',',$_POST['check_select']);
	  foreach ($keys as $key => $value){
	  	  if($value == '')
	  	      continue;
	  	  if(trim($_POST[$value.'_sort']) == '')
	  	      continue;
	  	  $inrow['video_sort'] = (int)$_POST[$value.'_sort'];
	  	  $inrow['video_uptime'] = date('Y-m-d H:i:s');
	 	    update_video($_POST[$value.'_sort_id'],$inrow);
	  }
}
if($_POST['act'] and ($_POST['act'] == 'kng_change') and $_POST['check_select']){
	  $keys =  explode(',',$_POST['check_select']);
	  foreach ($keys as $key => $value){
	  	  if($value == '')
	  	      continue;
	  	  if($_POST[$value.'_old_kng_id'] == $_POST['to_kng'])
	  	      continue;
	  	  $inrow['video_kng_id'] = (int)$_POST['to_kng'];
	  	  $inrow['video_uptime'] = date('Y-m-d H:i:s');
	 	    update_video($_POST[$value.'_sort_id'],$inrow);
	  }
}*/
if($_GET['act'] and ($_GET['act'] == 'del')){
	  if($_GET['member_id']){
	 	    del_member_by_id($_GET['member_id'],$inrow);
	  }
}
if($_POST['act'] and ($_POST['act'] == 'del') and $_POST['check_select']){
	  $keys =  explode(',',$_POST['check_select']);
	  foreach ($keys as $key => $value){
	  	  if($value == '')
	  	      continue;
	 	    del_member_by_id($_POST[$value.'_id']);
	  }
}
if($_POST['act'] and ($_POST['act'] == 'set_exam_p') and $_POST['check_select']){
	  $keys =  explode(',',$_POST['check_select']);
	  foreach ($keys as $key => $value){
	  	  if($value == '')
	  	      continue;
	  	  $uprow['member_exam_vlink'] = 1;
	  	  $uprow['member_uptime'] = date('Y-m-d H:i:s');
	 	    update_member_by_id($_POST[$value.'_id'],$uprow);
	  }
}




/***/
$percount = 10;
$curpage = 1;
$cur_sex = '';
$cur_state = '';
$cur_city_id = '';
$cur_identity_type = '';
$cur_school_code = '';
$keyword = $_REQUEST['keyword']; 
if(isset($_REQUEST['page'])){
    $curpage = $_GET['page'];
}
if(isset($_REQUEST['member_sex']) and ($_REQUEST['member_sex'] != ''))
    $cur_sex = $_REQUEST['member_sex'];
if(isset($_REQUEST['member_identity_type']) and ($_REQUEST['member_identity_type'] != ''))
    $cur_identity_type = $_REQUEST['member_identity_type'];
if(isset($_REQUEST['member_school_code']) and ($_REQUEST['member_school_code'] != ''))
	$cur_school_code = $_REQUEST['member_school_code'];    

if(isset($_REQUEST['member_status']) and ($_REQUEST['member_status'] != ''))
    $cur_state = $_REQUEST['member_status'];
if(isset($_REQUEST['city_id']) and ($_REQUEST['city_id'] != ''))
    $cur_city_id = $_REQUEST['city_id'];
$sql = ' select count(member_id) as cnt from zx_member a';
$sql .= ' Left join zx_city b on a.member_city_id = b.city_id ';
$sql .= ' Left join zx_school c on a.member_school_code = c.school_code ';
$sql .= ' Left join zx_student d on a.member_student_code = d.student_code ';
$sql .= ' where a.member_id <> 0 ';
if($cur_sex != '')
    $sql .= ' and a.member_sex ='.$cur_sex;
if($cur_state != '')
    $sql .= ' and a.member_status ='.$cur_state;
if($cur_city_id != '')
    $sql .= ' and a.member_city_id ='.$cur_city_id;
if($cur_school_code != '')
	$sql .= ' and a.member_school_code ="'.$cur_school_code.'"';
if($cur_identity_type != '')
    $sql .= ' and a.member_identity_type ='.$cur_identity_type;
if(isset($_REQUEST['keyword']) and ('' != $_REQUEST['keyword'])){
	if($_REQUEST['search_op'] == 'school_name'){
		$sql .= " and c.school_name like '%".$_REQUEST['keyword']."%' ";
	}else if($_REQUEST['search_op'] == 'student_code'){
		$sql .= " and d.student_code like '%".$_REQUEST['keyword']."%' ";
	}else if($_REQUEST['search_op'] == 'student_name'){
		$sql .= " and d.student_name like '%".$_REQUEST['keyword']."%' ";
	}else{
		$sql .= " and a.".$_REQUEST['search_op']." like '%".$_REQUEST['keyword']."%' ";
	}
}
$result = get_info_by_sql($sql);
$cnt = $result[0]['cnt'];
$totlepage = intval(($cnt-1)/$percount)+1;
if($curpage < 1){
  $curpage = 1;
}
if($totlepage < 1){
  $totlepage = 1;
}
if($curpage > $totlepage){
	$curpage = $totlepage;
}
$sql = ' select a.member_id,a.member_name,a.member_email,a.member_status,b.city_name,a.member_identity_type,
a.member_sex,a.member_birthday,a.member_logintime,a.member_times,a.member_school,a.member_exam_vlink,c.school_name,
d.student_name,d.student_code  from zx_member a ';
$sql .= ' Left join zx_city b on a.member_city_id = b.city_id ';
$sql .= ' Left join zx_school c on a.member_school_code = c.school_code ';
$sql .= ' Left join zx_student d on a.member_student_code = d.student_code ';

$sql .= ' where a.member_id <> 0 ';
if($cur_sex != '')
    $sql .= ' and a.member_sex ='.$cur_sex;
if($cur_state != '')
    $sql .= ' and a.member_status ='.$cur_state;
if($cur_city_id != '')
    $sql .= ' and a.member_city_id ='.$cur_city_id;
if($cur_school_code != '')
	$sql .= ' and a.member_school_code ="'.$cur_school_code.'"';
if($cur_identity_type != '')
    $sql .= ' and a.member_identity_type ='.$cur_identity_type;
if(isset($_REQUEST['keyword']) and ('' != $_REQUEST['keyword'])){
	if($_REQUEST['search_op'] == 'school_name'){
		$sql .= " and c.school_name like '%".$_REQUEST['keyword']."%' ";
	}else if($_REQUEST['search_op'] == 'student_code'){
		$sql .= " and d.student_code like '%".$_REQUEST['keyword']."%' ";
	}else if($_REQUEST['search_op'] == 'student_name'){
		$sql .= " and d.student_name like '%".$_REQUEST['keyword']."%' ";
	}else{
		$sql .= " and a.".$_REQUEST['search_op']." like '%".$_REQUEST['keyword']."%' ";
	}
}
$sql.= ' order by a.member_addtime desc ';
$sql.= ' limit ' . (($curpage-1)*$percount) . ',' . $percount;
$result=get_info_by_sql($sql);
$sex_array = array('','男','女');
$pims_array = array('无','有');
$itype_array = array('学生','老师');
$state_array = array('','正常使用','审核中','审核不通过','被封号');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery.js"></script>
<script language="javascript" src="js/jquery.autocomplete.js"></script>
<script language="javascript" src="js/member_manage.js"></script>
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script> 
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=member_to_manage">会员管理</a></div><br>

<ul id="innouni_sub_title">
	<li class="sub">会员管理</li>
	<li class="unsub"><a class="hand" onclick="$('#search')[0].style.visibility='inherit'">会员搜索</a></li>
</ul>
<div style="visibility:hidden;position:absolute;margin:0 40 40 170px;*margin:0 0 0 170px;border:1px solid #FCBA72;background:#fff;padding:5px 10px;" id="search">
	<!--<img src="images/close.gif"  style="position:absolute;margin:10px 0 0 612px;cursor:pointer;" onclick="$('#search')[0].style.visibility='hidden'" alt="关闭" />-->
	<form method="post" action="./?a=member_to_manage">性别：<select name="member_sex" id="member_sex"><option value="">全部</option>
			<option value="1">男</option><option value="2">女</option></select>
				身份：<select name="member_identity_type" id="member_identity_type"><option value="">全部</option>
			<option value="0">学生</option><option value="1">老师</option></select>
				
				
		状态：<select name="member_status" id="member_status">
			<option value="">全部</option>
			<option value="1">正常</option>
			<option value="2">审核中</option>
			<option value="3">审核不通过</option>
			<option value="4">被封号</option>
			</select>
		所在学校：<select name="member_school_code" id="member_school_code">
			<option value="">全部</option>
			<?=$school_list ?>
			<option value="0000000000000000">其他</option>
			</select>
		城市：<input name="city_search" id="city_search" class="input" value="" />
			<input  type="hidden" name="city_id" id="city_id" value="" />
		<select name="search_op" id="search_op">
			<option value="member_name">昵称</option>
			<option value="member_email">账号</option>
			<option value="member_birthday">生日</option>
			<option value="school_name">所在学校</option>
			<option value="student_code">学号</option>
			<option value="student_name">学号</option>
			<option value="member_logintime">最近登录时间</option>
			</select><input name="keyword" id="keyword" class="input" value="" /> <input type="submit" class="bnt01" value="搜索">
		<img src="images/close.gif"  style="margin:10px 0 0 10px;cursor:pointer;" onclick="$('#search')[0].style.visibility='hidden'" alt="关闭"/>
	</form>
	
</div>
<div id="innouni_right_b">
<form action="./?a=member_to_manage&page=<?=$curpage?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>&member_school_code=<?=$cur_school_code?>&member_identity_type=<?=$cur_identity_type?>&member_sex=<?=$cur_sex?>&member_status=<?=$cur_state?>&member_city_id=<?=$cur_city_id?>" method="post" >
  <table border="0" align="center" cellpadding="3" cellspacing="1" class="table_b">
    <tr>
      <td class="title_bg" width="40px" >选择</td>
      <!--<td class="title_bg" width="60px" >序号</td>-->
      <td class="title_bg" width="100px" >会员昵称</td>
      <td class="title_bg" width="100px">账号</td>
     <td class="title_bg" width="60px">生日</td>
      <td class="title_bg" width="100px">所在学校</td>
      <td class="title_bg" width="90px">学号</td>
      <td class="title_bg" width="90px">姓名</td>
      <td class="title_bg" width="80px">城市</td>
      <td class="title_bg" width="40px">性别</td>
      <td class="title_bg" width="40px">身份</td>
      <td class="title_bg" width="60px">状态</td>
      <td class="title_bg" width="60px">试题视频关联权限</td>
      <td class="title_bg" width="60px">登录次数</td>
			<td class="title_bg" width="120px">最后登录</td>
      <td class="title_bg" width="80px">操作</td>
      <input  type="hidden" name="check_select" id="check_select" value="" />
    </tr>
  <? foreach($result as $key => $value){ ?>
		<tr onmouseover=this.bgColor='#EBFFDC'; onmouseout=this.bgColor='#ffffff';  bgcolor='#ffffff'>
			<td align="center">
				<input type='checkbox' name='checkboxlist'  onclick='checkbox()' value='<?=$key?>' />
				<input type='hidden'  name='<?=$key?>_id' value='<?=$value['member_id']?>' />
			</td>	
			<td align="center"><a href="./?a=member_to_view&page=<?=$curpage?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>&member_school_code=<?=$cur_school_code?>&member_identity_type=<?=$cur_identity_type?>&member_sex=<?=$cur_sex?>&member_status=<?=$cur_state?>&member_city_id=<?=$cur_city_id?>&member_id=<?=$value['member_id']?>" ><?=$value['member_name']?></a></td>
			<td ><?=$value['member_email']?></td>
      
            <td ><?=$value['member_birthday']?></td>
            <td ><?if($value['school_name']==''){echo '其他';}else{echo $value['school_name'];}?></td>
            <td ><?=$value['student_code']?></td>
            <td ><?=$value['student_name']?></td>
      
			<td ><?=$value['city_name']?></td>
			
			<td align="center"><?=$sex_array[$value['member_sex']]?></td>
			<td align="center"><?=$itype_array[$value['member_identity_type']]?></td>
			<td align="center"><?=$state_array[$value['member_status']]?></td>
      <td align="center"><?=$pims_array[$value['member_exam_vlink']]?></td>
			
			<td align="center"><?=$value['member_times']?></td>
			<td align="center"><?=$value['member_logintime']?></td>
			<!--<td><a href="./?a=video_to_view&page=<?=$curpage?>&keyword=<?=$keyword ?>&video_kng_id=<?=$cur_kng_id ?>&video_id=<?=$value['video_id']?>&video_td_state=<?=$cur_state?>"><?=$value['video_title']?></a></td>
			-->
			<td align="center">
				<!--<a href="./?a=video_to_edit&page=<?=$curpage?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>&member_sex=<?=$cur_sex?>&member_status=<?=$cur_state?>&member_city_id=<?=$cur_city_id?>&video_id=<?=$value['video_id']?>">审核</a> 
				
				<a href="./?a=video_to_edit&page=<?=$curpage?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>&member_sex=<?=$cur_sex?>&member_status=<?=$cur_state?>&member_city_id=<?=$cur_city_id?>&video_id=<?=$value['video_id']?>">封号</a> 
			-->
				<a href="./?a=member_to_manage&page=<?=$curpage?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>&member_school_code=<?=$cur_school_code?>&member_identity_type=<?=$cur_identity_type?>&member_sex=<?=$cur_sex?>&member_status=<?=$cur_state?>&member_city_id=<?=$cur_city_id?>&act=del&member_id=<?=$value['member_id']?>" onclick="return confirm('确定要删除会员（<?=$value['member_name']?>）？');">删除</a>
			</td>
		</tr>
	<? } ?>
		<tr>
			<td colspan="15" class="tdbg" >
				&nbsp;&nbsp;
				<input type="checkbox" name="checkboxlist" onclick="checkboxall(this)" />全选
				<select name="act"  id="act" disabled>
					<!--<option value="s-yes">审核通过</option>
					<option value="s-no">审核不通过</option>
					<option value="s-dai">待审核</option>
					<option value="s-stop">批量封号</option>-->
					<option value="del">批量删除</option>
					<option value="set_exam_p">设置试题视频关联权限</option>
				</select>
				<input type="submit" class="bnt01" value="执行" id="dosubmit"  disabled />
			</td>
	  </tr>
  <? if ($totlepage > 1){ ?>
    <tr>
			<td colspan="15" align="center" class="tdbg">
				<? if($curpage <> 1){ ?>
				<a href="./?a=member_to_manage&page=<?=(int)($curpage - 1)?>&search_op=<?=$_REQUEST['search_op']?>&keyword=<?=$keyword?>&member_school_code=<?=$cur_school_code?>&member_identity_type=<?=$cur_identity_type?>&member_sex=<?=$cur_sex?>&member_status=<?=$cur_state?>&member_city_id=<?=$cur_city_id?>">上一页</a>
				<? } ?>
				<?
				if($curpage <= 5){
					$start = 1;
					$end = $totlepage >= 11?11:$totlepage;
				}else{
					$start = $totlepage - $curpage > 5?$curpage-5:($totlepage>=11?$totlepage-10:1);
					$end = $totlepage - $curpage > 5?$curpage + 5:$totlepage;
				}
				?>
				<? if($start > 1){ ?>
				<a href="./?a=member_to_manage&page=1&search_op=<?=$_REQUEST['search_op']?>&keyword=<?=$keyword ?>&member_school_code=<?=$cur_school_code?>&member_identity_type=<?=$cur_identity_type?>&member_sex=<?=$cur_sex?>&member_status=<?=$cur_state?>&member_city_id=<?=$cur_city_id?>"><?=1?></a>...
				<? } ?>
				<? for($i = $start; $i <=$end; $i++){ ?>
					<? if($value<>$curpage){ ?>
					<a href="./?a=member_to_manage&page=<?=$i?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>&member_school_code=<?=$cur_school_code?>&member_identity_type=<?=$cur_identity_type?>&member_sex=<?=$cur_sex?>&member_status=<?=$cur_state?>&member_city_id=<?=$cur_city_id?>"><?=$i?></a>
					<? }else{ ?>
					<a><?=$value?></a>
					<? } ?>
				<? } ?>
				<? if($end < $totlepage){ ?>
				...<a href="./?a=member_to_manage&page=<?=$totlepage?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>&member_school_code=<?=$cur_school_code?>&member_identity_type=<?=$cur_identity_type?>&member_sex=<?=$cur_sex?>&member_status=<?=$cur_state?>&member_city_id=<?=$cur_city_id?>"><?=$totlepage?></a>
				<? } ?>
				<? if($curpage <> $totlepage){ ?>
				<a href="./?a=member_to_manage&page=<?=(int)($curpage + 1)?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>&member_school_code=<?=$cur_school_code?>&member_identity_type=<?=$cur_identity_type?>&member_sex=<?=$cur_sex?>&member_status=<?=$cur_state?>&member_city_id=<?=$cur_city_id?>">下一页</a>
				<? } ?>
				页次：<?=$curpage?>/<?=$totlepage?>页 &nbsp;每页:<?=$percount?>条&nbsp;总数：<?=$cnt?>条
			</td>
    </tr>
  <? } ?>
  </table>
  </form>
</div>

</body>
</html>
