 $(document).ready(function() {
    $("input[type=button]").bind('click', function() { checkadd(); });
    $("input[type !=button]").bind('keydown', function(event) { if (event.keyCode == 13){ checkadd();return false;} });
});
var errmsg = {
    0: '标题不能为空！',
    1: '发生不知名的错误，数据丢失！',
    2: '该标题已存在！'
};
function checkadd(){
	  if(!checktitle())return false;
	  //if(!checkpassword())return false;
	  $.ajax({
			  type: 'POST',
			  url: './?a=kng_title_check',
		  	data:{kng_title:$('#kng_title').val()},
		  	cache: false,
		  	async: false,
		  	success: function(msg){
				    switch (msg) {
				    case '0':
				        $('#kng_title_span').empty();
                $('#kng_title_span').append('&nbsp;' + errmsg[1]);
				        break;
				    case '1':
                $('#kng_title_span').empty();
                $('#kng_title_span').append('&nbsp;' + errmsg[2]);
                break;
            case '2':
                document.addform.submit();
                break;
				    }
				}
		});
}
function checktitle() { 
	  if (!checkspace('#kng_title', 0)) {
        return false;
    }
    /*var sspacegz = /\s/g;
    if (sspacegz.test($('#username').attr('value'))) {
        $('#username_span').empty();
        var restr = '&nbsp;' + errmsg[1];
        $('#username_span').append(restr);
        return false;
    }*/
    $('#kng_title_span').empty();
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