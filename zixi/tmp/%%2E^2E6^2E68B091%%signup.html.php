<?php /* Smarty version 2.6.26, created on 2013-12-18 11:29:02
         compiled from signup.html */ ?>
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
/css/signup.css">
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/jquery-1.9.1.min.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/jquery.menu-aim.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/com.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/signup1.js"></script>
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
    <div class="signup-top enable-transitions role-mode">
        <div class="signup-container signup-transition card-case vertical-shadow">
            <div class="slide-container">
                <div class="signup-form-container signup-transition container-fluid">
                    <div class="row-fluid">
                        <div class="signup-form-body span10">
                            
                            
                            <div class="span10 teacher-header">
                                    <h3><span class="bold-text">账号注册</span></h3>
                                </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="one-click-form">
                                    </div>
                                    <form method="POST" class="auth-form" id="signupForm" name="signupForm" action="<?php echo $this->_tpl_vars['web_site']; ?>
/signup">
                                    <!--<input type="hidden" name="continue" value="/students?guide=1">
                                    <input type="hidden" name="isteacher" value="1">-->

                                    <div class="email-form" style="">
                                        <div class="horizontal-separator">
                                           <!-- <span class="separator-text">OR</span>-->
                                        </div>
                                        <div class="pw-signup container">
                                            <div class="field-container row-fluid">
                                                <label class="field-label span4" for="member_name">昵称</label>
                                                <input id="member_name" name="member_name" type="member_name" class="simple-input ui-corner-all span4" value="<?php echo $this->_tpl_vars['member_name']; ?>
" onblur=checkName()>
                                                <div class="field-error span4" id="error-text-member_name"></div>
                                            </div>
                                            <div class="field-container row-fluid">
                                                <label class="field-label span4" for="member_email">电子邮箱</label>
                                                <input id="member_email" name="member_email" type="email" class="simple-input ui-corner-all span4" value="<?php echo $this->_tpl_vars['member_email']; ?>
" onblur=checkEmail()>
                                                <div class="field-error span4" id="error-text-member_email"><?php echo $this->_tpl_vars['err_email']; ?>
</div>
                                            </div>
                                           

                                            <div class="field-container row-fluid">
                                                <span class="span8 simple-input-container submit-button-container">
                                                    <input type="button" id="submit-button" name="signup" value="提&nbsp;交" class="simple-button green">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </form></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="signup-login-callout signup-transition">
           已登录账号?
            <span class="teacher-signup" style="display: inline;">
                <a class="login-link" href="<?php echo $this->_tpl_vars['web_site']; ?>
/login">立即登录</a> 
            </span>
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

</body>
</html>