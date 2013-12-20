<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if(!$_POST['kng_title']){
    echo "发生不知名的错误，数据丢失！";
    echo "<meta http-equiv=refresh content='3; url=./?a=kng_to_add'>";
    die();
}
if(!get_magic_quotes_gpc()) {
    $_POST['kng_title'] = addslashes($_POST['kng_title']);
    $_POST['kng_description'] = addslashes($_POST['kng_description']);
}
$sql = ' select count(*) as cnt from zx_knowledge ';
$sql.= ' where kng_title = "'.$_POST['kng_title'].'"';
$result = get_info_by_sql($sql);
if(FALSE == $result){
    echo "<script>alert('知识点添加失败！');</script>";
    echo "<meta http-equiv=refresh content='0; url=./?a=kng_to_add'>";
    die();
}
$cnt = $result[0]['cnt'];
if(0 !=  $cnt){
	  echo '知识点 '.$_POST['kng_title'].' 已经存在，添加失败！';
    echo "<meta http-equiv=refresh content='3; url=./?a=kng_to_add'>";
    die();
}

$inrow = array(
 'kng_title'=> $_POST['kng_title'],
 'kng_description'=> $_POST['kng_description'],
 'kng_isrecommend'=> $_POST['kng_isrecommend'],
 'kng_foot_id'=> $_POST['kng_foot_id'],
 'kng_grade'=> 1,
 'kng_sort'=> (int)$_POST['kng_sort'],
 'kng_addtime'=> date('Y-m-d H:i:s'),
);
if($_POST['kng_foot_id']){
	 $tmpar = explode('_', $_POST['kng_foot_id']);
	 $inrow['kng_foot_id']=$tmpar[0];
	 $inrow['kng_grade']=((int)$tmpar[1]+1);
}
$result = add_kng($inrow);
if(FALSE == $result){
    echo "<script>alert('知识点添加失败！');</script>";
    echo "<meta http-equiv=refresh content='0; url=./?a=kng_to_add'>";
    die();
}
unset($result);
echo "<script>alert('知识点添加成功！');</script>";
echo "<meta http-equiv=refresh content='0; url=./?a=kng_to_manage'>";