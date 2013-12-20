<?php
class main extends spController{
	  /** 类初始化 构造函数 */
    function __construct(){
        //自动执行父类构造函数
        parent::__construct();
        global $__action;
        if(is_file(APP_ADMIN_PATH.'/action/'.$__action.'.php')){
            require(APP_ADMIN_PATH.'/action/'.$__action.'.php');
        }else{
        	  if($__action == 'index')
        	      $this->display('index.html');
        }
        exit();
        die();
    }
}	