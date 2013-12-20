<?php /* Smarty version 2.6.26, created on 2013-12-15 20:39:18
         compiled from index.html */ ?>
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
  <link rel="shortcut icon" href="images/favicon.ico">
  <link rel="stylesheet" type="text/css" href="css/com.css">
  <link rel="stylesheet" type="text/css" href="css/header.css">
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <script src="js/jquery-1.9.1.min.js"></script>
  <script src="js/jquery.menu-aim.js"></script>
  <script src="js/com.js"></script>
  <script src="js/index.js"></script>
   
<style>
    #page_sub_nav </style>

</head>
<!--[if lt IE 7]>  <body class="ie ie6 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 7]>     <body class="ie ie7 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 8]>     <body class="ie ie8 lte9 lte8"> <![endif]-->
<!--[if IE 9]>     <body class="ie ie9 lte9"> <![endif]-->
<!--[if gt IE 9]>  <body> <![endif]-->
<!--[if !IE]>
<!--> <body data-twttr-rendered="true"><!--<![endif]-->
<div id="outer-wrapper" class="clearfix new-header">
<!--header-s-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--header-e-->
<?php if ($this->_tpl_vars['member'] == ''): ?>

<?php endif; ?>
<!--内容-->
    <div id="page-container">
    <div id="page-container-inner">
    	
<article id="homepage" class="clearfix homepage-signup" style="padding-top: 22px;">

 <!--search e-->

 <div class="row-fluid page-ribbon">
    <div class="span3 tagline">
       <!-- <h1>earch</h1>-->
        <img src='images/search_logo.png' style='width:60px;'>
    </div>
    <div class="span9 main-search">
    
    
   <form class="large-search-form" action="<?php echo $this->_tpl_vars['web_site']; ?>
/search" method="post">
    <input id="large-search-input" name="search_query" placeholder="输入关键词回车搜索" class="placeholder simple-input search-input blur-on-esc large-search-bar ui-corner-all ui-autocomplete-input" >
    <!--<span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
    <i class="icon-search"></i>-->
    <div class="throbber"></div>
    <input type="submit" class="simple-button primary large-font big-button large-search-submit" value="搜一搜">
   </form>
    </div>
</div>
<div class="section-row-one">
	<div class="section-row-one-left">
		<!--推荐视频-->
		<div class="section-separator" style="padding-top: 22px;">
		            <h2><span class="section-separator-text">推荐视频</span></h2>
		            <hr>
		</div>
		<div class="row-fluid suggested-actions">
		
			<?php $_from = $this->_tpl_vars['video_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['videoitem']):
?>
		   <div class="span4">
		    <a class="vertical-shadow suggested-action" href="<?php echo $this->_tpl_vars['web_site']; ?>
/kng<?php echo $this->_tpl_vars['videoitem']['knglist']; ?>
/video/<?php echo $this->_tpl_vars['videoitem']['video_id']; ?>
">
		    <div class="suggested-action-image-link " style="background-image: url(<?php if ($this->_tpl_vars['videoitem']['video_lc_picurl'] == ''): ?><?php echo $this->_tpl_vars['videoitem']['video_picurl']; ?>
<?php else: ?>files/video-logo/<?php echo $this->_tpl_vars['videoitem']['video_lc_picurl']; ?>
<?php endif; ?>);">
		    </div>
		    <h6 class="pulls ellipsis suggested-action-title" title="<?php echo $this->_tpl_vars['videoitem']['video_title']; ?>
"><?php echo $this->_tpl_vars['videoitem']['video_title']; ?>
</h6>
		    <!--<p class="pulled"><?php echo $this->_tpl_vars['videoitem']['video_description']; ?>
</p>-->
		    </a>
		   </div>
		  <?php endforeach; endif; unset($_from); ?> 
		</div>
	</div>
	<div class="section-row-one-right">
		<div class="section-row-one-right-content">
			<span class="span4 logged-out-sidebar">
        <div class="section-separator">
            <h2><span class="section-separator-text">最新更新</span></h2>
            <hr>
        </div>
  <!--
        <div class="suggested-action join-academy vertical-shadow">
            <div class="subscribe-tease">
                <h2 class="pulls">Subscribe to our courses</h2>
                <div class="homepage-mailing">
                    <span><div class="subscription">
            <span class="already-subscribed-container" style="display:none;">
                <p>Nice! You're subscribed to receive <a class="already-subscribed" href="https://www.khanacademy.org/#">emails about new content</a>.</p>
            </span>

            <span class="not-subscribed-container">
                <input type="email" name="email" class="email" placeholder="Enter your email to learn about new courses." value="">
            </span>
        <div class="dropdown">
            <span class="dropdown-toggle" style="display:none"></span>
            <div class="subscription-dropdown-placeholder"></div>
        </div>
    </div></span>
                </div>
            </div>
        </div>
       <div class="suggested-actions" style="padding-top: 30px">
            
	        <a class="vertical-shadow suggested-action" href="<?php echo $this->_tpl_vars['web_site']; ?>
/kng<?php echo $this->_tpl_vars['nw_video_knglist']; ?>
/video/<?php echo $this->_tpl_vars['nw_video_id']; ?>
">
		       <div class="suggested-action-image-link " style="background-image: url(<?php echo $this->_tpl_vars['nw_video_picurl']; ?>
);">
		       </div>
		      	<h2 class="pulls ellipsis suggested-action-title" title="<?php echo $this->_tpl_vars['nw_video_title']; ?>
"><?php echo $this->_tpl_vars['nw_video_title']; ?>
</h2>
		     	 	<p class="pulled"><?php echo $this->_tpl_vars['nw_video_description']; ?>
</p>
					</a>
        </div>
        
         -->
        <?php $_from = $this->_tpl_vars['nw_video_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['video']):
?>
        <div class="nw-video">
	        <div class="suggested-actions" style="padding-top: 30px">
	            
		        <a class="vertical-shadow suggested-action" href="<?php echo $this->_tpl_vars['web_site']; ?>
/kng<?php echo $this->_tpl_vars['video']['video_knglist']; ?>
/video/<?php echo $this->_tpl_vars['video']['video_id']; ?>
">
			       <div class="suggested-action-image-link " style="background-image: url(<?php echo $this->_tpl_vars['video']['video_picurl']; ?>
);">
			       </div>
			      	<h6 class="pulls ellipsis suggested-action-title" title="<?php echo $this->_tpl_vars['video']['video_title']; ?>
"><?php echo $this->_tpl_vars['video']['video_title']; ?>
</h6>
			     	 	<!--<p class="pulled"><?php echo $this->_tpl_vars['video']['video_description']; ?>
</p>-->
						</a>
	        </div>
      	</div>
        <?php endforeach; endif; unset($_from); ?>
    
    </span>
		</div>
	</div>
</div>

<div class="row-fluid library-section visited-no-recolor">
    <span class="span8">
        <div class="section-separator library-section-separator">
            <h2><span class="section-separator-text"><?php echo $this->_tpl_vars['browse_our_library']; ?>
</span></h2>
            <hr>
        </div>
        <ul>
        	   <?php $_from = $this->_tpl_vars['nav_kng_result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['kngitem']):
?>
                    <li class="subjects-column-first">
                        <h2 class="domain-header">
                            <a><?php echo $this->_tpl_vars['kngitem']['kng_title']; ?>
</a>
                        </h2>
                        <div class="domain-table-container">
                            <table class="domain-table">
                            <tbody>
                            	<tr>
                            	<?php $_from = $this->_tpl_vars['kngitem']['kng_items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['kngim']):
?>
                            	    <?php if ($this->_tpl_vars['key'] != 0): ?>
                            	       <?php if (( $this->_tpl_vars['key']%3 ) == 0): ?></tr> <tr><?php endif; ?>
                            	    <?php endif; ?>
                            	    <td class="subject-cell">
                            	    	
                                         <a href="<?php echo $this->_tpl_vars['web_site']; ?>
/kng/<?php echo $this->_tpl_vars['kngitem']['kng_id']; ?>
/<?php echo $this->_tpl_vars['kngim']['kng_id']; ?>
"  class="subject-link"><?php echo $this->_tpl_vars['kngim']['kng_title']; ?>
</a>
                                   
                                  </td>
                              <?php endforeach; endif; unset($_from); ?>
                              </tr>
                            </tbody>
                            </table>
                        </div>
                    </li> 
             <?php endforeach; endif; unset($_from); ?>
        </ul>
        <div class="homepage-actions">
            <!--<a href="https://www.khanacademy.org/exercisedashboard" class="simple-button primary big-button large-font">练习</a>-->
            <a href="<?php echo $this->_tpl_vars['web_site']; ?>
/library" class="simple-button big-button large-font">浏览全部视频</a>
        </div>
    </span>
    <div class="section-row-one-right">
		<div class="section-row-one-right-content">
			<span class="span4 logged-out-sidebar">
        <div class="section-separator">
            <h2><span class="section-separator-text">公告</span></h2>
            <hr>
             <span  class="section-separator-text" style="color: #444;">
             	<?php echo $this->_tpl_vars['web_notice']; ?>

            </span>
        </div>
       
  <!--
        <div class="suggested-action join-academy vertical-shadow">
            <div class="subscribe-tease">
                <h2 class="pulls">Subscribe to our courses</h2>
                <div class="homepage-mailing">
                    <span><div class="subscription">
            <span class="already-subscribed-container" style="display:none;">
                <p>Nice! You're subscribed to receive <a class="already-subscribed" href="https://www.khanacademy.org/#">emails about new content</a>.</p>
            </span>

            <span class="not-subscribed-container">
                <input type="email" name="email" class="email" placeholder="Enter your email to learn about new courses." value="">
            </span>
        <div class="dropdown">
            <span class="dropdown-toggle" style="display:none"></span>
            <div class="subscription-dropdown-placeholder"></div>
        </div>
    </div></span>
                </div>
            </div>
        </div>
       <div class="suggested-actions" style="padding-top: 30px">
            
	        <a class="vertical-shadow suggested-action" href="<?php echo $this->_tpl_vars['web_site']; ?>
/kng<?php echo $this->_tpl_vars['nw_video_knglist']; ?>
/video/<?php echo $this->_tpl_vars['nw_video_id']; ?>
">
		       <div class="suggested-action-image-link " style="background-image: url(<?php echo $this->_tpl_vars['nw_video_picurl']; ?>
);">
		       </div>
		      	<h2 class="pulls ellipsis suggested-action-title" title="<?php echo $this->_tpl_vars['nw_video_title']; ?>
"><?php echo $this->_tpl_vars['nw_video_title']; ?>
</h2>
		     	 	<p class="pulled"><?php echo $this->_tpl_vars['nw_video_description']; ?>
</p>
					</a>
        </div>
        
         -->
       
    </span>
		</div>
	</div>
    
</div>


</article>
            <div id="end-of-page-spacer">&nbsp;</div>
    </div>
    </div>
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