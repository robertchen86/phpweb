<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$video_list = '';
$member_list = '';
$video_list = get_video_list(0); 
$member_list = get_member_list(0);
$video_list = '<option value="">全部</option>'.$video_list; 
$member_list = '<option value="">全部</option>'.$member_list;
/***/
if($_GET['act'] and ($_GET['act'] == 'del')){
	  if($_GET['video_id']){
	 	    del_vcomment_by_id($_GET['vcomment_id']);
	  }
}
if($_POST['act'] and ($_POST['act'] == 'del') and $_POST['check_select']){
	  $keys =  explode(',',$_POST['check_select']);
	  foreach ($keys as $key => $value){
	  	  if($value == '')
	  	      continue;
	 	    del_vcomment_by_id($_POST[$value.'_id']);
	  }
}
/***/
$percount = 10;
$curpage = 1;
$cur_video_id = '';
$cur_member_id = '';
$cur_state = '';
$keyword = $_REQUEST['keyword']; 
if(isset($_REQUEST['page'])){
    $curpage = $_GET['page'];
}
if(isset($_REQUEST['vcomment_video_id']) and ($_REQUEST['vcomment_video_id'] != ''))
    $cur_video_id = $_REQUEST['vcomment_video_id'];
if(isset($_REQUEST['vcomment_member_id']) and ($_REQUEST['vcomment_member_id'] != ''))
    $cur_member_id = $_REQUEST['vcomment_member_id'];
    
$sql = ' select count(a.vcomment_id) as cnt from zx_video_comment a ';
$sql .= ' Left join zx_video b on a.vcomment_video_id = b.video_id ';
$sql .= ' where a.vcomment_id <> 0 ';
$sql .= ' and b.video_isdel = 0 ';
if($cur_video_id != '')
    $sql .= ' and a.vcomment_video_id ='.$cur_video_id;
if($cur_member_id != '')
    $sql .= ' and a.vcomment_member_id ='.$cur_member_id;
if(isset($_REQUEST['keyword']) and ('' != $_REQUEST['keyword'])){
	  if($_REQUEST['key_op'] == 1){
	 	    $sql .= " and a.vcomment_content like '%".$_REQUEST['keyword']."%' ";
	  }
	  if($_REQUEST['key_op'] == 2){
	 	    $sql .= " and a.vcomment_addtime like '%".$_REQUEST['keyword']."%' ";
	  }
}
/*    
if(isset($_REQUEST['video_td_state']) and ($_REQUEST['video_td_state'] != '')){
    $sql .= ' and video_td_state ='.$_REQUEST['video_td_state'];
    $cur_state = $_REQUEST['video_td_state'];
}*/
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
$sql = ' select a.vcomment_id,a.vcomment_content,a.vcomment_addtime,
b.video_title,c.member_name
 from zx_video_comment a ';
$sql .= ' Left join zx_video b on a.vcomment_video_id = b.video_id ';
$sql .= ' Left join zx_member c on a.vcomment_member_id = c.member_id ';
$sql .= ' where a.vcomment_id <> 0 ';
$sql .= ' and b.video_isdel = 0 ';
if($cur_video_id != '')
    $sql .= ' and a.vcomment_video_id ='.$cur_video_id;
if($cur_member_id != '')
    $sql .= ' and a.vcomment_member_id ='.$cur_member_id;
if(isset($_REQUEST['keyword']) and ('' != $_REQUEST['keyword'])){
	  if($_REQUEST['key_op'] == 1){
	 	    $sql .= " and a.vcomment_content like '%".$_REQUEST['keyword']."%' ";
	  }
	  if($_REQUEST['key_op'] == 2){
	 	    $sql .= " and a.vcomment_addtime like '%".$_REQUEST['keyword']."%' ";
	  }
}
$sql.= ' order by a.vcomment_addtime desc ';
$sql.= ' limit ' . (($curpage-1)*$percount) . ',' . $percount;
$result=get_info_by_sql($sql);
//$tuij = array('否','是');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/com.css" rel="stylesheet" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script language="javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/vcomment_manage.js"></script>
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script> 
</head>
<body><!--
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=video_to_trash">视频回收站</a>　┊　<a href="./?a=video_to_manage">视频管理</a></div>-->
<br>

<ul id="innouni_sub_title">
	<li class="sub">留言管理</li>
	<li class="unsub"><a class="hand" onclick="$('#search')[0].style.visibility='inherit'">留言搜索</a></li>
</ul>
<div style="visibility:hidden;position:absolute;margin:0 40 40 170px;*margin:0 0 0 170px;border:1px solid #FCBA72;background:#fff;padding:5px 10px;" id="search">
	<!--<img src="images/close.gif"  style="position:absolute;margin:10px 0 0 612px;cursor:pointer;" onclick="$('#search')[0].style.visibility='hidden'" alt="关闭" />-->
	<form method="post" action="./?a=vcomment_to_manage">视频：<select name="vcomment_video_id" id="vcomment_video_id"><?=$video_list?></select>
		会员：<select name="vcomment_member_id" id="vcomment_member_id"><?=$member_list?></select>
		<select name="key_op" id="key_op">
			<option value="1">关键字</option>
			<option value="2">留言时间</option>
		</select>
		<input name="keyword" id="keyword" class="input" value="" /> <input type="submit" class="bnt01" value="搜索">
		<img src="images/close.gif"  style="margin:10px 0 0 10px;cursor:pointer;" onclick="$('#search')[0].style.visibility='hidden'" alt="关闭"/>
	</form>
	
</div>
<div id="innouni_right_b">
<form action="./?a=vcomment_to_manage&page=<?=$curpage?>&keyword=<?=$keyword ?>&key_op=<?=$key_op ?>&vcomment_video_id=<?=$cur_video_id?>&vcomment_member_id=<?=$cur_member_id?>" method="post" >
  <table border="0" align="center" cellpadding="3" cellspacing="1" class="table_b">
    <tr>
      <td class="title_bg" width="40px" >选择</td>
      <td class="title_bg" width="160px">会员</td>
      <td class="title_bg" width="160px">视频</td>
      <td class="title_bg" >留言内容</td>
			<td class="title_bg" width="160px">留言时间</td>
      <td class="title_bg" width="80px">操作</td>
      <input  type="hidden" name="check_select" id="check_select" value="" />
    </tr>
  <? foreach($result as $key => $value){ ?>
		<tr onmouseover=this.bgColor='#EBFFDC'; onmouseout=this.bgColor='#ffffff';  bgcolor='#ffffff'>
			<td align="center">
				<input type='checkbox' name='checkboxlist'  onclick='checkbox()' value='<?=$key?>' />
				<input type='hidden'  name='<?=$key?>_id' value='<?=$value['vcomment_id']?>' />
			</td>		
			<!--<td align="center">
				 <input type='text'  name='<?=$key?>_sort' id='<?=$key?>_sort'  value='<?=(int)$value['video_sort']?>' style='width:80%' onkeyup='value=value.replace(/[^0-9]/g,\"\") ' onbeforepaste='clipboardData.setData(\"text\",clipboardData.getData(\"text\").replace(/[^0-9]/g,\"\"))'  />
			</td>-->
			<td align="center"><?=$value['member_name']?></td>
			<td><?=$value['video_title']?></td>
			<td ><?=$value['vcomment_content']?></td>
			<td align="center"><?=$value['vcomment_addtime']?></td>
			<td align="center">
				<!--<a href="./?a=video_to_edit&page=<?=$curpage?>&keyword=<?=$keyword ?>&key_op=<?=$key_op ?>&vcomment_video_id=<?=$cur_video_id?>&vcomment_member_id=<?=$cur_member_id?>&video_id=<?=$value['video_id']?>">编辑</a> -->
				<a href="./?a=vcomment_to_manage&page=<?=$curpage?>&keyword=<?=$keyword ?>&key_op=<?=$key_op ?>&vcomment_video_id=<?=$cur_video_id?>&vcomment_member_id=<?=$cur_member_id?>&act=del&vcomment_id=<?=$value['vcomment_id']?>" onclick="return confirm('确定要删除视频留言？');">删除</a>
			</td>
		</tr>
	<? } ?>
		<tr>
			<td colspan="6" class="tdbg" >
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
			<td colspan="6" align="center" class="tdbg">
				<? if($curpage <> 1){ ?>
			
				<a href="./?a=vcomment_to_manage&page=<?=(int)($curpage - 1)?>&keyword=<?=$keyword ?>&key_op=<?=$key_op ?>&vcomment_video_id=<?=$cur_video_id?>&vcomment_member_id=<?=$cur_member_id?>">上一页</a>
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
				<a href="./?a=vcomment_to_manage&page=1&keyword=<?=$keyword ?>&key_op=<?=$key_op ?>&vcomment_video_id=<?=$cur_video_id?>&vcomment_member_id=<?=$cur_member_id?>"><?=1?></a>...
				<? } ?>
				<? for($i = $start; $i <=$end; $i++){ ?>
					<? if($value<>$curpage){ ?>
					<a href="./?a=vcomment_to_manage&page=<?=$i?>&keyword=<?=$keyword ?>&key_op=<?=$key_op ?>&vcomment_video_id=<?=$cur_video_id?>&vcomment_member_id=<?=$cur_member_id?>"><?=$i?></a>
					<? }else{ ?>
					<a><?=$value?></a>
					<? } ?>
				<? } ?>
				<? if($end < $totlepage){ ?>
				...<a href="./?a=vcomment_to_manage&page=<?=$totlepage?>&keyword=<?=$keyword ?>&key_op=<?=$key_op ?>&vcomment_video_id=<?=$cur_video_id?>&vcomment_member_id=<?=$cur_member_id?>"><?=$totlepage?></a>
				<? } ?>
				<? if($curpage <> $totlepage){ ?>
				<a href="./?a=vcomment_to_manage&page=<?=(int)($curpage + 1)?>&keyword=<?=$keyword ?>&key_op=<?=$key_op ?>&vcomment_video_id=<?=$cur_video_id?>&vcomment_member_id=<?=$cur_member_id?>">下一页</a>
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
