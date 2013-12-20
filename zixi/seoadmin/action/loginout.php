<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$_SESSION['inni_zixishi_userid'] = null;
$_SESSION['inni_zixishi_user'] = null;
echo "<meta http-equiv=refresh content='0; url=./'>";
die();