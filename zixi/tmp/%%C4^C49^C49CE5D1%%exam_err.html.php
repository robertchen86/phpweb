<?php /* Smarty version 2.6.26, created on 2013-12-15 20:02:48
         compiled from exam_err.html */ ?>
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
/js/jquery-1.9.1.min.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/jquery.menu-aim.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/com.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/exam_err.js"></script>


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
           <a href="">错题查看</a>
        </div>
    </div>
</div>

<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;">
	<!--
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
				
						<span class="progress-title">当前进度：<span class="current_exam">1</span>&nbsp;/&nbsp;<span><?php echo $this->_tpl_vars['examcount']; ?>
</span></span>
					</a>
				</li>
    
    </ol>

    
</div>-->
<div class="slimScrollBar ui-draggable" style="background-color: rgb(102, 102, 102); width: 8px; position: absolute; top: 0px; opacity: 0.4; display: none; border-top-left-radius: 8px; border-top-right-radius: 8px; border-bottom-right-radius: 8px; border-bottom-left-radius: 8px; z-index: 99; right: 5px; height: 453px;"></div><div class="slimScrollRail" style="width: 8px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 8px; border-top-right-radius: 8px; border-bottom-right-radius: 8px; border-bottom-left-radius: 8px; background-color: rgb(51, 51, 51); opacity: 0.3; z-index: 90; right: 5px; background-position: initial initial; background-repeat: initial initial;"></div><div class="shadow"><img src="./nei4_files/round-shadow.png" style="top: -10px;"></div><div class="shadow bottom"><img src="./nei4_files/round-shadow-bottom.png" style="bottom: -10px; top: auto;"></div><div class="shadow"><img src="/images/round-shadow.png" style="top: -10px;"></div><div class="shadow bottom"><img src="/images/round-shadow-bottom.png" style="bottom: 0px; top: auto;"></div></div>
</div></div>
    </div>

    <div class="tutorial-content">
      <div class="layers">
        <div class="content layer">
        	<div class="answer_time">
        		<h1>总共错题：<?php echo $this->_tpl_vars['err_count']; ?>
</h1>
        	</div>
        	<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  
  	
  	<tr class="tdbg"><td>&nbsp;</td><td>&nbsp;</td></tr>
  	<tr class="tdbg">
  		<td width="12%" align="right" >所属知识点：<input type="hidden" id="member_id" value="<?php echo $this->_tpl_vars['member_id']; ?>
"><input type="hidden" id="exam_id" value="<?php echo $this->_tpl_vars['exam_id']; ?>
">
  		    <input type="hidden" id="er_id" value="<?php echo $this->_tpl_vars['er_id']; ?>
">
  			</td>
  		<td><select id="kng_s_id"><?php echo $this->_tpl_vars['kng_list']; ?>
</select><input id="err_time" name="err_time" value="<?php echo $this->_tpl_vars['f_er_time']; ?>
" type="hidden"/></td>
  	</tr>
  	 <tr class="tdbg"><td>&nbsp;</td><td>&nbsp;</td></tr>
  	<tr class="tdbg">
  		<td width="12%" align="right" >相关视频：</td>
  		<td><select id="video_s_id"><?php echo $this->_tpl_vars['video_list']; ?>
</select></td>
  	</tr>
  	 <tr class="tdbg"><td>&nbsp;</td><td>&nbsp;</td></tr>
  	<tr class="tdbg">
      <td width="12%" align="right" >试题题目：</td>
      <td border=1>
      	<!--<textarea name="exam_title" id="exam_title" class="ke-textarea" style="height: 280px;width:680px"></textarea>-->
      	<span class="exam_title" id="exam_title"><?php echo $this->_tpl_vars['f_exam_title']; ?>
</span>
      	
      </td>
    </tr>
     <tr class="tdbg"><td>&nbsp;</td><td>&nbsp;</td></tr>
		<tr class="tdbg">
		 	<td align="right">正确答案：</td>
			<td>
				<input name="exam_true" id="exam_true" size="1" maxlength="1" value="<?php echo $this->_tpl_vars['f_exam_true']; ?>
" readonly>
			</td>
		</tr>
		 <tr class="tdbg"><td>&nbsp;</td><td>&nbsp;</td></tr>
		<tr class="tdbg">
		 	<td align="right">你的回答：</td>
			<td>
				<input name="exam_answer" id="exam_answer" size="1" maxlength="1" value="<?php echo $this->_tpl_vars['f_exam_answered']; ?>
" readonly>
			</td>
		</tr>
	 <tr class="tdbg"><td>&nbsp;</td><td>&nbsp;</td></tr>	
		<tr class="tdbg">
		   <td align="right">错误原因：</td>
		   <td>
		     <select id="er_exam_type" name="er_exam_type" disabled >
   			   <option value="2" <?php if ($this->_tpl_vars['er_exam_type'] == 2): ?>selected<?php endif; ?>  >不会</option>
   			   <option value="3" <?php if ($this->_tpl_vars['er_exam_type'] == 3): ?>selected<?php endif; ?>  >粗心</option>
   			   <option value="1" <?php if ($this->_tpl_vars['er_exam_type'] == 1): ?>selected<?php endif; ?> >蒙一个</option>
  			 </select>
  		   </td>
		</tr>
		<tr class="tdbg">
		 	<td align="right">评论：</td>
			<td>
				<textarea id="er_exam_comments" name="er_exam_comments" class="simple-input ui-corner-all " style=" width: 500px; height: 68px;" disabled><?php echo $this->_tpl_vars['er_exam_comments']; ?>
</textarea>
			</td>
		</tr>
		
    <tr class="tdbg"><td>&nbsp;</td><td>&nbsp;</td></tr>
		
    <tr class="tdbg">
	  <td>&nbsp;</td>
      <td> <input type="button" class="bnt" value="上一题" id="btn_pre"> 
      	&nbsp;<input type="button" class="bnt" value="下一题" id="btn_next"> 
      	&nbsp;<input type="button" class="bnt" value="查看解题步骤" id="btn_view" onclick="showBz()" >&nbsp;<input type="button" class="bnt" value="答案质疑" id="btn_zhiyi" onclick="showZy()" >
      		&nbsp;<input type="button" class="bnt" value="删 除" id="btn_del"> </td>
    </tr>
	  <!--步骤信息-->
	  <tbody  id="tb_buzou" style="display:none">
	  <tr class="tdbg">
	  	<td colspan="2" >
	  		<iframe id="if_step_preview" name="if_step_preview" width="800px" height="600px;" frameborder="0" src="./?a=math_to_view&m_content=<?php echo $this->_tpl_vars['exam_step_space']; ?>
"></iframe>
	  		
	  	</td>
	  </tr>
	  <tr class="tdbg">
	  <td>&nbsp;</td>
      <td> <input type="button" value=" 步骤信息收起 " id="btn_hideinfo" onclick="hideBz()" /></td>
    </tr>
	  </tbody>
	  <!--质疑信息-->
	  <tbody id="tb_zhiyi" style="display:none">
	  <tr class="tdbg">
	  	<td  colspan="2" >
	  		<div class="tutorial-description" >
          <span itemprop="name" class="title desktop-only">
             <div class="answer_action_left">
             	 质疑理由：<br>
             	 <textarea id="zhiyi_content" name="zhiyi_content" class="simple-input ui-corner-all " style=" width: 500px; height: 68px;"></textarea>
             	 <br>
             </div>
          </span>
         </div>
	  	</td>
	  </tr>
	  <tr class="tdbg">
	  <td>&nbsp;</td>
      <td> <input type="button" value=" 提 交 " id="btn_submint_zhiyi"  onclick="do_submint()" /> &nbsp;&nbsp;<input type="button" value=" 取 消 " id="btn_cancel"  onclick="hideZy()" /></td>
    </tr>
  </tbody>
  
  </table>
  
  
        	
        	
          
          <!--<div class="answer_list_end"></div>-->
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
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<!-- zixi.org.cn Baidu tongji analytics 
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F373a5160f96b2e16d6ffc7ced7340f47' type='text/javascript'%3E%3C/script%3E"));
</script>-->
</body>
</html>