<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$kngid = $_REQUEST['kngid'];
if(!$kngid){
    die();
}
echo '<option value="">全部</option>',get_video_list2($kngid);