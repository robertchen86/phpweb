<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
/*
if($_GET['act'] and ($_GET['act'] == 'del')){
	  if($_GET['examlog_id']){
	 	    del_examlog_by_id($_GET['examlog_id'],$inrow);
	  }
}
if($_POST['act'] and ($_POST['act'] == 'del') and $_POST['check_select']){
	  $keys =  explode(',',$_POST['check_select']);
	  foreach ($keys as $key => $value){
	  	  if($value == '')
	  	      continue;
	 	    del_examlog_by_id($_POST[$value.'_id']);
	  }
}
*/

/***/
$percount = 10;
$curpage = 1;
/*$cur_member_name = '';
$cur_state = '';
$cur_city_id = '';*/
$keyword = $_REQUEST['keyword']; 
if(isset($_REQUEST['page'])){
    $curpage = $_GET['page'];
}
/*if(isset($_REQUEST['member_name']) and ($_REQUEST['member_name'] != ''))
    $cur_member_name = $_REQUEST['member_name'];
if(isset($_REQUEST['member_status']) and ($_REQUEST['member_status'] != ''))
    $cur_state = $_REQUEST['member_status'];
if(isset($_REQUEST['city_id']) and ($_REQUEST['city_id'] != ''))
    $cur_city_id = $_REQUEST['city_id'];*/
$sql = ' select count(examlog_id) as cnt from zx_video_log a ';
$sql .= ' Left join zx_member b on a.examlog_member_id = b.member_id ';
$sql .= ' Left join zx_video c on a.examlog_video_id = c.video_id ';
$sql .= ' where a.examlog_id <> 0 ';
/*if($cur_sex != '')
    $sql .= ' and member_sex ='.$cur_sex;
if($cur_state != '')
    $sql .= ' and member_status ='.$cur_state;
if($cur_city_id != '')
    $sql .= ' and member_city_id ='.$cur_city_id;*/
    /*
if(isset($_REQUEST['keyword']) and ('' != $_REQUEST['keyword'])){
	  if($_REQUEST['search_op']=='member_name')
	     $sql .= " and b.member_name like '%".$_REQUEST['keyword']."%' ";
	  if($_REQUEST['search_op']=='video_title')
	     $sql .= " and c.video_title like '%".$_REQUEST['keyword']."%' ";   
	  if($_REQUEST['search_op']=='examlog_st_time')
	     $sql .= " and a.examlog_st_time like '%".$_REQUEST['keyword']."%' ";   
	  if($_REQUEST['search_op']=='examlog_end_time')
	     $sql .= " and a.video_title like '%".$_REQUEST['keyword']."%' "; 
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
$sql = ' select a.examlog_id,a.examlog_st_time,a.examlog_end_time,b.member_name,
c.video_title from zx_video_log a ';
$sql .= ' Left join zx_member b on a.examlog_member_id = b.member_id ';
$sql .= ' Left join zx_video c on a.examlog_video_id = c.video_id ';
$sql .= ' where a.examlog_id <> 0 ';
if(isset($_REQUEST['keyword']) and ('' != $_REQUEST['keyword'])){
	  if($_REQUEST['search_op']=='member_name')
	     $sql .= " and b.member_name like '%".$_REQUEST['keyword']."%' ";
	  if($_REQUEST['search_op']=='video_title')
	     $sql .= " and c.video_title like '%".$_REQUEST['keyword']."%' ";   
	  if($_REQUEST['search_op']=='examlog_st_time')
	     $sql .= " and a.examlog_st_time like '%".$_REQUEST['keyword']."%' ";   
	  if($_REQUEST['search_op']=='examlog_end_time')
	     $sql .= " and a.video_title like '%".$_REQUEST['keyword']."%' "; 
}
$sql.= ' order by a.examlog_st_time desc ';
$sql.= ' limit ' . (($curpage-1)*$percount) . ',' . $percount;
$result=get_info_by_sql($sql);
*/
$memberdb = spClass("zx_member");
$member_array = $memberdb->spPager($this->spArgs("page", 1), $percount)->findAll();
$exam_recorddb = spClass("zx_exam_record");
foreach($member_array as $key => $member){
	$right = $exam_recorddb->findCount(array("er_member_id" => $member["member_id"], "er_exam_selected" => 1));
	$wrong = $exam_recorddb->findCount(array("er_member_id" => $member["member_id"], "er_exam_selected" => 0));
	$member_array[$key]["rcount"] = $right;
	$member_array[$key]["wcount"] = $wrong;
}
$pager = $memberdb->spPager()->getPager();
$totlepage = $pager["total_page"];
$cnt = $pager["total_count"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery.js"></script>
<script language="javascript" src="js/jquery.autocomplete.js"></script>
<script language="javascript" src="js/examlog_manage.js"></script>
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script> 
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=examlog_to_manage">试题记录管理</a></div><br>

<ul id="innouni_sub_title">
	<li class="sub">试题记录管理</li>
	<!--<li class="unsub"><a class="hand" onclick="$('#search')[0].style.visibility='inherit'">记录搜索</a></li>-->
</ul>
<div style="visibility:hidden;position:absolute;margin:0 40 40 170px;*margin:0 0 0 170px;border:1px solid #FCBA72;background:#fff;padding:5px 10px;" id="search">
	<!--<img src="images/close.gif"  style="position:absolute;margin:10px 0 0 612px;cursor:pointer;" onclick="$('#search')[0].style.visibility='hidden'" alt="关闭" />-->
	<form method="post" action="./?a=examlog_to_manage">
		<select name="search_op" id="search_op">
			<option value="member_name">会员昵称</option>
			<!--<option value="member_name">账号</option>-->
			<option value="video_title">试题标题</option>
			<option value="examlog_st_time">开始时间</option>
				<option value="examlog_end_time ">结束时间</option>
			</select><input name="keyword" id="keyword" class="input" value="" /> <input type="submit" class="bnt01" value="搜索">
		<img src="images/close.gif"  style="margin:10px 0 0 10px;cursor:pointer;" onclick="$('#search')[0].style.visibility='hidden'" alt="关闭"/>
	</form>
	
</div>
<div id="innouni_right_b">
<form action="./?a=examlog_to_manage&page=<?=$curpage?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>" method="post" >
  <table border="0" align="center" cellpadding="3" cellspacing="1" class="table_b">
    <tr>
      <!--<td class="title_bg" width="40px" >选择</td>-->
      <!--<td class="title_bg" width="60px" >序号</td>-->
      <td class="title_bg" width="120px" >会员昵称</td>
      <td class="title_bg" width="160px">答对题数</td>
      <td class="title_bg" width="120px">答错题数</td>
      <!--<td class="title_bg" width="120px">结束时间</td>
      <td class="title_bg" width="80px">操作</td>-->
      <input  type="hidden" name="check_select" id="check_select" value="" />
    </tr>
  <? foreach($member_array as $key => $value){ ?>
		<tr onmouseover=this.bgColor='#EBFFDC'; onmouseout=this.bgColor='#ffffff';  bgcolor='#ffffff'>
			<!--
			<td align="center">
				<input type='checkbox' name='checkboxlist'  onclick='checkbox()' value='<?=$key?>' />
				<input type='hidden'  name='<?=$key?>_id' value='<?=$value['examlog_id']?>' />
			</td>	
			-->
			<td ><a href="<?=spUrl("main", "examlog_byone_to_view", array("memberid" => $value["member_id"]))?>"><?=$value['member_name']?></a></td>
			<td ><?=$value['rcount']?></td>
			<td align="center"><?=$value['wcount']?></td>
			<!--<td align="center"><?=$value['examlog_end_time']?></td>
			<td align="center"><a href="./?a=examlog_to_manage&page=<?=$curpage?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>&act=del&examlog_id=<?=$value['examlog_id']?>" onclick="return confirm('确定要删除试题记录？');">删除</a>
			</td>
			-->
		</tr>
	<? } ?>
	<!--
		<tr>
			<td colspan="9" class="tdbg" >
				&nbsp;&nbsp;
				<input type="checkbox" name="checkboxlist" onclick="checkboxall(this)" />全选
				<select name="act"  id="act" disabled>
					<option value="del">批量删除</option>
				</select>
				<input type="submit" class="bnt01" value="执行" id="dosubmit"  disabled />
			</td>
	  </tr>
	  -->
  <? if ($totlepage > 1){ ?>
    <tr>
			<td colspan="9" align="center" class="tdbg">
				<? if($curpage <> 1){ ?>
				<a href="./?a=examlog_to_manage&page=<?=(int)($curpage - 1)?>&search_op=<?=$_REQUEST['search_op']?>&keyword=<?=$keyword?>">上一页</a>
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
				<a href="./?a=examlog_to_manage&page=1&search_op=<?=$_REQUEST['search_op']?>&keyword=<?=$keyword ?>"><?=1?></a>...
				<? } ?>
				<? for($i = $start; $i <=$end; $i++){ ?>
					<? if($value<>$curpage){ ?>
					<a href="./?a=examlog_to_manage&page=<?=$i?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>"><?=$i?></a>
					<? }else{ ?>
					<a><?=$value?></a>
					<? } ?>
				<? } ?>
				<? if($end < $totlepage){ ?>
				...<a href="./?a=examlog_to_manage&page=<?=$totlepage?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>"><?=$totlepage?></a>
				<? } ?>
				<? if($curpage <> $totlepage){ ?>
				<a href="./?a=examlog_to_manage&page=<?=(int)($curpage + 1)?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>">下一页</a>
				<? } ?>
				页次：<?=$curpage?>/<?=$totlepage?>页 &nbsp;每页:<?=$percount?>条&nbsp;总数：<?=$cnt?>条
			</td>
    </tr>
  <? } ?>
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
