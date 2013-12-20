<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if((!$_POST['username']) or (!$_POST['password']) ){
    echo 0;
    die();
}
//字符串经过任何过滤
/*当 magic_quotes_gpc 打开时，所有的 ' (单引号), " (双引号),
 \ (反斜线) and 空字符会自动转为含有反斜线的溢出字符。*/
if(!get_magic_quotes_gpc()) {
    $_POST['username'] = addslashes($_POST['username']);
    $_POST['password'] = addslashes($_POST['password']);
}
$username = $_POST['username'];
$password = $_POST['password'];
$passwordmd5 = md5($password);
$checkcode = strtolower($_POST['checkcode']);
if($checkcode != $_SESSION['checkstr']){
    echo 1;
    die();
}
unset($result);
$result = check_admin_exist($username);
if(FALSE == $result){
	  echo 2;
    die();
}
unset($result);
$result = check_admin_pass($username,$passwordmd5);
if(FALSE == $result){
	  echo 3;
    die();
}
unset($result);
$result = get_admin_by_name($username);
$_SESSION['inni_zixishi_userid'] = $result[0]['admin_id'];
unset($result);
//验证通过
$_SESSION['inni_zixishi_user'] = $username;
echo 5;