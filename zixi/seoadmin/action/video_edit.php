<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if((!$_REQUEST['video_title'])  or (!$_REQUEST['video_tags'])  or (!$_REQUEST['video_id'] )){
    echo "发生不知名的错误，数据丢失！";
    echo "<meta http-equiv=refresh content='3; url=./?a=video_to_edit&page=".$_REQUEST['page']."&keyword=".$_REQUEST['keyword']."&video_kng_id=".$_REQUEST['video_kng_id']."&video_id=".$_REQUEST['video_id']."'>";
    die();
}
if(!get_magic_quotes_gpc()) {
    $_REQUEST['video_title'] = addslashes($_REQUEST['video_title']);
    $_REQUEST['video_tags'] = addslashes($_REQUEST['video_tags']);
    $_REQUEST['video_description'] = addslashes($_REQUEST['video_description']);
}

$inrow = array(
 'video_title'=> $_REQUEST['video_title'],
 'video_tags'=> $_REQUEST['video_tags'],
 'video_description'=> $_REQUEST['video_description'],
 'video_kng_id'=> $_REQUEST['kng_id'],
 'video_isrecommend'=> $_REQUEST['video_isrecommend'],
 'video_sort'=> $_REQUEST['video_sort'],
 'video_uptime'=> date('Y-m-d H:i:s'),
);
$result = update_video($_REQUEST['video_id'],$inrow);
if(FALSE == $result){
    echo "<script>alert('视频信息编辑失败！');</script>";
    echo "<meta http-equiv=refresh content='0; url=./?a=video_to_edit&page=".$_REQUEST['page']."&keyword=".$_REQUEST['keyword']."&video_kng_id=".$_REQUEST['video_kng_id']."&video_id=".$_REQUEST['video_id']."'>";
    die();
}
unset($result);
echo "<script>alert('视频信息编辑成功！');</script>";
echo "<meta http-equiv=refresh content='0; url=./?a=video_to_manage&page=".$_REQUEST['page']."&keyword=".$_REQUEST['keyword']."&video_kng_id=".$_REQUEST['video_kng_id']."'>";