<?php
//echo "<meta http-equiv=refresh content='0; url=http://121.199.34.66'>"; 
//die();
//header('content-type:text/html; charset=utf-8');
//echo '<html><body><div ><center><h2>网站即将开通。。。</h2></center></div></body></html>';


//die();
define('SP_PATH','SpeedPHP');
define('FN_PATH','function');
define('INNI_ZIXISHI_LOCK',TRUE);
define('APP_PATH',dirname(__FILE__));
header('content-type:text/html; charset=utf-8');
ob_start('ob_gzhandler');
date_default_timezone_set('Asia/Shanghai');
$spConfig = array(
		'default_controller' => 'webmain', // 默认的控制器名称
		'default_action' => 'index',  // 默认的动作名称
		'sp_cache' => APP_PATH.'/tmp', // 框架临时文件夹目录
    'view' => array( 
        'enabled' => true, // 开启Smarty 
        'config' => array(
            'template_dir' => APP_PATH.'/tpl', // 模板存放的目录*
            'compile_dir' => APP_PATH.'/tmp', // 编译目录
			      'cache_dir' => APP_PATH.'/tmp', // 缓存目录
        ),
    ),
);
require(FN_PATH.'/fn_common.php');
require(FN_PATH.'/fn_sendemail.php');
require(SP_PATH.'/SpeedPHP.php');
spRun();