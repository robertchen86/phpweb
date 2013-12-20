 $(document).ready(function() {
    $("input[type=button]").bind('click', function() { checkadd(); });
    $("input[type !=button]").bind('keydown', function(event) { if (event.keyCode == 13){ checkadd();return false;} });
});
var errmsg = {
    0: '账户不能为空！',
    1: '账户密码不能为空！',
    2: '两次密码不一致！',
    3: '发生不知名的错误，数据丢失！',
    4: '该账户已存在！'
};
function checkadd(){
	  if(!checkusername())return false;
	  if(!checkpassword())return false;
	  $.ajax({
			  type: 'POST',
			  url: './?a=admin_name_check',
		  	data:{username:$('#username').val(),id:$('#admin_id').val()},
		  	cache: false,
		  	async: false,
		  	success: function(msg){
				    switch (msg) {
				    case '0':
				        $('#username_span').empty();
                $('#username_span').append('&nbsp;' + errmsg[3]);
				        break;
				    case '1':
                $('#username_span').empty();
                $('#username_span').append('&nbsp;' + errmsg[4]);
                break;
            case '2':
                document.addform.submit();
                break;
				    }
				}
		});
}
function checkusername() { 
	  if (!checkspace('#username', 0)) {
        return false;
    }
    /*var sspacegz = /\s/g;
    if (sspacegz.test($('#username').attr('value'))) {
        $('#username_span').empty();
        var restr = '&nbsp;' + errmsg[1];
        $('#username_span').append(restr);
        return false;
    }*/
    $('#username_span').empty();
    return true;
}
function checkpassword() { 
	  /*if (!checkspace('#password', 1)) {
        return false;
    }*/
	  $('#password_span').empty();
	  if(trim($('#password').val()) != trim($('#repassword').val())){	
		    
		    $('#repassword_span').empty();
        var restr = '&nbsp;' + errmsg[2];
        $('#repassword_span').append(restr);
        return false;
	  }
	  $('#repassword_span').empty();
    return true;
}
function checkspace(id, num) {
    var checkobj = $(id).attr('value');
    checkobj = trim(checkobj);
    var checkobjspan = id + '_span';
    if (checkobj == '') {
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