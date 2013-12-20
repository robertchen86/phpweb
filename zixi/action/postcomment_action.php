<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
/***验证区*s**/
if((!$_REQUEST['comment']) or (!$_REQUEST['video_id']) or (!$_REQUEST['member_id'])){
    echo 0;
    die();
}
if(!get_magic_quotes_gpc()) {
   $_REQUEST['comment'] = addslashes($_POST['comment']);
}
$sql = ' select count(*) as cnt from zx_video_comment ';
$sql.= ' where vcomment_member_id = '.$_POST['member_id'];
$sql.= ' and vcomment_video_id = '.$_POST['video_id'];
$sql.= " and (vcomment_addtime like '".date('Y-m-d')."%' )";
$result = get_info_by_sql($sql);
if(FALSE == $result){
    echo 0;
    die();
}
$cnt = $result[0]['cnt'];
if(0 !=  $cnt){
	  echo 1;
    die();
}
$ins_date = date('Y-m-d H:i:s');
$inrow = array(
    'vcomment_member_id' => $_REQUEST['member_id'],
    'vcomment_video_id' => $_REQUEST['video_id'],
    'vcomment_content' => $_REQUEST['comment'],
    'vcomment_addtime' => $ins_date,
);
$result = add_vcomment($inrow);
if(FALSE == $result){
    echo 0;
    die();
}
$cnt = 0;
$sql = ' select count(*) as cnt from zx_video_comment ';
$sql.= ' where  vcomment_video_id = '.$_REQUEST['video_id'];
$sql.= ' and  vcomment_member_id = '.$_REQUEST['member_id'];
$result = get_info_by_sql($sql);
if(FALSE == $result){
    echo 0;
    die();
}
$cnt = $result[0]['cnt'];
$sql = 'select a.vcomment_id,a.vcomment_member_id,a.vcomment_content,a.vcomment_addtime,
	  b.member_name  from zx_video_comment a, zx_member b ';
$sql.= ' where a.vcomment_member_id = b.member_id ';
$sql.= ' and  a.vcomment_video_id = '.$_REQUEST['video_id'];
$sql.= ' and  a.vcomment_member_id = '.$_REQUEST['member_id'];
$sql.= ' and  a.vcomment_addtime = "'.$ins_date.'"';
//$sql.= ' order by a.vcomment_addtime desc ';
$result = get_info_by_sql($sql);


$ok_echo = '
<div class="question-guidelines post-guidelines alert sytlevm " id="vcitem_'.$cnt.'">
      	<div class="comment  discussion-item is-author" style="opacity: 1;">
        <div class="item-separator"></div>
        <div class="discussion-meta">
        	<div class="discussion-meta-info">
        		<a class="author-nickname discussion-author" data-hasqtip="true" aria-describedby="qtip-12" href="javascript:void(0);">
        		'.$result[0]['member_name'].'
            </a>
            <span class="discussion-meta-faded">:</span>
          </div>
          <div class="discussion-meta-controls" id="meta-controls_'.$cnt.'"><input type="hidden" id="vcid_'.$cnt.'" value="'.$result[0]['vcomment_id'].'" >
              <span class="discussion-meta-separator">•</span>
              <span class="mod-tools" >
              <a href="javascript:void(0);showedit('.$cnt.')" class="edit">编辑</a>
              <span class="discussion-meta-separator">•</span>
              <a href="javascript:void(0);dodel('.$cnt.')" class="delete">删除</a>
              </span>
          </div>
        </div>
        <div class="discussion-content" id="discussion-content_'.$cnt.'">'.$result[0]['vcomment_content'].'</div>
        <div class="discussion-meta">
        	 <div class="discussion-meta-time">
        	 	  <span class="discussion-meta-faded" d="meta-faded_'.$cnt.'">'.$result[0]['vcomment_addtime'].'</span>
        	 </div>
        </div>
        </div>
        <textarea class="discussion-text open" id="text-edit_'.$cnt.'"  style="height: 30px;display: none;" tabindex="1" placeholder="">'.$result[0]['vcomment_addtime'].'</textarea>
        <div class="discussion-controls "id="discussion-controls_'.$cnt.'"  style="display: none;">
         <input class="simple-button primary discussion-cancel" type="button" value="&nbsp;取&nbsp;&nbsp;消&nbsp;" tabindex="3" onclick="closeedit('.$cnt.')">
         &nbsp;&nbsp;&nbsp;&nbsp;
         <input class="simple-button primary discussion-submit" type="button" value="&nbsp;提&nbsp;&nbsp;交&nbsp;" tabindex="2" onclick="postedit('.$cnt.')">
        </div>
       </div>';
echo $ok_echo;