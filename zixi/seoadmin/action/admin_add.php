<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if((!$_POST['username']) or (!$_POST['password']) or (!$_POST['repassword']) ){
    echo "发生不知名的错误，数据丢失！";
    echo "<meta http-equiv=refresh content='3; url=./?a=admin_to_add'>";
    die();
}
if(!get_magic_quotes_gpc()) {
    $_POST['username'] = addslashes($_POST['username']);
    $_POST['password'] = addslashes($_POST['password']);
    $_POST['repassword'] = addslashes($_POST['repassword']);
}
$result = get_admin_name_exist_count($_POST['username']);
if(0 !=  $result){
	  echo '账户 '.$_POST['username'].' 已经存在，添加失败！';
    echo "<meta http-equiv=refresh content='3; url=./?a=admin_to_add'>";
    die();
}
if($_POST['password'] !=  $_POST['repassword']){
	  echo '两个密码不一致，添加失败！';
    echo "<meta http-equiv=refresh content='3; url=./?a=admin_to_add'>";
    die();
}
$inrow = array(
 'admin_name'=> $_POST['username'],
 'admin_password'=> md5($_POST['password']),
 'admin_addtime'=> date('Y-m-d H:i:s'),
);
$result = add_admin($inrow);
if(FALSE == $result){
    echo "<script>alert('账户添加失败！');</script>";
    echo "<meta http-equiv=refresh content='0; url=./?a=admin_to_add'>";
    die();
}
unset($result);
echo "<script>alert('账户添加成功！');</script>";
echo "<meta http-equiv=refresh content='0; url=./?a=admin_to_manage'>";




