<?php
/* 全局配置文件 */
// request token 获取地址
$request_token_url = 'http://api.tudou.com/auth/request_token.oauth';
// 用户授权页面
$authorize_url = 'http://api.tudou.com/auth/authorize.oauth';
// access token 获取地址
$access_token_url = 'http://api.tudou.com/auth/access_token.oauth';
// OAuth 验证方法，这里选择 HMAC_SHA1
$hmac_method = new OAuthSignatureMethod_HMAC_SHA1();
$sig_method = $hmac_method;