$(document).ready(function() {
	  $("input[type=button]").bind('click', function() { checkAll(); });
});
var errmsg = {
    0: '',
    1: '邮箱不能为空！',
    2: '邮箱格式不正确！',
    3: '登录密码不能为空！',
    4: '该账号邮箱不存在！',
    5: '该账号密码不正确！'
};
function checkAll(){
	  if(!checkEmail())return false;
	  if(!checkPassword())return false;
	  $.ajax({
			  type: 'POST',
			  url: './?a=login_check',
		  	data:{member_email:$('#member_email').val(),password:$('#password').val()},
		  	cache: false,
		  	async: false,
		  	success: function(msg){
				    switch (msg) {
				    case '0':
				        $('#error-text').empty();
                $('#error-text').append('&nbsp;' + errmsg[3]);
				        break;
				    case '1':
				        $('#error-text').empty();
                $('#error-text').append('&nbsp;' + errmsg[4]);
                break;
            case '2':
                $('#error-text').empty();
                $('#error-text').append('&nbsp;' + errmsg[5]);
				        break;
				    case '3':
				        document.loginForm.submit();
                break;
            }
				}
		});
}
function checkEmail() { 
	  if (!checkSpace('member_email', 1))return false;
	  if(!isEmail($('#member_email').val())){
	  	  $('#error-text').empty();
        $('#error-text').append(errmsg[2]);
	  	return false;
	  }
    $('#error-text').empty();
    return true;
}
function checkPassword() { 
	  if (!checkSpace('password', 3))return false;
    $('#error-text').empty();
    return true;
}
function isEmail(strEmail) {
    if (strEmail.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) != -1)
        return true;
    return false;
}
function checkSpace(id, num) {
    var objval = $('#'+id).val();
    objval = trim(objval);
    var checkobjspan = '#error-text';
    if (objval == '') {
        $(checkobjspan).empty();
        var restr = '&nbsp;' + errmsg[num];
        $(checkobjspan).append(restr);
        return false;
    }
    $(checkobjspan).empty();
    return true;
}
//去左右空格
function trim(str) {
    return str.replace(/\s+$|^\s+/g, '');
}