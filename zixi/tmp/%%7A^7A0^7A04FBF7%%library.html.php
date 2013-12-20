<?php /* Smarty version 2.6.26, created on 2013-12-19 20:16:44
         compiled from library.html */ ?>
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
/css/library.css">
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/jquery-1.9.1.min.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/jquery.menu-aim.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/com.js"></script>
<?php echo '
<script type="text/x-mathjax-config">
  MathJax.Hub.Config({
    extensions: ["tex2jax.js"],
    jax: ["input/TeX","output/HTML-CSS"],
    tex2jax: {inlineMath: [["$","$"],["\\\\(","\\\\)"]]}
  });
</script>
'; ?>

 	<script src="<?php echo $this->_tpl_vars['web_site']; ?>
/mathjax/MathJax.js" ></script>
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
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--内容-->
<div id="page-container">
    <div id="page-container-inner">
    	
<article id="homepage">
<div class="clear"></div>
<div id="library">       
  <div id="library-content"> 
  	 <div id="library-content-main"> 
  	 	  <div class="clear desktop-only"><a name="algebra" id="algebra">&nbsp;</a></div>
  	 	   <?php $_from = $this->_tpl_vars['kng1_result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['kngitem1']):
?>
  	 	     
            <div >
                <div  class="library-content-header">
                    <h2 class="topic-heading topic-heading-first ">
                    <a href="javasript:void(0)"><?php echo $this->_tpl_vars['kngitem1']['kng_title']; ?>
</a>
                    </h2>
                </div>
            </div>
              <?php $_from = $this->_tpl_vars['kngitem1']['kng2_items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['kngitem2']):
?>
              <div>
                <div class="library-content-header">
		                <h2 class="subtopic-1-heading topic-heading-first">
                        <a href="<?php echo $this->_tpl_vars['web_site']; ?>
/kng<?php echo $this->_tpl_vars['kngitem2']['knglist']; ?>
"><?php echo $this->_tpl_vars['kngitem2']['kng_title']; ?>
</a>
                    </h2>
                </div>
                
                   <div class="library-content-list">
                    <p class="topic-desc"><?php echo $this->_tpl_vars['kngitem2']['kng_description']; ?>
</p>
                    <?php if ($this->_tpl_vars['kngitem2']['vcount'] != 0): ?>
                    <div style="height:<?php echo $this->_tpl_vars['kngitem2']['vcount']*18; ?>
px;" >
                    	<?php $_from = $this->_tpl_vars['kngitem2']['vlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['vkey'] => $this->_tpl_vars['vitem']):
?>
                    	  <?php if (( $this->_tpl_vars['vkey']%3 ) == 0): ?>
                         <a class="m0 vl vid-progress progress-container" href="<?php echo $this->_tpl_vars['web_site']; ?>
/kng<?php echo $this->_tpl_vars['kngitem2']['knglist']; ?>
/video/<?php echo $this->_tpl_vars['vitem']['video_id']; ?>
" >
                         <span class="progress-title"><?php echo $this->_tpl_vars['vitem']['video_title']; ?>
</span>
                         </a>
                        <?php endif; ?>
                      <?php endforeach; endif; unset($_from); ?>
                      <?php $_from = $this->_tpl_vars['kngitem2']['vlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['vkey'] => $this->_tpl_vars['vitem']):
?>
                    	  <?php if (( $this->_tpl_vars['vkey']%3 ) == 1): ?>
                         <a class="m1 vl vid-progress progress-container" href="<?php echo $this->_tpl_vars['web_site']; ?>
/kng<?php echo $this->_tpl_vars['kngitem2']['knglist']; ?>
/video/<?php echo $this->_tpl_vars['vitem']['video_id']; ?>
" <?php if ($this->_tpl_vars['vkey'] == 1): ?>style="margin-top:-<?php echo $this->_tpl_vars['kngitem2']['vcount']*18; ?>
px;"<?php endif; ?> >
                         <span class="progress-title"><?php echo $this->_tpl_vars['vitem']['video_title']; ?>
</span>
                         </a>
                        <?php endif; ?>
                      <?php endforeach; endif; unset($_from); ?>
                      <?php $_from = $this->_tpl_vars['kngitem2']['vlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['vkey'] => $this->_tpl_vars['vitem']):
?>
                    	  <?php if (( $this->_tpl_vars['vkey']%3 ) == 2): ?>
                         <a class="m2 vl vid-progress progress-container" href="<?php echo $this->_tpl_vars['web_site']; ?>
/kng<?php echo $this->_tpl_vars['kngitem2']['knglist']; ?>
/video/<?php echo $this->_tpl_vars['vitem']['video_id']; ?>
" <?php if ($this->_tpl_vars['vkey'] == 2): ?>style="margin-top:-<?php echo $this->_tpl_vars['kngitem2']['vcount2']*18; ?>
px;"<?php endif; ?> >
                         <span class="progress-title"><?php echo $this->_tpl_vars['vitem']['video_title']; ?>
</span>
                         </a>
                        <?php endif; ?>
                      <?php endforeach; endif; unset($_from); ?>
                    </div>
                    <?php endif; ?>
                    <div class="clear desktop-only subtopic-jump-fix">
                        <a name="algebra_why">&nbsp;</a>
                    </div>
                </div>
                
             </div>
               
              <?php endforeach; endif; unset($_from); ?>
           
          <?php endforeach; endif; unset($_from); ?>
  	 	  
  	 </div>  
  </div>     
</div>  
</article>
<!--
<div id="back-to-top" style="display: block;">
    <a class="arrow" href="<?php echo $this->_tpl_vars['web_site']; ?>
/library">▲</a>
    <a class="text" href="<?php echo $this->_tpl_vars['web_site']; ?>
/library">置顶</a>
</div>-->

    <div id="end-of-page-spacer">&nbsp;</div>
    </div>
    </div>


<!--内容-结束-->    
</div>
<div class="push"></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!-- zixi.org.cn Baidu tongji analytics -->
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F373a5160f96b2e16d6ffc7ced7340f47' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>