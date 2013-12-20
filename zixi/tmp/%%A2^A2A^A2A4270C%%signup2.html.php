<?php /* Smarty version 2.6.26, created on 2013-12-18 16:52:46
         compiled from signup2.html */ ?>
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
/css/signup2.css">
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/jquery-1.3.2.min.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/jquery.menu-aim.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/com.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/signup2.js"></script>
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
    <div class="completesignup-container card-case vertical-shadow">
        <div class="completesignup-contents">
       
        <img src="<?php echo $this->_tpl_vars['web_site']; ?>
/images/hand-tree.png" width="75" height="75" class="tree">
        <h3>
            <span class="bold-text">账号注册</span>
        </h3>
        <form  method="POST" class="auth-form container" id="signupForm" name="signupForm" action="<?php echo $this->_tpl_vars['web_site']; ?>
/completesignup">
        <div class="field-container row-fluid">
            <label class="field-label span4" for="member_email">电子邮箱</label> <input type="hidden" id="web_site" value="<?php echo $this->_tpl_vars['web_site']; ?>
"/>
            <input type="hidden" id="member_email"  name="member_email" value="<?php echo $this->_tpl_vars['member_email']; ?>
">
            <input id="email" name="email" class="simple-input ui-corner-all span6" value="<?php echo $this->_tpl_vars['member_email']; ?>
" disabled="true">
        </div>
        <div class="field-container row-fluid">
            <label class="field-label span4" for="member_name">昵称</label>
            <input id="member_name" name="member_name" class="simple-input ui-corner-all span6" value="<?php echo $this->_tpl_vars['member_name']; ?>
">
        </div>
        <div class="field-container row-fluid">
            <label class="field-label span4" for="member_sex">性别</label>
            <select id="member_sex" name="member_sex" class="simple-input ui-corner-all span6">
                <option value="1">男</option>
                <option value="2">女</option>
            </select>
        </div>
        <div class="field-container row-fluid">
            <label class="field-label span4" for="member_city_id">城市</label>
            <select id="member_city_id" name="member_city_id" class="simple-input ui-corner-all span6"><?php echo $this->_tpl_vars['city_option']; ?>

            </select>
        </div>
         <div class="field-container row-fluid">
            <label class="field-label span4" for="username">所在学校</label>
            <select id="member_school_code" name="member_school_code" class="simple-input ui-corner-all span6" ><?php echo $this->_tpl_vars['school_list']; ?>
</select>
        </div>
         <div class="field-container row-fluid">
            <label class="field-label span4" for="username">学号</label>
            <input id="member_student_code" name="member_student_code" class="simple-input ui-corner-all span6" />
        </div>
        <div class="field-container row-fluid">
            <label class="field-label span4" for="member_identity_type">身份类型</label>
            <select id="member_identity_type" name="member_identity_type" class="simple-input ui-corner-all span6">
                <option value="0">学生</option>
                <option value="1">老师</option>
            </select>
        </div>
        <div class="field-container row-fluid">
            <label class="field-label span4" for="member_kng_id">学科</label>
            <select id="member_kng_id" name="member_kng_id" class="simple-input ui-corner-all span6" disabled>
                <?php echo $this->_tpl_vars['kng_option']; ?>

            </select>
        </div>
        <div class="field-container row-fluid">
            <label class="field-label span4" for="password">登录密码</label>
            <input id="password" name="password" type="password" class="simple-input ui-corner-all span6" value="">
        </div>
        <div class="field-container row-fluid">
            <label class="field-label span4" for="repassword">确认密码</label>
            <input id="repassword" name="repassword" type="password" class="simple-input ui-corner-all span6">
        </div>
        
        <div class="horizontal-separator"></div>
       
        <div class="field-container row-fluid">
                                                <label class="field-label span4" for="birthday">出生日期</label>
                                                <div id="birthday-picker" class="span4">
                <fieldset class="birthday-picker">                               
	                <select class="birth-month simple-input ui-corner-all login-input" id='birthmonth' name="birth[month]"><?php echo $this->_tpl_vars['month_option']; ?>
</select><select class="birth-day simple-input ui-corner-all login-input" id='birthday' name="birth[day]"><?php echo $this->_tpl_vars['day_option']; ?>
</select><select class="birth-year simple-input ui-corner-all login-input" id='birthyear' name="birth[year]"><?php echo $this->_tpl_vars['year_option']; ?>
</select><input type="hidden" name="birthdate" id="birthdate" value="">
	              </fieldset>
	           </div>
                                                

                                                
        </div>
        <!--<div class="field-container row-fluid">
            <span class="span4 subscribe-input">
                <input id="subscribe" name="subscribe" value="1" type="checkbox">
            </span>
            <label class="span6 subscribe-label" for="subscribe">
                Email me every two weeks when new content is available
            </label>
        </div>-->
        <div class="error-container row-fluid">
            <div class="field-error span10" id="error-text">&nbsp;</div>
        </div>
        <div class="field-container submit-container row-fluid">
            <div class="offset2 span5">
                <span class="tos-area">同意我们的<a href="<?php echo $this->_tpl_vars['web_site']; ?>
/tos" target="_blank" tabindex="1">服务协议</a>及<a href="<?php echo $this->_tpl_vars['web_site']; ?>
/privacy-policy" target="_blank" tabindex="1">隐私权政策</a></span>
            </div>
            <div class="span3">
                <input type="button" id="submit-button" name="submit-button" value="注&nbsp;&nbsp;册" class="simple-button green">
            </div>
        </div>

        </form>

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