<?php
class main extends spController{
	  /** ���ʼ�� ���캯�� */
    function __construct(){
        //�Զ�ִ�и��๹�캯��
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