<?php
class webmain extends spController{
	  //类构造函数
    function __construct() {
        //自动执行父类构造函数
        parent::__construct();
        global $__action;
        if(is_file(APP_PATH.'/action/'.$__action.'_action.php')){
            require(APP_PATH.'/action/'.$__action.'_action.php');
        }
        die();
    }
}