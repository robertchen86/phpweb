<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';

$this->title = '服务协议 - '.$web_name;
$this->keywords = '服务协议';
$this->description = '服务协议';
$this->display('tos.html');	