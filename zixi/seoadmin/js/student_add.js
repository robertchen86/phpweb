$(document).ready(function() {
    $("input[type=button]").bind('click', function() { checkadd(); });
    $("input[type !=button]").bind('keydown', function(event) { if (event.keyCode == 13){ checkadd();return false;} });
});
var errmsg = {
	0: '所属学校不能为空！',
    1: '学号不能为空！',
    2: '姓名不能为空！',
    3: '发生不知名的错误，数据丢失！',
    4: '该学号已存在！'
    	
};
function checkadd(){
	if(!checkscode())return false;
	if(!checkcode())return false;
	if(!checkname())return false;
	$.ajax({
		type: 'POST',
		url: './?a=student_code_check',
		data:{student_code:$('#student_code').val(),student_s_code:$('#student_s_code').val()},
		cache: false,
		async: false,
		success: function(msg){
			switch (msg) {
			case '0':
				$('#student_code_span').empty();
                $('#student_code_span').append('&nbsp;' + errmsg[3]);
				break;
		    case '1':
                $('#student_code_span').empty();
                $('#student_code_span').append('&nbsp;' + errmsg[4]);
                break;
            case '2':
                document.addform.submit();
                break;
		    }
		}
	});
}
function checkscode() { 
	if (!checkspace('#student_s_code', 0)) {
        return false;
    }
    $('#student_s_code_span').empty();
    return true;
}
function checkcode() { 
	if (!checkspace('#student_code', 1)) {
        return false;
    }
    $('#student_code_span').empty();
    return true;
}
function checkname() { 
	if (!checkspace('#student_name', 2)) {
        return false;
    }
    $('#student_name_span').empty();
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