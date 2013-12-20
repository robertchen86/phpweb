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
$memberid = $this->spArgs("memberid", 1);
$memberinfo = spClass("zx_member")->findBy("member_id", $memberid);
$exam_recorddb = spClass("zx_exam_record");
$result = $exam_recorddb->spPager($this->spArgs("page", 1), $percount)->findAll(array("er_member_id" => $memberid), "er_time desc");
$pager = $exam_recorddb->spPager()->getPager();
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
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=examlog_byone_to_view&memberid=<?=$memberid?>">视频记录管理</a></div><br>

<ul id="innouni_sub_title">
	<li class="sub">视频记录管理</li>
	<!--<li class="unsub"><a class="hand" onclick="$('#search')[0].style.visibility='inherit'">记录搜索</a></li>-->
</ul>
<div style="visibility:hidden;position:absolute;margin:0 40 40 170px;*margin:0 0 0 170px;border:1px solid #FCBA72;background:#fff;padding:5px 10px;" id="search">
	<!--<img src="images/close.gif"  style="position:absolute;margin:10px 0 0 612px;cursor:pointer;" onclick="$('#search')[0].style.visibility='hidden'" alt="关闭" />-->
	<form method="post" action="./?a=examlog_byone_to_view&memberid=<?=$memberid?>">
		<select name="search_op" id="search_op">
			<option value="member_name">试题序号</option>
			<option value="video_title">选择答案</option>
			<option value="examlog_st_time">答题使用时间</option>
			<option value="examlog_st_time">是否正确</option>
				<option value="examlog_end_time ">答题时间</option>
			</select><input name="keyword" id="keyword" class="input" value="" /> <input type="submit" class="bnt01" value="搜索">
		<img src="images/close.gif"  style="margin:10px 0 0 10px;cursor:pointer;" onclick="$('#search')[0].style.visibility='hidden'" alt="关闭"/>
	</form>
	
</div>
<div id="innouni_right_b">
	<center>以下是用户名为"<?=$memberinfo["member_name"]?>"的做题记录<br/></center>
<form action="./?a=exam_record_data_out&memberid=<?=$memberid?>?>" method="post" >
  <table border="0" align="center" cellpadding="3" cellspacing="1" class="table_b">
    <tr>
      <td class="title_bg" width="15%" >试题序号</td>
      <td class="title_bg" width="15%">选择答案</td>
      <td class="title_bg" width="15%">答题使用时间</td>
      <td class="title_bg" width="20%">是否正确</td>
      <td class="title_bg" width="20%">答题时间</td>
    </tr>
  <? foreach($result as $key => $value){ ?>
		<tr onmouseover=this.bgColor='#EBFFDC'; onmouseout=this.bgColor='#ffffff';  bgcolor='#ffffff'>
			<td ><?=$value['er_exam_id']?></td>
			<td ><?=$value['er_exam_answered'] == "N" ? "" : $value['er_exam_answered']?></td>
			<td align="center"><?=$value['er_exam_usetime']?></td>
			<td align="center"><?=$value['er_exam_selected'] == 0 ? "错误" : "正确"?></td>
			<td align="center"><?=$value['er_time']?></td>
		</tr>
	<? } ?>
	<tr>
			<td colspan="7" class="tdbg" >

				操作：<input type="submit" class="bnt01" value="导 出"/>
			</td>
	  </tr>
  <? if ($totlepage > 1){ ?>
    <tr>
			<td colspan="9" align="center" class="tdbg">
				<? if($curpage <> 1){ ?>
				<a href="./?a=examlog_byone_to_view&memberid=<?=$memberid?>&page=<?=(int)($curpage - 1)?>&search_op=<?=$_REQUEST['search_op']?>&keyword=<?=$keyword?>">上一页</a>
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
				<a href="./?a=examlog_byone_to_view&memberid=<?=$memberid?>&page=1&search_op=<?=$_REQUEST['search_op']?>&keyword=<?=$keyword ?>"><?=1?></a>...
				<? } ?>
				<? for($i = $start; $i <=$end; $i++){ ?>
					<? if($value<>$curpage){ ?>
					<a href="./?a=examlog_byone_to_view&memberid=<?=$memberid?>&page=<?=$i?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>"><?=$i?></a>
					<? }else{ ?>
					<a><?=$value?></a>
					<? } ?>
				<? } ?>
				<? if($end < $totlepage){ ?>
				...<a href="./?a=examlog_byone_to_view&memberid=<?=$memberid?>&page=<?=$totlepage?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>"><?=$totlepage?></a>
				<? } ?>
				<? if($curpage <> $totlepage){ ?>
				<a href="./?a=examlog_byone_to_view&memberid=<?=$memberid?>&page=<?=(int)($curpage + 1)?>&keyword=<?=$keyword ?>&search_op=<?=$_REQUEST['search_op']?>">下一页</a>
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
