<?php /* Smarty version 2.6.26, created on 2013-12-15 23:01:28
         compiled from kng.html */ ?>
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
/css/kng1.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['web_site']; ?>
/css/kng12.css">
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/jquery-1.9.1.min.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/jquery.menu-aim.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/com.js"></script>
  <!--
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
/mathjax/MathJax.js" ></script>-->
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
         
<article id="topic-page">
<div class="topic-page-content">
	
  <div class="container math" style="display: table; height: 1642px;">
        <a class="hidden-desktop btn-navbar simple-button big-button large-font icon-reorder" data-toggle="collapse" data-target=".nav-collapse">
              <?php echo $this->_tpl_vars['footKng']; ?>

        </a>
        <div class="nav-pane nav-collapse collapse">
          
<ul class="docked-nav">
  <li >
    <a class="tab-link topic-name topic-heading-link math subject-color"  href="<?php echo $this->_tpl_vars['web_site']; ?>
/kng/<?php echo $this->_tpl_vars['footKngId']; ?>
/<?php echo $this->_tpl_vars['twoKngId']; ?>
" data-id="">
        <h2 class="topic-heading"><!--#_--><?php echo $this->_tpl_vars['footKng']; ?>
<!--/_-->
        </h2>
    </a>
  </li>
   <?php $_from = $this->_tpl_vars['kng_left_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['kngitem']):
?>
    <li >
      <a class="tab-link subtopic-link math <?php if ($this->_tpl_vars['twoKngId'] == $this->_tpl_vars['kngitem']['kng_id']): ?>active<?php endif; ?>"  href="<?php echo $this->_tpl_vars['web_site']; ?>
/kng/<?php echo $this->_tpl_vars['footKngId']; ?>
/<?php echo $this->_tpl_vars['kngitem']['kng_id']; ?>
" >
        <?php echo $this->_tpl_vars['kngitem']['kng_title']; ?>

    </a>
    </li>
    <?php endforeach; endif; unset($_from); ?>
</ul>
          <div style="clear: both"></div>
        </div>
        <div class="content-pane">
          
            
          
        <div class="topic-content-view-root">


<div class="content-pane-inner" style="height: 1642px;">
<div data-role="header" class="main-header">
  <div class="topic-video visible-desktop">
  </div>
  <div class="topic-info math topic-color">
    <div class="topic-title"><!--#_--><?php echo $this->_tpl_vars['kng_title']; ?>
<!--/_--></div>
        <!--<img class="topic-icon" src="./neic2_files/addition-subtraction-60x60.png" width="60" height="60">-->
    <div class="topic-desc"><!--#_--><?php echo $this->_tpl_vars['kng_title']; ?>
<!--/_--></div>
   
  </div>
</div>
<div class="sub-header-spacer math tutorial-color"> </div>
<div class="videos-list">
<div class="tutorial-contents uncurated">
  <ol class="first progress-container">
  	<?php $_from = $this->_tpl_vars['video_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['vitem']):
?>
  	<?php if (( $this->_tpl_vars['key']%2 ) == 0): ?>
  	<?php if ($this->_tpl_vars['vitem']['video_id'] != ''): ?>
    <li class="progress-item">
        <a href="<?php echo $this->_tpl_vars['web_site']; ?>
/kng/<?php echo $this->_tpl_vars['footKngId']; ?>
/<?php echo $this->_tpl_vars['twoKngId']; ?>
/video/<?php echo $this->_tpl_vars['vitem']['video_id']; ?>
" class="progress-item-link">
            <div class="subway-icon v23916">
            <div class="pipe"></div>
            <div class="pipe completed"></div>
            <div class="status v23916 video-node"></div>
            </div>
            <span class="progress-title"><?php echo $this->_tpl_vars['vitem']['video_title']; ?>
</span>
        </a>
    </li>
    <?php endif; ?>
    <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    
  </ol>
  <ol class="second progress-container">
   	<?php $_from = $this->_tpl_vars['video_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['vitem']):
?>
  	<?php if (( $this->_tpl_vars['key']%2 ) != 0): ?>
  	<?php if ($this->_tpl_vars['vitem']['video_id'] != ''): ?>
    <li class="progress-item">
        <a href="<?php echo $this->_tpl_vars['web_site']; ?>
/kng/<?php echo $this->_tpl_vars['footKngId']; ?>
/<?php echo $this->_tpl_vars['twoKngId']; ?>
/video/<?php echo $this->_tpl_vars['vitem']['video_id']; ?>
" class="progress-item-link">
            <div class="subway-icon v23916">
            <div class="pipe"></div>
            <div class="pipe completed"></div>
            <div class="status v23916 video-node"></div>
            </div>
            <span class="progress-title"><?php echo $this->_tpl_vars['vitem']['video_title']; ?>
</span>
        </a>
    </li>
    <?php endif; ?>
    <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>   
    
  </ol>
  <div style="clear: both"> </div>
</div>
  
</div>

</div>

<div style="clear: both;"></div>
</div></div>
      </div>
  </div>
</article>
</div>
<div id="end-of-page-spacer">&nbsp;</div>
</div>
    
<!--end container-->
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