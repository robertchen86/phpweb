<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/

if($_GET['act'] and ($_GET['act'] == 'del')){
	  if($_GET['vlog_id']){
	 	    del_vlog_by_id($_GET['vlog_id'],$inrow);
	  }
}
if($_POST['act'] and ($_POST['act'] == 'del') and $_POST['check_select']){
	  $keys =  explode(',',$_POST['check_select']);
	  foreach ($keys as $key => $value){
	  	  if($value == '')
	  	      continue;
	 	    del_vlog_by_id($_POST[$value.'_id']);
	  }
}




/***/
$v_p_list ='<option value="" >全部</option>'.get_video_list();
$m_p_list ='<option value="" >全部</option>'.get_member_list();
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
$sql = ' select count(vlog_id) as cnt from zx_video_log a ';
$sql .= ' Left join zx_member b on a.vlog_member_id = b.member_id ';
$sql .= ' Left join zx_video c on a.vlog_video_id = c.video_id ';
$sql .= ' where a.vlog_id <> 0 ';
/*if($cur_sex != '')
    $sql .= ' and member_sex ='.$cur_sex;
if($cur_state != '')
    $sql .= ' and member_status ='.$cur_state;
if($cur_city_id != '')
    $sql .= ' and member_city_id ='.$cur_city_id;*/
if(isset($_REQUEST['keyword']) and ('' != $_REQUEST['keyword'])){
	  if($_REQUEST['search_op']=='member_name')
	     $sql .= " and b.member_name like '%".$_REQUEST['keyword']."%' ";
	  if($_REQUEST['search_op']=='video_title')
	     $sql .= " and c.video_title like '%".$_REQUEST['keyword']."%' ";   
	  if($_REQUEST['search_op']=='vlog_st_time')
	     $sql .= " and a.vlog_st_time like '%".$_REQUEST['keyword']."%' ";   
	  if($_REQUEST['search_op']=='vlog_end_time')
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
$sql = ' select a.vlog_id,a.vlog_st_time,a.vlog_end_time,b.member_name,
c.video_title from zx_video_log a ';
$sql .= ' Left join zx_member b on a.vlog_member_id = b.member_id ';
$sql .= ' Left join zx_video c on a.vlog_video_id = c.video_id ';
$sql .= ' where a.vlog_id <> 0 ';
if(isset($_REQUEST['keyword']) and ('' != $_REQUEST['keyword'])){
	  if($_REQUEST['search_op']=='member_name')
	     $sql .= " and b.member_name like '%".$_REQUEST['keyword']."%' ";
	  if($_REQUEST['search_op']=='video_title')
	     $sql .= " and c.video_title like '%".$_REQUEST['keyword']."%' ";   
	  if($_REQUEST['search_op']=='vlog_st_time')
	     $sql .= " and a.vlog_st_time like '%".$_REQUEST['keyword']."%' ";   
	  if($_REQUEST['search_op']=='vlog_end_time')
	     $sql .= " and a.video_title like '%".$_REQUEST['keyword']."%' "; 
}
$sql.= ' order by a.vlog_st_time desc ';
$sql.= ' limit ' . (($curpage-1)*$percount) . ',' . $percount;
$result=get_info_by_sql($sql);

//$this->k_p_list = get_kng_list2(0);
//echo  get_kng_list2(0);
//die();
//$this->v_p_list = get_video_list2($video_kng_id,$exam_video_id);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery.js"></script>
<script language="javascript" src="js/jquery.autocomplete.js"></script>
<script language="javascript" src="js/vlog_manage.js"></script>
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script> 
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=vlog_to_manage">视频记录管理</a></div><br>

<ul id="innouni_sub_title">
	<li class="sub">视频记录管理</li>
	<li class="unsub"><a class="hand" onclick="$('#search')[0].style.visibility='inherit'">记录搜索</a></li>
	<li class="unsub"><a class="hand" onclick="$('#log_out')[0].style.visibility='inherit'">记录导出</a></li>
</ul>
<div style="visibility:hidden;position:absolute;margin:0 40 40 170px;*margin:0 0 0 170px;border:1px solid #FCBA72;background:#fff;padding:5px 10px;" id="search">
	<!--<img src="images/close.gif"  style="position:absolute;margin:10px 0 0 612px;cursor:pointer;" onclick="$('#search')[0].style.visibility='hidden'" alt="关闭" />-->
	<form method="post" action="./?a=vlog_to_manage">
		<select name="search_op" id="search_op">
			<option value="member_name">会员昵称</option>
			<!--<option value="member_name">账号</option>-->
			<option value="video_title">视频标题</option>
			<option value="vlog_st_time">开始时间</option>
			<option value="vlog_end_time ">结束时间</option>
			</select><input name="keyword" id="keyword" class="input" value="" /> <input type="submit" class="bnt01" value="搜索">
		<img src="images/close.gif"  style="margin:10px 0 0 10px;cursor:pointer;" onclick="$('#search')[0].style.visibility='hidden'" alt="关闭"/>
	</form>
	
</div>
<div style="visibility:hidden;position:absolute;margin:0 40 40 170px;*margin:0 0 0 170px;border:1px solid #FCBA72;background:#fff;padding:5px 10px;" id="log_out">
	<!--<img src="images/close.gif"  style="position:absolute;margin:10px 0 0 612px;cursor:pointer;" onclick="$('#search')[0].style.visibility='hidden'" alt="关闭" />-->
	<form method="post" action="./?a=vlog_to_out">
		会员<select name="m_id" id="m_id"><?=$m_p_list?></select>知识点<select name="kng_id" id="kng_id"><option value="">全部</option> <?=get_kng_list2(0)?>  </select>
		视频<select name="v_id" id="v_id" disabled></select><input type="submit" class="bnt01" value="导出">
		<img src="images/close.gif"  style="margin:10px 0 0 10px;cursor:pointer;" onclick="$('#log_out')[0].style.visibility='hidden'" alt="关闭"/>
	</form>
	
</div>
<div id="innouni_right_b">
<form action="./?a=vlog_to_manage&page=<?=$curpage?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>" method="post" >
  <table border="0" align="center" cellpadding="3" cellspacing="1" class="table_b">
    <tr>
      <td class="title_bg" width="40px" >选择</td>
      <!--<td class="title_bg" width="60px" >序号</td>-->
      <td class="title_bg" width="120px" >会员昵称</td>
      <td class="title_bg" width="160px">视频标题</td>
      <td class="title_bg" width="120px">开始时间</td>
      <td class="title_bg" width="120px">结束时间</td>
      <td class="title_bg" width="80px">操作</td>
      <input  type="hidden" name="check_select" id="check_select" value="" />
    </tr>
  <? foreach($result as $key => $value){ ?>
		<tr onmouseover=this.bgColor='#EBFFDC'; onmouseout=this.bgColor='#ffffff';  bgcolor='#ffffff'>
			<td align="center">
				<input type='checkbox' name='checkboxlist'  onclick='checkbox()' value='<?=$key?>' />
				<input type='hidden'  name='<?=$key?>_id' value='<?=$value['vlog_id']?>' />
			</td>	
			<td ><?=$value['member_name']?></td>
			<td ><?=$value['video_title']?></td>
			<td align="center"><?=$value['vlog_st_time']?></td>
			<td align="center"><?=$value['vlog_end_time']?></td>
			<td align="center"><a href="./?a=vlog_to_manage&page=<?=$curpage?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>&act=del&vlog_id=<?=$value['vlog_id']?>" onclick="return confirm('确定要删除视频记录？');">删除</a>
			</td>
		</tr>
	<? } ?>
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
  <? if ($totlepage > 1){ ?>
    <tr>
			<td colspan="9" align="center" class="tdbg">
				<? if($curpage <> 1){ ?>
				<a href="./?a=vlog_to_manage&page=<?=(int)($curpage - 1)?>&search_op=<?=$_REQUEST['search_op']?>&keyword=<?=$keyword?>">上一页</a>
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
				<a href="./?a=vlog_to_manage&page=1&search_op=<?=$_REQUEST['search_op']?>&keyword=<?=$keyword ?>"><?=1?></a>...
				<? } ?>
				<? for($i = $start; $i <=$end; $i++){ ?>
					<? if($value<>$curpage){ ?>
					<a href="./?a=vlog_to_manage&page=<?=$i?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>"><?=$i?></a>
					<? }else{ ?>
					<a><?=$value?></a>
					<? } ?>
				<? } ?>
				<? if($end < $totlepage){ ?>
				...<a href="./?a=vlog_to_manage&page=<?=$totlepage?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>"><?=$totlepage?></a>
				<? } ?>
				<? if($curpage <> $totlepage){ ?>
				<a href="./?a=vlog_to_manage&page=<?=(int)($curpage + 1)?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>">下一页</a>
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
