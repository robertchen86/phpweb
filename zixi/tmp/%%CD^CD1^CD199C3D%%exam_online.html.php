<?php /* Smarty version 2.6.26, created on 2013-12-17 00:41:51
         compiled from exam_online.html */ ?>
<!DOCTYPE>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
	<title><?php echo $this->_tpl_vars['title']; ?>
</title>
	<meta name="description" content="<?php echo $this->_tpl_vars['description']; ?>
">
  <meta name="keywords" content="<?php echo $this->_tpl_vars['keywords']; ?>
">
  <link rel="shortcut icon" href="<?php echo $this->_tpl_vars['web_site']; ?>
/images/favicon.ico">
  <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['web_site']; ?>
/css/com.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['web_site']; ?>
/css/header.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['web_site']; ?>
/css/exam.css">
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/jquery-1.3.2.min.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/jquery.menu-aim.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/com.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/exam_online.js"></script>
 
 <?php echo '
<style>
    #page_sub_nav { display: none; }
    .selectbox{-webkit-appearance:checkbox; margin:0 10px 0 0;}
    .blackcolor{color:black;}
    .answer_list{color:black;}
    .answer_list_one{margin:10px 10px 10px 10px; height:30px;}
    .answer_list_end{height:30px;}
    
    .answer_time{
    	text-align:center;
    }
    
		.answer_action{
		
		}

		.answer_action_left{
			float:left;
			color:black;
			margin:0 0 0 100px;
		}
		.answer_action_left input{
			width:21px;
		}
		
		.answer_action_right{
			float:right;
			margin:0 200px 0 0;
		}
		.answer_action_right img{
			margin:0 0 0 30px;
		}
		.div_center{margin:0 auto;}
		
</style>
'; ?>


</head>
<!--[if lt IE 7]>  <body class="ie ie6 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 7]>     <body class="ie ie7 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 8]>     <body class="ie ie8 lte9 lte8"> <![endif]-->
<!--[if IE 9]>     <body class="ie ie9 lte9"> <![endif]-->
<!--[if gt IE 9]>  <body  > <![endif]-->
<!--[if !IE]>
<!--> <body data-twttr-rendered="true"  ><!--<![endif]-->
<div id="outer-wrapper" class="clearfix new-header">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
           <a href="<?php echo $this->_tpl_vars['web_site']; ?>
/kng/<?php echo $this->_tpl_vars['footKngId']; ?>
/<?php echo $this->_tpl_vars['twoKngId']; ?>
">试题进度</a>
           
        </div>
    </div>
</div>

<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;">
	<div class="topic-nav-content math" data-khan-scroll="true" style="overflow: hidden; width: auto; height: auto;">
    <ol class="core">
      
        <li id="v/basic-addition" class="tutorial-nav-node video-node">
					<a class="tutorial-router-link tab-link  progress-container clearfix">
						<div class="subway-icon v23798">
							<div class="pipe"></div>
							<div class="pipe completed"></div>
							<div class="status <?php if ($this->_tpl_vars['videoitem']['video_id'] == $this->_tpl_vars['videoId']): ?>v23798<?php endif; ?> video-node">
							</div>
						</div>
				
						<span class="progress-title">测试中请勿刷新</span>
					</a>
				</li>
				<li id="v/basic-addition" class="tutorial-nav-node video-node">
					<a class="tutorial-router-link tab-link  progress-container clearfix">
						<div class="subway-icon v23798">
							<div class="pipe"></div>
							<div class="pipe completed"></div>
							<div class="status <?php if ($this->_tpl_vars['videoitem']['video_id'] == $this->_tpl_vars['videoId']): ?>v23798<?php endif; ?> video-node">
							</div>
						</div>
				
						<span class="progress-title">当前进度：<span class="current_exam">1</span>&nbsp;/&nbsp;<span><?php echo $this->_tpl_vars['maxcount']; ?>
</span></span>
					</a>
				</li>
    
    </ol>
</div><div class="slimScrollBar ui-draggable" style="background-color: rgb(102, 102, 102); width: 8px; position: absolute; top: 0px; opacity: 0.4; display: none; border-top-left-radius: 8px; border-top-right-radius: 8px; border-bottom-right-radius: 8px; border-bottom-left-radius: 8px; z-index: 99; right: 5px; height: 453px;"></div><div class="slimScrollRail" style="width: 8px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 8px; border-top-right-radius: 8px; border-bottom-right-radius: 8px; border-bottom-left-radius: 8px; background-color: rgb(51, 51, 51); opacity: 0.3; z-index: 90; right: 5px; background-position: initial initial; background-repeat: initial initial;"></div><div class="shadow"><img src="./nei4_files/round-shadow.png" style="top: -10px;"></div><div class="shadow bottom"><img src="./nei4_files/round-shadow-bottom.png" style="bottom: -10px; top: auto;"></div><div class="shadow"><img src="/images/round-shadow.png" style="top: -10px;"></div><div class="shadow bottom"><img src="/images/round-shadow-bottom.png" style="bottom: 0px; top: auto;"></div></div>
    </div></div>
    </div>

    <div class="tutorial-content">
      <div class="layers">
        <div class="content layer">
        	<div class="answer_time">
        		<h1>答题倒计时：<?php echo $this->_tpl_vars['timemax']; ?>
</h1>
        	</div>
          <div class="tutorial-description">
            <div class="progress-stack-view stack"></div>
            <h2 class="title-header">
            	<span id="exam_num" itemprop="name" class="title desktop-only">第<?php echo $this->_tpl_vars['exam_num']; ?>
题：</span>
              <span id="exam_title" itemprop="name" class="title desktop-only">
              	<?php echo $this->_tpl_vars['exam_title']; ?>

              </span>
              <input type="hidden" id="g_time" value="<?php echo $this->_tpl_vars['exam_g_time']; ?>
"/>
              <input type="hidden" id="exam_id" value="<?php echo $this->_tpl_vars['exam_id']; ?>
"/>
              <input type="hidden" id="exam_number" value="<?php echo $this->_tpl_vars['exam_num']; ?>
"/>
              <input type="hidden" id="exam_ids" value="<?php echo $this->_tpl_vars['exam_ids']; ?>
"/>
              <input type="hidden" id="timemax" value="<?php echo $this->_tpl_vars['timemax']; ?>
"/>
              <input type="hidden" id="web_site" value="<?php echo $this->_tpl_vars['web_site']; ?>
"/>
              
            </h2>
          </div>
          <!--<div class="answer_list">
          	<?php echo $this->_tpl_vars['current_exam']['exam_answer']; ?>

          </div>-->
          <div class="answer_action">
          	<div class="answer_action_left">答案：<input type="radio" name="answerss" value="A"/>A&nbsp;&nbsp;&nbsp;<input type="radio" name="answerss" value="B"/>B&nbsp;&nbsp;&nbsp;<input type="radio" name="answerss" value="C"/>C&nbsp;&nbsp;&nbsp;<input type="radio" name="answerss" value="D"/>D</div>
          	<div class="answer_action_right">
          		<!--  <input type="button" value=" 放 弃 " id="btn_giveup" /><input type="button" value=" 下一题 " id="btn_next"/>-->
          		<input type="button" value=" 蒙一个 " id="btn_giveup" /><input type="button" value=" 下一题 " id="btn_next"/>
          	</div>
          </div>
          <div class="answer_list_end"></div>
        </div>
        <!--
        <div class="content layer">
          <div class="tutorial-description">
            <div class="progress-stack-view stack"></div>
            <h2 class="title-header">
              <span id="exam_title_end" itemprop="name" class="title desktop-only">
              	您已完成5道题，答对5道，答错0道！
              </span>
            </h2>
          </div>
          <div class="answer_list_end"></div>
        </div>
        
        <div class="content layer">
          <div class="tutorial-description">
            <div class="progress-stack-view stack"></div>
            
            <h2 class="title-header">
              <span id="exam_title_end" itemprop="name" class="title desktop-only">
              	<center>
              	<img src="<?php echo $this->_tpl_vars['web_site']; ?>
/images/xiao.jpg" /><br/>
              	你答对了！
              	</center>
              </span>
              
            </h2>
          </div>
          <div class="answer_list_end"></div>
        </div>
            
        <div class="content layer">
          <div class="tutorial-description">
            <div class="progress-stack-view stack"></div>
            
            <h2 class="title-header">
              <span id="exam_title_end" itemprop="name" class="title desktop-only">
              	<center>
              	<img src="<?php echo $this->_tpl_vars['web_site']; ?>
/images/ku.jpg" /><br/>
              	你答错了！
              </span>
              </center>
            </h2>
          
          </div>
          <div class="answer_list_end"></div>
        </div>-->
        </div>
    </div>
</article>

            <div id="end-of-page-spacer">&nbsp;</div>

    </div>
    </div>
<!--neirong end-->

</div>
<div class="push"></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!-- zixi.org.cn Baidu tongji analytics
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F373a5160f96b2e16d6ffc7ced7340f47' type='text/javascript'%3E%3C/script%3E"));
</script> -->
</body>
</html>