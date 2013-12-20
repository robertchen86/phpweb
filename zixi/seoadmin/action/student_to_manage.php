<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$school_list = '';
$school_list .= get_school_list('');
/***/
if($_GET['act'] and ($_GET['act'] == 'del')){
	if($_GET['student_id']){
		//$inrow['product_trash'] = 1;
		//update_product($_GET['product_id'],$inrow);
		del_student_by_id($_GET['student_id']);
	}
}
if($_POST['act'] and ($_POST['act'] == 'del') and $_POST['check_select']){
	$keys =  explode(',',$_POST['check_select']);
	foreach ($keys as $key => $value){
		if($value == '')
			continue;
		//$inrow['product_trash'] = 1;
		//update_kng($_POST[$value.'_sort_id'],$inrow);
		del_student_by_id($_POST[$value.'_st_id']);
	}
}
if($_POST['act'] and ($_POST['act'] == 'tochange') and $_POST['check_select']){
	$keys =  explode(',',$_POST['check_select']);
	foreach ($keys as $key => $value){
		if($value == '')
			continue;
		//if(trim($_POST[$value.'_sort']) == '')
		//	continue;
		$inrow['student_s_code'] = $_POST['to_school'];
		$inrow['student_updatetime'] = date('Y-m-d H:i:s');
		update_student($_POST[$value.'_st_id'],$inrow);
	}
}




/***/
$percount = 10;
$curpage = 1;
$cur_school_code = '';
$keyword = $_REQUEST['keyword'];
if(isset($_REQUEST['page'])){
	$curpage = $_GET['page'];
}
if(isset($_REQUEST['school_code']) and ('' != $_REQUEST['school_code']))
	$cur_school_code = $_REQUEST['school_code'];
$sql = ' select count(student_id) as cnt from zx_student ';
$sql .= ' where student_id <> 0';
if('' != $cur_school_code)
	$sql .= ' and student_s_code = "'.$cur_school_code.'"';	
if(isset($_REQUEST['keyword']) and ('' != $_REQUEST['keyword']))
	$sql .= " and ".$_REQUEST['search_op']." like '%".$_REQUEST['keyword']."%' ";
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
$sql = ' select a.student_id,a.student_code,a.student_s_code,a.student_name,
a.student_updatetime,b.school_name from zx_student a ';
$sql .= ' Left join zx_school b on a.student_s_code = b.school_code ';
$sql .= ' where a.student_id <> 0';
if('' != $cur_school_code)
	$sql .= ' and a.student_s_code = "'.$cur_school_code.'"';
if(isset($_REQUEST['keyword']) and ('' != $_REQUEST['keyword']))
	$sql .= " and a.".$_REQUEST['search_op']." like '%".$_REQUEST['keyword']."%' ";
$sql.= ' order by a.student_code <> 0 desc,a.student_code asc ';
$sql.= ' limit ' . (($curpage-1)*$percount) . ',' . $percount;
$result=get_info_by_sql($sql);
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
<script type="text/javascript" src="js/student_manage.js"></script>
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script> 
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=student_to_add">添加学生</a>　┊　<a href="./?a=student_to_manage">学生管理</a></div><br>

<ul id="innouni_sub_title">
	<li class="sub">学生管理</li>
	<li class="unsub"><a class="hand" onclick="$('#search')[0].style.visibility='inherit'">学生搜索</a></li>
</ul>
<div style="visibility:hidden;position:absolute;margin:0 40 40 170px;*margin:0 0 0 170px;border:1px solid #FCBA72;background:#fff;padding:5px 10px;" id="search">
	<form method="post" action="./?a=student_to_manage">所属学校：<select name="school_code" id="school_code"><?=$school_list?></select>
	  <select name="search_op" id="search_op">
	  <option value="student_name">姓名</option>
	  <option value="student_code">学号</option>
	  </select>
	   
		关键字：<input name="keyword" id="keyword" class="input" value="" /> <input type="submit" class="bnt01" value="搜索">
			<img src="images/close.gif"  style="margin:10px 0 0 10px;cursor:pointer;" onclick="$('#search')[0].style.visibility='hidden'" alt="关闭"/>
	</form>
</div>
<div id="innouni_right_b">
<form action="./?a=student_to_manage&page=<?=$curpage?>&keyword=<?=$keyword?>&search_op=<?=$_REQUEST['search_op']?>&school_code=<?=$cur_school_code?>" method="post" >
  <table border="0" align="center" cellpadding="3" cellspacing="1" class="table_b">
    <tr>
      <td class="title_bg" width="60px" >选择</td>
      <td class="title_bg" width="120px" >学号</td>
      <td class="title_bg" width="160px" >姓名</td>
      <td class="title_bg" width="180px">所属学校</td>
	  <td class="title_bg" width="120px">更新时间</td>
      <td class="title_bg" width="80px">操作</td>
      <input  type="hidden" name="check_select" id="check_select" value="" />
    </tr>
  <? foreach($result as $key => $value){ ?>
		<tr onmouseover=this.bgColor='#EBFFDC'; onmouseout=this.bgColor='#ffffff';  bgcolor='#ffffff'>
			<td align="center">
				<input type='checkbox' name='checkboxlist'  onclick='checkbox()' value='<?=$key?>' />
				<input type='hidden'  name='<?=$key?>_st_id' value='<?=$value['student_id']?>' />
			</td>		
			<!--  <td align="center">
				 <input type='text'  name='<?=$key?>_sort' id='<?=$key?>_sort'  value='<?=(int)$value['kng_sort']?>' style='width:80%' onkeyup='value=value.replace(/[^0-9]/g,\"\") ' onbeforepaste='clipboardData.setData(\"text\",clipboardData.getData(\"text\").replace(/[^0-9]/g,\"\"))'  />
			</td>
			<td><?if($value['fv_count']==0){?><a href="./?a=kng_to_view&kng_id=<?=$value['kng_id']?>"><?=$value['kng_title']?></a><?}else{?><a href="./?a=kng_to_manage&kng_foot_id=<?=$value['kng_id']?>"><?=$value['kng_title']?></a><?}?></td>
			-->
			<td align="center"><?=$value['student_code']?></td>
			<td align="center"><?=$value['student_name']?></td>
			<td align="center"><?=$value['school_name']?></td>
			<td align="center"><?=$value['student_updatetime']?></td>
			
			<td align="center">
				<a href="./?a=student_to_edit&page=<?=$curpage?>&keyword=<?=$keyword?>&search_op=<?=$_REQUEST['search_op']?>&school_code=<?=$cur_school_code?>&student_id=<?=$value['student_id']?>">编辑</a> 
				<a href="./?a=student_to_manage&page=<?=$curpage?>&keyword=<?=$keyword?>&search_op=<?=$_REQUEST['search_op']?>&school_code=<?=$cur_school_code?>&act=del&student_id=<?=$value['student_id']?>" onclick="return confirm('确定要删除学生（<?=$value['student_name']?>）？');">删除</a>
			</td>
		</tr>
	<? } ?>
		<tr>
			<td colspan="6" class="tdbg" >
				&nbsp;&nbsp;
				<input type="checkbox" name="checkboxlist" onclick="checkboxall(this)" />全选
				<!--<input name="chkAll" type="checkbox" id="chkAll" onclick=CheckAll(this.form) value="checkbox"/> 全选--> 
				<select name="act"  id="act" disabled>
				    <option value="del">批量删除</option>
					<option value="tochange">批量转移</option>
				</select>
				<select name="to_school"  id="to_school" disabled><?=$school_list?></select>
				<input type="submit" class="bnt01" value="执行" id="dosubmit"  disabled />
				
			</td>
	  </tr>
  <? if ($totlepage > 1){ ?>
    <tr>
			<td colspan="8" align="center" class="tdbg">
				<? if($curpage <> 1){ ?>
				<a href="./?a=student_to_manage&page=<?=(int)($curpage - 1)?>&keyword=<?=$keyword?>&search_op=<?=$_REQUEST['search_op']?>&school_code=<?=$cur_school_code?>">上一页</a>
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
				<a href="./?a=student_to_manage&page=1&keyword=<?=$keyword?>&search_op=<?=$_REQUEST['search_op']?>&school_code=<?=$cur_school_code?>"><?=1?></a>...
				<? } ?>
				<? for($i = $start; $i <=$end; $i++){ ?>
					<? if($value<>$curpage){ ?>
					<a href="./?a=student_to_manage&page=<?=$i?>&keyword=<?=$keyword?>&search_op=<?=$_REQUEST['search_op']?>&school_code=<?=$cur_school_code?>"><?=$i?></a>
					<? }else{ ?>
					<a><?=$value?></a>
					<? } ?>
				<? } ?>
				<? if($end < $totlepage){ ?>
				...<a href="./?a=student_to_manage&page=<?=$totlepage?>&keyword=<?=$keyword?>&search_op=<?=$_REQUEST['search_op']?>&school_code=<?=$cur_school_code?>"><?=$totlepage?></a>
				<? } ?>
				<? if($curpage <> $totlepage){ ?>
				<a href="./?a=student_to_manage&page=<?=(int)($curpage + 1)?>&keyword=<?=$keyword?>&search_op=<?=$_REQUEST['search_op']?>&school_code=<?=$cur_school_code?>">下一页</a>
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