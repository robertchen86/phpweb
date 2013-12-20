<?php
define('SP_PATH','../SpeedPHP');
define('FN_PATH','../function');
define('CF_PATH','../config');
define('APP_PATH',dirname(dirname(__FILE__)));
define('APP_ADMIN_PATH',dirname(__FILE__));
define('INNI_ZIXISHI_LOCK',TRUE);
header('content-type:text/html; charset=utf-8');
//ob_start('ob_gzhandler');
date_default_timezone_set('Asia/Shanghai');
$spConfig = array(
			'default_controller' => 'main', // 默认的控制器名称
			'default_action' => 'index',  // 默认的动作名称
			'sp_cache' => APP_ADMIN_PATH.'/tmp', // 框架临时文件夹目录
			'controller_path' => APP_ADMIN_PATH.'/controller', // 用户控制器程序的路径定义
	    //'model_path' => APP_PATH.'/model', // 用户模型程序的路径定义
      'view' => array( 
        'enabled' => TRUE, // 开启Smarty 
        'config' =>array(
         'template_dir' => APP_ADMIN_PATH.'/tpl', // 模板存放的目录*
         'compile_dir' => APP_ADMIN_PATH.'/tmp', // 编译目录
			   'cache_dir' => APP_ADMIN_PATH.'/tmp', // 缓存目录
        ),
      ),
);
require(FN_PATH."/fn_common.php");
require(SP_PATH."/SpeedPHP.php");
spRun();