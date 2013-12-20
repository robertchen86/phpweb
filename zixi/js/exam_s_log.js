$(document).ready(function() {
 	  $("input[type=checkbox]").bind('change', function() { check(this); });
 	  //$("#kng_set_id").bind('change', function(){kng_set_change($(this));});
 	  $("#btn_save").bind('click', function(){btn_save();});
});
function btn_save(){
	  var checkboxs = $("input[type=checkbox]");
	  var c_count = 0;
	  for(var i = 0; i < checkboxs.length ; i++) {
    	if(checkboxs[i].checked == true)c_count += 1;
    }
	  if(c_count > 4){alert('知识点最多选择4个！');return false;}
	  document.exam_log.submit();
}
function check(it){
	var checkboxs = $("input[type=checkbox]");
	var string_t = '';
	for(var i = 0; i < checkboxs.length ; i++) {
    	if(checkboxs[i].checked == true)string_t +=',' + checkboxs[i].value;
  }
  $('#kng_ids').attr('value',string_t);
}
/*
function kng_set_change(it){
	//$("#video_id").find("option").remove();
	//$("#video_id").append("<option value='0'>请选择视频</option>");
	$("#video_list_show").html("");
	if(it.val() == 0){
	}else{
		$.ajax({
		  type: 'POST',
		  url: $("#web_site").val()+'/?a=exam_kng_video_get',
	  	data:{videoid:it.val()},
	  	cache: false,
	  	async: false,
	  	success: function(msg){
	  		$("#video_list_show").html(msg);
	  		$("#video_ids").val("");
	  		$("input[type=checkbox]").bind('change', function() { check($(this)); });
			}
		});
	}
}*/
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