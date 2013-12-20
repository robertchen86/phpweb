$(document).ready(function() {
	$("#btn_save").bind('click', function() { checkadd(); });
    $("input[type !=button]").bind('keydown', function(event) { if (event.keyCode == 13){ checkadd();return false;} });
});
var errmsg = {
    0: '学校名称不能为空！',
    1: '发生不知名的错误，数据丢失！',
    2: '该学校已存在！'
};
function checkadd(){
	if(!checkname())return false;
	$.ajax({
		type: 'POST',
		url: './?a=school_name_check',
		data:{school_name:$('#school_name').val(),school_id:$('#school_id').val()},
		cache: false,
		async: false,
		success: function(msg){
			switch (msg) {
			case '0':
				$('#school_name_span').empty();
                $('#school_name_span').append('&nbsp;' + errmsg[1]);
				break;
		    case '1':
                $('#school_name_span').empty();
                $('#school_name_span').append('&nbsp;' + errmsg[2]);
                break;
            case '2':
                document.addform.submit();
                break;
		    }
		}
	});
}
function checkname() { 
	if (!checkspace('#school_name', 0)) {
        return false;
    }
    $('#school_name_span').empty();
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