<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
/***/
$percount = 15;
$curpage = 1;
$kng_id = 0;
//$keyword = $_REQUEST['keyword'];
if(isset($_REQUEST['page'])){
    $curpage = $_GET['page'];}
if(isset($_REQUEST['kng_id']))
    $kng_id = $_REQUEST['kng_id'];
/*
$sql = ' select a.video_id,a.video_title,a.video_tags,a.video_itemCode,
    a.video_isrecommend,a.video_sort,a.video_td_state,a.video_pubDate,a.video_uptime,
    b.kng_title,b.kng_id,a.video_addtime
    from zx_video a ';
$sql .= ' Left join zx_knowledge b on a.video_kng_id = b.kng_id ';*/
    
    
    
$sql = ' select count(video_id) as cnt from zx_video ';
$sql.= ' where video_kng_id ='.$kng_id;
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

$sql = ' select a.video_id,a.video_title,a.video_itemCode,c.kng_title from zx_video a ';
/*$sql.= ' LEFT JOIN (select exam_video_id, count(exam_id) as ex_count  from zx_exam
     group by exam_video_id
    )  b ON b.exam_video_id = a.video_id
    ';*/
$sql .= ' Left join zx_knowledge c on a.video_kng_id = c.kng_id ';
$sql.= ' where a.video_kng_id='.$kng_id;
$sql.= ' order by a.video_sort <> 0 desc,a.video_sort asc ';
$sql.= ' limit ' . (($curpage-1)*$percount) . ',' . $percount;
//echo $sql;
$result=get_info_by_sql($sql);
foreach($result as $key => $value){
	$sql = ' select count(exam_id) as ex_count  from zx_exam where exam_video_id like ",%'.$value['video_id'].'%,"';
	$result_t=get_info_by_sql($sql);
	$result[$key]['ex_count']=$result_t[0]['ex_count'];
}
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
<!--
<script type="text/javascript" src="js/kng_manage.js"></script>-->
<script type="text/javascript">
    if (window.location.href == window.parent.location.href) window.location.href = "./";
</script> 
</head>
<body>
<!--
<div class="innouni_notice"><span>管理操作：</span><a href="./?a=kng_to_add">添加知识点</a>　┊　<a href="./?a=kng_to_manage">知识点管理</a></div>-->
<br>

<ul id="innouni_sub_title">
	<li class="sub">知识点管理</li>
	
</ul>
<div id="innouni_right_b">
<form action="./?a=kng_to_view&page=<?=$curpage?>&kng_id=<?=$kng_id?>" method="post" >
  <table border="0" align="center" cellpadding="3" cellspacing="1" class="table_b">
    <tr>
      
      <td class="title_bg" width="60px" >序号</td>
      <td class="title_bg" width="100px" >视频编码</td>
      <td class="title_bg" >视频标题</td>
      <td class="title_bg"  width="60px" >习题数</td>
      <td class="title_bg" >知识点</td>

      
      <input  type="hidden" name="check_select" id="check_select" value="" />
    </tr>
  <? foreach($result as $key => $value){ ?>
		<tr onmouseover=this.bgColor='#EBFFDC'; onmouseout=this.bgColor='#ffffff';  bgcolor='#ffffff'>
			<td align="center"><?=$key?></td>
            <td align="center"><?=$value['video_itemCode']?></td>
            <td align="center"><?=$value['video_title']?></td>
            <td align="center"><?if($value['ex_count']==''){echo 0;}else{echo $value['ex_count'];}?></td>
            <td align="center"><?=$value['kng_title']?></td>
      </tr>
	<? } ?>
		  <? if ($totlepage > 1){ ?>
    <tr>
			<td colspan="5" align="center" class="tdbg">
				<? if($curpage <> 1){ ?>
				<a href="./?a=kng_to_view&page=<?=(int)($curpage - 1)?>&kng_foot_id=<?=$cur_root_id?>">上一页</a>
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
				<a href="./?a=kng_to_view&page=1&kng_id=<?=$kng_id?>"><?=1?></a>...
				<? } ?>
				<? for($i = $start; $i <=$end; $i++){ ?>
					<? if($value<>$curpage){ ?>
					<a href="./?a=kng_to_view&page=<?=$i?>&kng_id=<?=$kng_id?>"><?=$i?></a>
					<? }else{ ?>
					<a><?=$value?></a>
					<? } ?>
				<? } ?>
				<? if($end < $totlepage){ ?>
				...<a href="./?a=kng_to_view&page=<?=$totlepage?>&kng_id=<?=$kng_id?>"><?=$totlepage?></a>
				<? } ?>
				<? if($curpage <> $totlepage){ ?>
				<a href="./?a=kng_to_view&page=<?=(int)($curpage + 1)?>&kng_id=<?=$kng_id?>">下一页</a>
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
