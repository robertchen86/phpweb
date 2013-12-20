<?php /* Smarty version 2.6.26, created on 2013-12-17 00:39:37
         compiled from search.html */ ?>
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
/css/search.css">
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/jquery-1.9.1.min.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/jquery.menu-aim.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/com.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/search.js"></script>
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
    <article class="search_results" id="search_results" style="padding-top: 22px;">
    <div class="large-search-bar-container row-fluid">
        <span class="span12">
        
        
<form class="large-search-form" action="<?php echo $this->_tpl_vars['web_site']; ?>
/search" method="post" >
    <input id="large-search-input" name="search_query" class="placeholder simple-input search-input blur-on-esc large-search-bar ui-corner-all ui-autocomplete-input" autocomplete="off" value="<?php echo $this->_tpl_vars['search_query']; ?>
"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
    <!--<i class="icon-search"></i>-->
    <div class="throbber"></div>
    
    <input type="submit" class="simple-button primary large-font big-button large-search-submit" value="搜一搜">
    
</form>
        </span>
    </div>
    <section class="searchresult-counts row-fluid">
        <div class="span12 visited-no-recolor">
          <div class="btn-group">
            <button class="btn<?php if ($this->_tpl_vars['kng_count'] == 0): ?> disabled<?php endif; ?>" data-section="topics"><!--<i class="icon-book"></i>-->
 知识点<span class="result-count"><?php echo $this->_tpl_vars['kng_count']; ?>
</span>
            </button>
            <!--<button class="btn" data-section="programs"><i class="icon-picture"></i>
 Programs<span class="result-count">1</span>
            </button>-->
            <button class="btn<?php if ($this->_tpl_vars['video_count'] == 0): ?> disabled<?php endif; ?>" data-section="videos"><!--<i class="icon-facetime-video"></i>-->
视频<span class="result-count"><?php echo $this->_tpl_vars['video_count']; ?>
</span>
            </button>
            <!--<button class="btn disabled" data-section="exercises"><i class="icon-star"></i>
 Exercises<span class="result-count">0</span>
            </button>-->
          </div>
        </div>
    </section>


    <div class="search-results-list">
    <?php if ($this->_tpl_vars['kng_count'] != 0): ?>	
    <section class="topics" id="topics">
    	<?php $_from = $this->_tpl_vars['kng_result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['kngitem']):
?>
<div id="kngitem"  class="Topic-result search-result row-fluid <?php if ($this->_tpl_vars['key'] == 0): ?>first-result<?php endif; ?><?php if (( $this->_tpl_vars['key']+1 ) == $this->_tpl_vars['kng_count']): ?>last-result<?php endif; ?><?php if ($this->_tpl_vars['key'] > 9): ?> result-hidden<?php endif; ?>">
    <div class="span2 search-result-type visited-no-recolor">
    <!--<i class="icon-book"></i>-->
            <?php if ($this->_tpl_vars['key'] == 0): ?>知识点<?php else: ?>&nbsp;<?php endif; ?>
    </div>
    <div class="span10 search-result-info">
        <a href="<?php echo $this->_tpl_vars['web_site']; ?>
/kng<?php echo $this->_tpl_vars['kngitem']['knglist']; ?>
" data-tag="Search Body" class="topic-result individual-result" target="_blank">
            <span class="searchresulthighlight"><?php echo $this->_tpl_vars['kngitem']['kng_title']; ?>
</span>
        </a>&nbsp; 
    </div>
</div>
      <?php endforeach; endif; unset($_from); ?>
      <?php if ($this->_tpl_vars['kng_count'] > 10): ?>	
       <div  id="kngresult" class="row-fluid search-result last-result">
  <div class="span2 search-result-type">
    <a href="javascript:void(0);" class="show-hidden-results">
        &nbsp;
    </a>
  </div>
  <div class="span10 search-result-info" style="border-left: 0">
    <a href="javascript:void(0);showallkng();" class="show-hidden-results individual-result">
        <!--<i class="icon-plus"></i>--> 显示全部知识点
    </a>
  </div>
</div>
     <?php endif; ?>      
      
      
    </section>
     <?php endif; ?>   

        <!--
        <section class="program-results" id="programs">
        
            
<div class="Program-result search-result row-fluid first-result last-result">
    <div class="span2 search-result-type visited-no-recolor">
        
        
            


<i class="icon-picture"></i>



            Programs
        
    </div>

    <div class="span10 search-result-info">
    

    
        <a href="https://www.khanacademy.org/math/applied-math/cryptography/modern-crypt/p/prime-density-spiral" data-tag="Search Body" class="program-result individual-result">
            <span class="searchresulthighlight">Prime density spiral</span>
        </a>
        <div class="topic-breadcrumbs">

    
        <span class="breadcrumb">
            Math
        </span>
     » 
    <a class="breadcrumb" href="https://www.khanacademy.org/math/applied-math">Applied math</a>
     » 
    <a class="breadcrumb" href="https://www.khanacademy.org/math/applied-math/cryptography">Journey into Cryptography</a>
     » 
    <a class="breadcrumb" href="https://www.khanacademy.org/math/applied-math/cryptography/modern-crypt">Modern Cryptography</a>
    
</div>
    

    

    
    </div>
</div>

        
        </section>-->
     <?php if ($this->_tpl_vars['video_count'] != 0): ?>	
        <section class="video-results" id="videos">
        <?php $_from = $this->_tpl_vars['video_result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['videoitem']):
?>	
<div id="videoitem" class="Video-result search-result row-fluid <?php if ($this->_tpl_vars['key'] == 0): ?>first-result<?php endif; ?><?php if (( $this->_tpl_vars['key']+1 ) == $this->_tpl_vars['video_count']): ?>last-result<?php endif; ?><?php if ($this->_tpl_vars['key'] > 9): ?> result-hidden<?php endif; ?> ">
    <div class="span2 search-result-type visited-no-recolor">
    <!--<i class="icon-facetime-video"></i>-->
           <?php if ($this->_tpl_vars['key'] == 0): ?>视频<?php else: ?>&nbsp;<?php endif; ?>
    </div>
    <div class="span10 search-result-info">
        <a href="<?php if ($this->_tpl_vars['videoitem']['videoknglist'] != ''): ?><?php echo $this->_tpl_vars['web_site']; ?>
/kng<?php echo $this->_tpl_vars['videoitem']['videoknglist']; ?>
/video/<?php echo $this->_tpl_vars['videoitem']['video_id']; ?>
<?php else: ?>javascript:void(0);<?php endif; ?>" data-tag="Search Body" class="video-result individual-result vid-progress vqOwCpnQsDLM" target="_blank">
            <span class="searchresulthighlight"><?php echo $this->_tpl_vars['videoitem']['video_title']; ?>
</span>
        </a>
        <div class="topic-breadcrumbs"><?php echo $this->_tpl_vars['videoitem']['videoknglisttitle']; ?>
</div>
    </div>
</div>

        <?php endforeach; endif; unset($_from); ?>   
      <?php if ($this->_tpl_vars['video_count'] > 10): ?>	
       <div  id="videoresult" class="row-fluid search-result last-result">
  <div class="span2 search-result-type">
    <a href="javascript:void(0);" class="show-hidden-results">
        &nbsp;
    </a>
  </div>
  <div class="span10 search-result-info" style="border-left: 0">
    <a href="javascript:void(0);showallvideo();" class="show-hidden-results individual-result">
        <!--<i class="icon-plus"></i>--> 显示全部视频
    </a>
  </div>
</div>
     <?php endif; ?>
        
        </section>
      <?php endif; ?>  

        
    </div>
</article>


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