<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
//set_time_limit(0);
if($member == '')
		$this->error("请登录", $this->web_site . "/login");
$memberinfo = spClass("zx_member")->findBy("member_name", $member);
$member_id = $memberinfo["member_id"];

//print_R($_REQUEST);
$kng_list = '';
$kng_id = 0;
$time_t = '';
if($_REQUEST['kng_set_id']){
    $kng_id = $_REQUEST['kng_set_id'];
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
    //echo $from_date,'=',$to_date;
    $time_t = '从'.$from_date.'到'.$to_date;
    $vid_array =  explode(',', trim($_REQUEST['video_ids'])); 
    $series = array();
    $s_count = 0;
    $serieslint =  array();
    foreach($vid_array as $key => $value){
    	  if($value == '')continue;
    	  $series[$s_count]['name'] = get_vtitle_by_vid($value);
    	  $bk_data= get_m_showdata($member_id,$value,$from_date,$to_date);
    	  $data = array();
    	  $data2 = array();
    	  foreach($bk_data as $bk_key => $bk_value){
    	  	 $data[$bk_key]['ptime'] = $bk_value['avg_u'];
    	  	 $data[$bk_key]['plv'] = $bk_value['avg_s'];
    	  	 $data2[$bk_key]['ptime'] = $bk_value['avg_u'];
    	  }
    	  $series[$s_count]['data'] = $data;
    	  $serieslint[$s_count]['data'] = $data2;
    	  $s_count += 1;
    }
    $color = array('#2f7ed8','#0d233a','#8bbc21','#910000');
}

/***/

$f_month_option = get_month_op($_REQUEST['from_month']);
$t_month_option = get_month_op($_REQUEST['to_month']);
$f_year_option = get_year_op($_REQUEST['from_year']);
$t_year_option = get_year_op($_REQUEST['to_year']);
$f_day_option = get_day_op($_REQUEST['from_day']);
$t_day_option = get_day_op($_REQUEST['to_day']);

/***/

if($kng_id == 0){
    $knowledgedb = spClass("zx_knowledge");
    $rootkng = $knowledgedb->find(array("kng_foot_id" => 0));
    //$childkng = $knowledgedb->find(array("kng_foot_id" => $rootkng["kng_id"]));
    $childkng = $knowledgedb->find(array("kng_foot_id" => $rootkng["kng_id"]));
    $kng_id = $childkng['kng_id'];
}

$kng_list .= get_kng_list_by_ajax($kng_id);

//$examinfo = get_examinfo_by_kng_id2($kng_id,$kng_v_type,$exam_id,$updown);
$video_list = '<option value="0">请选择视频</option>';
$video_list = get_video_list_by_ajax($kng_id,$_REQUEST['video_ids']);

$kng_r = get_kng_by_id($kng_id);
$title_t = $kng_r[0]['kng_title'];

$title = '习题记录回顾 - '.$web_name;
$keywords = '习题记录回顾';
$description = '习题记录回顾';
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
  <link rel="stylesheet" type="text/css" href="css/com.css">
  <link rel="stylesheet" type="text/css" href="css/header.css">
  <link rel="stylesheet" type="text/css" href="css/exam.css">
  <script src="js/jquery-1.9.1.min.js"></script>
  <script src="js/jquery.menu-aim.js"></script>


  <script src="js/com.js"></script>
  <script src="js/exam_log.js"></script>
  <script src="js/highcharts/highcharts.js"></script>
  <script src="js/highcharts/highcharts-more.js"></script>
  <script src="js/highcharts/modules/exporting.js"></script>

<style>
    #page_sub_nav { display: none; }
   
</style>
<script type="text/javascript">
$(function () {
    $('#container').highcharts({
	    chart: {type: 'bubble',zoomType: 'xy'},
	    title: {text: "<?=$title_t?>"}, //索引的二级知识点
		  subtitle:{ text: "<?=$time_t?>" },//索引的时间
		  yAxis:{title:{ text:"平均耗时",rotation: 0,offset:60,},},
		  xAxis:{title:{ text:"做题组数"},},
		  plotOptions:{
		  	bubble:{maxSize: '10%',minSize: '2%',},
			  line:{ showInLegend: false, // 不是主要元素，无需在图例中显示
				       marker: { enabled: false },// 无需显示线段标记
				       states: { hover: { lineWidth: 0 } },
				       enableMouseTracking: false, //无需动画
				       dashStyle: 'Dot'
			  },
		  },
		  tooltip:{
			formatter:function(){
				var s
				s = '正确率' + '<br>' + this.point.z*100 + '%';
				return s
			},
		  },//设计鼠标悬浮后的信息提示
		
	    series: [
	    <? foreach($series as $key => $value){ ?>
	    	{type: 'bubble',name: "<?=$value['name']?>",
			  data:[
			   <? foreach($value['data'] as $key1 => $value1){ ?>
			   	 <?if($key1 != 0){?>,<?}?>
			   	 [<?=($key1+1)?>,<?=$value1['ptime']?>,<?=$value1['plv']?>]
			   <?} ?>
			  ]
	      }, 
	    <?} ?>
	    
	    <? foreach($serieslint as $key => $value){ ?>
	    	<?if($key != 0){?>,<?}?>{type: 'line',color: '<?= $color[$key]?>', 
	      data:[
	          <? foreach($value['data'] as $key1 => $value1){ ?>
	          	<?if($key1 != 0){?>,<?}?>
	          	[<?=($key1+1)?>,<?=$value1['ptime']?>]
	          <?} ?>
	      ],}
	    <?} ?>
	   
	    		],
		// The next default color is '#910000',

	});//end of container.high charts
    
});// end of function

		</script>
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
        	
     <form name="exam_log" id="exam_log" method="post" action="./?a=exam_log" >
     <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  	<tbody>
  	
    <tr class="tdbg"><td>&nbsp;</td><td>&nbsp;</td></tr>
    <tr class="tdbg">
		 	<td   width="12%"  align="right" >知识点：</td>
			<td >
				<select name="kng_set_id" id="kng_set_id" class="simple-input ui-corner-all "><?=$kng_list?></select>
			</td>
		</tr>
		<tr class="tdbg"><td>&nbsp;</td><td>&nbsp;</td></tr>
		 <tr class="tdbg">
		 	<td width="12%" align="right" >关联视频：<input type="hidden" name="video_ids" id="video_ids" value="<?=$_REQUEST['video_ids']?>"/></td>
		 	<td >
		 		<table id="video_list_show">
					<tr>
						<td><?=$video_list?></td>
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
      <td>
      	<input type="button" id="btn_save" name="submit-button" value="确&nbsp;&nbsp;认" class="simple-button ">
      	<!--<input type="button" class="bnt" value="确认" id="btn_save"> -->
      </td>
    </tr>
    <tr class="tdbg">
    	<td colspan="2" >
	      <div id="container" style="height: 400px; min-width: 310px; max-width: 600px; margin: 0 auto"></div>
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