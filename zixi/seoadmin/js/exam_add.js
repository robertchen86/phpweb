 $(document).ready(function() {
    $("input[type=button]").bind('click', function() { checkadd(); });
    $("input[type !=button]").bind('keydown', function(event) { if (event.keyCode == 13){ checkadd();return false;} });
    $("#kng_id").bind('change', function(){kng_change($(this));});
});

function kng_change(it){
	$("#video_id").find("option").remove();
	//$("#video_id").append("<option value='0'>请选择视频</option>");
	$("#video_list_show").html("");
	if(it.val() == 0){

	}else{
		$.ajax({
		  type: 'GET',
		  url: './?a=exam_kng_video_get',
	  	data:{videoid:it.val()},
	  	cache: false,
	  	async: false,
	  	success: function(msg){
	  		//$("#video_id").append(msg);
	  		$("#video_list_show").html(msg);
	  		$("input[type=checkbox]").bind('change', function() { check($(this)); });
			}
		});
	}
}

function check(it){
	if($("#video_ids").val() == "" && it.attr("checked")){
		$("#video_ids").val("," + it.val() + ",");
	}else if($("#video_ids").val() != ""){
		var isin = false;
		if($("#video_ids").val().indexOf("," + it.val() + ",") >= 0){
			isin = true;
		}
		if(it.attr("checked") == true && isin == false){
			$("#video_ids").val($("#video_ids").val() + it.val() + ",");
		}else if(it.attr("checked") == false && isin == true){
			$("#video_ids").val($("#video_ids").val().replace(it.val() + ",", ""));
		}
		
	}
}

var errmsg = {
    0: '题目不能为空！',
    1: '发生不知名的错误，数据丢失！',
    2: '该题目已存在！',
    3: '答案不能为空！'
};
function checkadd(){
	  if(!checktitle())return false;
	  //if(!checkpassword())return false;
	  $.ajax({
			  type: 'POST',
			  url: './?a=exam_title_check',
		  	data:{exam_title:trim($('#exam_title').val())},
		  	cache: false,
		  	async: false,
		  	success: function(msg){
				    switch (msg) {
				    case '0':
				        $('#exam_title_span').empty();
                $('#exam_title_span').append('&nbsp;' + errmsg[1]);
				        break;
				    case '1':
                $('#exam_title_span').empty();
                $('#exam_title_span').append('&nbsp;' + errmsg[2]);
                break;
            case '2':
                document.addform.submit();
                break;
				    }
				}
		});
}
function checktitle() { 
	  if (!checkspace('#exam_title', 0)) {
        return false;
    }
    /*var sspacegz = /\s/g;
    if (sspacegz.test($('#username').attr('value'))) {
        $('#username_span').empty();
        var restr = '&nbsp;' + errmsg[1];
        $('#username_span').append(restr);
        return false;
    }*/
    $('#exam_title_span').empty();
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