<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
$videoid = $this->spArgs("videoid");
if(!$videoid){
    die();
}
echo get_video_list_by_ajax($videoid);