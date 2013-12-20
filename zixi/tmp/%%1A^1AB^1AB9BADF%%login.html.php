<?php /* Smarty version 2.6.26, created on 2013-12-17 00:41:47
         compiled from login.html */ ?>
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
/css/login.css">
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/jquery-1.9.1.min.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/jquery.menu-aim.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/com.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/login.js"></script>

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
    <article id="page-root">
    <div class="login-container">
       <div class="card-case vertical-shadow">
            
            <div class="pw-login">
              <h3 class="regular-header">会员登录</h3>
              <div class="pw-login-contents">
                <form class="auth-form" id="loginForm"  name="loginForm" method="POST" action="<?php echo $this->_tpl_vars['web_site']; ?>
/login">
                <div class="field-error" id="error-text">&nbsp;<?php echo $this->_tpl_vars['err_email']; ?>
</div>
                <img src="<?php echo $this->_tpl_vars['web_site']; ?>
/images/hand-tree.png" width="75" height="75" class="tree">
                <div class="field-container">
                <label class="field-label" for="identifier">登录邮箱</label>
                <input type="hidden" id="http_referer"  name="http_referer" value="<?php echo $this->_tpl_vars['http_referer']; ?>
">
                <input tabindex="1" id="member_email" name="member_email" class="simple-input ui-corner-all" value="<?php echo $this->_tpl_vars['member_email']; ?>
">
                </div>
                <div class="field-container">
                  <label class="field-label password-label" for="password">密码</label>
                  <input tabindex="2" id="password" name="password" type="password" class="simple-input ui-corner-all">
                  
                </div>
               <div>
                   <a id="forgot-hint" href="<?php echo $this->_tpl_vars['web_site']; ?>
/forgotpw" target="_top">忘记密码?</a>
                   <input tabindex="3" id="btg_login" class="simple-button green" value="登&nbsp;录" type="button">
                   
                  
               </div>
                <div class="field-container">
                    <input tabindex="4" class="simple-button green" value="14中账号登录" onclick="window.location.href ='./?a=login_other'" type="button">
                  
                </div>
                <div class="signup-prompt-container">
                <span class="signup-prompt">还没有注册会员?</span>
                <a class="signup-link" target="_top" href="<?php echo $this->_tpl_vars['web_site']; ?>
/signup">立即注册</a>.
                </div>
                </form>
              </div>
            </div>
        </div>
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

</body>
</html>