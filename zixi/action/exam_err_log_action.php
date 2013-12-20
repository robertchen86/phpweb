<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';

if($member == '')
	$this->error("请登录", $this->web_site . "/login");
//if(isset($_REQUEST['group_id']) and ($_REQUEST['group_id'] != '')){
if(isset($_REQUEST['group_id'])){
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
	//学生id
	$sql = ' select a.member_id,a.member_name from zx_member a ';
	$sql.= ' left join zx_member_belong b on a.member_id = b.m_belong_s_id ';
	//$sql.= ' left join zx_student c on a.member_student_code=c.student_code ';
	//$sql.=' where a.member_id = b.m_belong_s_id ';
	$sql.=' where a.member_identity_type = 0 ';
	$sql.=' and b.m_belong_t_id = '.$member_id;
	$sql.=' and b.m_belong_g_id like "%,'.$_REQUEST['group_id'].',%"';
	$member_id_list = get_info_by_sql($sql);
	$member_ids = '';
	foreach($member_id_list as $key=> $value){
		if($member_ids != '')$member_ids += ',';
		$member_ids += ''+$value['member_id'];
	}
	
	$sql= ' select i.er_exam_id,i.er_cnt,j.exam_title from (select count(a.er_id) as er_cnt,a.er_exam_id from zx_exam_record a,zx_exam b ';
	$sql.=' where a.er_exam_isdisplay = 0 and a.er_exam_id = b.exam_id ';
	if($from_date != '')
		$sql .= ' and date(a.er_gtime) >= "'.date("Y-m-d",strtotime($from_date)).'"';
	if($to_date != '')
		$sql .= ' and date(a.er_gtime) <=  "'.date("Y-m-d",strtotime($to_date)).'"';
	$sql.=' and a.er_exam_selected <> 1';
	$sql.=' and b.exam_kng_id in ('.substr($_REQUEST['kng_ids'],1).')';
	$sql.=' GROUP BY a.er_exam_id  ) as i' ;
	$sql.= ' left join zx_exam j on i.er_exam_id = j.exam_id ';
	$sql.= ' order by i.er_cnt desc,i.er_exam_id desc ';
	$sql.= ' limit 0,5 ';
	//echo $sql;
	$er_list = get_info_by_sql($sql);
	foreach($er_list as $key => $value){
		$er_list[$key]['exam_title'] = str_replace("mage", "/image",preg_replace('/(src=")([^"]+)(\/.)/is', ' $1' . $web_site . "/files/" . '$2', $value['exam_title']));
	}
	//print_R($result);
}
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

$title = '学生错题统计 - '.$web_name;
$keywords = '学生错题统计';
$description = '学生错题统计';
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
<!--  {literal}
<script type="text/x-mathjax-config">
  MathJax.Hub.Config({
    extensions: ["tex2jax.js"],
    jax: ["input/TeX","output/HTML-CSS"],
    tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
  });
</script>
{/literal}
 	<script src="{$web_site}/mathjax/MathJax.js" ></script>-->


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
           <a href="<?=$web_site?>/exam_err_log">学生错题统计</a>
           
        </div>
    </div>
</div>

    </div></div>
    </div>

    <div class="tutorial-content">
      <div class="layers">
      	<div class="content layer">
      	<div class="answer_time">
        		<h1>学生错题统计</h1>
        </div>
        <form name="exam_log" id="exam_log" method="post" action="./?a=exam_err_log" >
     <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  	<tbody>
  	
    <tr class="tdbg"><td>&nbsp;</td><td>&nbsp;</td></tr>
    <tr class="tdbg">
		 	<td   width="12%"  align="right" >组别：<input type="hidden" name="web_site" id="web_site" value="<?=$web_site?>"/></td>
			<td >
				<select name="group_id" id="group_id" class="simple-input ui-corner-all "><?=$group_list?></select>
			</td>
		</tr>
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
    		<? foreach($er_list as $key=> $value){?>
        	<div class="tutorial-description">
            <div class="progress-stack-view stack"></div>
            <h2 class="title-header">
              <span id="exam_num" itemprop="name" class="title desktop-only">第<?=$value['er_exam_id']?>题(做错数：<?=$value['er_cnt']?>)</span>
              <span id="exam_title" itemprop="name" class="title desktop-only">
              	<?=$value['exam_title']?>
              </span>
            </h2>
            
           </div>
           <? } ?>
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
</body>
</html>