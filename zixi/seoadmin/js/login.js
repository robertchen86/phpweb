$(document).ready(function() {
    $('#btg_login').bind('click', function() { dologin(); });
    $("input[type !=image]").bind('keydown', function(event) { if (event.keyCode == 13){ dologin();return false;} });
    $('#username').bind('blur', function() { checkusername(); });
    $('#password').bind('blur', function() { checkpassword(); });
    $('#checkcode').bind('blur', function() { checkcheckcode(); });
});
var errmsg = {
    0: '登录用户名不能为空！',
    1: '登录用户名中存在空格！',
    2: '登录密码不能为空！',
    3: '登录验证码不能为空！',
    4: '登录验证码不能小于五位！',
    5: '发生不知名的错误，数据丢失！',
    6: '验证码不正确！',
    7: '用户名不正确！',
    8: '密码不正确！'
};
function dologin() {
	  if ((!checkusername()) || (!checkpassword()) || (!checkcheckcode())) {
	  	  return false;
	  }
	  //$('#username_span').empty();
	  //$('#password_span').empty();
    $.post("./?a=login", { username: $("#username").attr('value'), password: $("#password").attr('value'), checkcode: $("#checkcode").attr('value') }, function(msg) {
            switch (msg) {
                case '0':
                    //$('#username_span').empty();
                    //$('#username_span').append('&nbsp;&nbsp;&nbsp;' + errmsg[5]);
                    alert(errmsg[5]);
                    break;
                case '1':
                    //$('#username_span').empty();
                    //$('#username_span').append('&nbsp;&nbsp;&nbsp;' + errmsg[6]);
                    alert(errmsg[6]);
                    break;
                case '2':
                    //$('#username_span').empty();
                   // $('#username_span').append('&nbsp;&nbsp;&nbsp;' + errmsg[7]);
                   alert(errmsg[7]);
                    break;
                case '3':
                    //$('#password_span').empty();
                    //$('#password_span').append('&nbsp;&nbsp;&nbsp;' + errmsg[8]);
                    alert(errmsg[8]);
                    break;
                case '4':
                    //$('#username_span').empty();
                    //$('#username_span').append('&nbsp;&nbsp;&nbsp;' + errmsg[5]);
                    break;
                case '5':
                   // document.getElementById('loginbox').style.display = "none";
                    //document.getElementById('info').style.display = "block";
                    window.location.href = "./?a=cpanel";
                    break;
            }
        });
}
function checkusername() {  //检查登录用户名
	  if (!checkspace('#username', 0)) {
        return false;
    }
    var sspacegz = /\s/g;
    if (sspacegz.test($('#username').attr('value'))) {
        ///$('#username_span').empty();
        //var restr = '&nbsp;&nbsp;&nbsp;' + errmsg[1];
        //$('#username_span').append(restr);
        alert(errmsg[1]);
        return false;
    }
    //$('#username_span').empty();
    return true;
}
function checkpassword() {  //检查登录密码
	  if (!checkspace('#password', 2)) {
        return false;
    }
	  //$('#password_span').empty();
    return true;
}
function checkcheckcode() {  //检查登录验证码
    if (trim($("#checkcode").attr('value')) == '') {
        alert(errmsg[3]);
        return false;
    }
    if (trim($("#checkcode").attr('value')).length < 5) {
        alert(errmsg[4]);
        return false;
    }
    return true;
}
function checkspace(id, num) {
    var checkobj = $(id).attr('value');
    checkobj = trim(checkobj);
    //var checkobjspan = id + '_span';
    if (checkobj == '') {
        //$(checkobjspan).attr('class', 'txtallerr');
       // $(checkobjspan).empty();
       // var restr = '&nbsp;&nbsp;&nbsp;' + errmsg[num];
        //$(checkobjspan).append(restr);
        alert(errmsg[num]);
        return false;
    }
    //$(checkobjspan).empty();
    //$(checkobjspan).append('&nbsp;&nbsp;&nbsp;');
    //$(checkobjspan).attr('class', 'txtallright');
    return true;
}
/*
function checkspace(id, num) {
    var checkobj = $(id).attr('value');
    checkobj = trim(checkobj);
    //var checkobjspan = id + '_span';
    if (checkobj == '') {
        //$(checkobjspan).empty();
        //var restr = '&nbsp;' + errmsg[num];
        //$(checkobjspan).append(restr);
        alert(errmsg[num]);
        return false;
    }
    //$(checkobjspan).empty();
    return true;
}
*/
//去左右空格
function trim(str) {
    return str.replace(/\s+$|^\s+/g, '');
}