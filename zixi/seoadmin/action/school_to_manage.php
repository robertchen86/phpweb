<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
/***/
if($_GET['act'] and ($_GET['act'] == 'del')){
	if($_GET['school_id']){
		//$inrow['product_trash'] = 1;
		//update_product($_GET['product_id'],$inrow);
		del_school_by_id($_GET['school_id']);
	}
}
if($_POST['act'] and ($_POST['act'] == 'del') and $_POST['check_select']){
	$keys =  explode(',',$_POST['check_select']);
	foreach ($keys as $key => $value){
		if($value == '')
			continue;
		//$inrow['product_trash'] = 1;
		//update_kng($_POST[$value.'_sort_id'],$inrow);
		del_school_by_id($_POST[$value.'_scl_id']);
	}
}
if($_POST['act'] and ($_POST['act'] == 'sortup') and $_POST['check_select']){
	$keys =  explode(',',$_POST['check_select']);
	foreach ($keys as $key => $value){
		if($value == '')
			continue;
		if(trim($_POST[$value.'_sort']) == '')
			continue;
		$inrow['school_sort'] = (int)$_POST[$value.'_sort'];
		$inrow['school_updatetime'] = date('Y-m-d H:i:s');
		update_school($_POST[$value.'_scl_id'],$inrow);
	}
}




/***/
$percount = 10;
$curpage = 1;
//$cur_root_id = 0;
$keyword = $_REQUEST['keyword'];
if(isset($_REQUEST['page'])){
	$curpage = $_GET['page'];
	// $_get_str .='&page='.$_GET['page'];
	//if(!$_GET['dotype'])
	// $pageexit = true;
}
//if(isset($_REQUEST['kng_foot_id']))
//	$cur_root_id = $_REQUEST['kng_foot_id'];
$sql = ' select count(school_code) as cnt from zx_school ';
$sql .= ' where school_id <>0 ';
if(isset($_REQUEST['keyword']) and ('' != $_REQUEST['keyword']))
	$sql .= " and school_name like '%".$_REQUEST['keyword']."%' ";
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
$sql = ' select a.school_id,a.school_code,a.school_name,a.school_sort,a.school_updatetime,b.std_count from zx_school a ';
$sql.= ' LEFT JOIN (select  student_s_code, count(student_code) as std_count  from zx_student group by student_s_code)  b ON b.student_s_code = a.school_code ';
$sql .= ' where a.school_id <>0 ';
if(isset($_REQUEST['keyword']) and ('' != $_REQUEST['keyword']))
	$sql .= " and school_name like '%".$_REQUEST['keyword']."%' ";
$sql.= ' order by a.school_sort <> 0 desc,a.school_sort asc ';
$sql.= ' limit ' . (($curpage-1)*$percount) . ',' . $percount;
$result=get_info_by_sql($sql);
//$tuij = array('否','是');
/***/
/*if($_REQUEST['act'] = 'del'){
 del_admin_by_id($_REQUEST['id']);
}
$result = get_all_admin();*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/school_manage.js"></script>
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script> 
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=school_to_add">添加学校</a>　┊　<a href="./?a=school_to_manage">学校管理</a></div><br>

<ul id="innouni_sub_title">
	<li class="sub">学校管理</li>
	<li class="unsub"><a class="hand" onclick="$('#search')[0].style.visibility='inherit'">学校搜索</a></li>
</ul>
<div style="visibility:hidden;position:absolute;margin:0 40 40 170px;*margin:0 0 0 170px;border:1px solid #FCBA72;background:#fff;padding:5px 10px;" id="search">
	<form method="post" action="./?a=school_to_manage">
		关键字：<input name="keyword" id="keyword" class="input" value="" /> <input type="submit" class="bnt01" value="搜索">
			<img src="images/close.gif"  style="margin:10px 0 0 10px;cursor:pointer;" onclick="$('#search')[0].style.visibility='hidden'" alt="关闭"/>
	</form>
</div>
<div id="innouni_right_b">
<form action="./?a=school_to_manage&page=<?=$curpage?>&keyword=<?=$keyword ?>" method="post" >
  <table border="0" align="center" cellpadding="3" cellspacing="1" class="table_b">
    <tr>
      <td class="title_bg" width="60px" >选择</td>
      <td class="title_bg" width="60px" >序号</td>
      <td class="title_bg" width="120px">学校code</td>
      <td class="title_bg" >学校</td>
      <td class="title_bg" width="80px" >学生数</td>
	 <td class="title_bg" width="160px">更新时间</td>
      <td class="title_bg" width="80px">操作</td>
      <input  type="hidden" name="check_select" id="check_select" value="" />
    </tr>
  <? foreach($result as $key => $value){ ?>
		<tr onmouseover=this.bgColor='#EBFFDC'; onmouseout=this.bgColor='#ffffff';  bgcolor='#ffffff'>
			<td align="center">
				<input type='checkbox' name='checkboxlist'  onclick='checkbox()' value='<?=$key?>' />
				<input type='hidden'  name='<?=$key?>_scl_id' value='<?=$value['school_id']?>' />
			</td>		
			<td align="center">
				 <input type='text'  name='<?=$key?>_sort' id='<?=$key?>_sort'  value='<?=(int)$value['school_sort']?>' style='width:80%' onkeyup='value=value.replace(/[^0-9]/g,\"\") ' onbeforepaste='clipboardData.setData(\"text\",clipboardData.getData(\"text\").replace(/[^0-9]/g,\"\"))'  />
			</td>
			<td align="center"><?=$value['school_code']?></td>
			<td align="center"><?=$value['school_name']?></td>
			<td align="center"><?if($value['std_count']==''){echo 0;}else{echo $value['std_count'];}?></td>
			<td align="center"><?=$value["school_updatetime"]?></td>
			<td align="center">
				<a href="./?a=school_to_edit&page=<?=$curpage?>&keyword=<?=$keyword ?>&school_id=<?=$value['school_id']?>">编辑</a> 
				<a href="./?a=school_to_manage&page=<?=$curpage?>&keyword=<?=$keyword ?>&act=del&school_id=<?=$value['school_id']?>" onclick="return confirm('确定要删除学校（<?=$value['school_name']?>）？');">删除</a>
			</td>
		</tr>
	<? } ?>
		<tr>
			<td colspan="7" class="tdbg" >
				&nbsp;&nbsp;
				<input type="checkbox" name="checkboxlist" onclick="checkboxall(this)" />全选
				<!--<input name="chkAll" type="checkbox" id="chkAll" onclick=CheckAll(this.form) value="checkbox"/> 全选--> 
				<select name="act"  id="act" disabled>
					<option value="sortup">更新排序</option>
					<option value="del">批量删除</option>
				</select>
				<input type="submit" class="bnt01" value="执行" id="dosubmit"  disabled />
				
			</td>
	  </tr>
  <? if ($totlepage > 1){ ?>
    <tr>
			<td colspan="8" align="center" class="tdbg">
				<? if($curpage <> 1){ ?>
				<a href="./?a=school_to_manage&page=<?=(int)($curpage - 1)?>&keyword=<?=$keyword ?>">上一页</a>
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
				<a href="./?a=school_to_manage&page=1&keyword=<?=$keyword ?>"><?=1?></a>...
				<? } ?>
				<? for($i = $start; $i <=$end; $i++){ ?>
					<? if($value<>$curpage){ ?>
					<a href="./?a=school_to_manage&page=<?=$i?>&keyword=<?=$keyword ?>"><?=$i?></a>
					<? }else{ ?>
					<a><?=$value?></a>
					<? } ?>
				<? } ?>
				<? if($end < $totlepage){ ?>
				...<a href="./?a=school_to_manage&page=<?=$totlepage?>&keyword=<?=$keyword ?>"><?=$totlepage?></a>
				<? } ?>
				<? if($curpage <> $totlepage){ ?>
				<a href="./?a=school_to_manage&page=<?=(int)($curpage + 1)?>&keyword=<?=$keyword ?>">下一页</a>
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