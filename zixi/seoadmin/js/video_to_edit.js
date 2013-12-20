 $(document).ready(function() {
    $("input[type=button]").bind('click', function() { checkEd(); });
});
var errmsg = {
    0: '标题不能为空！',
    1: '标签不能为空！',
    2: '该标题已存在！'
};
function checkTitle(){
	  if (!checkspace('#video_title', 0)) {
        return false;
    }
    $('#video_title_span').empty();
    return true;
}
function checkTags(){
	  if (!checkspace('#video_tags', 1)) {
        return false;
    }
    //$('#video_tags').val(trimAll($('#video_tags').val()));
    $('#video_tags').val(trimd($('#video_tags').val()));
    $('#video_tags_span').empty();
    return true;
}
function checkEd(){
	  if(!checkTitle())return false;
	  if(!checkTags())return false;
	  document.edform.submit();
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
function trimAll(str) {
    return str.replace(/\s/g, '');
}
function trimd(str) {
    return str.replace(/,+$|^,+/g, '');
}