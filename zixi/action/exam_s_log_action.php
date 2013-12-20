<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
//set_time_limit(0);

if($member == '')
		$this->error("请登录", $this->web_site . "/login");
//$kng_id == 0;		
if(isset($_REQUEST['group_id']) and ($_REQUEST['group_id'] != '')){
	  //$kng_id = $_REQUEST['kng_set_id'];
	$from_date = '';
    $to_date = '';
    if($_REQUEST['from_year']){
    	  $from_date = $_REQUEST['from_year'];
    	  $from_date .='-'.(($_REQUEST['from_month'])?$_REQUEST['from_month']:1);
    	  $from_date .='-'.(($_REQUEST['from_day'])?$_REQUEST['from_day']:1);
    }
    if($_REQUEST['to_year']){
    	  $to_date = $_REQUEST['to_year'];
    	  $to_date .='-'.(($_REQUEST['to_month'])?$_REQUEST['to_month']:12);
    	  $to_date .='-'.(($_REQUEST['to_day'])?$_REQUEST['to_day']:31);
    }
    $all_array =array();
    $kngid_array =  explode(',', trim($_REQUEST['kng_ids'])); 
    $sql = ' select kng_id,kng_title from zx_knowledge ';
    $sql.= ' where kng_id in ('.substr($_REQUEST['kng_ids'],1).')';
    $kng_list = get_info_by_sql($sql);
    //学生id
    $sql = ' select a.member_id,a.member_name,c.student_name from zx_member a ';
    $sql.= ' left join zx_member_belong b on a.member_id = b.m_belong_s_id ';
    $sql.= ' left join zx_student c on a.member_student_code=c.student_code ';
    //$sql.=' where a.member_id = b.m_belong_s_id ';
    $sql.=' where a.member_identity_type = 0 ';
    $sql.=' and b.m_belong_t_id = '.$member_id;
    $sql.=' and b.m_belong_g_id like "%,'.$_REQUEST['group_id'].',%"';
    $member_id_list = get_info_by_sql($sql);
    $m_ids = array();
    $tmp_array =array();
    $tmp_array = init_array_formap($kng_list);
    foreach($member_id_list as $key=> $value){
    	  $m_ids[] = $value['member_id'];
    	  //初始化学生数据
    	  $tmp_array = init_array_formap($kng_list);
    	  $tmp_array['name'] = $value['member_name'];
    	  if($value['student_name'])$tmp_array['name'] = $value['student_name'];
    	  $all_array[$value['member_id']] = $tmp_array;
    }
    // print_r($m_ids);  
    
    $all_array1 = $all_array;
    $all_array2 = $all_array;
    
    $tmp_array =array();
    $tmp_array = init_array_formap($kng_list);
   // $sql.= ' left join zx_student c on a.member_student_code=c.student_code ';
    $sql= ' select count(a.er_id) as cnt,a.er_member_id,b.exam_kng_id,c.kng_title,d.member_name,e.student_name from zx_exam_record a,zx_exam b,zx_knowledge c ,zx_member d,zx_student e ';
    $sql.=' where a.er_exam_id = b.exam_id and d.member_id = a.er_member_id and c.kng_id = b.exam_kng_id and d.member_student_code=e.student_code and a.er_exam_isdisplay = 0 ';
    if($from_date != '')
	      $sql .= ' and date(a.er_gtime) >= "'.date("Y-m-d",strtotime($from_date)).'"';
    if($to_date != '')
	      $sql .= ' and date(a.er_gtime) <=  "'.date("Y-m-d",strtotime($to_date)).'"';
	  $sql.=' and a.er_exam_selected <> -1 ';
	  $sql.= ' and b.exam_kng_id in ('.substr($_REQUEST['kng_ids'],1).')';
	  $sql.=' GROUP BY b.exam_kng_id,a.er_member_id  ' ;
	  $sql.= ' order by a.er_member_id desc ,b.exam_kng_id ';
	  //echo $sql;
	  $result = get_info_by_sql($sql);
	  $tmp_array2 =array();
	  foreach($result as $key=> $value){
	  	  //$tmp_array =array();
	  	 
	  	 // echo 
	  	  if(!in_array($value['er_member_id'],$m_ids))continue;
	  	  $tmp_name = $value['member_name'];
	  	  if($value['student_name'])$tmp_name = $value['student_name'] ;
	  	  //echo '11';
	  	  if($tmp_array['name'] == ''){
	  	  	  $tmp_array['name'] = $tmp_name;
	  	  	  
	  	  	  $tmp_array2['id'] = $value['er_member_id'];
	  	  	  $tmp_array[$value['kng_title']] = $value['cnt'];
	  	  }else{
	  	  	  if($tmp_array['name'] == $tmp_name){
	  	  	  	  $tmp_array[$value['kng_title']] = $value['cnt'];
	  	  	  }else{
	  	  	  	  $all_array1[$tmp_array2['id']] = $tmp_array;
	  	  	  	  $tmp_array = init_array_formap($kng_list);
	  	  	  	  $tmp_array['name'] = $tmp_name;
	  	  	  	  $tmp_array2['id'] = $value['er_member_id'];
	  	  	      $tmp_array[$value['kng_title']] = $value['cnt'];
	  	  		}
	  	  }
	  }
	  $all_array1[$tmp_array2['id']] = $tmp_array;
	  
	  $tmp_array = init_array_formap($kng_list);
    $sql= ' select count(a.er_id) as cnt,a.er_member_id,b.exam_kng_id,c.kng_title,d.member_name,e.student_name from zx_exam_record a,zx_exam b,zx_knowledge c ,zx_member d ,zx_student e';
    $sql.=' where a.er_exam_id = b.exam_id and d.member_id = a.er_member_id and c.kng_id = b.exam_kng_id  and d.member_student_code=e.student_code and a.er_exam_isdisplay = 0';
    if($from_date != '')
	      $sql .= ' and date(a.er_gtime) >= "'.date("Y-m-d",strtotime($from_date)).'"';
    if($to_date != '')
	      $sql .= ' and date(a.er_gtime) <=  "'.date("Y-m-d",strtotime($to_date)).'"';
	  $sql.=' and a.er_exam_selected = 1 ';
	  $sql.= ' and b.exam_kng_id in ('.substr($_REQUEST['kng_ids'],1).')';
	  $sql.=' GROUP BY b.exam_kng_id,a.er_member_id  ' ;
	  $sql.= ' order by a.er_member_id desc ,b.exam_kng_id ';
	  $result = get_info_by_sql($sql);
	  //$all_array2 =array();
	  $tmp_array2 =array();
	  foreach($result as $key=> $value){
	  	  if(!in_array($value['er_member_id'],$m_ids))continue;
	  	   $tmp_name = $value['member_name'];
	  	  if($value['student_name'])$tmp_name = $value['student_name'] ;
	  	  if($tmp_array['name'] == ''){
	  	  	  $tmp_array['name'] = $tmp_name;
	  	  	  $tmp_array2['id'] = $value['er_member_id'];
	  	  	  $tmp_array[$value['kng_title']] = $value['cnt'];
	  	  }else{
	  	  	  if($tmp_array['name'] == $tmp_name){
	  	  	  	  $tmp_array[$value['kng_title']] = $value['cnt'];
	  	  	  }else{
	  	  	  	  $all_array2[$tmp_array2['id']] = $tmp_array;
	  	  	  	  $tmp_array = init_array_formap($kng_list);
	  	  	  	  $tmp_array['name'] = $tmp_name;
	  	  	  	  $tmp_array2['id'] = $value['er_member_id'];
	  	  	      $tmp_array[$value['kng_title']] = $value['cnt'];
	  	  		}
	  	  }
	  }
	  $all_array2[$tmp_array2['id']] = $tmp_array;
	  //zai hua
	  $source =array();
	  $source1 =array();
	  foreach($all_array1 as $key=> $value){
	  	  $source[] =  $value;
	  }
	  foreach($all_array2 as $key=> $value){
	  	   $source1[] =  $value;
	  }
	  
}
//print_r($source);
//print_r($source1);

$sql = ' select m_group_id,m_group_name from zx_member_group';
$sql.= '  where m_group_t_id ='.$member_id;
$result = get_info_by_sql($sql);
$group_list = '';
 $group_list .= '<option value="0" ' .($_REQUEST['group_id'] == 0 ? " selected" : "") .' >未分组</option>';
foreach($result as $key => $value){
	 $group_list .= '<option value="'.$value['m_group_id'].'" ' .($_REQUEST['group_id'] == $value['m_group_id'] ? " selected" : "") .' >'.$value['m_group_name'].'</option>';
}
//$this->group_list = $group_list;
//$member_id 老师 kng_id
$sql = ' select member_id,member_kng_id from zx_member';
$sql.= '  where member_id ='.$member_id;
$result = get_info_by_sql($sql);
$member_kng_id = $result[0]['member_kng_id'];

$kng_list = get_kng_list_by_ajax2($member_kng_id,$_REQUEST['kng_ids']);

/***/

$f_month_option = get_month_op($_REQUEST['from_month']);
$t_month_option = get_month_op($_REQUEST['to_month']);
$f_year_option = get_year_op($_REQUEST['from_year']);
$t_year_option = get_year_op($_REQUEST['to_year']);
$f_day_option = get_day_op($_REQUEST['from_day']);
$t_day_option = get_day_op($_REQUEST['to_day']);






/*
$source = array(
array('name'=> '史雯', '排列组合'=> 47, '概率'=> 5, '统计'=>  0,'集合'=>  1),
array('name'=> '江奕朴', '排列组合'=> 26, '概率'=> 13, '统计'=> 3,'集合'=>  7),
array('name'=> '林小猜', '排列组合'=> 61, '概率'=> 29, '统计'=> 7,'集合'=>  41),
array('name'=> '朱柯庆', '排列组合'=> 81, '概率'=> 63, '统计'=> 16,'集合'=>  13),
array('name'=> '马君奕', '排列组合'=> 12, '概率'=> 28, '统计'=> 0,'集合'=>  61),
array('name'=> '潘德瀛', '排列组合'=> 9, '概率'=> 0, '统计'=> 0,'集合'=>  20),
array('name'=> '沈瞳', '排列组合'=> 45, '概率'=> 0, '统计'=> 0,'集合'=>  30),
array('name'=> '赵东阳', '排列组合'=> 5, '概率'=> 0, '统计'=> 0,'集合'=>  10),
array('name'=> '龚涵', '排列组合'=> 20, '概率'=> 10, '统计'=> 6,'集合'=>  1),
array('name'=> '方辰月', '排列组合'=> 18, '概率'=> 16, '统计'=> 7,'集合'=>  0),
array('name'=> '卢寅杰', '排列组合'=> 37, '概率'=> 0, '统计'=> 12,'集合'=>  90),
);
$source1 = array(
array('name'=> '史雯', '排列组合'=> 6, '概率'=> 2, '统计'=> 0,'集合'=>  0),
array('name'=> '江奕朴', '排列组合'=> 9, '概率'=> 4, '统计'=> 3,'集合'=>  6),
array('name'=> '林小猜', '排列组合'=> 20, '概率'=> 20, '统计'=> 7,'集合'=>  20),
array('name'=> '朱柯庆', '排列组合'=> 25, '概率'=> 37, '统计'=> 13,'集合'=>  10),
array('name'=> '马君奕', '排列组合'=> 4, '概率'=> 12, '统计'=> 0,'集合'=>  21),
array('name'=> '潘德瀛', '排列组合'=> 0, '概率'=> 0, '统计'=> 0,'集合'=>  15),
array('name'=> '沈瞳', '排列组合'=> 12, '概率'=> 0, '统计'=> 0,'集合'=>  10),
array('name'=> '赵东阳', '排列组合'=> 1, '概率'=> 0, '统计'=> 0,'集合'=>  10),
array('name'=> '龚涵', '排列组合'=> 10, '概率'=> 4, '统计'=> 2,'集合'=>  0),
array('name'=> '方辰月', '排列组合'=> 6, '概率'=> 13, '统计'=> 6,'集合'=>  0),
array('name'=> '卢寅杰', '排列组合'=> 13, '概率'=> 0, '统计'=> 9,'集合'=>  45),

);*/

$title = '学生习题记录回顾 - '.$web_name;
$keywords = '学生习题记录回顾';
$description = '学生习题记录回顾';
?>
<!DOCTYPE>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
	<title><?=$title?></title>
	<meta name="description" content="<?=$description?>">
  <meta name="keywords" content="<?=$keywords?>">
  <link rel="shortcut icon" href="<?=$web_site?>/images/favicon.ico">
  <link rel="stylesheet" type="text/css" href="<?=$web_site?>/css/com.css">
  <link rel="stylesheet" type="text/css" href="<?=$web_site?>/css/header.css">
  <link rel="stylesheet" type="text/css" href="<?=$web_site?>/css/exam.css">
  <script src="<?=$web_site?>/js/jquery-1.3.2.min.js"></script>
  <script src="<?=$web_site?>/js/jquery.menu-aim.js"></script>
  <script src="<?=$web_site?>/js/com.js"></script>
  <script src="<?=$web_site?>/js/exam_s_log.js"></script>
 <!-- <script type="text/javascript" src="<?=$web_site?>/js/jquery-1.7.1.min.js"></script>-->
  <script type="text/javascript" src="<?=$web_site?>/js/matrix/deps/raphael.js"></script>
  <script type="text/javascript" src="<?=$web_site?>/js/matrix/deps/underscore-min.js"></script>
  <script type="text/javascript" src="<?=$web_site?>/js/matrix/matrix.js"></script>
  <script type="text/javascript" src="<?=$web_site?>/js/matrix/floatTag.js"></script>

<style>
    #page_sub_nav { display: none; }
</style>

</head>
<!--[if lt IE 7]>  <body class="ie ie6 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 7]>     <body class="ie ie7 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 8]>     <body class="ie ie8 lte9 lte8"> <![endif]-->
<!--[if IE 9]>     <body class="ie ie9 lte9"> <![endif]-->
<!--[if gt IE 9]>  <body  > <![endif]-->
<!--[if !IE]>
<!--> <body data-twttr-rendered="true"  ><!--<![endif]-->

<div id="outer-wrapper" class="clearfix new-header">
<?=require 'header.php';?>
<!--{include file="header.html"}
-->


<!--内容-->
<div id="page-container">
    <div id="page-container-inner">

<article id="tutorial-page">
    <div class="tutorial-nav docked-nav" data-khan-nav="true">
    	<div class="nav-container affix-top">
    		<div class="nav-container affix-top">
<div class="topic-nav-header math">
    <div class="crumbs">
        <div class="subject subject-color">
           <a href="">习题记录回顾</a>
        </div>
    </div>
</div>

<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;">
	
<div class="slimScrollBar ui-draggable" style="background-color: rgb(102, 102, 102); width: 8px; position: absolute; top: 0px; opacity: 0.4; display: none; border-top-left-radius: 8px; border-top-right-radius: 8px; border-bottom-right-radius: 8px; border-bottom-left-radius: 8px; z-index: 99; right: 5px; height: 453px;"></div><div class="slimScrollRail" style="width: 8px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 8px; border-top-right-radius: 8px; border-bottom-right-radius: 8px; border-bottom-left-radius: 8px; background-color: rgb(51, 51, 51); opacity: 0.3; z-index: 90; right: 5px; background-position: initial initial; background-repeat: initial initial;"></div><div class="shadow"><img src="./nei4_files/round-shadow.png" style="top: -10px;"></div><div class="shadow bottom"><img src="./nei4_files/round-shadow-bottom.png" style="bottom: -10px; top: auto;"></div><div class="shadow"><img src="/images/round-shadow.png" style="top: -10px;"></div><div class="shadow bottom"><img src="/images/round-shadow-bottom.png" style="bottom: 0px; top: auto;"></div></div>
</div></div>
    </div>

    <!--主内容-->
    <div class="tutorial-content">
      <div class="layers">
        <div class="content layer">
        	<div class="answer_time">
        		<h1>习题记录回顾</h1>
        	</div>
        	
     <form name="exam_log" id="exam_log" method="post" action="./?a=exam_s_log" >
     <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  	<tbody>
  	
    <tr class="tdbg"><td>&nbsp;</td><td>&nbsp;</td></tr>
    <tr class="tdbg">
		 	<td   width="12%"  align="right" >组别：<input type="hidden" name="web_site" id="web_site" value="<?=$web_site?>"/></td>
			<td >
				<select name="group_id" id="group_id" class="simple-input ui-corner-all "><?=$group_list?></select>
			</td>
		</tr>
	<!--	<tr class="tdbg"><td>&nbsp;</td><td>&nbsp;</td></tr>
    <tr class="tdbg">
		 	<td   width="12%"  align="right" >知识点：</td>
			<td >
				<select name="kng_set_id" id="kng_set_id" class="simple-input ui-corner-all "><?=$kng_list?></select>
			</td>
		</tr>-->
		<tr class="tdbg"><td>&nbsp;</td><td>&nbsp;</td></tr>
		 <tr class="tdbg">
		 	<td width="12%" align="right" >知识点：<input type="hidden" name="kng_ids" id="kng_ids" value="<?=$_REQUEST['kng_ids']?>"/></td>
		 	<td >
		 		<table id="kng_list_show">
					<tr>
						<td><?=$kng_list?></td>
					</tr>
				</table>
		 	</td>
		</tr>
		<tr class="tdbg"><td>&nbsp;</td><td>&nbsp;</td></tr>
		<tr class="tdbg">
		 	<td width="12%"  align="right">日期：</td>
			<td >
				<select class="simple-input ui-corner-all" style="width:60px;" id='from_year' name='from_year'><?=$f_year_option?></select>
				<select class="simple-input ui-corner-all" style="width:60px;" id='from_month' name='from_month'><?=$f_month_option?></select>
				<select class="simple-input ui-corner-all" style="width:60px;" id='from_day' name='from_day'><?=$f_day_option?></select>
				至
				<select class="simple-input ui-corner-all" style="width:60px;" id='to_year' name='to_year'><?=$t_year_option?></select>
				<select class="simple-input ui-corner-all" style="width:60px;" id='to_month' name='to_month'><?=$t_month_option?></select>
				<select class="simple-input ui-corner-all" style="width:60px;" id='to_day' name='to_day'><?=$t_day_option?></select>
			</td>
		</tr>
    <tr class="tdbg"><td>&nbsp;</td><td>&nbsp;</td></tr>
    <tr class="tdbg">
	  <td>&nbsp;</td>
      <td><input type="button" class="bnt" value="确认" id="btn_save"> 
      </td>
    </tr>
    <tr class="tdbg">
    	<td colspan="2" >
    		<div id='chart'></div>
	      <script type="text/javascript">
      var matrix = new Chart.Matrix("chart", {});

      var source = [
       <? foreach($source as $key => $value){ ?>
       	<?if($key != 0){?>,<?}?>
       	{<? foreach($value as $key_v => $value_v){ ?>
       		'<?=$key_v?>': '<?=$value_v?>',
       	<?} ?>}
      <?} ?>
      ];
      var source1 = [
        <? foreach($source1 as $key => $value){ ?>
       	<?if($key != 0){?>,<?}?>
       	{<? foreach($value as $key_v => $value_v){ ?>
       		'<?=$key_v?>': '<?=$value_v?>',
       	<?} ?>}
      <?} ?>
       
      ];
      matrix.setSource(source, source1);
      matrix.render();
    </script>
	    </td>
	  </tr>
  </tbody>
  </table>
        </form>
          <div class="answer_list_end"></div>
        </div>
        
        
        </div>
    </div>
</article>

    <div id="end-of-page-spacer">&nbsp;</div>

    </div>
 </div>
<!--neirong end-->
</div>
<div class="push"></div>
<?=require 'footer.php';?>
<!--{include file="footer.html"}-->
</body>
</html>