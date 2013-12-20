<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
/***验证区*s**/
if(!$_POST['pageNo']){
    echo 0;
    die();
}
set_time_limit(0);
$result = get_account_by_type(1);
$app_key = $result[0]['account_app_key'];
$obj = catch_comments($app_key,$video_itemCode,($_POST['pageNo']+1));
$objpage = object2array($obj['page']);
$pageCount = $objpage['pageCount']; 
$addstring = '';
$objresults = object2array($obj['results']);
foreach ($objresults as $key => $value){
    $tmpv = object2array($value);
    $addstring .= '<div class="question-guidelines post-guidelines alert sytlevm " ><div class="comment  discussion-item is-author" style="opacity: 1;"><div class="item-separator"></div>';
    $addstring .= '<div class="discussion-meta"><div class="discussion-meta-info"><a class="author-nickname discussion-author" data-hasqtip="true" aria-describedby="qtip-12" href="javascript:void(0);">';
    $addstring .= $tmpv['nickname'].'</a><span class="discussion-meta-faded">:</span></div></div>';
    $addstring .= '<div class="discussion-content " >'.$tmpv['content'].'</div>';
    $addstring .= '<div class="discussion-meta"><div class="discussion-meta-time" ><span class="discussion-meta-faded" >'.$tmpv['publish_time'].'</span></div></div></div></div>';
}
echo $addstring,'****z*x*s****',$pageCount;