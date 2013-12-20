<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
if(!get_magic_quotes_gpc()) {
    $_POST['account_name'] = addslashes($_POST['account_name']);
    $_POST['account_password'] = addslashes($_POST['account_password']);
    $_POST['app_key'] = addslashes($_POST['app_key']);
    $_POST['app_secret'] = addslashes($_POST['app_secret']);
    $_POST['account_access_token'] = addslashes($_POST['account_access_token']);
    $_POST['account_access_token_secret'] = addslashes($_POST['account_access_token_secret']);
}
$inrow = array(
 'account_name'=> $_POST['account_name'],
 'account_password'=> $_POST['account_password'],
 'account_app_key'=> $_POST['app_key'],
 'account_app_secret'=> $_POST['app_secret'],
 'account_type'=> $_POST['type'],
 'account_access_token'=> $_POST['account_access_token'],
 'account_access_token_secret'=> $_POST['account_access_token_secret'],
 'account_uptime'=> date('Y-m-d H:i:s'),
);
if(!$_POST['id']) {
	  $result = add_account($inrow);
	  if(FALSE == $result){
        echo "<script>alert('账户更新设置失败！');</script>";
        echo "<meta http-equiv=refresh content='0; url=./?a=account_to_set&type=".$_POST['type']."'>";
        die();
    }
    unset($result);
}else{
	  $result = update_account($_POST['id'],$inrow);
    if(FALSE == $result){
        echo "<script>alert('账户更新设置失败！');</script>";
        echo "<meta http-equiv=refresh content='0; url=./?a=account_to_set&type=".$_POST['type']."'>";
        die();
    }
    unset($result);
}
echo "<script>alert('账户更新成功！');</script>";
echo "<meta http-equiv=refresh content='0; url=./?a=account_to_set&type=".$_POST['type']."'>";