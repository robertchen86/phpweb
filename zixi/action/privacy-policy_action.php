<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';


$this->title = '隐私权政策 - '.$web_name;
$this->keywords = '隐私权政策';
$this->description = '隐私权政策';
$this->display('privacy-policy.html');	