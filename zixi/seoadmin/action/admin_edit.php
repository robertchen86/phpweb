<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if((!$_POST['username'])  or (!$_POST['admin_id']) ){
    echo "发生不知名的错误，数据丢失！";
    echo "<meta http-equiv=refresh content='3; url=./?a=admin_to_manage'>";
    die();
}
if(!get_magic_quotes_gpc()) {
    $_POST['username'] = addslashes($_POST['username']);
    $_POST['password'] = addslashes($_POST['password']);
    $_POST['repassword'] = addslashes($_POST['repassword']);
}
$cnt = 0;
$sql = ' select count(*) as cnt from zx_admin ';
$sql.= ' where admin_name = "'.$_POST['username'].'"';
if($_POST['admin_id']){
	  $sql.= ' and admin_id <>'.$_POST['admin_id'];
}
$result = get_info_by_sql($sql);
if(FALSE == $result){
    echo "<script>alert('账户编辑失败，请重试！');</script>";
    echo "<meta http-equiv=refresh content='0; url=./?a=admin_to_manage'>";
    die();
}
$cnt = $result[0]['cnt'];
if(0 !=  $cnt){
	  echo '账户 '.$_POST['username'].' 已经存在，添加失败！';
    echo "<meta http-equiv=refresh content='3; url=./?a=admin_to_manage'>";
    die();
}
if(trim($_POST['password']) !=  trim($_POST['repassword'])){
	  echo '两个密码不一致，添加失败！';
    echo "<meta http-equiv=refresh content='3; url=./?a=admin_to_manage'>";
    die();
}
$inrow = array(
 'admin_name'=> $_POST['username'],
 'admin_uptime'=> date('Y-m-d H:i:s'),
);
if($_POST['password'])
    $inrow['admin_password'] = md5($_POST['password']);
$result = update_admin($_POST['admin_id'],$inrow);
if(FALSE == $result){
    echo "<script>alert('账户编辑失败！');</script>";
    echo "<meta http-equiv=refresh content='0; url=./?a=admin_to_edit&id=".$_POST['admin_id']."'>";
    die();
}
unset($result);
echo "<script>alert('账户编辑成功！');</script>";
echo "<meta http-equiv=refresh content='0; url=./?a=admin_to_manage'>";




