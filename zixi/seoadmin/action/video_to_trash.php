<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$kng_list = '';
$kng_list2 = '';
$kng_list = get_kng_list3(0); 
$kng_list2 = '<option value="0">无</option>'.$kng_list;
$kng_list = '<option value="">全部</option>'.$kng_list2;
/***/
if($_GET['act'] and ($_GET['act'] == 'del')){
	  if($_GET['video_id']){
	 	    del_video_by_id($_GET['video_id']);
	  }
}
if($_POST['act'] and ($_POST['act'] == 'del') and $_POST['check_select']){
	  $keys =  explode(',',$_POST['check_select']);
	  foreach ($keys as $key => $value){
	  	  if($value == '')
	  	      continue;
	 	    del_video_by_id($_POST[$value.'_sort_id']);
	  }
}

if($_GET['act'] and ($_GET['act'] == 'goback')){
	  if($_GET['video_id']){
	 	    $inrow['video_isdel'] = 0;
	  	  $inrow['video_uptime'] = date('Y-m-d H:i:s');
	 	    update_video($_GET['video_id'],$inrow);
	  }
}
if($_POST['act'] and ($_POST['act'] == 'goback') and $_POST['check_select']){
	  $keys =  explode(',',$_POST['check_select']);
	  foreach ($keys as $key => $value){
	  	  if($value == '')
	  	      continue;
	  	  $inrow['video_isdel'] = 0;
	  	  $inrow['video_uptime'] = date('Y-m-d H:i:s');
	 	    update_video($_POST[$value.'_sort_id'],$inrow);
	  }
}

/***/
$percount = 10;
$curpage = 1;
$cur_kng_id = '';
$cur_state = '';
if(isset($_REQUEST['page'])){
    $curpage = $_GET['page'];
}
if(isset($_REQUEST['video_kng_id']) and ($_REQUEST['video_kng_id'] != ''))
    $cur_kng_id = $_REQUEST['video_kng_id'];
$sql = ' select count(video_id) as cnt from zx_video ';
$sql .= ' where video_isdel = 1 ';
if(isset($_REQUEST['video_td_state']) and ($_REQUEST['video_td_state'] != '')){
    $sql .= ' and video_td_state ='.$_REQUEST['video_td_state'];
    $cur_state = $_REQUEST['video_td_state'];
}
if($cur_kng_id != '')
    $sql .= ' and video_kng_id ='.$cur_kng_id;
if(isset($_REQUEST['keyword']) and ('' != $_REQUEST['keyword'])){
	  $sql .= " and (video_title like '%".$_REQUEST['keyword']."%'";
	  $sql .= " or  video_tags like '%".$_REQUEST['keyword']."%' ";
	  $sql .= " or  video_description like '%".$_REQUEST['keyword']."%' )";
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
$sql = ' select a.video_id,a.video_title,a.video_tags,a.video_itemCode,
a.video_isrecommend,a.video_sort,a.video_td_state,a.video_pubDate,a.video_uptime,
b.kng_title,b.kng_id,a.video_addtime
 from zx_video a ';
$sql .= ' Left join zx_knowledge b on a.video_kng_id = b.kng_id ';
$sql .= ' where a.video_isdel = 1 ';
if(isset($_REQUEST['video_td_state']) and ($_REQUEST['video_td_state'] != '')){
    $sql .= ' and a.video_td_state ='.$_REQUEST['video_td_state'];
}
if($cur_kng_id != '')
    $sql .= ' and a.video_kng_id ='.$cur_kng_id;
if(isset($_REQUEST['keyword']) and ('' != $_REQUEST['keyword'])){
	  $sql .= " and (a.video_title like '%".$_REQUEST['keyword']."%'";
	  $sql .= " or  a.video_tags like '%".$_REQUEST['keyword']."%' ";
	  $sql .= " or  a.video_description like '%".$_REQUEST['keyword']."%' )";
}
$sql.= ' order by a.video_addtime desc ';
$sql.= ' limit ' . (($curpage-1)*$percount) . ',' . $percount;
$result=get_info_by_sql($sql);
$tuij = array('否','是');
$state_array = array('','正常播放','审核中','转码中','不存在','重复上传','审核不通过');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/video_trash.js"></script>
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script> 
</head>
<body>
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=video_to_trash">视频回收站</a>　┊　<a href="./?a=video_to_manage">视频管理</a></div><br>

<ul id="innouni_sub_title">
	<li class="sub">视频管理</li>
	<li class="unsub"><a class="hand" onclick="$('#search')[0].style.visibility='inherit'">视频搜索</a></li>
</ul>
<div style="visibility:hidden;position:absolute;margin:0 40 40 170px;*margin:0 0 0 170px;border:1px solid #FCBA72;background:#fff;padding:5px 10px;" id="search">
	<!--<img src="images/close.gif"  style="position:absolute;margin:10px 0 0 612px;cursor:pointer;" onclick="$('#search')[0].style.visibility='hidden'" alt="关闭" />-->
	<form method="post" action="./?a=video_to_trash">相关知识点：<select name="video_kng_id" id="video_kng_id"><?=$kng_list?></select>
		状态：<select name="video_td_state" id="video_td_state">
			<option value="">全部</option>
			<option value="1">正常播放</option>
			<option value="2">审核中</option>
			<option value="3">转码中</option>
			<option value="4">不存在</option>
			<option value="5">重复上传</option>
			<option value="6">审核不通过</option>
			</select>
		关键字：<input name="keyword" id="keyword" class="input" value="" /> <input type="submit" class="bnt01" value="搜索">
		<img src="images/close.gif"  style="margin:10px 0 0 10px;cursor:pointer;" onclick="$('#search')[0].style.visibility='hidden'" alt="关闭"/>
	</form>
	
</div>
<div id="innouni_right_b">
<form action="./?a=video_to_trash&page=<?=$curpage?>&keyword=<?=$keyword ?>&video_kng_id=<?=$cur_kng_id ?>&video_td_state=<?=$cur_state?>" method="post" >
  <table border="0" align="center" cellpadding="3" cellspacing="1" class="table_b">
    <tr>
      <td class="title_bg" width="40px" >选择</td>
      <!--<td class="title_bg" width="60px" >序号</td>-->
      <td class="title_bg" width="100px" >视频编码</td>
      <td class="title_bg" >视频标题</td>
      <td class="title_bg" >知识点</td>
      <td class="title_bg" width="80px">状态</td>
      <td class="title_bg" width="40px">推荐</td>
			<td class="title_bg" width="80px">发布时间</td>
			<td class="title_bg" width="160px">更新时间</td>
      <td class="title_bg" width="80px">操作</td>
      <input  type="hidden" name="check_select" id="check_select" value="" />
    </tr>
  <? foreach($result as $key => $value){ ?>
		<tr onmouseover=this.bgColor='#EBFFDC'; onmouseout=this.bgColor='#ffffff';  bgcolor='#ffffff'>
			<td align="center">
				<input type='checkbox' name='checkboxlist'  onclick='checkbox()' value='<?=$key?>' />
				<input type='hidden'  name='<?=$key?>_sort_id' value='<?=$value['video_id']?>' />
				<input type='hidden'  name='<?=$key?>_old_kng_id' value='<?=$value['kng_id']?>' />
			</td>		
			<!--<td align="center">
				 <input type='text'  name='<?=$key?>_sort' id='<?=$key?>_sort'  value='<?=(int)$value['video_sort']?>' style='width:80%' onkeyup='value=value.replace(/[^0-9]/g,\"\") ' onbeforepaste='clipboardData.setData(\"text\",clipboardData.getData(\"text\").replace(/[^0-9]/g,\"\"))'  />
			</td>-->
			<td align="center"><?=$value['video_itemCode']?></td>
			<td><!--<a href="./?a=video_to_view&page=<?=$curpage?>&keyword=<?=$keyword ?>&video_kng_id=<?=$cur_kng_id ?>&video_id=<?=$value['video_id']?>&video_td_state=<?=$cur_state?>">--><?=$value['video_title']?><!--</a>--></td>
			<td align="center"><?=$value['kng_title']?></td>
			<td align="center"><?=$state_array[$value['video_td_state']]?></td>
			<td align="center"><?=$tuij[$value['video_isrecommend']]?></td>
			
			<td align="center"><?=$value['video_pubDate']?></td>
			<td align="center"><?=$value['video_uptime']?></td>
			<td align="center">
				<a href="./?a=video_to_trash&page=<?=$curpage?>&keyword=<?=$keyword ?>&video_kng_id=<?=$cur_kng_id?>&act=goback&video_td_state=<?=$cur_state?>&video_id=<?=$value['video_id']?>">还原</a> 
				<a href="./?a=video_to_trash&page=<?=$curpage?>&keyword=<?=$keyword ?>&video_kng_id=<?=$cur_kng_id?>&act=del&video_td_state=<?=$cur_state?>&video_id=<?=$value['video_id']?>" onclick="return confirm('确定要删除视频（<?=$value['video_title']?>）信息？');">删除</a>
			</td>
		</tr>
	<? } ?>
		<tr>
			<td colspan="9" class="tdbg" >
				&nbsp;&nbsp;
				<input type="checkbox" name="checkboxlist" onclick="checkboxall(this)" />全选
				<select name="act"  id="act" disabled>
					<option value="del">批量删除</option>
					<option value="goback">批量还原</option>
				</select>
				<input type="submit" class="bnt01" value="执行" id="dosubmit"  disabled />
			</td>
	  </tr>
  <? if ($totlepage > 1){ ?>
    <tr>
			<td colspan="9" align="center" class="tdbg">
				<? if($curpage <> 1){ ?>
				<a href="./?a=video_to_trash&page=<?=(int)($curpage - 1)?>&keyword=<?=$keyword ?>&video_kng_id=<?=$cur_kng_id ?>&video_td_state=<?=$cur_state?>">上一页</a>
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
				<a href="./?a=video_to_trash&page=1&keyword=<?=$keyword ?>&video_kng_id=<?=$cur_kng_id ?>&video_td_state=<?=$cur_state?>"><?=1?></a>...
				<? } ?>
				<? for($i = $start; $i <=$end; $i++){ ?>
					<? if($value<>$curpage){ ?>
					<a href="./?a=video_to_trash&page=<?=$i?>&keyword=<?=$keyword ?>&video_kng_id=<?=$cur_kng_id ?>&video_td_state=<?=$cur_state?>"><?=$i?></a>
					<? }else{ ?>
					<a><?=$value?></a>
					<? } ?>
				<? } ?>
				<? if($end < $totlepage){ ?>
				...<a href="./?a=video_to_trash&page=<?=$totlepage?>&keyword=<?=$keyword ?>&video_kng_id=<?=$cur_kng_id ?>&video_td_state=<?=$cur_state?>"><?=$totlepage?></a>
				<? } ?>
				<? if($curpage <> $totlepage){ ?>
				<a href="./?a=video_to_trash&page=<?=(int)($curpage + 1)?>&keyword=<?=$keyword ?>&video_kng_id=<?=$cur_kng_id ?>&video_td_state=<?=$cur_state?>">下一页</a>
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
