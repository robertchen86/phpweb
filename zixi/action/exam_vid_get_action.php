<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$kngid = $this->spArgs("kngid");
if(!$kngid){
    die();
}
echo get_video_list2($kngid);