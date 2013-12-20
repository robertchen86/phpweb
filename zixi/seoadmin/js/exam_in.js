 $(document).ready(function() {
    $("input[type=button]").bind('click', function() { checkadd(); });
    $("input[type !=button]").bind('keydown', function(event) { if (event.keyCode == 13){ checkadd();return false;} });
});

var errmsg = {
    0: '图片存放文件夹名不能为空！',
    1: '请选择文件！',
};
function checkadd(){
	  if (trim($('#map_filename').val()) == '') {
	  	  alert(errmsg[0]);
        return false;
    }
    if (trim($('#infile').val()) == '') {
	  	  alert(errmsg[1]);
        return false;
    }
	  document.addform.submit();
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