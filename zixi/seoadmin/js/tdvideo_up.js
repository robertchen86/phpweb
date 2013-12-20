 $(document).ready(function() {
    $('#btn_up').bind('click', function() { checkUp(); });
});
var errmsg = {
    0: '请选择上传视频文件！',
    1: '视频格式不正确或者不支持！',
    2: '视频上传失败！',
    3: '视频上传成功，等待土豆审核！'
};
function checkUp(){
	  if (!checkspace('#upfile', 0)) {
        return false;
    }
    $('#uptab').hide();
    $('#updiv').show();
    document.upform.submit();
 
   /* var upFile = $('#upFile').attr('value');
	  var extension = upFile.substr(upFile.lastIndexOf(".") + 1);
	  if(extension == ""){
      	$('#upFile_span').empty();
        var restr = '&nbsp;' + errmsg[1];
        $('#upFile_span').append(restr);
      	return false;
    }
    if (!(extension == "jpg" || extension == "jpeg" || extension == "png" || extension == "gif" || extension == "bmp")){
      	$('#upFile_span').empty();
        var restr = '&nbsp;' + errmsg[1];
        $('#upFile_span').append(restr);
      	return false;  	
    }*/
	  //
	  
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