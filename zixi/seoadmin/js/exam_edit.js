 $(document).ready(function() {
 		$("input[type=button]").eq(0).bind('click', function() { kng_video_show($(this), parseFloat($("#exam_id").val()) + 1); });
    $("input[type=button]").eq(1).bind('click', function() { checkedit(); });
    $("input[type=button]").eq(2).bind('click', function() { kng_video_show($(this), $("#exam_id").val()); });
    $("input[type=button]").eq(3).bind('click', function() { exam_del(); });
    $("input[type !=button]").bind('keydown', function(event) { if (event.keyCode == 13){ checkadd();return false;} });
    $("#kng_video_show").bind('change', function(){kng_video_show($(this), "");});
    $("#kng_id").bind('change', function(){kng_change($(this));});
    $("input[type=checkbox]").bind('change', function() { check($(this)); });
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
	  	datatype: 'json',
	  	cache: false,
	  	async: false,
	  	success: function(msg){
	  		//$("#video_id").append(msg);
	  		$("#video_list_show").html(msg);
	  		$("#video_ids").val("");
	  		$("input[type=checkbox]").bind('change', function() { check($(this)); });
			}
		});
	}
}

function kng_video_show(it, examid){
	$("#kng_id").find("option").each(function(){
			if($(this).val() == it.val())$(this).attr("selected", "selected");
	});
	//alert("./?a=exam_kng_video_show&kngid=" + $("#kng_video_show").val() + "&examid=" + $("#exam_id").val());
	
	$.ajax({
		  type: 'POST',
		  url: "./?a=exam_kng_video_show&kngid=" + $("#kng_video_show").val() + "&examid=" + examid,
	  	dataType: 'json',
	  	cache: false,
	  	async: false,
	  	success: function(json){
	  		if(json == null){
					$("#exam_id").val(0);
					$(".exam_title").html("无题");
					$("#video_list_show").html("");
					$("#exam_true").val("");
				  $("input[type=checkbox]").bind('change', function() { check($(this)); });
					return;
				}
				
				$("#exam_id").val(json.exam_id);
				$(".exam_title").html(json.exam_title);
				$("#video_list_show").html(json.video_select);
			
				$("#exam_true").val(json.exam_true);
				//$("#video_list_show").html(msg);
			  $("input[type=checkbox]").bind('change', function() { check($(this)); });
			  $("#video_ids").val(json.exam_video_id);
			  $("input[type=button]").eq(3).val(json.exam_isdel == 0 ? "删 除": "已删除");
			}
		});
		/*
	$.getJSON("./?a=exam_kng_video_show&kngid=" + $("#kng_video_show").val() + "&examid=" + examid, function(json){
		alert(json.exam_title);
		if(json == null){
			$("#exam_id").val(0);
			$(".exam_title").html("无题");
			$("#video_list_show").html("");
			$("#exam_true").val("");
		  $("input[type=checkbox]").bind('change', function() { check($(this)); });
			return;
		}
		
		$("#exam_id").val(json.exam_id);
		$(".exam_title").html(json.exam_title);
		$("#video_list_show").html(json.video_select);
	
		$("#exam_true").val(json.exam_true);
		//$("#video_list_show").html(msg);
	  $("input[type=checkbox]").bind('change', function() { check($(this)); });
	  $("#video_ids").val(json.exam_video_id);
	});
	*/
}

function exam_del(){
	//if(confirm("确定要删除？") ==  true) return;
	//alert("./?a=exam_kng_video_show&kngid=" + $("#kng_video_show").val() + "&examid=" + $("#exam_id").val() + "&act=del");
		$.ajax({
		  type: 'POST',
		  url: "./?a=exam_kng_video_show&kngid=" + $("#kng_video_show").val() + "&examid=" + $("#exam_id").val() + "&act=del",
	  	dataType: 'json',
	  	cache: false,
	  	async: false,
	  	success: function(json){
	  		alert("删除成功！");
				if(json == null){
					$("#exam_id").val(0);
					$(".exam_title").html("无题");
					$("#video_list_show").html("");
					$("#exam_true").val("");
				  $("input[type=checkbox]").bind('change', function() { check($(this)); });
					return;
				}
				$("#exam_id").val(json.exam_id);
				$(".exam_title").html(json.exam_title);
				$("#video_list_show").html(json.video_select);
			
				$("#exam_true").val(json.exam_true);
				//$("#video_list_show").html(msg);
			  $("input[type=checkbox]").bind('change', function() { check($(this)); });
			  $("#video_ids").val(json.exam_video_id);
			  $("input[type=button]").eq(3).val(json.exam_isdel == 0 ? "删 除": "已删除");
			}
		});
		/*
	$.getJSON("./?a=exam_kng_video_show&kngid=" + $("#kng_video_show").val() + "&examid=" + $("#exam_id").val() + "&act=del", function(json){
		alert("删除成功！");
		if(json == null){
			$("#exam_id").val(0);
			$(".exam_title").html("无题");
			$("#video_list_show").html("");
			$("#exam_true").val("");
		  $("input[type=checkbox]").bind('change', function() { check($(this)); });
			return;
		}
		$("#exam_id").val(json.exam_id);
		$(".exam_title").html(json.exam_title);
		$("#video_list_show").html(json.video_select);
	
		$("#exam_true").val(json.exam_true);
		//$("#video_list_show").html(msg);
	  $("input[type=checkbox]").bind('change', function() { check($(this)); });
	  $("#video_ids").val(json.exam_video_id);
	});
	*/
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
function checkedit(){
	  //if(!checktitle())return false;
	  //if(!checkpassword())return false;
	  /*
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
		*/
		//document.addform.submit();
	//	alert("./?a=exam_edit&exam_true=" + $("#exam_true").val() + "&exam_id=" + $("#exam_id").val() + "&video_ids=" + $("#video_ids").val() + "&kng_id=" + trim($("#kng_video_show").val()));
	$.ajax({
		  type: 'POST',
		  url: "./?a=exam_edit&exam_true=" + $("#exam_true").val() + "&exam_id=" + $("#exam_id").val() + "&video_ids=" + $("#video_ids").val() + "&kng_id=" + trim($("#kng_video_show").val()),
	  	dataType: 'json',
	  	cache: false,
	  	async: false,
	  	success: function(json){
				if(json == null){
					$("#exam_id").val(0);
					$(".exam_title").html("无题");
					$("#video_list_show").html("");
					$("#exam_true").val("");
				  $("input[type=checkbox]").bind('change', function() { check($(this)); });
					return;
				}
				$("#exam_id").val(json.exam_id);
				$(".exam_title").html(json.exam_title);
				$("#video_list_show").html(json.video_select);
			
				$("#exam_true").val(json.exam_true);
				//$("#video_list_show").html(msg);
			  $("input[type=checkbox]").bind('change', function() { check($(this)); });
			  $("#video_ids").val(json.exam_video_id);
			  $("input[type=button]").eq(3).val(json.exam_isdel == 0 ? "删 除": "已删除");
			}
		});
	/*
		$.getJSON("./?a=exam_edit&exam_true=" + $("#exam_true").val() + "&exam_id=" + $("#exam_id").val() + "&video_ids=" + $("#video_ids").val() + "&kng_id=" + trim($("#kng_video_show").val()) , function(json){
			if(json == null){
				$("#exam_id").val(0);
				$(".exam_title").html("无题");
				$("#video_list_show").html("");
				$("#exam_true").val("");
			  $("input[type=checkbox]").bind('change', function() { check($(this)); });
				return;
			}
			$("#exam_id").val(json.exam_id);
			$(".exam_title").html(json.exam_title);
			$("#video_list_show").html(json.video_select);
		
			$("#exam_true").val(json.exam_true);
			//$("#video_list_show").html(msg);
		  $("input[type=checkbox]").bind('change', function() { check($(this)); });
		  $("#video_ids").val(json.exam_video_id);
		});
		
		*/
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